<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\File;

class SitemapWidget extends Widget
{
    protected static string $view = 'filament.widgets.sitemap-widget';
    
    protected int | string | array $columnSpan = 'full';
    
    protected static ?int $sort = 1;
    
    public ?string $sitemapContent = null;
    
    protected $listeners = ['sitemap-generated' => 'loadSitemap'];
    
    public static function canView(): bool
    {
        return request()->routeIs('filament.admin.pages.sitemap-manager');
    }
    
    public function mount(): void
    {
        $this->loadSitemap();
    }
    
    public function loadSitemap(): void
    {
        $sitemapPath = public_path('sitemap.xml');
        
        if (File::exists($sitemapPath)) {
            $this->sitemapContent = File::get($sitemapPath);
        } else {
            $this->sitemapContent = null;
        }
    }
    
    public function getSitemapExists(): bool
    {
        return File::exists(public_path('sitemap.xml'));
    }
    
    public function getSitemapSize(): string
    {
        $sitemapPath = public_path('sitemap.xml');
        
        if (!File::exists($sitemapPath)) {
            return '0 KB';
        }
        
        $size = File::size($sitemapPath);
        
        if ($size < 1024) {
            return $size . ' B';
        } elseif ($size < 1048576) {
            return round($size / 1024, 2) . ' KB';
        } else {
            return round($size / 1048576, 2) . ' MB';
        }
    }
    
    public function getLastModified(): ?string
    {
        $sitemapPath = public_path('sitemap.xml');
        
        if (!File::exists($sitemapPath)) {
            return null;
        }
        
        return File::lastModified($sitemapPath);
    }
}


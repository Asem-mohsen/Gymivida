<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use App\Filament\Widgets\SitemapWidget;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SitemapManager extends Page
{
    protected static string $view = 'filament.pages.sitemap-manager';
    
    protected static ?string $navigationIcon = 'heroicon-o-map';
    
    protected static ?string $navigationLabel = 'Sitemap Manager';
    
    public function getTitle(): string
    {
        return 'Sitemap Manager';
    }
    
    public function getHeading(): string
    {
        return 'Sitemap Manager';
    }
    
    public function getSubheading(): ?string
    {
        return 'Generate and manage your website sitemap';
    }
    
    protected function getHeaderActions(): array
    {
        return [
            Action::make('generate')
                ->label('Generate Sitemap')
                ->icon('heroicon-o-arrow-path')
                ->color('primary')
                ->requiresConfirmation()
                ->modalHeading('Generate Sitemap')
                ->modalDescription('This will generate a new sitemap.xml file. This may take a few moments.')
                ->modalSubmitActionLabel('Generate')
                ->action(function () {
                    try {
                        Artisan::call('sitemap:generate');
                        
                        Notification::make()
                            ->title('Sitemap generated successfully')
                            ->success()
                            ->send();
                        
                        // Refresh the widget by dispatching an event
                        $this->dispatch('sitemap-generated');
                    } catch (\Exception $e) {
                        Log::error('Failed to generate sitemap: ' . $e->getMessage());
                        Notification::make()
                            ->title('Failed to generate sitemap')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
            
            Action::make('download')
                ->label('Download Sitemap')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->visible(fn () => File::exists(public_path('sitemap.xml')))
                ->action(function () {
                    return $this->downloadSitemap();
                }),
        ];
    }
    
    protected function getHeaderWidgets(): array
    {
        return [
            SitemapWidget::class,
        ];
    }
    
    protected function downloadSitemap(): StreamedResponse | \Illuminate\Http\RedirectResponse
    {
        $sitemapPath = public_path('sitemap.xml');
        
        if (!File::exists($sitemapPath)) {
            Notification::make()
                ->title('Sitemap file not found')
                ->body('Please generate the sitemap first.')
                ->warning()
                ->send();
            
            return redirect()->back();
        }
        
        $fileName = 'sitemap.xml';
        
        return response()->streamDownload(function () use ($sitemapPath) {
            echo File::get($sitemapPath);
        }, $fileName, [
            'Content-Type' => 'application/xml',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }
}


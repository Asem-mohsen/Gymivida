<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate sitemap.xml for all gyms and their content';

    public function handle()
    {
        $domain = config('app.url');
        $path = public_path('sitemap.xml');
        $supportedLocales = ['en', 'ar'];

        $sitemap = Sitemap::create();

        // Routes that should be included in sitemap
        $routes = [
            'home' => ['priority' => 1.0, 'changeFrequency' => Url::CHANGE_FREQUENCY_DAILY],
            'privacy' => ['priority' => 0.6, 'changeFrequency' => Url::CHANGE_FREQUENCY_MONTHLY],
            'terms' => ['priority' => 0.6, 'changeFrequency' => Url::CHANGE_FREQUENCY_MONTHLY],
        ];

        // Add routes for each locale
        foreach ($supportedLocales as $locale) {
            foreach ($routes as $routeName => $config) {
                try {
                    $url = route($routeName, ['locale' => $locale]);
                    $sitemap->add(Url::create($url)
                        ->setPriority($config['priority'])
                        ->setChangeFrequency($config['changeFrequency'])
                        ->setLastModificationDate(now()));
                } catch (\Exception $e) {
                    // Route might not exist, skip it
                    continue;
                }
            }
        }

        $sitemap->writeToFile($path);

        $this->info("Sitemap generated successfully: {$path}");
        $this->info("Included " . count($sitemap->getTags()) . " URLs");
        return 0;
    }
}

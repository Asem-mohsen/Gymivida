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

        $sitemap = Sitemap::create();

        // Add main homepage
        $sitemap->add(Url::create($domain . '/')
            ->setPriority(1.0)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));

        // Add privacy page
        $sitemap->add(Url::create($domain . '/privacy')
            ->setPriority(0.6)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));

        // Add terms page
        $sitemap->add(Url::create($domain . '/terms')
            ->setPriority(0.6)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));


        $sitemap->writeToFile($path);

        $this->info("Sitemap generated successfully: {$path}");
        return 0;
    }

}

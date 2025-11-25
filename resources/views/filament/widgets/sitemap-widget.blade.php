<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Sitemap Content
        </x-slot>
        
        <x-slot name="description">
            @if($this->getSitemapExists())
                <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400 mb-4">
                    <span>
                        <strong>Size:</strong> {{ $this->getSitemapSize() }}
                    </span>
                    @if($this->getLastModified())
                        <span>
                            <strong>Last Modified:</strong> {{ \Carbon\Carbon::createFromTimestamp($this->getLastModified())->format('Y-m-d H:i:s') }}
                        </span>
                    @endif
                </div>
            @else
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    No sitemap has been generated yet. Click the "Generate Sitemap" button above to create one.
                </p>
            @endif
        </x-slot>

        @if($this->getSitemapExists() && $this->sitemapContent)
            <div class="relative">
                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 overflow-auto max-h-96">
                    <pre class="text-xs text-gray-800 dark:text-gray-200 whitespace-pre-wrap break-words"><code>{{ $this->sitemapContent }}</code></pre>
                </div>
            </div>
        @else
            <div class="text-center py-8 text-gray-500 dark:text-gray-400" style="justify-self: center; width: 100px;">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="mt-2">No sitemap file found</p>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>


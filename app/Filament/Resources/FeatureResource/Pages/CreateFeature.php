<?php

namespace App\Filament\Resources\FeatureResource\Pages;

use App\Filament\Resources\FeatureResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFeature extends CreateRecord
{
    protected static string $resource = FeatureResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['name'] = [
            'en' => $data['name_en'] ?? '',
            'ar' => $data['name_ar'] ?? '',
        ];
        $data['description'] = [
            'en' => $data['description_en'] ?? '',
            'ar' => $data['description_ar'] ?? '',
        ];
        unset($data['name_en'], $data['name_ar'], $data['description_en'], $data['description_ar']);

        return $data;
    }
}

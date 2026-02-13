<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function mutateFormDataBeforeFill(array $data): array
    {
        $data['name_en'] = $this->record->getTranslation('name', 'en');
        $data['name_ar'] = $this->record->getTranslation('name', 'ar');
        $data['description_en'] = $this->record->getTranslation('description', 'en');
        $data['description_ar'] = $this->record->getTranslation('description', 'ar');

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
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

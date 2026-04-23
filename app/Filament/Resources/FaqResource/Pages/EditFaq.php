<?php

namespace App\Filament\Resources\FaqResource\Pages;

use App\Enums\FaqKind;
use App\Filament\Resources\FaqResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFaq extends EditRecord
{
    protected static string $resource = FaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function mutateFormDataBeforeFill(array $data): array
    {
        if (isset($data['kind']) && $data['kind'] instanceof FaqKind) {
            $data['kind'] = $data['kind']->value;
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (($data['kind'] ?? null) === FaqKind::FreeTrial->value) {
            $data['answer_en'] = null;
            $data['answer_ar'] = null;
            $data['documentation_type'] = null;
        }

        return $data;
    }
}

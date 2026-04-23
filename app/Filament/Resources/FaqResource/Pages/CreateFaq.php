<?php

namespace App\Filament\Resources\FaqResource\Pages;

use App\Enums\FaqKind;
use App\Filament\Resources\FaqResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFaq extends CreateRecord
{
    protected static string $resource = FaqResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (($data['kind'] ?? null) === FaqKind::FreeTrial->value) {
            $data['answer_en'] = null;
            $data['answer_ar'] = null;
            $data['documentation_type'] = null;
        }

        return $data;
    }
}

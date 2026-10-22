<?php

declare(strict_types=1);

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class FinalSubmitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'gym_type' => ['nullable', 'in:mixed,ladies_only,men_only'],
            'target_audience' => ['nullable', 'array'],
            'target_audience.*' => ['in:youth,professionals,luxury,families,seniors,athletes,beginners,general'],
            'amenities' => ['nullable', 'array'],
            'amenities.*' => ['in:personal_training,group_classes,pool,sauna,spa,cafe,parking,childcare,lockers,wifi,twentyfour_seven,crossfit'],
            'additional_info' => ['nullable', 'string', 'max:1000'],
            'confirm' => ['accepted'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->request->remove('owner_password');
        $this->request->remove('owner_password_confirmation');
    }
}

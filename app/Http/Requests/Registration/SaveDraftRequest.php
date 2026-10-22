<?php

declare(strict_types=1);

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class SaveDraftRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_step' => ['nullable', 'integer', 'min:1', 'max:5'],
            'owner_name' => ['nullable', 'string', 'max:255'],
            'owner_email' => ['nullable', 'email', 'max:255'],
            'owner_phone' => ['nullable', 'string', 'max:50'],
            'owner_gender' => ['nullable', 'in:male,female'],
            'owner_password' => ['nullable', 'string', 'min:8', 'confirmed'],
            // Must be listed so validated() forwards it to Website B's confirmed rule.
            'owner_password_confirmation' => ['nullable', 'string'],
            'gym_name' => ['nullable', 'array'],
            'gym_name.en' => ['nullable', 'string', 'max:255'],
            'gym_name.ar' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'regex:/^[a-z0-9-]*$/'],
            'size' => ['nullable', 'in:1-10,10-50,50-100,100-1000'],
            'address' => ['nullable', 'array'],
            'description' => ['nullable', 'array'],
            'contact_email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
            'external_plan_id' => ['nullable', 'string'],
            'plan_name' => ['nullable', 'string'],
            'billing_cycle' => ['nullable', 'in:monthly,yearly'],
            'facebook_url' => ['nullable', 'url'],
            'instagram_url' => ['nullable', 'url'],
            'x_url' => ['nullable', 'url'],
            'gym_type' => ['nullable', 'in:mixed,ladies_only,men_only'],
            'target_audience' => ['nullable', 'array'],
            'amenities' => ['nullable', 'array'],
            'additional_info' => ['nullable', 'string', 'max:1000'],
        ];
    }

}

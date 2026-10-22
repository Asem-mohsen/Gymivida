<?php

declare(strict_types=1);

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubmitStepRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $step = (int) $this->input('step', 1);

        return match ($step) {
            1 => [
                'step' => ['required', 'integer', 'in:1'],
                'owner_name' => ['required', 'string', 'max:255'],
                'owner_email' => ['required', 'email', 'max:255'],
                'owner_phone' => ['required', 'string', 'max:50'],
                'owner_gender' => ['required', 'in:male,female'],
                'owner_password' => ['nullable', 'string', 'min:8', 'confirmed'],
                // Must be listed so validated() forwards it to Website B's confirmed rule.
                'owner_password_confirmation' => ['nullable', 'string'],
            ],
            2 => [
                'step' => ['required', 'integer', 'in:2'],
                'gym_name' => ['required', 'array'],
                'gym_name.en' => ['required', 'string', 'max:255'],
                'gym_name.ar' => ['nullable', 'string', 'max:255'],
                'slug' => ['required', 'string', 'regex:/^[a-z0-9-]+$/'],
                'size' => ['required', 'in:1-10,10-50,50-100,100-1000'],
                'address' => ['required', 'array'],
                'address.en' => ['required', 'string'],
                'address.ar' => ['nullable', 'string'],
                'description' => ['nullable', 'array'],
                'description.en' => ['nullable', 'string'],
                'description.ar' => ['nullable', 'string'],
                'contact_email' => ['required', 'email'],
                'phone' => ['required', 'string'],
                'city' => ['required', 'string'],
                'country' => ['required', 'string'],
                'external_plan_id' => ['required', 'string'],
                'plan_name' => ['required', 'string'],
                'billing_cycle' => ['required', 'in:monthly,yearly'],
            ],
            3 => [
                'step' => ['required', 'integer', 'in:3'],
            ],
            4 => [
                'step' => ['required', 'integer', 'in:4'],
                'facebook_url' => ['nullable', 'url'],
                'instagram_url' => ['nullable', 'url'],
                'x_url' => ['nullable', 'url'],
            ],
            5 => [
                'step' => ['required', 'integer', 'in:5'],
                'gym_type' => ['nullable', 'in:mixed,ladies_only,men_only'],
                'target_audience' => ['nullable', 'array'],
                'target_audience.*' => ['in:youth,professionals,luxury,families,seniors,athletes,beginners,general'],
                'amenities' => ['nullable', 'array'],
                'amenities.*' => ['in:personal_training,group_classes,pool,sauna,spa,cafe,parking,childcare,lockers,wifi,twentyfour_seven,crossfit'],
                'additional_info' => ['nullable', 'string', 'max:1000'],
            ],
            default => [
                'step' => ['required', 'integer', Rule::in([1, 2, 3, 4, 5])],
            ],
        };
    }

}

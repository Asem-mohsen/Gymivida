<?php

declare(strict_types=1);

namespace App\Http\Requests\Registration\Concerns;

trait LocalizesRegistrationAttributes
{
    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'slug' => __('registration.slug'),
            'owner_name' => __('registration.owner_name'),
            'owner_email' => __('registration.owner_email'),
            'owner_phone' => __('registration.owner_phone'),
            'owner_gender' => __('registration.owner_gender'),
            'owner_password' => __('registration.password'),
            'owner_password_confirmation' => __('registration.confirm_password'),
            'gym_name' => __('registration.gym_name_en'),
            'gym_name.en' => __('registration.gym_name_en'),
            'gym_name.ar' => __('registration.gym_name_ar'),
            'size' => __('registration.size'),
            'city' => __('registration.city'),
            'country' => __('registration.country'),
            'contact_email' => __('registration.contact_email'),
            'phone' => __('registration.phone'),
            'address' => __('registration.address_en'),
            'address.en' => __('registration.address_en'),
            'address.ar' => __('registration.address_ar'),
            'description' => __('registration.description_en'),
            'description.en' => __('registration.description_en'),
            'description.ar' => __('registration.description_ar'),
            'external_plan_id' => __('registration.select_plan'),
            'plan_name' => __('registration.select_plan'),
            'billing_cycle' => __('registration.billing_cycle'),
            'facebook_url' => __('registration.facebook_url'),
            'instagram_url' => __('registration.instagram_url'),
            'x_url' => __('registration.x_url'),
            'gym_type' => __('registration.gym_type'),
            'target_audience' => __('registration.target_audience'),
            'amenities' => __('registration.amenities'),
            'additional_info' => __('registration.additional_info'),
            'file' => __('registration.gym_logo'),
            'type' => __('registration.gym_logo'),
            'confirm' => __('registration.confirm_submit'),
        ];
    }
}

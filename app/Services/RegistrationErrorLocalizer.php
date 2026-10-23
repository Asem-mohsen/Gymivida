<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Str;

/**
 * Maps gym-platform / Laravel English validation copy into the active site locale.
 */
class RegistrationErrorLocalizer
{
    /**
     * @param  array<string, mixed>  $errors
     * @return array{message: string, errors: array<string, list<string>>}
     */
    public function localize(?string $message, array $errors = []): array
    {
        $localizedErrors = [];

        foreach ($errors as $field => $messages) {
            $list = is_array($messages) ? $messages : [$messages];
            $localizedErrors[(string) $field] = array_values(array_map(
                fn ($msg) => $this->localizeFieldMessage((string) $field, (string) $msg),
                $list
            ));
        }

        return [
            'message' => $this->localizeGenericMessage($message, $localizedErrors),
            'errors' => $localizedErrors,
        ];
    }

    protected function localizeFieldMessage(string $field, string $message): string
    {
        $attribute = $this->attributeLabel($field);
        $lower = Str::lower(trim($message));

        if ($this->matches($lower, [
            'already been taken',
            'has already been taken',
            'already taken',
            'has already been used',
        ])) {
            return __('registration.validation.unique', ['attribute' => $attribute]);
        }

        if ($this->matches($lower, ['is required', 'field is required']) || preg_match('/\brequired\b/', $lower) === 1) {
            return __('registration.validation.required', ['attribute' => $attribute]);
        }

        if ($this->matches($lower, ['valid email', 'must be a valid email'])) {
            return __('registration.validation.email', ['attribute' => $attribute]);
        }

        if ($this->matches($lower, ['format is invalid', 'invalid format', 'may only contain'])) {
            return __('registration.validation.regex', ['attribute' => $attribute]);
        }

        if ($this->matches($lower, ['valid url', 'must be a valid url'])) {
            return __('registration.validation.url', ['attribute' => $attribute]);
        }

        if (preg_match('/at least (\d+)/', $lower, $matches) === 1) {
            return __('registration.validation.min', [
                'attribute' => $attribute,
                'min' => $matches[1],
            ]);
        }

        if (preg_match('/(?:greater than|than) (\d+)/', $lower, $matches) === 1) {
            return __('registration.validation.max', [
                'attribute' => $attribute,
                'max' => $matches[1],
            ]);
        }

        if ($this->matches($lower, ['confirmation does not match', 'does not match'])) {
            return __('registration.validation.confirmed', ['attribute' => $attribute]);
        }

        return $message;
    }

    /**
     * @param  array<string, list<string>>  $localizedErrors
     */
    protected function localizeGenericMessage(?string $message, array $localizedErrors): string
    {
        if ($localizedErrors !== []) {
            $first = reset($localizedErrors);

            return is_array($first) && isset($first[0]) && is_string($first[0])
                ? $first[0]
                : __('common.check_form_errors');
        }

        if ($message === null || trim($message) === '') {
            return __('common.something_went_wrong');
        }

        $lower = Str::lower(trim($message));

        if ($this->matches($lower, ['validation failed', 'the given data was invalid'])) {
            return __('common.check_form_errors');
        }

        return $this->localizeFieldMessage('field', $message);
    }

    protected function attributeLabel(string $field): string
    {
        $map = [
            'slug' => 'slug',
            'owner_name' => 'owner_name',
            'owner_email' => 'owner_email',
            'owner_phone' => 'owner_phone',
            'owner_gender' => 'owner_gender',
            'owner_password' => 'password',
            'owner_password_confirmation' => 'confirm_password',
            'gym_name' => 'gym_name_en',
            'gym_name.en' => 'gym_name_en',
            'gym_name.ar' => 'gym_name_ar',
            'size' => 'size',
            'city' => 'city',
            'country' => 'country',
            'contact_email' => 'contact_email',
            'phone' => 'phone',
            'address' => 'address_en',
            'address.en' => 'address_en',
            'address.ar' => 'address_ar',
            'description' => 'description_en',
            'description.en' => 'description_en',
            'description.ar' => 'description_ar',
            'billing_cycle' => 'billing_cycle',
            'external_plan_id' => 'select_plan',
            'plan_name' => 'select_plan',
            'facebook_url' => 'facebook_url',
            'instagram_url' => 'instagram_url',
            'x_url' => 'x_url',
            'gym_type' => 'gym_type',
            'target_audience' => 'target_audience',
            'amenities' => 'amenities',
            'additional_info' => 'additional_info',
            'gym_logo' => 'gym_logo',
            'file' => 'gym_logo',
        ];

        $key = $map[$field] ?? null;
        if ($key !== null) {
            $label = __('registration.'.$key);
            if ($label !== 'registration.'.$key) {
                return $label;
            }
        }

        return str_replace(['_', '.'], ' ', $field);
    }

    /**
     * @param  list<string>  $needles
     */
    protected function matches(string $haystack, array $needles): bool
    {
        foreach ($needles as $needle) {
            if (Str::contains($haystack, $needle)) {
                return true;
            }
        }

        return false;
    }
}

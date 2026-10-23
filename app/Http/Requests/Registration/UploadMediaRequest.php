<?php

declare(strict_types=1);

namespace App\Http\Requests\Registration;

use App\Http\Requests\Registration\Concerns\LocalizesRegistrationAttributes;
use Illuminate\Foundation\Http\FormRequest;

class UploadMediaRequest extends FormRequest
{
    use LocalizesRegistrationAttributes;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'image', 'mimes:jpeg,jpg,png,webp,gif', 'max:20480'],
            'type' => ['required', 'in:gym_logo,favicon,email_logo,footer_logo'],
        ];
    }
}

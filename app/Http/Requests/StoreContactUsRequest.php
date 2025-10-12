<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactUsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'product_id' => ['nullable', 'integer', 'exists:products,id'],
            'wants_registration_email' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please provide your full name.',
            'name.max' => 'Name cannot exceed 255 characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'phone.max' => 'Phone number cannot exceed 20 characters.',
            'subject.max' => 'Subject cannot exceed 255 characters.',
            'message.required' => 'Please enter your message.',
            'message.max' => 'Message cannot exceed 5000 characters.',
            'product_id.exists' => 'The selected product is invalid.',
        ];
    }
}


@extends('emails.layout')

@php
    $gymName = __('mail.brand');
    $gymTagline = __('mail.tagline');
    $emailTitle = __('mail.new_contact_submission.title');
@endphp

@section('content')
    <p style="margin: 0 0 15px 0;">{{ __('mail.new_contact_submission.greeting') }}</p>

    <p style="margin: 0 0 15px 0;">{{ __('mail.new_contact_submission.intro') }}</p>

    <!-- Contact Details Box -->
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin: 20px 0; background-color: #f8f8f8; border-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}: 3px solid #333333;">
        <tr>
            <td style="padding: 15px;">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tr>
                        <td style="font-size: 14px; line-height: 1.6; color: #333333;">
                            <p style="margin: 0 0 10px 0; font-weight: bold; color: #333333;">{{ __('mail.new_contact_submission.details_heading') }}</p>
                            <p style="margin: 0 0 5px 0;"><strong>{{ __('mail.new_contact_submission.label_name') }}:</strong> {{ $contact->name }}</p>
                            <p style="margin: 0 0 5px 0;"><strong>{{ __('mail.new_contact_submission.label_email') }}:</strong> {{ $contact->email }}</p>
                            @if($contact->phone)
                            <p style="margin: 0 0 5px 0;"><strong>{{ __('mail.new_contact_submission.label_phone') }}:</strong> {{ $contact->phone }}</p>
                            @endif
                            @if($contact->subject)
                            <p style="margin: 0 0 5px 0;"><strong>{{ __('mail.new_contact_submission.label_subject') }}:</strong> {{ $contact->subject }}</p>
                            @endif
                            @if($contact->product)
                            <p style="margin: 0 0 5px 0;"><strong>{{ __('mail.new_contact_submission.label_product') }}:</strong> {{ $contact->product->name }}</p>
                            @endif
                            <p style="margin: 10px 0 0 0; font-weight: bold; color: #333333;">{{ __('mail.new_contact_submission.label_message') }}:</p>
                            <p style="margin: 5px 0 0 0; white-space: pre-wrap;">{{ $contact->message }}</p>
                            @if($contact->wants_registration_email)
                            <p style="margin: 15px 0 0 0; padding: 10px; background-color: #d4edda; border-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}: 3px solid #28a745; color: #155724;">
                                <strong>✓ {{ __('mail.new_contact_submission.requested_registration') }}</strong>
                            </p>
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <p style="margin: 20px 0 0 0;">{{ __('mail.best_regards') }}<br><strong style="color: #333333;">{{ __('mail.system_signature') }}</strong></p>
@endsection

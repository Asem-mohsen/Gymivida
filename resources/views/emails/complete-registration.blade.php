@extends('emails.layout')

@php
    $gymName = __('mail.brand');
    $gymTagline = __('mail.tagline');
    $emailTitle = __('mail.complete_registration.title');
    $contactEmail = $contactEmail ?? config('app.gymivida_email');
    $disclaimer = __('mail.complete_registration.disclaimer', ['email' => $contact->email]);
    $buttonUrl = $registrationUrl;
    $buttonText = __('mail.complete_registration.button');
    $displayName = $userName ?? $contact->name;
@endphp

@section('content')
    <p style="margin: 0 0 15px 0;">{{ __('mail.complete_registration.greeting', ['name' => $displayName]) }}</p>

    <p style="margin: 0 0 15px 0;">{{ __('mail.complete_registration.intro') }}</p>

    <p style="margin: 0 0 20px 0;">{{ __('mail.complete_registration.body') }}</p>

    <!-- Information Box -->
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin: 20px 0; background-color: #f8f8f8; border-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}: 3px solid #333333;">
        <tr>
            <td style="padding: 15px;">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tr>
                        <td style="font-size: 14px; line-height: 1.6; color: #333333;">
                            <p style="margin: 0 0 10px 0; font-weight: bold; color: #333333;">{{ __('mail.complete_registration.contact_info_heading') }}</p>
                            <p style="margin: 0 0 5px 0;">{{ __('mail.complete_registration.label_name') }}: {{ $contact->name }}</p>
                            <p style="margin: 0 0 5px 0;">{{ __('mail.complete_registration.label_email') }}: {{ $contact->email }}</p>
                            @if($contact->phone)
                            <p style="margin: 0 0 5px 0;">{{ __('mail.complete_registration.label_phone') }}: {{ $contact->phone }}</p>
                            @endif
                            @if($contact->product)
                            <p style="margin: 0;">{{ __('mail.complete_registration.label_product') }}: {{ $contact->product->name }}</p>
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Important Note -->
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin: 20px 0; background-color: #f8f8f8; border: 1px solid #e0e0e0;">
        <tr>
            <td style="padding: 15px;">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tr>
                        <td style="font-size: 13px; line-height: 1.6; color: #333333;">
                            <p style="margin: 0; font-weight: bold;">{{ __('mail.complete_registration.important_heading') }}</p>
                            <p style="margin: 5px 0 0 0;">{{ __('mail.complete_registration.important_body') }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <p style="margin: 20px 0 15px 0;">{{ __('mail.complete_registration.support') }}</p>

    <p style="margin: 15px 0 0 0;">{{ __('mail.best_regards') }}<br><strong style="color: #333333;">{{ __('mail.team_signature') }}</strong></p>
@endsection

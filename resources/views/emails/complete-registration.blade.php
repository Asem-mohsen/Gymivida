@extends('emails.layout')

@php
    $gymName = 'Gymivida';
    $gymTagline = 'Your Complete Gym Management Solution';
    $emailTitle = 'Complete Your Gym Registration';
    $contactEmail = $contactEmail ?? config('app.gymivida_email');
    $disclaimer = 'This email was sent to ' . $contact->email . '. If you did not request this email, please ignore it.';
    $buttonUrl = $registrationUrl;
    $buttonText = 'Complete Your Registration';
@endphp

@section('content')
    @if(isset($userName) && $userName)
    <p style="margin: 0 0 15px 0;">Hello {{ $userName }},</p>
    @else
    <p style="margin: 0 0 15px 0;">Hello {{ $contact->name }},</p>
    @endif
    
    <p style="margin: 0 0 15px 0;">Thank you for your interest in Gymivida. We are excited to help you take your gym to the next level.</p>
    
    <p style="margin: 0 0 20px 0;">You have requested to complete your gym registration. We have prepared a personalized registration form for you to provide us with more details about your gym.</p>
    
    <!-- Information Box -->
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin: 20px 0; background-color: #f8f8f8; border-left: 3px solid #333333;">
        <tr>
            <td style="padding: 15px;">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tr>
                        <td style="font-size: 14px; line-height: 1.6; color: #333333;">
                            <p style="margin: 0 0 10px 0; font-weight: bold; color: #333333;">Your Contact Information:</p>
                            <p style="margin: 0 0 5px 0;">Name: {{ $contact->name }}</p>
                            <p style="margin: 0 0 5px 0;">Email: {{ $contact->email }}</p>
                            @if($contact->phone)
                            <p style="margin: 0 0 5px 0;">Phone: {{ $contact->phone }}</p>
                            @endif
                            @if($contact->product)
                            <p style="margin: 0;">Interested Product: {{ $contact->product->name }}</p>
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
                            <p style="margin: 0; font-weight: bold;">Important:</p>
                            <p style="margin: 5px 0 0 0;">This registration link is unique to you and will remain active. Please complete your registration at your earliest convenience.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    
    <p style="margin: 20px 0 15px 0;">If you have any questions or need assistance, please do not hesitate to reach out to our support team.</p>
    
    <p style="margin: 15px 0 0 0;">Best regards,<br><strong style="color: #333333;">The Gymivida Team</strong></p>
@endsection
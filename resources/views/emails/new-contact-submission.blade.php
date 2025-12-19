@extends('emails.layout')

@php
    $gymName = 'Gymivida';
    $gymTagline = 'Your Complete Gym Management Solution';
    $emailTitle = 'New Contact Form Submission';
@endphp

@section('content')
    <p style="margin: 0 0 15px 0;">Hello,</p>
    
    <p style="margin: 0 0 15px 0;">A new contact form submission has been received through the Gymivida website.</p>
    
    <!-- Contact Details Box -->
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin: 20px 0; background-color: #f8f8f8; border-left: 3px solid #333333;">
        <tr>
            <td style="padding: 15px;">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tr>
                        <td style="font-size: 14px; line-height: 1.6; color: #333333;">
                            <p style="margin: 0 0 10px 0; font-weight: bold; color: #333333;">Contact Details:</p>
                            <p style="margin: 0 0 5px 0;"><strong>Name:</strong> {{ $contact->name }}</p>
                            <p style="margin: 0 0 5px 0;"><strong>Email:</strong> {{ $contact->email }}</p>
                            @if($contact->phone)
                            <p style="margin: 0 0 5px 0;"><strong>Phone:</strong> {{ $contact->phone }}</p>
                            @endif
                            @if($contact->subject)
                            <p style="margin: 0 0 5px 0;"><strong>Subject:</strong> {{ $contact->subject }}</p>
                            @endif
                            @if($contact->product)
                            <p style="margin: 0 0 5px 0;"><strong>Interested Product:</strong> {{ $contact->product->name }}</p>
                            @endif
                            <p style="margin: 10px 0 0 0; font-weight: bold; color: #333333;">Message:</p>
                            <p style="margin: 5px 0 0 0; white-space: pre-wrap;">{{ $contact->message }}</p>
                            @if($contact->wants_registration_email)
                            <p style="margin: 15px 0 0 0; padding: 10px; background-color: #d4edda; border-left: 3px solid #28a745; color: #155724;">
                                <strong>✓ This contact has requested registration email</strong>
                            </p>
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    
    <p style="margin: 20px 0 0 0;">Best regards,<br><strong style="color: #333333;">Gymivida System</strong></p>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $emailTitle ?? 'Gymivida' }}</title>
    <!--[if mso]>
    <style type="text/css">
        body, table, td {font-family: Arial, Helvetica, sans-serif !important;}
    </style>
    <![endif]-->
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 1.6; color: #333333;">
    <!-- Outer wrapper table -->
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #f4f4f4;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <!-- Main content table -->
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="600" style="max-width: 600px; background-color: #ffffff; width: 100%;">
                    <!-- Header Section -->
                    <tr>
                        <td style="padding: 30px 30px 20px 30px; text-align: center;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td style="font-size: 24px; font-weight: bold; color: #333333; line-height: 1.4;">
                                        {{ $gymName ?? 'Gymivida' }}
                                    </td>
                                </tr>
                                @if(isset($gymTagline) && $gymTagline)
                                <tr>
                                    <td style="padding-top: 8px; font-size: 13px; color: #666666; line-height: 1.5;">
                                        {{ $gymTagline }}
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
                    <!-- Separator Line -->
                    <tr>
                        <td style="padding: 0 30px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td style="border-top: 1px solid #e0e0e0; height: 1px; line-height: 1px; font-size: 1px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Main Title Section -->
                    @if(isset($emailTitle) && $emailTitle)
                    <tr>
                        <td style="padding: 25px 30px 15px 30px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td style="font-size: 18px; font-weight: bold; color: #333333; line-height: 1.5;">
                                        {{ $emailTitle }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @endif
                    <!-- Content Section -->
                    <tr>
                        <td style="padding: 15px 30px 25px 30px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td style="font-size: 14px; line-height: 1.6; color: #333333;">
                                        @yield('content')
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Button Section (Optional) -->
                    @if(isset($buttonUrl) && isset($buttonText) && $buttonUrl && $buttonText)
                    <tr>
                        <td style="padding: 0 30px 25px 30px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td align="center" style="padding: 10px 0;">
                                        <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="background-color: #333333;">
                                                    <a href="{{ $buttonUrl }}" style="display: inline-block; padding: 10px 16px; font-size: 14px; font-weight: normal; text-decoration: none; color: #ffffff; background-color: #333333; border: none; text-align: center;">
                                                        {{ $buttonText }}
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @endif
                    <!-- Footer Separator -->
                    <tr>
                        <td style="padding: 0 30px 20px 30px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td style="border-top: 1px solid #e0e0e0; height: 1px; line-height: 1px; font-size: 1px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Footer Section -->
                    <tr>
                        <td style="padding: 20px 30px 30px 30px; background-color: #ffffff;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td align="center" style="font-size: 12px; line-height: 1.6; color: #666666; padding-bottom: 8px;">
                                        <strong style="color: #333333;">{{ $gymName ?? 'Gymivida' }}</strong>
                                    </td>
                                </tr>
                                @if(isset($contactEmail) && $contactEmail)
                                <tr>
                                    <td align="center" style="font-size: 12px; line-height: 1.6; color: #666666; padding-bottom: 8px;">
                                        <a href="mailto:{{ $contactEmail }}" style="color: #333333; text-decoration: underline;">{{ $contactEmail }}</a>
                                    </td>
                                </tr>
                                @endif
                                @if(isset($disclaimer) && $disclaimer)
                                <tr>
                                    <td align="center" style="font-size: 11px; line-height: 1.5; color: #999999; padding-top: 8px;">
                                        {{ $disclaimer }}
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td align="center" style="font-size: 11px; line-height: 1.5; color: #999999; padding-top: 8px;">
                                        &copy; {{ date('Y') }} {{ $gymName ?? 'Gymivida' }}. All rights reserved.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

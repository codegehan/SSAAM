<?php

class Email
{
    static function SendEmail($OtpCode)
    {
        $htmlContent = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Email OTP Template</title>
        </head>
        <body style='font-family: \"Helvetica Neue\", sans-serif; background-color: #f0f0f0; text-align: center; padding: 20px; margin: 0;'>
            <div style='background: #fff; border-radius: 8px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); padding: 30px; display: inline-block; width: 360px; margin: 0 auto;'>
                <div style='background: #007bff; border-radius: 8px 8px 0 0; padding: 15px; color: #fff;'>
                    <h2 style='text-align: center; color: #ffffff; margin: 20px 0; font-size: 24px;'>Email OTP Verification</h2>
                </div>
                <p style='text-align: center; font-size: 16px; margin: 10px 0; color: #333;'>Your OTP code is: <span style='font-size: 4em; color: #007bff; display: block; margin: 20px 0;'>{$OtpCode}</span></p>
                <p style='text-align: center; font-size: 16px; margin: 10px 0; color: #333;'>Use this code to login your account.</p>
                <p style='color: #555;'>Please note:</p>
                <ul style='list-style-type: none; padding: 0;'>
                    <li style='color: #007bff; font-size: 18px;'>This OTP code will expire in 2 minutes for security reasons.</li>
                    <br>
                    <li>If you have any questions, contact our support team at <a href='mailto:support@example.com' style='color: #007bff;'>CCS Creatives Committee</a>.</li>
                </ul>
            </div>
        </body>
        </html>";

        return $htmlContent;
    }
}
?>

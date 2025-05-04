<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService {
    public function sendResetEmail($to, $token) {
        $resetLink = "http://localhost/neeco2/reset-password?token=" . urlencode($token);

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USERNAME'];
            $mail->Password = $_ENV['SMTP_PASSWORD'];
            $mail->SMTPSecure = $_ENV['SMTP_ENCRYPTION'];
            $mail->Port = $_ENV['SMTP_PORT'];

            $mail->setFrom($_ENV['SMTP_FROM'], $_ENV['APP_NAME']);
            $mail->addAddress($to);
            $mail->Subject = 'Password Reset Request';
            $mail->isHTML(true);
            $mail->Body = "Click the link to reset your password: <a href=\"$resetLink\">Reset Password</a>";


            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log('Mail Error: ' . $mail->ErrorInfo);
            return false;
        }
    }
}

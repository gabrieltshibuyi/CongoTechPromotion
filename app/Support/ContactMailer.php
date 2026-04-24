<?php

namespace App\Support;

final class ContactMailer
{
    public function send(array $payload): bool
    {
        $recipient = (string) config('contact_email');
        $prefix = (string) config('mail_subject_prefix', '[Website]');
        $subject = trim($prefix . ' ' . $payload['subject']);
        $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

        $fromEmail = (string) config('mail_from_email', $recipient);
        $fromName = (string) config('mail_from_name', config('site_name', 'Website'));
        $replyToName = str_replace(["\r", "\n"], '', $payload['name']);
        $replyToEmail = str_replace(["\r", "\n"], '', $payload['email']);

        $headers = [
            'MIME-Version: 1.0',
            'Content-Type: text/plain; charset=UTF-8',
            'From: ' . $fromName . ' <' . $fromEmail . '>',
            'Reply-To: ' . $replyToName . ' <' . $replyToEmail . '>',
            'X-Mailer: PHP/' . PHP_VERSION,
        ];

        $message = implode(PHP_EOL, [
            'Nouvelle demande recue via le site Congo Tech Promotion',
            '',
            'Nom / Organisation : ' . $payload['name'],
            'Email : ' . $payload['email'],
            'Objet : ' . $payload['subject'],
            '',
            'Message :',
            $payload['message'],
            '',
            'Langue : ' . $payload['locale'],
            'Date : ' . date('c'),
            'IP : ' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'),
        ]);

        $transportError = null;

        set_error_handler(static function (int $severity, string $errorMessage) use (&$transportError): bool {
            $transportError = $errorMessage;

            return true;
        });

        try {
            $sent = mail($recipient, $encodedSubject, $message, implode("\r\n", $headers));
        } finally {
            restore_error_handler();
        }

        $this->logAttempt($payload, $sent, $transportError);

        return $sent;
    }

    private function logAttempt(array $payload, bool $sent, ?string $transportError = null): void
    {
        $logPath = (string) config('mail_log_path', ROOT_PATH . '/storage/logs/contact-mail.log');
        $directory = dirname($logPath);

        if (!is_dir($directory)) {
            mkdir($directory, 0775, true);
        }

        $lines = [
            str_repeat('-', 80),
            'date=' . date('c'),
            'status=' . ($sent ? 'sent' : 'failed'),
            'name=' . $payload['name'],
            'email=' . $payload['email'],
            'subject=' . $payload['subject'],
            'locale=' . $payload['locale'],
            'message=' . preg_replace('/\R/u', ' | ', $payload['message']),
            'transport_error=' . ($transportError ?? 'none'),
        ];

        file_put_contents($logPath, implode(PHP_EOL, $lines) . PHP_EOL, FILE_APPEND);
    }
}

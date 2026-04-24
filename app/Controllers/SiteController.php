<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Support\ContactMailer;
use App\Support\SiteContent;

final class SiteController extends Controller
{
    public function home(): void
    {
        $this->render('home/index', SiteContent::page(locale(), 'home'));
    }

    public function about(): void
    {
        $this->render('about/index', SiteContent::page(locale(), 'about'));
    }

    public function contact(): void
    {
        $this->render('contact/index', array_merge(
            SiteContent::page(locale(), 'contact'),
            [
                'contactFormErrors' => flash_get('contact_errors', []),
                'contactFormOld' => flash_get('contact_old', []),
                'contactFormStatus' => flash_get('contact_status'),
            ]
        ));
    }

    public function submitContact(): void
    {
        if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
            flash_set('contact_status', [
                'type' => 'error',
                'message' => locale() === 'fr'
                    ? 'La session du formulaire a expiré. Veuillez réessayer.'
                    : 'The form session expired. Please try again.',
            ]);
            redirect_to_page('contact', locale());
        }

        $payload = [
            'name' => trim((string) ($_POST['name'] ?? '')),
            'email' => trim((string) ($_POST['email'] ?? '')),
            'subject' => trim((string) ($_POST['subject'] ?? '')),
            'message' => trim((string) ($_POST['message'] ?? '')),
            'locale' => locale(),
        ];

        $errors = [];

        if ($payload['name'] === '') {
            $errors['name'] = locale() === 'fr' ? 'Le nom ou l’organisation est requis.' : 'Name or organization is required.';
        }

        if ($payload['email'] === '' || filter_var($payload['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors['email'] = locale() === 'fr' ? 'Une adresse email valide est requise.' : 'A valid email address is required.';
        }

        if ($payload['subject'] === '') {
            $errors['subject'] = locale() === 'fr' ? 'L’objet est requis.' : 'A subject is required.';
        }

        if ($payload['message'] === '' || mb_strlen($payload['message']) < 20) {
            $errors['message'] = locale() === 'fr'
                ? 'Le message doit contenir au moins 20 caractères.'
                : 'The message must contain at least 20 characters.';
        }

        if ($errors !== []) {
            flash_set('contact_errors', $errors);
            flash_set('contact_old', $payload);
            flash_set('contact_status', [
                'type' => 'error',
                'message' => locale() === 'fr'
                    ? 'Merci de corriger les champs indiqués puis de renvoyer votre demande.'
                    : 'Please correct the highlighted fields and resubmit your request.',
            ]);
            redirect_to_page('contact', locale());
        }

        $sent = (new ContactMailer())->send($payload);

        flash_set('contact_status', [
            'type' => $sent ? 'success' : 'error',
            'message' => $sent
                ? (locale() === 'fr'
                    ? 'Votre message a été envoyé avec succès. Nous reviendrons vers vous rapidement.'
                    : 'Your message was sent successfully. We will get back to you shortly.')
                : (locale() === 'fr'
                    ? 'L’envoi a échoué côté serveur. Vérifiez la configuration SMTP de WAMP/Apache et consultez le journal local.'
                    : 'Sending failed on the server side. Check the WAMP/Apache SMTP configuration and the local log file.'),
        ]);

        if (!$sent) {
            flash_set('contact_old', $payload);
        }

        redirect_to_page('contact', locale());
    }
}

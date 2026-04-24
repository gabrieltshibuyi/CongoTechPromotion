<?php

$scriptDirectory = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$scriptFilename = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_FILENAME'] ?? ''));
$publicFrontController = str_replace('\\', '/', ROOT_PATH . '/public/index.php');
$baseUrl = rtrim($scriptDirectory, '/');
$assetBaseUrl = $baseUrl;

$usesPublicFrontController = $scriptFilename !== ''
    && strcasecmp($scriptFilename, $publicFrontController) === 0;

if (str_ends_with($baseUrl, '/public')) {
    $baseUrl = substr($baseUrl, 0, -7) ?: '';
}

if ($usesPublicFrontController) {
    $assetBaseUrl = rtrim($scriptDirectory, '/');
} else {
    $assetBaseUrl = $baseUrl;
}

if ($baseUrl === '/' || $baseUrl === '.') {
    $baseUrl = '';
}

if ($assetBaseUrl === '.') {
    $assetBaseUrl = '';
}

return [
    'site_name' => 'Congo Tech Promotion',
    'base_url' => $baseUrl,
    'asset_base_url' => $assetBaseUrl,
    'logo_path' => 'assets/media/branding/logo-ctp.png',
    'default_locale' => 'fr',
    'supported_locales' => ['fr', 'en'],
    'contact_email' => 'contact@congotechpromotion.cd',
    'contact_phone' => '+243 000 000 000',
    'contact_location' => 'Kinshasa, RDC',
    'mail_from_email' => 'no-reply@congotechpromotion.cd',
    'mail_from_name' => 'Congo Tech Promotion Website',
    'mail_subject_prefix' => '[CTP Site]',
    'mail_log_path' => ROOT_PATH . '/storage/logs/contact-mail.log',
];

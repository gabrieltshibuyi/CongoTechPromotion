<?php

declare(strict_types=1);

define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';

    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = APP_PATH . '/' . str_replace('\\', '/', $relativeClass) . '.php';

    if (is_file($file)) {
        require $file;
    }
});

$config = require APP_PATH . '/config.php';

$requestedLocale = strtolower((string) ($_GET['lang'] ?? $config['default_locale']));
$supportedLocales = $config['supported_locales'] ?? [$config['default_locale']];
$locale = in_array($requestedLocale, $supportedLocales, true) ? $requestedLocale : $config['default_locale'];

function config(string $key, mixed $default = null): mixed
{
    global $config;

    return $config[$key] ?? $default;
}

function asset(string $path): string
{
    $baseUrl = config('asset_base_url', config('base_url', ''));

    return ($baseUrl !== '' ? $baseUrl : '') . '/' . ltrim($path, '/');
}

function page_path(string $page, ?string $targetLocale = null): string
{
    $language = $targetLocale ?? locale();

    return match ($page) {
        'home' => $language === 'fr' ? '/accueil' : '/',
        'about' => $language === 'fr' ? '/qui-sommes-nous' : '/about',
        'contact' => '/contact',
        default => '/',
    };
}

function locale(): string
{
    global $locale;

    return $locale;
}

function current_path(): string
{
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $baseUrl = config('base_url', '');

    $prefixes = [];

    if ($baseUrl !== '') {
        $prefixes[] = $baseUrl . '/public';
        $prefixes[] = $baseUrl;
    } else {
        $prefixes[] = '/public';
    }

    foreach ($prefixes as $prefix) {
        if ($prefix !== '' && str_starts_with($path, $prefix)) {
            $path = substr($path, strlen($prefix)) ?: '/';
            break;
        }
    }

    $normalized = '/' . trim($path, '/');

    return $normalized === '//' ? '/' : $normalized;
}

function url(string $path = '/', array $query = []): string
{
    $normalizedPath = '/' . ltrim($path, '/');
    $baseUrl = config('base_url', '');
    $queryString = http_build_query($query);

    return ($baseUrl !== '' ? $baseUrl : '') . ($normalizedPath === '//' ? '/' : $normalizedPath) . ($queryString !== '' ? '?' . $queryString : '');
}

function localized_url(string $path = '/', ?string $targetLocale = null, array $query = []): string
{
    $language = $targetLocale ?? locale();
    $defaultLocale = config('default_locale', 'fr');

    if ($language !== $defaultLocale) {
        $query['lang'] = $language;
    } else {
        unset($query['lang']);
    }

    return url($path, $query);
}

function page_url(string $page, ?string $targetLocale = null, array $query = []): string
{
    return localized_url(page_path($page, $targetLocale), $targetLocale, $query);
}

function link_to(string $path, ?string $targetLocale = null): string
{
    if ($path === '') {
        return page_url('home', $targetLocale);
    }

    if (str_starts_with($path, 'mailto:') || str_starts_with($path, 'tel:') || preg_match('/^https?:\/\//', $path) === 1) {
        return $path;
    }

    if (str_starts_with($path, '#')) {
        return page_url('home', $targetLocale) . $path;
    }

    return localized_url($path, $targetLocale);
}

function redirect_to(string $path = '/', ?string $targetLocale = null, array $query = []): never
{
    header('Location: ' . localized_url($path, $targetLocale, $query));
    exit;
}

function redirect_to_page(string $page, ?string $targetLocale = null, array $query = []): never
{
    header('Location: ' . page_url($page, $targetLocale, $query));
    exit;
}

function flash_set(string $key, mixed $value): void
{
    $_SESSION['_flash'][$key] = $value;
}

function flash_get(string $key, mixed $default = null): mixed
{
    $value = $_SESSION['_flash'][$key] ?? $default;
    unset($_SESSION['_flash'][$key]);

    return $value;
}

function csrf_token(): string
{
    if (!isset($_SESSION['_csrf_token']) || !is_string($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['_csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') . '">';
}

function verify_csrf_token(?string $token): bool
{
    return is_string($token) && hash_equals(csrf_token(), $token);
}

function icon_svg(string $name): string
{
    $icons = [
        'representation' => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19h16"/><path d="M6 17V8.5L12 5l6 3.5V17"/><path d="M9 17v-4h6v4"/></svg>',
        'strategy' => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19h16"/><path d="M7 15l3-3 3 2 5-6"/><path d="M15 8h3v3"/></svg>',
        'support' => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"/><path d="M5 20a7 7 0 0 1 14 0"/><path d="M18.5 9.5h3"/><path d="M20 8v3"/></svg>',
        'connections' => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 7H7a4 4 0 1 0 0 8h2"/><path d="M15 7h2a4 4 0 1 1 0 8h-2"/><path d="M8 12h8"/><path d="M12 8l4 4-4 4"/></svg>',
        'curation' => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3 5 6v5c0 4.6 2.8 8.6 7 10 4.2-1.4 7-5.4 7-10V6l-7-3Z"/><path d="m9.5 12 1.8 1.8 3.7-4.1"/></svg>',
        'institutional' => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 20h18"/><path d="M5 20V9"/><path d="M10 20V5"/><path d="M15 20v-8"/><path d="M20 20v-5"/></svg>',
        'pin' => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s6-5.33 6-11a6 6 0 1 0-12 0c0 5.67 6 11 6 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>',
        'phone' => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.86 19.86 0 0 1-8.63-3.07A19.5 19.5 0 0 1 5.15 12.8 19.86 19.86 0 0 1 2.08 4.09 2 2 0 0 1 4.06 2h3a2 2 0 0 1 2 1.72l.33 2.57a2 2 0 0 1-.57 1.68L7.2 9.6a16 16 0 0 0 7.2 7.2l1.63-1.62a2 2 0 0 1 1.68-.57l2.57.33A2 2 0 0 1 22 16.92Z"/></svg>',
        'mail' => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/></svg>',
        'twitter' => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="currentColor"><path d="M18.9 2H22l-6.77 7.74L23 22h-6.1l-4.78-6.28L6.64 22H3.53l7.24-8.28L1 2h6.25l4.32 5.7L18.9 2Zm-1.07 18h1.69L6.33 3.9H4.52L17.83 20Z"/></svg>',
        'facebook' => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="currentColor"><path d="M13.5 22v-8h2.7l.4-3h-3.1V9.1c0-.87.26-1.46 1.5-1.46H16.7V5a20 20 0 0 0-2.48-.13c-2.46 0-4.14 1.5-4.14 4.28V11H7.3v3h2.78v8h3.42Z"/></svg>',
        'youtube' => '<svg viewBox="0 0 24 24" aria-hidden="true" fill="currentColor"><path d="M21.58 7.19a2.99 2.99 0 0 0-2.1-2.11C17.64 4.6 12 4.6 12 4.6s-5.64 0-7.48.48a2.99 2.99 0 0 0-2.1 2.11A31.3 31.3 0 0 0 2 12a31.3 31.3 0 0 0 .42 4.81 2.99 2.99 0 0 0 2.1 2.11c1.84.48 7.48.48 7.48.48s5.64 0 7.48-.48a2.99 2.99 0 0 0 2.1-2.11A31.3 31.3 0 0 0 22 12a31.3 31.3 0 0 0-.42-4.81ZM10 15.5v-7l6 3.5-6 3.5Z"/></svg>',
    ];

    return $icons[$name] ?? $icons['representation'];
}

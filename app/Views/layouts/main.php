<!DOCTYPE html>
<html lang="<?= htmlspecialchars($locale ?? locale(), ENT_QUOTES, 'UTF-8'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($metaDescription ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    <title><?= htmlspecialchars($pageTitle ?? config('site_name'), ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="icon" type="image/png" href="<?= htmlspecialchars(asset(ltrim(config('logo_path'), '/')), ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;500;600;700&family=Sora:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= htmlspecialchars(asset('assets/css/style.css'), ENT_QUOTES, 'UTF-8'); ?>">
</head>
<body data-page="<?= htmlspecialchars(strtolower((string) ($pageName ?? 'home')), ENT_QUOTES, 'UTF-8'); ?>">
    <div class="site-shell">
        <header class="site-header">
            <div class="container header-inner">
                <a class="brand" href="<?= htmlspecialchars(page_url('home'), ENT_QUOTES, 'UTF-8'); ?>">
                    <img src="<?= htmlspecialchars(asset(ltrim(config('logo_path'), '/')), ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($brandLabel ?? config('site_name'), ENT_QUOTES, 'UTF-8'); ?>">
                </a>

                <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" aria-label="Navigation">
                    <span></span>
                    <span></span>
                </button>

                <div id="site-nav" class="nav-panel">
                    <nav class="site-nav">
                        <?php foreach (($nav ?? []) as $item): ?>
                            <?php $isActive = ($currentPath ?? current_path()) === $item['path']; ?>
                            <a class="<?= $isActive ? 'is-active' : ''; ?>" href="<?= htmlspecialchars(link_to($item['path']), ENT_QUOTES, 'UTF-8'); ?>">
                                <?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        <?php endforeach; ?>
                    </nav>

                    <div class="language-switcher" aria-label="<?= htmlspecialchars($switcherLabel ?? 'Language', ENT_QUOTES, 'UTF-8'); ?>">
                        <?php foreach (($languageLinks ?? []) as $languageCode => $languageLabel): ?>
                            <?php $isCurrentLanguage = ($locale ?? locale()) === $languageCode; ?>
                            <a class="<?= $isCurrentLanguage ? 'is-current' : ''; ?>" href="<?= htmlspecialchars(isset($currentPage) ? page_url((string) $currentPage, $languageCode) : link_to($currentPath ?? '/', $languageCode), ENT_QUOTES, 'UTF-8'); ?>">
                                <?= htmlspecialchars($languageLabel, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <a class="button button-primary nav-cta" href="<?= htmlspecialchars(link_to($pageCtaPath ?? '/contact'), ENT_QUOTES, 'UTF-8'); ?>">
                        <?= htmlspecialchars($pageCtaLabel ?? 'Contact', ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                </div>
            </div>
        </header>

        <main>
            <?= $content; ?>
        </main>

        <footer class="site-footer">
            <div class="footer-stripe" aria-hidden="true">
                <span class="stripe stripe-cyan"></span>
                <span class="stripe stripe-gold"></span>
                <span class="stripe stripe-red"></span>
            </div>

            <div class="container footer-panel">
                <div class="footer-brand-centered">
                    <img class="footer-brand-logo" src="<?= htmlspecialchars(asset(ltrim(config('logo_path'), '/')), ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($brandLabel ?? config('site_name'), ENT_QUOTES, 'UTF-8'); ?>">
                </div>

                <nav class="footer-menu-horizontal" aria-label="Footer navigation">
                    <?php foreach (($footerLinks ?? []) as $item): ?>
                        <a href="<?= htmlspecialchars(link_to($item['path']), ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?></a>
                    <?php endforeach; ?>
                </nav>

                <div class="footer-social-row">
                    <?php foreach (($footerSocialLinks ?? []) as $item): ?>
                        <a class="footer-social-link" href="<?= htmlspecialchars(link_to($item['path']), ENT_QUOTES, 'UTF-8'); ?>" aria-label="<?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?= icon_svg($item['icon'] ?? 'twitter'); ?>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="footer-bottom-row">
                    <p><?= htmlspecialchars($footerCopyright ?? '', ENT_QUOTES, 'UTF-8'); ?> - <?= htmlspecialchars($footerLegalLabel ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </div>
        </footer>
    </div>

    <script src="<?= htmlspecialchars(asset('assets/js/main.js'), ENT_QUOTES, 'UTF-8'); ?>"></script>
</body>
</html>

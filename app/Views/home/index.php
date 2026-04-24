<section class="section home-institutional reveal">
    <div class="container">
        <div class="section-heading centered home-institutional-heading">
            <span class="section-tag"><?= htmlspecialchars($heroEyebrow, ENT_QUOTES, 'UTF-8'); ?></span>
            <h1><?= htmlspecialchars($heroTitle, ENT_QUOTES, 'UTF-8'); ?></h1>
            <p class="lead"><?= htmlspecialchars($heroLead, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>

        <div class="home-institutional-copy centered">
            <?php foreach ($highlights as $highlight): ?>
                <p><?= htmlspecialchars($highlight, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endforeach; ?>
        </div>

        <div class="institutional-stat-grid">
            <?php foreach ($stats as $stat): ?>
                <article class="institutional-stat">
                    <strong><?= htmlspecialchars($stat['value'], ENT_QUOTES, 'UTF-8'); ?></strong>
                    <span><?= htmlspecialchars($stat['label'], ENT_QUOTES, 'UTF-8'); ?></span>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="who" class="section section-light reveal">
    <div class="container">
        <div class="who-panel">
            <div class="who-panel-copy">
                <span class="who-panel-tag"><?= htmlspecialchars($who['tag'], ENT_QUOTES, 'UTF-8'); ?></span>
                <h2><?= htmlspecialchars($who['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
                <p class="who-panel-text"><?= htmlspecialchars($who['paragraphs'][0], ENT_QUOTES, 'UTF-8'); ?></p>

                <ul class="who-panel-list">
                    <?php foreach ($who['highlights'] as $item): ?>
                        <li><?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>

                <a class="button who-panel-button" href="<?= htmlspecialchars(link_to($who['cta']['path']), ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($who['cta']['label'], ENT_QUOTES, 'UTF-8'); ?></a>
            </div>

            <div class="who-panel-media">
                <img
                    src="<?= htmlspecialchars(asset($who['image']['src']), ENT_QUOTES, 'UTF-8'); ?>"
                    alt="<?= htmlspecialchars($who['image']['alt'], ENT_QUOTES, 'UTF-8'); ?>"
                    loading="lazy"
                    decoding="async"
                    width="1600"
                    height="900"
                >
            </div>
        </div>
        <?php $whoExtraParagraphs = array_slice($who['paragraphs'], 1); ?>
        <?php if ($whoExtraParagraphs !== []): ?>
            <div class="who-panel-note centered">
                <?php foreach ($whoExtraParagraphs as $paragraph): ?>
                    <p><?= htmlspecialchars($paragraph, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="section reveal">
    <div class="container">
        <div class="section-heading centered narrow">
            <span class="section-tag"><?= htmlspecialchars($servicesPreview['tag'], ENT_QUOTES, 'UTF-8'); ?></span>
            <h2><?= htmlspecialchars($servicesPreview['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
            <p><?= htmlspecialchars($servicesPreview['text'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <div class="service-grid">
            <?php foreach ($servicesPreview['items'] as $index => $service): ?>
                <article class="service-card service-card-interactive service-card-accent-<?= htmlspecialchars($service['accent'] ?? 'blue', ENT_QUOTES, 'UTF-8'); ?> service-card-cascade reveal" style="--card-delay: <?= (int) ($index * 90); ?>ms;">
                    <div class="service-icon" aria-hidden="true"><?= icon_svg($service['icon'] ?? 'representation'); ?></div>
                    <h3><?= htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p><?= htmlspecialchars($service['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="viva-rdc" class="section reveal">
    <div class="container">
        <div class="section-heading centered narrow">
            <span class="section-tag"><?= htmlspecialchars($viva['tag'], ENT_QUOTES, 'UTF-8'); ?></span>
            <h2><?= htmlspecialchars($viva['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
        </div>
        <div class="home-institutional-copy centered">
            <?php foreach ($viva['paragraphs'] as $paragraph): ?>
                <p><?= htmlspecialchars($paragraph, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endforeach; ?>
        </div>
        <div class="institutional-note-list">
            <?php foreach ($viva['notes'] as $note): ?>
                <article class="institutional-note-item">
                    <span class="mini-tag"><?= htmlspecialchars($note['label'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <p><?= htmlspecialchars($note['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>


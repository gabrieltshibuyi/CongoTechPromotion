<section class="section about-simple reveal">
    <div class="container">
        <div class="section-heading centered narrow">
            <span class="section-tag"><?= htmlspecialchars($heroEyebrow, ENT_QUOTES, 'UTF-8'); ?></span>
            <h1><?= htmlspecialchars($heroTitle, ENT_QUOTES, 'UTF-8'); ?></h1>
            <p class="lead"><?= htmlspecialchars($heroLead, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>

        <div class="about-simple-copy">
            <?php foreach ($intro['paragraphs'] as $paragraph): ?>
                <p><?= htmlspecialchars($paragraph, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endforeach; ?>

            <?php foreach ($positioning['paragraphs'] as $paragraph): ?>
                <p><?= htmlspecialchars($paragraph, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endforeach; ?>

            <p class="about-simple-actors">
                <strong><?= htmlspecialchars($actors['tag'], ENT_QUOTES, 'UTF-8'); ?> :</strong>
                <?= htmlspecialchars(implode(', ', $actors['items']), ENT_QUOTES, 'UTF-8'); ?>.
            </p>

            <p class="about-simple-focus">
                <strong><?= htmlspecialchars($focus['tag'], ENT_QUOTES, 'UTF-8'); ?> :</strong>
                <?= htmlspecialchars($focus['text'], ENT_QUOTES, 'UTF-8'); ?>
            </p>
        </div>
    </div>
</section>

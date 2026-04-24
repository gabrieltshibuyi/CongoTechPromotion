<section class="section section-light contact-section-intro reveal">
    <div class="container contact-grid">
        <div class="rich-text">
            <span class="section-tag"><?= htmlspecialchars($intro['tag'], ENT_QUOTES, 'UTF-8'); ?></span>
            <h2><?= htmlspecialchars($intro['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
            <?php foreach ($intro['paragraphs'] as $paragraph): ?>
                <p><?= htmlspecialchars($paragraph, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endforeach; ?>
        </div>
        <div class="contact-card-stack">
            <?php foreach ($contactCards as $card): ?>
                <article class="contact-card reveal">
                    <span class="mini-tag"><?= htmlspecialchars($card['label'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php if (!empty($card['href'])): ?>
                        <a href="<?= htmlspecialchars($card['href'], ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($card['value'], ENT_QUOTES, 'UTF-8'); ?></a>
                    <?php else: ?>
                        <strong><?= htmlspecialchars($card['value'], ENT_QUOTES, 'UTF-8'); ?></strong>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section contact-section-form reveal">
    <div class="container contact-grid">
        <div class="brief-card reveal">
            <span class="section-tag"><?= htmlspecialchars($brief['tag'], ENT_QUOTES, 'UTF-8'); ?></span>
            <h2><?= htmlspecialchars($brief['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
            <div class="brief-list">
                <?php foreach ($brief['items'] as $item): ?>
                    <div class="brief-item"><?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8'); ?></div>
                <?php endforeach; ?>
            </div>
        </div>

        <form class="contact-form reveal" action="<?= htmlspecialchars(link_to('/contact'), ENT_QUOTES, 'UTF-8'); ?>" method="post">
            <?= csrf_field(); ?>
            <h3><?= htmlspecialchars($form['title'], ENT_QUOTES, 'UTF-8'); ?></h3>

            <?php if (!empty($contactFormStatus)): ?>
                <div class="form-alert form-alert-<?= htmlspecialchars($contactFormStatus['type'], ENT_QUOTES, 'UTF-8'); ?>">
                    <?= htmlspecialchars($contactFormStatus['message'], ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>

            <?php foreach ($form['fields'] as $index => $field): ?>
                <?php
                $fieldName = match ($index) {
                    0 => 'name',
                    1 => 'email',
                    2 => 'subject',
                    default => 'message',
                };
                $fieldValue = $contactFormOld[$fieldName] ?? '';
                $fieldError = $contactFormErrors[$fieldName] ?? null;
                ?>
                <label>
                    <span><?= htmlspecialchars($field['label'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php if ($index === array_key_last($form['fields'])): ?>
                        <textarea name="<?= htmlspecialchars($fieldName, ENT_QUOTES, 'UTF-8'); ?>" placeholder="<?= htmlspecialchars($field['placeholder'], ENT_QUOTES, 'UTF-8'); ?>" rows="5"><?= htmlspecialchars((string) $fieldValue, ENT_QUOTES, 'UTF-8'); ?></textarea>
                    <?php else: ?>
                        <input type="<?= $fieldName === 'email' ? 'email' : 'text'; ?>" name="<?= htmlspecialchars($fieldName, ENT_QUOTES, 'UTF-8'); ?>" value="<?= htmlspecialchars((string) $fieldValue, ENT_QUOTES, 'UTF-8'); ?>" placeholder="<?= htmlspecialchars($field['placeholder'], ENT_QUOTES, 'UTF-8'); ?>">
                    <?php endif; ?>
                    <?php if ($fieldError !== null): ?>
                        <small class="field-error"><?= htmlspecialchars($fieldError, ENT_QUOTES, 'UTF-8'); ?></small>
                    <?php endif; ?>
                </label>
            <?php endforeach; ?>
            <?php if (!empty($form['note'])): ?>
                <p class="form-note"><?= htmlspecialchars($form['note'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
            <button class="button button-primary" type="submit"><?= htmlspecialchars($form['button'], ENT_QUOTES, 'UTF-8'); ?></button>
        </form>
    </div>
</section>



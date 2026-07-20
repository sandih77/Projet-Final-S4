<?php
/**
 * Bloc d'alertes réutilisable : messages flash de session + erreurs de
 * validation transmises par le contrôleur. Inclure avec :
 *   <?= $this->include('partials/alerts') ?>
 */
$flashSuccess = session()->getFlashdata('success');
$flashError = session()->getFlashdata('error');
?>

<?php if ($flashSuccess) : ?>
    <div class="alert alert-success" data-autohide>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        <p><?= esc($flashSuccess) ?></p>
    </div>
<?php endif; ?>

<?php if ($flashError) : ?>
    <div class="alert alert-error">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <p><?= esc($flashError) ?></p>
    </div>
<?php endif; ?>

<?php if (!empty($error)) : ?>
    <div class="alert alert-error">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <p><?= esc($error) ?></p>
    </div>
<?php endif; ?>

<?php if (!empty($errors)) : ?>
    <div class="alert alert-error">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <div>
            <?php foreach ($errors as $err) : ?>
                <p><?= esc($err) ?></p>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

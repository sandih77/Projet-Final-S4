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
        <i class="bi bi-check-circle-fill"></i>
        <p><?= esc($flashSuccess) ?></p>
    </div>
<?php endif; ?>

<?php if ($flashError) : ?>
    <div class="alert alert-error">
        <i class="bi bi-exclamation-circle-fill"></i>
        <p><?= esc($flashError) ?></p>
    </div>
<?php endif; ?>

<?php if (!empty($error)) : ?>
    <div class="alert alert-error">
        <i class="bi bi-exclamation-circle-fill"></i>
        <p><?= esc($error) ?></p>
    </div>
<?php endif; ?>

<?php if (!empty($errors)) : ?>
    <div class="alert alert-error">
        <i class="bi bi-exclamation-circle-fill"></i>
        <div>
            <?php foreach ($errors as $err) : ?>
                <p><?= esc($err) ?></p>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

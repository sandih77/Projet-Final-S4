<?= $this->extend('layouts/auth') ?>

<?= $this->section('title') ?>Connexion<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Bienvenue</h1>
<p class="auth-subtitle">Connectez-vous avec votre numéro de téléphone et votre code secret.</p>

<?= $this->include('partials/alerts') ?>

<?php if (isset($errors)) : ?>
    <div class="alert alert-error">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <div>
            <?php foreach ($errors as $error) : ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?php if (isset($error)) : ?>
    <div class="alert alert-error">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <p><?= esc($error) ?></p>
    </div>
<?php endif; ?>

<form action="<?= site_url("clients/login") ?>" method="post" class="form-grid">

    <?= csrf_field() ?>

    <div class="form-group">
        <label for="telephone">Téléphone</label>
        <input
            type="tel"
            id="telephone"
            name="telephone"
            placeholder="0341234567"
            pattern="^(032|033|034|037|038)[0-9]{7}$"
            maxlength="10"
            minlength="10"
            value="<?= old("telephone") ?>"
            required
        >
    </div>

    <div class="form-group">
        <label for="code_secret">Code secret</label>
        <input
            type="password"
            id="code_secret"
            name="code_secret"
            pattern="^[0-9]{4}$"
            maxlength="4"
            minlength="4"
            inputmode="numeric"
            required
        >
    </div>

    <button type="submit" class="btn btn-primary btn-block">
        Se connecter
    </button>

</form>

<p class="auth-footer-note">MoneyFlow &middot; Votre argent, partout, en toute sécurité.</p>

<?= $this->endSection() ?>

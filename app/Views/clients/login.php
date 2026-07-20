<?= $this->extend('layouts/auth') ?>

<?= $this->section('title') ?>Connexion<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Bienvenue</h1>
<p class="auth-subtitle">Connectez-vous avec votre numéro de téléphone et votre code secret.</p>

<?= $this->include('partials/alerts') ?>

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
        <i class="bi bi-box-arrow-in-right"></i>
        Se connecter
    </button>

</form>

<p class="auth-footer-note">MoneyFlow &middot; Votre argent, partout, en toute sécurité.</p>

<?= $this->endSection() ?>

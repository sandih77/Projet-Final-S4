<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Mon solde<?= $this->endSection() ?>

<?= $this->section('content') ?>

<a href="<?= site_url('clients/dashboard') ?>" class="back-link">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Retour au tableau de bord
</a>

<div class="page-header">
    <div>
        <h1>Mon compte</h1>
        <p class="page-description">Détails de votre compte et solde disponible.</p>
    </div>
</div>

<div class="balance-card">
    <div class="balance-label">Solde disponible</div>
    <div class="balance-value"><?= number_format((float) $solde, 0, ',', ' ') ?> Ar</div>
</div>

<div class="card">
    <div class="card-header">
        <h2>Informations personnelles</h2>
    </div>
    <div class="card-body">
        <div class="info-list">
            <div class="info-row">
                <span class="label">Nom</span>
                <span class="value"><?= esc($client->nom) ?></span>
            </div>
            <div class="info-row">
                <span class="label">Téléphone</span>
                <span class="value"><?= esc($client->telephone) ?></span>
            </div>
            <div class="info-row">
                <span class="label">Identifiant</span>
                <span class="value">#<?= esc($client->id) ?></span>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

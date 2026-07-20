<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Tableau de bord<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('partials/alerts') ?>

<div class="page-header">
    <div>
        <h1>Bonjour <?= esc($client['nom']) ?></h1>
        <p class="page-description">Voici un aperçu de votre compte mobile money.</p>
    </div>
</div>

<?php if (isset($solde)) : ?>
    <div class="balance-card">
        <div class="balance-label">Solde disponible</div>
        <div class="balance-value"><?= number_format((float) $solde, 0, ',', ' ') ?> Ar</div>
        <div class="balance-meta">Téléphone : <?= esc($client['telephone']) ?></div>
    </div>
<?php endif; ?>

<div class="quick-links">
    <a href="<?= site_url('clients/transaction') ?>" class="quick-link-card">
        <div class="qc-icon">
            <i class="bi bi-arrow-left-right"></i>
        </div>
        <div>
            <strong>Faire une transaction</strong>
            <span>Dépôt, retrait ou transfert</span>
        </div>
    </a>

    <a href="<?= site_url('clients/solde/' . $client['id']) ?>" class="quick-link-card">
        <div class="qc-icon">
            <i class="bi bi-wallet2"></i>
        </div>
        <div>
            <strong>Voir mon solde</strong>
            <span>Détails de votre compte</span>
        </div>
    </a>

    <a href="<?= site_url('clients/historique') ?>" class="quick-link-card">
        <div class="qc-icon">
            <i class="bi bi-clock-history"></i>
        </div>
        <div>
            <strong>Historique</strong>
            <span>Toutes vos transactions passées</span>
        </div>
    </a>

    <a href="<?= site_url('clients/logout') ?>" class="quick-link-card">
        <div class="qc-icon">
            <i class="bi bi-box-arrow-right"></i>
        </div>
        <div>
            <strong>Se déconnecter</strong>
            <span>Fermer votre session en sécurité</span>
        </div>
    </a>
</div>

<div class="card" style="margin-top:24px;">
    <div class="card-header">
        <h2>Informations du compte</h2>
    </div>
    <div class="card-body">
        <div class="info-list">
            <div class="info-row">
                <span class="label">Nom</span>
                <span class="value"><?= esc($client['nom']) ?></span>
            </div>
            <div class="info-row">
                <span class="label">Téléphone</span>
                <span class="value"><?= esc($client['telephone']) ?></span>
            </div>
            <div class="info-row">
                <span class="label">Identifiant</span>
                <span class="value">#<?= esc($client['id']) ?></span>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

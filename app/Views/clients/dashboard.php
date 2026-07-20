<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Tableau de bord<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('partials/alerts') ?>

<div class="page-header">
    <div>
        <h1>Bonjour <?= esc($client['nom']) ?> 👋</h1>
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
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg>
        </div>
        <div>
            <strong>Faire une transaction</strong>
            <span>Dépôt, retrait ou transfert</span>
        </div>
    </a>

    <a href="<?= site_url('clients/solde/' . $client['id']) ?>" class="quick-link-card">
        <div class="qc-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7a2 2 0 0 1 2-2h13a1 1 0 0 1 1 1v3"/><path d="M3 7v11a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10a1 1 0 0 0-1-1H5a2 2 0 0 1-2-2Z"/><circle cx="16.5" cy="14.5" r="1.5"/></svg>
        </div>
        <div>
            <strong>Voir mon solde</strong>
            <span>Détails de votre compte</span>
        </div>
    </a>

    <a href="<?= site_url('clients/logout') ?>" class="quick-link-card">
        <div class="qc-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
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

<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Tableau de bord<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('partials/alerts') ?>

<div class="page-header">
    <div>
        <h1>Tableau de bord</h1>
        <p class="page-description">Vue d'ensemble de la configuration de la plateforme mobile money.</p>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon tone-indigo">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21V6a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v15"/><path d="M15 21V10a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v11"/><line x1="3" y1="21" x2="21" y2="21"/></svg>
        </div>
        <div>
            <div class="stat-value"><?= (int) ($stats['operateurs'] ?? 0) ?></div>
            <div class="stat-label">Opérateurs</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon tone-green">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="9" x2="19" y2="9"/><line x1="5" y1="15" x2="19" y2="15"/><line x1="10" y1="4" x2="7" y2="20"/><line x1="17" y1="4" x2="14" y2="20"/></svg>
        </div>
        <div>
            <div class="stat-value"><?= (int) ($stats['prefixes'] ?? 0) ?></div>
            <div class="stat-label">Préfixes</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon tone-amber">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 21 7 12 12 3 7 12 2"/><polyline points="3 12 12 17 21 12"/><polyline points="3 17 12 22 21 17"/></svg>
        </div>
        <div>
            <div class="stat-value"><?= (int) ($stats['types_operation'] ?? 0) ?></div>
            <div class="stat-label">Types d'opération</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon tone-red">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/></svg>
        </div>
        <div>
            <div class="stat-value"><?= (int) ($stats['baremes'] ?? 0) ?></div>
            <div class="stat-label">Barèmes</div>
        </div>
    </div>
</div>

<div class="card-header" style="padding-left:0; border-bottom:none;">
    <h2>Accès rapide</h2>
</div>

<div class="quick-links">
    <a href="<?= site_url('operateurs/operateurs') ?>" class="quick-link-card">
        <div class="qc-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21V6a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v15"/><path d="M15 21V10a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v11"/><line x1="3" y1="21" x2="21" y2="21"/></svg>
        </div>
        <div>
            <strong>Gérer les opérateurs</strong>
            <span>Ajouter, modifier ou supprimer un opérateur</span>
        </div>
    </a>

    <a href="<?= site_url('operateurs/prefixes') ?>" class="quick-link-card">
        <div class="qc-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="9" x2="19" y2="9"/><line x1="5" y1="15" x2="19" y2="15"/><line x1="10" y1="4" x2="7" y2="20"/><line x1="17" y1="4" x2="14" y2="20"/></svg>
        </div>
        <div>
            <strong>Gérer les préfixes</strong>
            <span>Associer des préfixes téléphoniques à un opérateur</span>
        </div>
    </a>

    <a href="<?= site_url('operateurs/types-operation') ?>" class="quick-link-card">
        <div class="qc-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 21 7 12 12 3 7 12 2"/><polyline points="3 12 12 17 21 12"/><polyline points="3 17 12 22 21 17"/></svg>
        </div>
        <div>
            <strong>Types d'opération</strong>
            <span>Dépôt, retrait, transfert…</span>
        </div>
    </a>

    <a href="<?= site_url('operateurs/baremes') ?>" class="quick-link-card">
        <div class="qc-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/></svg>
        </div>
        <div>
            <strong>Gérer les barèmes</strong>
            <span>Définir les frais par tranche de montant</span>
        </div>
    </a>
</div>

<h2>Situation des Comptes Clients</h2>
    <h3>Fonds totaux en circulation : <?= number_format($total_solde_clients ?? 0, 0, ',', ' ') ?> Ar</h3>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Solde Calculé (Ar)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($clients)) : ?>
                <?php foreach ($clients as $client) : ?>
                    <tr>
                        <td><?= $client->id ?></td>
                        <td><?= esc($client->nom) ?></td>
                        <td><?= esc($client->telephone) ?></td>
                        <td><strong><?= number_format($client->solde, 0, ',', ' ') ?> Ar</strong></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">Aucun client trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

<?= $this->endSection() ?>

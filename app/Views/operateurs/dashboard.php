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
            <i class="bi bi-building"></i>
        </div>
        <div>
            <div class="stat-value"><?= (int) ($stats['operateurs'] ?? 0) ?></div>
            <div class="stat-label">Opérateurs</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon tone-green">
            <i class="bi bi-hash"></i>
        </div>
        <div>
            <div class="stat-value"><?= (int) ($stats['prefixes'] ?? 0) ?></div>
            <div class="stat-label">Préfixes</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon tone-amber">
            <i class="bi bi-diagram-3"></i>
        </div>
        <div>
            <div class="stat-value"><?= (int) ($stats['types_operation'] ?? 0) ?></div>
            <div class="stat-label">Types d'opération</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon tone-red">
            <i class="bi bi-sliders"></i>
        </div>
        <div>
            <div class="stat-value"><?= (int) ($stats['baremes'] ?? 0) ?></div>
            <div class="stat-label">Barèmes</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon tone-green">
            <i class="bi bi-cash-coin"></i>
        </div>
        <div>
            <div class="stat-value"><?= number_format((float) ($total_gains ?? 0), 0, ',', ' ') ?> Ar</div>
            <div class="stat-label">Gains totaux</div>
        </div>
    </div>
</div>

<div class="page-header" style="margin-top:8px;">
    <div>
        <h2 style="margin-bottom:0;">Répartition des gains</h2>
        <p class="page-description">Détail des frais perçus par type d'opération et par opérateur.</p>
    </div>
</div>

<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:18px; margin-bottom:24px;">
    <div class="card">
        <div class="card-header">
            <h3><i class="bi bi-diagram-3"></i> Gains par type d'opération</h3>
        </div>
        <?php if (empty($gains_par_type)) : ?>
            <div class="empty-state">
                <i class="bi bi-bar-chart"></i>
                <strong>Aucune donnée</strong>
                <span>Aucun gain enregistré pour le moment.</span>
            </div>
        <?php else : ?>
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Type d'opération</th>
                            <th>Opérations</th>
                            <th>Gains</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($gains_par_type as $gain) : ?>
                            <tr>
                                <td><span class="pill"><?= esc($gain['type_nom']) ?></span></td>
                                <td><?= (int) $gain['nombre_operations'] ?></td>
                                <td class="money positive"><?= number_format((float) $gain['total_gains'], 0, ',', ' ') ?> Ar</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <div class="card">
        <div class="card-header">
            <h3><i class="bi bi-building"></i> Gains par opérateur</h3>
        </div>
        <?php if (empty($gains_par_operateur)) : ?>
            <div class="empty-state">
                <i class="bi bi-bar-chart"></i>
                <strong>Aucune donnée</strong>
                <span>Aucun gain enregistré pour le moment.</span>
            </div>
        <?php else : ?>
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Opérateur</th>
                            <th>Opérations</th>
                            <th>Gains</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($gains_par_operateur as $gain) : ?>
                            <tr>
                                <td><span class="pill pill-muted"><?= esc($gain['operateur_nom']) ?></span></td>
                                <td><?= (int) $gain['nombre_operations'] ?></td>
                                <td class="money positive"><?= number_format((float) $gain['total_gains'], 0, ',', ' ') ?> Ar</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="card-header" style="padding-left:0; border-bottom:none;">
    <h2>Accès rapide</h2>
</div>

<div class="quick-links">
    <a href="<?= site_url('operateurs/operateurs') ?>" class="quick-link-card">
        <div class="qc-icon">
            <i class="bi bi-building"></i>
        </div>
        <div>
            <strong>Gérer les opérateurs</strong>
            <span>Ajouter, modifier ou supprimer un opérateur</span>
        </div>
    </a>

    <a href="<?= site_url('operateurs/prefixes') ?>" class="quick-link-card">
        <div class="qc-icon">
            <i class="bi bi-hash"></i>
        </div>
        <div>
            <strong>Gérer les préfixes</strong>
            <span>Associer des préfixes téléphoniques à un opérateur</span>
        </div>
    </a>

    <a href="<?= site_url('operateurs/types-operation') ?>" class="quick-link-card">
        <div class="qc-icon">
            <i class="bi bi-diagram-3"></i>
        </div>
        <div>
            <strong>Types d'opération</strong>
            <span>Dépôt, retrait, transfert…</span>
        </div>
    </a>

    <a href="<?= site_url('operateurs/baremes') ?>" class="quick-link-card">
        <div class="qc-icon">
            <i class="bi bi-sliders"></i>
        </div>
        <div>
            <strong>Gérer les barèmes</strong>
            <span>Définir les frais par tranche de montant</span>
        </div>
    </a>
</div>

<div class="page-header" style="margin-top:32px;">
    <div>
        <h2 style="margin-bottom:0;">Situation des comptes clients</h2>
        <p class="page-description">Fonds totaux en circulation : <strong><?= number_format((float) ($total_solde_clients ?? 0), 0, ',', ' ') ?> Ar</strong></p>
    </div>
</div>

<div class="card">
    <?php if (empty($clients)) : ?>
        <div class="empty-state">
            <i class="bi bi-people"></i>
            <strong>Aucun client trouvé</strong>
            <span>Les comptes clients apparaîtront ici une fois créés.</span>
        </div>
    <?php else : ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Solde calculé</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client) : ?>
                        <tr>
                            <td><span class="id-badge">#<?= esc($client->id) ?></span></td>
                            <td><strong><?= esc($client->nom) ?></strong></td>
                            <td><?= esc($client->telephone) ?></td>
                            <td class="money <?= $client->solde >= 0 ? 'positive' : 'negative' ?>">
                                <?= number_format((float) $client->solde, 0, ',', ' ') ?> Ar
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>

<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Barèmes<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('partials/alerts') ?>

<div class="page-header">
    <div>
        <h1>Barèmes</h1>
        <p class="page-description">Frais appliqués selon le type d'opération, l'opérateur et la tranche de montant.</p>
    </div>
    <a href="<?= site_url('operateurs/baremes/create') ?>" class="btn btn-primary">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Ajouter un barème
    </a>
</div>

<div class="card">
    <?php if (empty($baremes)) : ?>
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/></svg>
            <strong>Aucun barème trouvé</strong>
            <span>Définissez un barème de frais pour un type d'opération.</span>
        </div>
    <?php else : ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type d'opération</th>
                        <th>Montant min</th>
                        <th>Montant max</th>
                        <th>Frais</th>
                        <th>Opérateur</th>
                        <th class="col-actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($baremes as $bareme) : ?>
                        <tr>
                            <td><span class="id-badge">#<?= esc($bareme['id']) ?></span></td>
                            <td><span class="pill"><?= esc($bareme['type_operation_nom'] ?? $bareme['type_operation_id']) ?></span></td>
                            <td class="money"><?= number_format((float) $bareme['montant_min'], 0, ',', ' ') ?> Ar</td>
                            <td class="money"><?= number_format((float) $bareme['montant_max'], 0, ',', ' ') ?> Ar</td>
                            <td class="money"><?= number_format((float) $bareme['frais'], 0, ',', ' ') ?> Ar</td>
                            <td><span class="pill pill-muted"><?= esc($bareme['operateur_nom'] ?? $bareme['operateur_id']) ?></span></td>
                            <td>
                                <div class="cell-actions">
                                    <a href="<?= site_url('operateurs/baremes/edit/' . $bareme['id']) ?>" class="btn btn-secondary btn-sm">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                                        Modifier
                                    </a>
                                    <form action="<?= site_url('operateurs/baremes/delete/' . $bareme['id']) ?>" method="post" style="display:inline;">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce barème ?')">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>

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
        <i class="bi bi-plus-lg"></i>
        Ajouter un barème
    </a>
</div>

<div class="card">
    <?php if (empty($baremes)) : ?>
        <div class="empty-state">
            <i class="bi bi-sliders"></i>
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
                                        <i class="bi bi-pencil-square"></i>
                                        Modifier
                                    </a>
                                    <form action="<?= site_url('operateurs/baremes/delete/' . $bareme['id']) ?>" method="post" style="display:inline;">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce barème ?')">
                                            <i class="bi bi-trash3"></i>
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

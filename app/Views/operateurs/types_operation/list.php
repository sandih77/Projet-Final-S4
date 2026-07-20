<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Types d'opération<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('partials/alerts') ?>

<div class="page-header">
    <div>
        <h1>Types d'opération</h1>
        <p class="page-description">Dépôt, retrait, transfert : les opérations disponibles sur la plateforme.</p>
    </div>
    <a href="<?= site_url('operateurs/types-operation/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i>
        Ajouter un type
    </a>
</div>

<div class="card">
    <?php if (empty($types_operation)) : ?>
        <div class="empty-state">
            <i class="bi bi-diagram-3"></i>
            <strong>Aucun type d'opération trouvé</strong>
            <span>Ajoutez un type d'opération (dépôt, retrait, transfert…).</span>
        </div>
    <?php else : ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th class="col-actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($types_operation as $type) : ?>
                        <tr>
                            <td><span class="id-badge">#<?= esc($type['id']) ?></span></td>
                            <td><strong><?= esc($type['nom']) ?></strong></td>
                            <td>
                                <div class="cell-actions">
                                    <a href="<?= site_url('operateurs/types-operation/edit/' . $type['id']) ?>" class="btn btn-secondary btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                        Modifier
                                    </a>
                                    <form action="<?= site_url('operateurs/types-operation/delete/' . $type['id']) ?>" method="post" style="display:inline;">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type d\'opération ?')">
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

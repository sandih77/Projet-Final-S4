<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Opérateurs<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('partials/alerts') ?>

<div class="page-header">
    <div>
        <h1>Opérateurs</h1>
        <p class="page-description">Liste des opérateurs mobile money enregistrés dans la plateforme.</p>
    </div>
    <a href="<?= base_url('operateurs/operateurs/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i>
        Ajouter un opérateur
    </a>
</div>

<div class="card">
    <?php if (empty($operateurs)) : ?>
        <div class="empty-state">
            <i class="bi bi-building"></i>
            <strong>Aucun opérateur trouvé</strong>
            <span>Commencez par ajouter un opérateur mobile money.</span>
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
                    <?php foreach ($operateurs as $operateur) : ?>
                        <tr>
                            <td><span class="id-badge">#<?= esc($operateur['id']) ?></span></td>
                            <td><strong><?= esc($operateur['nom']) ?></strong></td>
                            <td>
                                <div class="cell-actions">
                                    <a href="<?= base_url('operateurs/operateurs/edit/' . $operateur['id']) ?>" class="btn btn-secondary btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                        Modifier
                                    </a>
                                    <form action="<?= base_url('operateurs/operateurs/delete/' . $operateur['id']) ?>" method="post" style="display:inline;">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet opérateur ?')">
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

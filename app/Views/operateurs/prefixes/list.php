<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Préfixes<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('partials/alerts') ?>

<div class="page-header">
    <div>
        <h1>Préfixes</h1>
        <p class="page-description">Préfixes téléphoniques associés à chaque opérateur.</p>
    </div>
    <a href="<?= base_url('operateurs/prefixes/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i>
        Ajouter un préfixe
    </a>
</div>

<div class="card">
    <?php if (empty($prefixes)) : ?>
        <div class="empty-state">
            <i class="bi bi-hash"></i>
            <strong>Aucun préfixe trouvé</strong>
            <span>Ajoutez un préfixe et associez-le à un opérateur.</span>
        </div>
    <?php else : ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Préfixe</th>
                        <th>Opérateur</th>
                        <th class="col-actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prefixes as $prefix) : ?>
                        <tr>
                            <td><span class="id-badge">#<?= esc($prefix['id']) ?></span></td>
                            <td><strong><?= esc($prefix['prefixe']) ?></strong></td>
                            <td><span class="pill"><?= esc($prefix['operateur_id']) ?></span></td>
                            <td>
                                <div class="cell-actions">
                                    <a href="<?= base_url('operateurs/prefixes/edit/' . $prefix['id']) ?>" class="btn btn-secondary btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                        Modifier
                                    </a>
                                    <form action="<?= base_url('operateurs/prefixes/delete/' . $prefix['id']) ?>" method="post" style="display:inline;">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce préfixe ?')">
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

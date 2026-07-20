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
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Ajouter un opérateur
    </a>
</div>

<div class="card">
    <?php if (empty($operateurs)) : ?>
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21V6a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v15"/><path d="M15 21V10a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v11"/><line x1="3" y1="21" x2="21" y2="21"/></svg>
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
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                                        Modifier
                                    </a>
                                    <form action="<?= base_url('operateurs/operateurs/delete/' . $operateur['id']) ?>" method="post" style="display:inline;">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet opérateur ?')">
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

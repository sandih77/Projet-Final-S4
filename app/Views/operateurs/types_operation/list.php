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
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Ajouter un type
    </a>
</div>

<div class="card">
    <?php if (empty($types_operation)) : ?>
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 21 7 12 12 3 7 12 2"/><polyline points="3 12 12 17 21 12"/><polyline points="3 17 12 22 21 17"/></svg>
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
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                                        Modifier
                                    </a>
                                    <form action="<?= site_url('operateurs/types-operation/delete/' . $type['id']) ?>" method="post" style="display:inline;">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type d\'opération ?')">
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

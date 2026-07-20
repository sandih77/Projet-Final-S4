<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?><?= isset($type_operation) ? "Modifier un type d'opération" : "Ajouter un type d'opération" ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<a href="<?= site_url('operateurs/types-operation') ?>" class="back-link">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Retour à la liste des types d'opération
</a>

<div class="page-header">
    <div>
        <h1><?= isset($type_operation) ? "Modifier le type d'opération" : "Ajouter un type d'opération" ?></h1>
        <p class="page-description">Ex. dépôt, retrait ou transfert.</p>
    </div>
</div>

<div class="card card-form">
    <div class="card-body">
        <?php if (isset($type_operation)) : ?>
            <form action="<?= site_url('operateurs/types-operation/update/' . $type_operation['id']) ?>" method="post" class="form-grid">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" value="<?= esc($type_operation['nom']) ?>" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="<?= site_url('operateurs/types-operation') ?>" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        <?php else : ?>
            <form action="<?= site_url('operateurs/types-operation/insert') ?>" method="post" class="form-grid">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" placeholder="Ex. depot" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <a href="<?= site_url('operateurs/types-operation') ?>" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>

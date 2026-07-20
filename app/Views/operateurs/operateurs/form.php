<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?><?= isset($operateur) ? 'Modifier un opérateur' : 'Ajouter un opérateur' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<a href="<?= base_url('operateurs/operateurs') ?>" class="back-link">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Retour à la liste des opérateurs
</a>

<div class="page-header">
    <div>
        <h1><?= isset($operateur) ? "Modifier l'opérateur" : 'Ajouter un opérateur' ?></h1>
        <p class="page-description">Renseignez le nom commercial de l'opérateur mobile money.</p>
    </div>
</div>

<div class="card card-form">
    <div class="card-body">
        <?php if (isset($operateur)) : ?>
            <form action="<?= base_url('operateurs/operateurs/update/' . $operateur['id']) ?>" method="post" class="form-grid">
                <div class="form-group">
                    <label for="nom">Nom de l'opérateur</label>
                    <input type="text" name="nom" id="nom" value="<?= esc($operateur['nom']) ?>" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="<?= base_url('operateurs/operateurs') ?>" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        <?php else : ?>
            <form action="<?= base_url('operateurs/operateurs/insert') ?>" method="post" class="form-grid">
                <div class="form-group">
                    <label for="nom">Nom de l'opérateur</label>
                    <input type="text" name="nom" id="nom" placeholder="Ex. Orange Money" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <a href="<?= base_url('operateurs/operateurs') ?>" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>

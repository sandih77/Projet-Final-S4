<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?><?= isset($prefix) ? 'Modifier un préfixe' : 'Ajouter un préfixe' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<a href="<?= base_url('operateurs/prefixes') ?>" class="back-link">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Retour à la liste des préfixes
</a>

<div class="page-header">
    <div>
        <h1><?= isset($prefix) ? 'Modifier le préfixe' : 'Ajouter un préfixe' ?></h1>
        <p class="page-description">Associez un préfixe téléphonique à un opérateur mobile money.</p>
    </div>
</div>

<div class="card card-form">
    <div class="card-body">
        <?php if (isset($prefix)) : ?>
            <form action="<?= base_url('operateurs/prefixes/update/' . $prefix['id']) ?>" method="post" class="form-grid">
                <div class="form-group">
                    <label for="prefixe">Préfixe</label>
                    <input type="text" name="prefixe" id="prefixe" value="<?= esc($prefix['prefixe']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="operateur_id">Opérateur</label>
                    <select name="operateur_id" id="operateur_id" required>
                        <?php foreach ($operateurs as $operateur) : ?>
                            <option value="<?= $operateur['id'] ?>" <?= $operateur['id'] == $prefix['operateur_id'] ? 'selected' : '' ?>>
                                <?= esc($operateur['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="<?= base_url('operateurs/prefixes') ?>" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        <?php else : ?>
            <form action="<?= base_url('operateurs/prefixes/insert') ?>" method="post" class="form-grid">
                <div class="form-group">
                    <label for="prefixe">Préfixe</label>
                    <input type="text" name="prefixe" id="prefixe" placeholder="Ex. 034" required>
                </div>
                <div class="form-group">
                    <label for="operateur_id">Opérateur</label>
                    <select name="operateur_id" id="operateur_id" required>
                        <?php foreach ($operateurs as $operateur) : ?>
                            <option value="<?= $operateur['id'] ?>"><?= esc($operateur['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <a href="<?= base_url('operateurs/prefixes') ?>" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?><?= isset($bareme) ? 'Modifier un barème' : 'Ajouter un barème' ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<a href="<?= site_url('operateurs/baremes') ?>" class="back-link">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Retour à la liste des barèmes
</a>

<div class="page-header">
    <div>
        <h1><?= isset($bareme) ? 'Modifier le barème' : 'Ajouter un barème' ?></h1>
        <p class="page-description">Définissez les frais applicables pour une tranche de montant.</p>
    </div>
</div>

<div class="card card-form">
    <div class="card-body">
        <?php if (isset($bareme)) : ?>
            <form action="<?= site_url('operateurs/baremes/update/' . $bareme['id']) ?>" method="post" class="form-grid">
                <div class="form-group">
                    <label for="type_operation_id">Type d'opération</label>
                    <select name="type_operation_id" id="type_operation_id" required>
                        <?php foreach ($types_operation as $type) : ?>
                            <option value="<?= $type['id'] ?>" <?= $bareme['type_operation_id'] == $type['id'] ? 'selected' : '' ?>>
                                <?= esc($type['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="montant_min">Montant min (Ar)</label>
                    <input type="number" name="montant_min" id="montant_min" value="<?= esc($bareme['montant_min']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="montant_max">Montant max (Ar)</label>
                    <input type="number" name="montant_max" id="montant_max" value="<?= esc($bareme['montant_max']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="frais">Frais (Ar)</label>
                    <input type="number" name="frais" id="frais" value="<?= esc($bareme['frais']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="operateur_id">Opérateur</label>
                    <select name="operateur_id" id="operateur_id" required>
                        <?php foreach ($operateurs as $operateur) : ?>
                            <option value="<?= $operateur['id'] ?>" <?= $bareme['operateur_id'] == $operateur['id'] ? 'selected' : '' ?>>
                                <?= esc($operateur['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="<?= site_url('operateurs/baremes') ?>" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        <?php else : ?>
            <form action="<?= site_url('operateurs/baremes/insert') ?>" method="post" class="form-grid">
                <div class="form-group">
                    <label for="type_operation_id">Type d'opération</label>
                    <select name="type_operation_id" id="type_operation_id" required>
                        <?php foreach ($types_operation as $type) : ?>
                            <option value="<?= $type['id'] ?>"><?= esc($type['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="montant_min">Montant min (Ar)</label>
                    <input type="number" name="montant_min" id="montant_min" required>
                </div>

                <div class="form-group">
                    <label for="montant_max">Montant max (Ar)</label>
                    <input type="number" name="montant_max" id="montant_max" required>
                </div>

                <div class="form-group">
                    <label for="frais">Frais (Ar)</label>
                    <input type="number" name="frais" id="frais" required>
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
                    <a href="<?= site_url('operateurs/baremes') ?>" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>

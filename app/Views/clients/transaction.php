<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Transaction<?= $this->endSection() ?>

<?= $this->section('content') ?>

<a href="<?= site_url("clients/dashboard") ?>" class="back-link">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Retour au tableau de bord
</a>

<div class="page-header">
    <div>
        <h1>Faire une transaction</h1>
        <p class="page-description">Effectuez un dépôt, un retrait ou un transfert en toute sécurité.</p>
    </div>
</div>

<?= $this->include('partials/alerts') ?>

<div class="card card-form">
    <div class="card-body">
        <form action="<?= site_url("clients/transaction/validate") ?>" method="post" class="form-grid">

            <div class="form-group">
                <label for="type_operation">Type d'opération</label>
                <select id="type_operation" name="type_operation" required>
                    <option value="">-- Sélectionnez un type --</option>

                    <?php foreach ($typesOperations as $typeOperation) : ?>
                        <option value="<?= $typeOperation['id'] ?>">
                            <?= esc($typeOperation['nom']) ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>

            <div class="form-group" id="destinataire_div" style="display:none;">
                <label for="destinataire">Téléphone du destinataire</label>
                <input
                    type="tel"
                    id="destinataire"
                    name="destinataire"
                    placeholder="0341234567"
                    pattern="^(032|033|034|037|038)[0-9]{7}$"
                >
            </div>

            <div class="form-group">
                <label for="montant">Montant (Ar)</label>
                <input
                    type="number"
                    id="montant"
                    name="montant"
                    placeholder="Montant"
                    required
                >
            </div>

            <div class="form-group">
                <label for="code_secret">Code secret</label>
                <input
                    type="password"
                    id="code_secret"
                    name="code_secret"
                    pattern="^[0-9]{4}$"
                    maxlength="4"
                    minlength="4"
                    inputmode="numeric"
                    required
                >
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    Valider la transaction
                </button>
                <a href="<?= site_url("clients/dashboard") ?>" class="btn btn-secondary">
                    Annuler
                </a>
            </div>

        </form>
    </div>
</div>

<script>
    const typeOperation = document.getElementById("type_operation");
    const destinataireDiv = document.getElementById("destinataire_div");
    const destinataireInput = document.getElementById("destinataire");

    typeOperation.addEventListener("change", function () {
        if (this.value == "3") {
            destinataireDiv.style.display = "block";
            destinataireInput.required = true;

        } else {
            destinataireDiv.style.display = "none";
            destinataireInput.required = false;
            destinataireInput.value = "";
        }

    });
</script>

<?= $this->endSection() ?>

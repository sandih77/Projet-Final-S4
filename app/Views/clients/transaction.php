<?= $this->extend("layouts/main") ?>

<?= $this->section("title") ?>Transaction<?= $this->endSection() ?>

<?= $this->section("content") ?>

<a href="<?= site_url("clients/dashboard") ?>" class="back-link">
    <i class="bi bi-arrow-left"></i>
    Retour au tableau de bord
</a>

<div class="page-header">
    <div>
        <h1>Faire une transaction</h1>
        <p class="page-description">Effectuez un dépôt, un retrait ou un transfert en toute sécurité.</p>
    </div>
</div>

<?= $this->include("partials/alerts") ?>

<div class="card card-form">
    <div class="card-body">
        <form action="<?= site_url(
            "clients/transaction/validate",
        ) ?>" method="post" class="form-grid">

            <div class="form-group">
                <label for="type_operation">Type d'opération</label>
                <select id="type_operation" name="type_operation" required>
                    <option value="">-- Sélectionnez un type --</option>

                    <?php foreach ($typesOperations as $typeOperation): ?>
                        <option value="<?= $typeOperation["id"] ?>">
                            <?= esc($typeOperation["nom"]) ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>

            <div class="form-group" id="destinataire_div" style="display:none;">
                <label for="destinataire">Téléphone du destinataire</label>

                <input
                    type="tel"
                    id="destinataire"
                    name="destinataire[]"
                    placeholder="0341234567"
                    pattern="^(032|033|034|037|038)[0-9]{7}$"
                    minlength="10"
                    maxlength="10"
                >

                <div id="destinataires_container"></div>

                <button
                    type="button"
                    id="ajouter_destinataire"
                    class="btn btn-secondary"
                    style="margin-top:10px;"
                >
                    + Ajouter destinataire
                </button>

                <p class="form-hint" id="operateur_info" style="display:none; margin-top:10px;"></p>
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

            <div class="form-group" id="frais_div" style="display:none;">
                <label>Inclure également les frais de retrait ?</label>
                <p class="form-hint">Le frais de transfert (et la commission inter-opérateur éventuelle) est toujours appliqué. Le frais de retrait, lui, est optionnel.</p>

                <div class="radio-group">
                    <label>
                        <input
                            type="radio"
                            name="inclure_transaction"
                            value="1"
                            checked
                        >
                        Oui
                    </label>
                    <label>
                        <input
                            type="radio"
                            name="inclure_transaction"
                            value="0"
                        >
                        Non
                    </label>
                </div>
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
                    <i class="bi bi-check2-circle"></i>
                    Valider la transaction
                </button>
                <a href="<?= site_url(
                    "clients/dashboard",
                ) ?>" class="btn btn-secondary">
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
const fraisDiv = document.getElementById("frais_div");

const ajouterDestinataireBtn = document.getElementById("ajouter_destinataire");
const destinatairesContainer = document.getElementById("destinataires_container");
const operateurInfo = document.getElementById("operateur_info");

typeOperation.addEventListener("change", function () {
    const isTransfert = this.value === "3";

    destinataireDiv.style.display = isTransfert ? "block" : "none";
    destinataireInput.required = isTransfert;

    if (!isTransfert) {
        destinataireInput.value = "";
        fraisDiv.style.display = "none";
        operateurInfo.style.display = "none";
        destinatairesContainer.innerHTML = "";
        ajouterDestinataireBtn.disabled = false;
    }
});

async function verifierOperateurDestinataire() {
    if (typeOperation.value !== "3" || destinataireInput.value.length !== 10) {
        fraisDiv.style.display = "none";
        operateurInfo.style.display = "none";
        ajouterDestinataireBtn.disabled = false;
        return;
    }

    try {
        const formData = new FormData();
        formData.append("telephone", destinataireInput.value);

        const response = await fetch(
            "<?= site_url("clients/transaction/verifier-operateur") ?>",
            {
                method: "POST",
                body: formData
            }
        );

        const data = await response.json();

        if (data.different) {
            // Autre opérateur : uniquement le frais de transfert (+ la
            // commission) s'applique. Pas de frais de retrait optionnel,
            // et pas de transfert multiple possible.
            fraisDiv.style.display = "none";
            ajouterDestinataireBtn.disabled = true;
            destinatairesContainer.innerHTML = "";
            operateurInfo.textContent = "Destinataire chez un autre opérateur : seul le frais de transfert (+ commission) s'applique. Le transfert multiple n'est pas disponible dans ce cas.";
            operateurInfo.style.display = "block";
        } else {
            // Même opérateur : frais de retrait optionnel et transfert
            // multiple autorisés.
            fraisDiv.style.display = "block";
            ajouterDestinataireBtn.disabled = false;
            operateurInfo.style.display = "none";
        }

    } catch (error) {
        console.error(error);
        fraisDiv.style.display = "none";
        operateurInfo.style.display = "none";
    }
}

destinataireInput.addEventListener("input", verifierOperateurDestinataire);

ajouterDestinataireBtn.addEventListener("click", function () {

    const premierNumero = destinataireInput.value;

    if (premierNumero.length < 3) {
        alert("Saisissez d'abord le premier numéro");
        return;
    }

    const prefixe = premierNumero.substring(0, 3);

    const div = document.createElement("div");
    div.classList.add("destinataire-item");

    div.innerHTML = `
        <label>Autre destinataire</label>
        <input
            type="tel"
            name="destinataire[]"
            value="${prefixe}"
            placeholder="${prefixe}xxxxxxx"
            pattern="^(032|033|034|037|038)[0-9]{7}$"
            minlength="10"
            maxlength="10"
        >
        <button type="button" class="btn btn-danger supprimer">
            Supprimer
        </button>
    `;

    destinatairesContainer.appendChild(div);

});

destinatairesContainer.addEventListener("click", function(e) {

    if (e.target.classList.contains("supprimer")) {
        e.target.parentElement.remove();
    }

});


</script>

<?= $this->endSection() ?>

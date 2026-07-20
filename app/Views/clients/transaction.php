<html>
<head>
    <title>Transaction - Projet Final S4</title>
</head>
<body>

    <h1>Faire une transaction</h1>

    <?php if (session()->getFlashdata("error")): ?>
        <p style="color:red">
            <?= session()->getFlashdata("error") ?>
        </p>
    <?php endif; ?>

    <?php if (session()->getFlashdata("success")): ?>
        <p style="color:green">
            <?= session()->getFlashdata("success") ?>
        </p>
    <?php endif; ?>


    <form action="<?= site_url("clients/transaction/validate") ?>" method="post">

        <label for="type_operation">Type d'opération</label>
        <select id="type_operation" name="type_operation" required>
            <option value="">-- Sélectionnez un type --</option>

            <?php foreach ($typesOperations as $typeOperation): ?>
                <option value="<?= $typeOperation['id'] ?>">
                    <?= $typeOperation['nom'] ?>
                </option>
            <?php endforeach; ?>

        </select>


        <div id="destinataire_div" style="display:none;">
            <label for="destinataire">Téléphone du destinataire</label>
            <input
                type="tel"
                id="destinataire"
                name="destinataire"
                placeholder="0341234567"
                pattern="^(032|033|034|037|038)[0-9]{7}$"
            >
        </div>


        <label for="montant">Montant</label>
        <input
            type="number"
            id="montant"
            name="montant"
            placeholder="Montant"
            required
        >


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


        <button type="submit">
            Valider la transaction
        </button>

    </form>

    <a href="<?= site_url("clients/dashboard") ?>">
        Retour
    </a>


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


</body>
</html>

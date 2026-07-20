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
        <label for="montant">Montant</label>
        <input type="number" id="montant" name="montant" placeholder="Montant" required>
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
        <button type="submit">Valider la transaction</button>
    </form>
    <a href=<?= site_url("clients/dashboard") ?>>Retour</a>
</body>
</html>

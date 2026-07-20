<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <a href="<?= site_url('operateurs/baremes') ?>">Retour à la liste des Baremes</a>

    <?php if (isset($bareme)) : ?>
        <h1>Modifier le Bareme</h1>
        <form action="<?= site_url('operateurs/baremes/update/' . $bareme['id']) ?>" method="post">
            <label for="type_operation_id">Type d'Operation:</label>
            <select name="type_operation_id" id="type_operation_id" required>
                <?php foreach ($types_operation as $type) : ?>
                    <option value="<?= $type['id'] ?>" <?= $bareme['type_operation_id'] == $type['id'] ? 'selected' : '' ?>>
                        <?= $type['nom'] ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <label for="montant_min">Montant Min:</label>
            <input type="number" name="montant_min" id="montant_min" value="<?= $bareme['montant_min'] ?>" required><br>

            <label for="montant_max">Montant Max:</label>
            <input type="number" name="montant_max" id="montant_max" value="<?= $bareme['montant_max'] ?>" required><br>

            <label for="frais">Frais:</label>
            <input type="number" name="frais" id="frais" value="<?= $bareme['frais'] ?>" required><br>

            <label for="operateur_id">Operateur ID:</label>
            <select name="operateur_id" id="operateur_id" required>
                <?php foreach ($operateurs as $operateur) : ?>
                    <option value="<?= $operateur['id'] ?>" <?= $bareme['operateur_id'] == $operateur['id'] ? 'selected' : '' ?>>
                        <?= $operateur['nom'] ?>
                    </option>
                <?php endforeach; ?>
                <button type="submit">Mettre à jour</button>
        </form>
    <?php else : ?>
        <h1>Ajouter un Bareme</h1>
        <form action="<?= site_url('operateurs/baremes/insert') ?>" method="post">
            <label for="type_operation_id">Type d'Operation:</label>
            <select name="type_operation_id" id="type_operation_id" required>
                <?php foreach ($types_operation as $type) : ?>
                    <option value="<?= $type['id'] ?>"><?= $type['nom'] ?></option>
                <?php endforeach; ?>
            </select><br>
            <label for="montant_min">Montant Min:</label>
            <input type="number" name="montant_min" id="montant_min" required><br>

            <label for="montant_max">Montant Max:</label>
            <input type="number" name="montant_max" id="montant_max" required><br>

            <label for="frais">Frais:</label>
            <input type="number" name="frais" id="frais" required><br>

            <label for="operateur_id">Operateur ID:</label>
            <select name="operateur_id" id="operateur_id" required>
                <?php foreach ($operateurs as $operateur) : ?>
                    <option value="<?= $operateur['id'] ?>"><?= $operateur['nom'] ?></option>
                <?php endforeach; ?>
            </select><br>
            
            <button type="submit">Ajouter</button>
        </form>
    <?php endif; ?>

</body>

</html>
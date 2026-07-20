<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire des prefixes</title>
</head>
<body>
    <a href="<?= base_url('operateurs/prefixes') ?>">Retour à la liste des prefixes</a>
    <?php if (isset($prefix)) : ?>
        <h2>Modifier le prefixe</h2>
        <form action="<?= base_url('operateurs/prefixes/update/' . $prefix['id']) ?>" method="post">
            <label for="prefixe">Prefixe:</label>
            <input type="text" name="prefixe" id="prefixe" value="<?= $prefix['prefixe'] ?>" required>
            <br>
            <label for="operateur_id">Operateur ID:</label>
            <select name="operateur_id" id="operateur_id" required>
                <?php foreach ($operateurs as $operateur) : ?>
                    <option value="<?= $operateur['id'] ?>" <?= $operateur['id'] == $prefix['operateur_id'] ? 'selected' : '' ?>>
                        <?= $operateur['nom'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Mettre à jour</button>
        </form>
    <?php else : ?>
        <h2>Ajouter un nouveau prefixe</h2>
        <form action="<?= base_url('operateurs/prefixes/insert') ?>" method="post">
            <label for="prefixe">Prefixe:</label>
            <input type="text" name="prefixe" id="prefixe" required>
            <br>
            <label for="operateur_id">Operateur ID:</label>
            <select name="operateur_id" id="operateur_id" required>
                <?php foreach ($operateurs as $operateur) : ?>
                    <option value="<?= $operateur['id'] ?>"><?= $operateur['nom'] ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <button type="submit">Ajouter</button>
        </form>
    <?php endif; ?>
</body>
</html>
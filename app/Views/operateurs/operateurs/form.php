<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operateurs - Formulaire</title>
</head>
<body>
    <a href="<?= base_url('operateurs/operateurs') ?>">Retour à la liste des operateurs</a>
    <?php if (isset($operateur)) : ?>
        <h2>Modifier l'operateur</h2>
        <form action="<?= base_url('operateurs/operateurs/update/' . $operateur['id']) ?>" method="post">
            <label for="nom">Nom:</label>
            <input type="text" name="nom" id="nom" value="<?= $operateur['nom'] ?>" required>
            <button type="submit">Mettre à jour</button>
        </form>
    <?php else : ?>
        <h2>Ajouter un nouvel operateur</h2>
        <form action="<?= base_url('operateurs/operateurs/insert') ?>" method="post">
            <label for="nom">Nom:</label>
            <input type="text" name="nom" id="nom" required>
            <button type="submit">Ajouter</button>
        </form>
    <?php endif; ?>

</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="<?= site_url('operateurs/types-operation') ?>">Retour à la liste des types d'operation</a>
    <?php if (isset($type_operation)) : ?>
        <h1>Modifier le Type d'Operation</h1>
        <form action="<?= site_url('operateurs/types-operation/update/' . $type_operation['id']) ?>" method="post">
            <label for="nom">Nom:</label>
            <input type="text" name="nom" id="nom" value="<?= $type_operation['nom'] ?>" required><br>
            <button type="submit">Mettre à jour</button>
        </form>
    <?php else : ?>
        <h1>Ajouter un Type d'Operation</h1>
        <form action="<?= site_url('operateurs/types-operation/insert') ?>" method="post">
            <label for="nom">Nom:</label>
            <input type="text" name="nom" id="nom" required><br>
            <button type="submit">Ajouter</button>
        </form>
    <?php endif; ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="<?= site_url('operateurs/types-operation/create') ?>">Ajouter un Type d'Operation</a>

    <h1>Liste des Types d'Operation</h1>
    <?php if (empty($types_operation)) : ?>
        <p>Aucun Type d'Operation trouvé.</p>
    <?php else : ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($types_operation as $type) : ?>
                    <tr>
                        <td><?= $type['id'] ?></td>
                        <td><?= $type['nom'] ?></td>
                        <td>
                            <a href="<?= site_url('operateurs/types-operation/edit/' . $type['id']) ?>">Modifier</a>
                            <form action="<?= site_url('operateurs/types-operation/delete/' . $type['id']) ?>" method="post" style="display:inline;">
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce Type d\'Operation ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>
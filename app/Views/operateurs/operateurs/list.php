<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operateurs - List</title>
</head>

<body>
    <h1>Liste des operateurs</h1>
    <a href="<?= base_url('operateurs/operateurs/create') ?>">Ajouter un nouvel operateur</a>
    <?php if (empty($operateurs)) : ?>
        <p>Aucun operateur trouvé.</p>
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
                <?php foreach ($operateurs as $operateur) : ?>
                    <tr>
                        <td><?= $operateur['id'] ?></td>
                        <td><?= $operateur['nom'] ?></td>
                        <td>
                            <a href="<?= base_url('operateurs/operateurs/edit/' . $operateur['id']) ?>">Modifier</a>
                            <form action="<?= base_url('operateurs/operateurs/delete/' . $operateur['id']) ?>" method="post" style="display:inline;">
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet operateur ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>

</html>
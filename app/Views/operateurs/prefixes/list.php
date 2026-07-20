<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MM-list prefixes</title>
</head>
<body>
    <a href="<?= base_url('operateurs/prefixes/create') ?>">Ajouter une nouvelle prefixe pour un operateur</a>

    <h2>Liste des prefixes</h2>
    <?php if (empty($prefixes)) : ?>
        <p>Aucun prefixe trouvé.</p>
    <?php else : ?>
        <table>
            <thead>
                <tr>    
                    <th>ID</th>
                    <th>Prefixe</th>
                    <th>Operateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prefixes as $prefix) : ?>
                    <tr>
                        <td><?= $prefix['id'] ?></td>
                        <td><?= $prefix['prefixe'] ?></td>
                        <td><?= $prefix['operateur_id'] ?></td>
                        <td>
                            <a href="<?= base_url('operateurs/prefixes/edit/' . $prefix['id']) ?>">Modifier</a>
                            <form action="<?= base_url('operateurs/prefixes/delete/' . $prefix['id']) ?>" method="post" style="display:inline;">
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce prefixe ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
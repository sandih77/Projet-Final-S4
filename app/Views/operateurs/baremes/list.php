<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baremes - list</title>
</head>

<body>
    <a href="<?= site_url('operateurs/baremes/create') ?>">Ajouter un Bareme</a>

    <h1>Liste des Baremes</h1>
    <?php if (empty($baremes)) : ?>
        <p>Aucun Bareme trouvé.</p>
    <?php else : ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type d'Operation</th>
                    <th>Montant Min</th>
                    <th>Montant Max</th>
                    <th>Frais</th>
                    <th>Operateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($baremes as $bareme) : ?>
                    <tr>
                        <td><?= $bareme['id'] ?></td>
                        <td><?= $bareme['type_operation_id'] ?></td>
                        <td><?= $bareme['montant_min'] ?></td>
                        <td><?= $bareme['montant_max'] ?></td>
                        <td><?= $bareme['frais'] ?></td>
                        <td><?= $bareme['operateur_id'] ?></td>
                        <td>
                            <a href="<?= site_url('operateurs/baremes/edit/' . $bareme['id']) ?>">Modifier</a>
                            <form action="<?= site_url('operateurs/baremes/delete/' . $bareme['id']) ?>" method="post" style="display:inline;">
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce Bareme ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>

</html>
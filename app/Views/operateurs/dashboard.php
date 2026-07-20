<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Operateurs</title>
</head>
<body>
    <ul>
        <li><a href="<?= base_url('operateurs/prefixes') ?>">Gérer les prefixes</a></li>
        <li><a href="<?= base_url('operateurs/operateurs') ?>">Gérer les operateurs</a></li>
        <li><a href="<?= base_url('operateurs/types-operation') ?>">Gérer les types d'operation</a></li>
        <li><a href="<?= base_url('operateurs/baremes') ?>">Gérer les baremes</a></li>
    </ul>

    <h1>Bienvenue sur le dashboard des operateurs</h1>

    <h2>Statistiques</h2>
    <h1>Total des gains : <?= $total_gains ?> Ar</h1>

    <h1> Total des gains par type d'operation : </h1>
    <ul>
        <?php foreach ($gains_par_type as $gain) : ?>
            <li><?= $gain['type_nom'] ?> : <?= $gain['total_gains'] ?> Ar</li>
        <?php endforeach; ?>
    </ul>

    <h1> Total Gain par operateur : </h1>
    <ul>
        <?php foreach ($gains_par_operateur as $gain) : ?>
            <li><?= $gain['operateur_nom'] ?> : <?= $gain['total_gains'] ?> Ar</li>
        <?php endforeach; ?>
    </ul>

    <h2>Situation des Comptes Clients</h2>
    <h3>Fonds totaux en circulation : <?= number_format($total_solde_clients ?? 0, 0, ',', ' ') ?> Ar</h3>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Solde Calculé (Ar)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($clients)) : ?>
                <?php foreach ($clients as $client) : ?>
                    <tr>
                        <td><?= $client->id ?></td>
                        <td><?= esc($client->nom) ?></td>
                        <td><?= esc($client->telephone) ?></td>
                        <td><strong><?= number_format($client->solde, 0, ',', ' ') ?> Ar</strong></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">Aucun client trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

    <h1>Bienvenue <?= esc($client['nom']); ?></h1>

    <p>Téléphone : <?= esc($client['telephone']); ?></p>

    <p>Id : <?= esc($client['id']); ?></p>

    <ul>
        <li><a href="<?= site_url('clients/transaction')?>">Faire une transaction</a></li>
        <li><a href="<?= site_url('clients/logout')?>">Se déconnecter</a></li>
        <li><a href="<?= site_url('clients/solde/'.$client['id'])?>">Voir solde</a></li>
    </ul>

</body>
</html>

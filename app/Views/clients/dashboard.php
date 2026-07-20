<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenue <?= esc($client->nom); ?></h1>
    <ul>
        <li><a href="<?= site_url('clients/depot')?>">Faire un dépôt</a></li>
        <li><a href="<?= site_url('clients/retrait')?>">Faire un retrait</a></li>
        <li><a href="<?= site_url('clients/transfert')?>">Faire un transfert</a></li>
        <li><a href="<?= site_url('clients/logout')?>">Se déconnecter</a></li>
    </ul>
</body>
</html>

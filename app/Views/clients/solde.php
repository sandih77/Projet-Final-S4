<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Solde du compte</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f5f5f5;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        h1 {
            color: #333;
        }

        .solde {
            font-size: 30px;
            font-weight: bold;
            color: green;
            margin: 20px 0;
        }

        a {
            text-decoration: none;
            background: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="card">

    <h1>Mon compte</h1>

    <p>
        <strong>Nom :</strong>
        <?= esc($client->nom) ?>
    </p>

    <p>
        <strong>Téléphone :</strong>
        <?= esc($client->telephone) ?>
    </p>

    <p>
        <strong>Identifiant :</strong>
        <?= esc($client->id) ?>
    </p>

    <hr>

    <h2>Solde disponible</h2>

    <div class="solde">
        <?= number_format($solde, 0, ',', ' ') ?> Ar
    </div>

    <a href="<?= site_url('clients/dashboard') ?>">
        Retour au tableau de bord
    </a>

</div>

</body>
</html>

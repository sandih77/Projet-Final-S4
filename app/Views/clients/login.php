<html>
<head>
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>

    <?php if (isset($errors)): ?>
        <div style="color:red;">
            <?php foreach ($errors as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div style="color:red;">
            <p><?= esc($error) ?></p>
        </div>
    <?php endif; ?>

    <form action="<?= site_url("clients/login") ?>" method="post">

        <?= csrf_field() ?>

        <label for="telephone">Téléphone:</label>
        <input
            type="tel"
            id="telephone"
            name="telephone"
            placeholder="0341234567"
            pattern="^(032|033|034|037|038)[0-9]{7}$"
            maxlength="10"
            minlength="10"
            value="<?= old("telephone") ?>"
            required
        >

        <br><br>

        <label for="code_secret">Code secret:</label>
        <input
            type="password"
            id="code_secret"
            name="code_secret"
            pattern="^[0-9]{4}$"
            maxlength="4"
            minlength="4"
            inputmode="numeric"
            required
        >

        <br><br>

        <button type="submit">
            Se connecter
        </button>

    </form>

</body>
</html>

<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="" method="post">
        <label for="telephone">Téléphone:</label>
        <input type="tel" id="telephone" name="telephone" placeholder="0341234567"
            pattern="(032|033|034|037|038)[0-9]{7}"
            maxlength="10"
            minlength="10"
            required
        >
        <label for="codesecret">Code secret:</label>
        <input type="password" id="codesecret" name="codesecret"
            pattern="[0-9]{4}"
            maxlength="4"
            minlength="4"
            inputmode="numeric"
            required
        >
        <button type="submit">Login</button>
    </form>
</body>
</html>

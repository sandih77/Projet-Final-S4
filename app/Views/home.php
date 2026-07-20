<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyFlow · Mobile Money</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body>
    <div class="auth-shell">
        <div class="auth-card" style="max-width:480px;">
            <div class="auth-brand">
                <div class="brand-mark">
                    <i class="bi bi-wallet2"></i>
                </div>
                <div>
                    <span class="brand-name">MoneyFlow</span>
                    <span class="brand-tag">Plateforme mobile money</span>
                </div>
            </div>

            <h1>Bienvenue</h1>
            <p class="auth-subtitle">Choisissez votre espace pour continuer.</p>

            <div class="form-grid">
                <a href="<?= base_url('clients') ?>" class="btn btn-primary btn-block">
                    <i class="bi bi-person-fill"></i>
                    Espace client
                </a>
                <a href="<?= base_url('operateurs') ?>" class="btn btn-secondary btn-block">
                    <i class="bi bi-building"></i>
                    Espace opérateur (back-office)
                </a>
            </div>

            <p class="auth-footer-note">MoneyFlow &middot; Votre argent, partout, en toute sécurité.</p>
        </div>
    </div>
</body>
</html>

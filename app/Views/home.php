<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyFlow · Mobile Money</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body>
    <div class="auth-shell">
        <div class="auth-card" style="max-width:480px;">
            <div class="auth-brand">
                <div class="brand-mark">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 7a2 2 0 0 1 2-2h13a1 1 0 0 1 1 1v3"/>
                        <path d="M3 7v11a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10a1 1 0 0 0-1-1H5a2 2 0 0 1-2-2Z"/>
                        <circle cx="16.5" cy="14.5" r="1.5"/>
                    </svg>
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
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7a2 2 0 0 1 2-2h13a1 1 0 0 1 1 1v3"/><path d="M3 7v11a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10a1 1 0 0 0-1-1H5a2 2 0 0 1-2-2Z"/><circle cx="16.5" cy="14.5" r="1.5"/></svg>
                    Espace client
                </a>
                <a href="<?= base_url('operateurs') ?>" class="btn btn-secondary btn-block">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21V6a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v15"/><path d="M15 21V10a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v11"/><line x1="3" y1="21" x2="21" y2="21"/></svg>
                    Espace opérateur (back-office)
                </a>
            </div>

            <p class="auth-footer-note">MoneyFlow &middot; Votre argent, partout, en toute sécurité.</p>
        </div>
    </div>
</body>
</html>

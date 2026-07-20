<?php
/**
 * Layout minimal pour les pages publiques (connexion, etc.)
 * Pas de sidebar : l'utilisateur n'est pas encore authentifié.
 */
$pageTitle = trim($this->renderSection('title', true));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle !== '' ? $pageTitle . ' · ' : '' ?>MoneyFlow</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body>
    <div class="auth-shell">
        <div class="auth-card">
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
                    <span class="brand-tag">Mobile money</span>
                </div>
            </div>

            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>
</html>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body>
    <div class="auth-shell">
        <div class="auth-card">
            <div class="auth-brand">
                <div class="brand-mark">
                    <i class="bi bi-wallet2"></i>
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

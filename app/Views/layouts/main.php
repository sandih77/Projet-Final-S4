<?php
/**
 * Layout principal partagé par toutes les pages authentifiées
 * (espace Opérateur et espace Client).
 *
 * La sidebar et la topbar sont générées automatiquement en fonction
 * de l'URL courante : aucune page n'a besoin de redéclarer sa navigation.
 *
 * Sections attendues dans les vues enfants :
 *   - title   (optionnel) : titre affiché dans <title> et la topbar
 *   - content (obligatoire) : contenu de la page
 */

$currentUri = uri_string();
$isClientArea = str_starts_with($currentUri, 'clients') || str_starts_with($currentUri, 'transaction');
$clientSession = $isClientArea ? session()->get('client') : null;

$navItems = $isClientArea
    ? [
        [
            'match' => 'clients/dashboard',
            'url' => 'clients/dashboard',
            'label' => 'Tableau de bord',
            'icon' => 'bi-speedometer2',
        ],
        [
            'match' => 'clients/solde',
            'url' => 'clients/solde/' . ($clientSession ? $clientSession['id'] : ''),
            'label' => 'Mon solde',
            'icon' => 'bi-wallet2',
        ],
        [
            'match' => 'clients/transaction',
            'url' => 'clients/transaction',
            'label' => 'Faire une transaction',
            'icon' => 'bi-arrow-left-right',
        ],
        [
            'match' => 'clients/historique',
            'url' => 'clients/historique',
            'label' => 'Historique',
            'icon' => 'bi-clock-history',
        ],
        [
            'match' => 'clients/epargne',
            'url' => 'clients/epargne',
            'label' => 'Epargner',
            'icon' => 'bi-wallet2',
        ],
    ]
    : [
        [
            'match' => 'operateurs/operateurs',
            'url' => 'operateurs/operateurs',
            'label' => 'Opérateurs',
            'icon' => 'bi-building',
        ],
        [
            'match' => 'operateurs/prefixes',
            'url' => 'operateurs/prefixes',
            'label' => 'Préfixes',
            'icon' => 'bi-hash',
        ],
        [
            'match' => 'operateurs/types-operation',
            'url' => 'operateurs/types-operation',
            'label' => "Types d'opération",
            'icon' => 'bi-diagram-3',
        ],
        [
            'match' => 'operateurs/baremes',
            'url' => 'operateurs/baremes',
            'label' => 'Barèmes',
            'icon' => 'bi-sliders',
        ],
    ];

$dashboardUrl = $isClientArea ? 'clients/dashboard' : 'operateurs';
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
    <div class="app-shell">

        <div class="sidebar-backdrop" id="appSidebarBackdrop"></div>

        <aside class="sidebar" id="appSidebar">
            <div class="sidebar-brand">
                <div class="brand-mark">
                    <i class="bi bi-wallet2"></i>
                </div>
                <div>
                    <span class="brand-name">MoneyFlow</span>
                    <span class="brand-tag"><?= $isClientArea ? 'Espace client' : 'Espace opérateur' ?></span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a
                    href="<?= site_url($dashboardUrl) ?>"
                    class="nav-link <?= ($currentUri === $dashboardUrl || $currentUri === 'operateurs') ? 'active' : '' ?>"
                >
                    <i class="bi bi-speedometer2"></i>
                    <span>Tableau de bord</span>
                </a>

                <?php foreach ($navItems as $item) : ?>
                    <?php if ($item['match'] === 'clients/dashboard') continue; // déjà affiché ci-dessus ?>
                    <a
                        href="<?= site_url($item['url']) ?>"
                        class="nav-link <?= str_starts_with($currentUri, $item['match']) ? 'active' : '' ?>"
                    >
                        <i class="bi <?= esc($item['icon']) ?>"></i>
                        <span><?= esc($item['label']) ?></span>
                    </a>
                <?php endforeach; ?>
            </nav>

            <div class="sidebar-footer">
                <?php if ($isClientArea && $clientSession) : ?>
                    <div class="sidebar-user">
                        <div class="avatar"><?= esc(mb_strtoupper(mb_substr($clientSession['nom'] ?? '?', 0, 1))) ?></div>
                        <div class="who">
                            <strong><?= esc($clientSession['nom'] ?? '') ?></strong>
                            <span><?= esc($clientSession['telephone'] ?? '') ?></span>
                        </div>
                    </div>
                    <a href="<?= site_url('clients/logout') ?>" class="nav-link logout">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Déconnexion</span>
                    </a>
                <?php elseif (!$isClientArea) : ?>
                    <a href="<?= base_url('/') ?>" class="nav-link logout">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Quitter l'espace</span>
                    </a>
                <?php endif; ?>
            </div>
        </aside>

        <div class="main-col">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Ouvrir le menu">
                        <i class="bi bi-list"></i>
                    </button>
                    <div>
                        <div class="topbar-title"><?= $pageTitle !== '' ? $pageTitle : 'MoneyFlow' ?></div>
                        <div class="topbar-subtitle"><?= $isClientArea ? 'Gérez vos opérations en toute simplicité' : 'Administration des opérateurs mobile money' ?></div>
                    </div>
                </div>
                <div class="topbar-right">
                    <?php if ($isClientArea && $clientSession) : ?>
                        <span class="badge-role"><i class="bi bi-person-circle"></i> Bienvenue, <?= esc($clientSession['nom'] ?? '') ?></span>
                    <?php elseif (!$isClientArea) : ?>
                        <span class="badge-role"><i class="bi bi-shield-lock"></i> Back-office</span>
                    <?php endif; ?>
                </div>
            </header>

            <main class="content">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>
</html>

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
            'icon' => 'grid',
        ],
        [
            'match' => 'clients/solde',
            'url' => 'clients/solde/' . ($clientSession ? $clientSession['id'] : ''),
            'label' => 'Mon solde',
            'icon' => 'wallet',
        ],
        [
            'match' => 'clients/transaction',
            'url' => 'clients/transaction',
            'label' => 'Faire une transaction',
            'icon' => 'swap',
        ],
    ]
    : [
        [
            'match' => 'operateurs/operateurs',
            'url' => 'operateurs/operateurs',
            'label' => 'Opérateurs',
            'icon' => 'building',
        ],
        [
            'match' => 'operateurs/prefixes',
            'url' => 'operateurs/prefixes',
            'label' => 'Préfixes',
            'icon' => 'hash',
        ],
        [
            'match' => 'operateurs/types-operation',
            'url' => 'operateurs/types-operation',
            'label' => "Types d'opération",
            'icon' => 'layers',
        ],
        [
            'match' => 'operateurs/baremes',
            'url' => 'operateurs/baremes',
            'label' => 'Barèmes',
            'icon' => 'sliders',
        ],
    ];

$dashboardUrl = $isClientArea ? 'clients/dashboard' : 'operateurs';
$pageTitle = trim($this->renderSection('title', true));

function moneyflow_icon(string $name): string
{
    $icons = [
        'grid' => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/>',
        'building' => '<path d="M4 21V6a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v15"/><path d="M15 21V10a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v11"/><path d="M9 9h0M9 12h0M9 15h0M9 18h0"/><line x1="3" y1="21" x2="21" y2="21"/>',
        'hash' => '<line x1="5" y1="9" x2="19" y2="9"/><line x1="5" y1="15" x2="19" y2="15"/><line x1="10" y1="4" x2="7" y2="20"/><line x1="17" y1="4" x2="14" y2="20"/>',
        'layers' => '<polygon points="12 2 21 7 12 12 3 7 12 2"/><polyline points="3 12 12 17 21 12"/><polyline points="3 17 12 22 21 17"/>',
        'sliders' => '<line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/>',
        'wallet' => '<path d="M3 7a2 2 0 0 1 2-2h13a1 1 0 0 1 1 1v3"/><path d="M3 7v11a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10a1 1 0 0 0-1-1H5a2 2 0 0 1-2-2Z"/><circle cx="16.5" cy="14.5" r="1.5"/>',
        'swap' => '<polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/>',
        'logout' => '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>',
        'menu' => '<line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>',
    ];

    $path = $icons[$name] ?? '';

    return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' . $path . '</svg>';
}
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
    <div class="app-shell">

        <div class="sidebar-backdrop" id="appSidebarBackdrop"></div>

        <aside class="sidebar" id="appSidebar">
            <div class="sidebar-brand">
                <div class="brand-mark">
                    <?= moneyflow_icon('wallet') ?>
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
                    <?= moneyflow_icon('grid') ?>
                    <span>Tableau de bord</span>
                </a>

                <?php foreach ($navItems as $item) : ?>
                    <?php if ($item['match'] === 'clients/dashboard') continue; // déjà affiché ci-dessus ?>
                    <a
                        href="<?= site_url($item['url']) ?>"
                        class="nav-link <?= str_starts_with($currentUri, $item['match']) ? 'active' : '' ?>"
                    >
                        <?= moneyflow_icon($item['icon']) ?>
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
                        <?= moneyflow_icon('logout') ?>
                        <span>Déconnexion</span>
                    </a>
                <?php elseif (!$isClientArea) : ?>
                    <a href="<?= base_url('/') ?>" class="nav-link logout">
                        <?= moneyflow_icon('logout') ?>
                        <span>Quitter l'espace</span>
                    </a>
                <?php endif; ?>
            </div>
        </aside>

        <div class="main-col">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Ouvrir le menu">
                        <?= moneyflow_icon('menu') ?>
                    </button>
                    <div>
                        <div class="topbar-title"><?= $pageTitle !== '' ? $pageTitle : 'MoneyFlow' ?></div>
                        <div class="topbar-subtitle"><?= $isClientArea ? 'Gérez vos opérations en toute simplicité' : 'Administration des opérateurs mobile money' ?></div>
                    </div>
                </div>
                <div class="topbar-right">
                    <?php if ($isClientArea && $clientSession) : ?>
                        <span class="badge-role">Bienvenue, <?= esc($clientSession['nom'] ?? '') ?></span>
                    <?php elseif (!$isClientArea) : ?>
                        <span class="badge-role">Back-office</span>
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

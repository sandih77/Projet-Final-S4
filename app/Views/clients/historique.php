<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Historique<?= $this->endSection() ?>

<?= $this->section('content') ?>

<a href="<?= site_url('clients/dashboard') ?>" class="back-link">
    <i class="bi bi-arrow-left"></i>
    Retour au tableau de bord
</a>

<div class="page-header">
    <div>
        <h1>Historique des transactions</h1>
        <p class="page-description">Toutes vos opérations (dépôts, retraits et transferts) triées par date.</p>
    </div>
</div>

<?= $this->include('partials/alerts') ?>

<div class="card">
    <?php if (empty($historique)) : ?>
        <div class="empty-state">
            <i class="bi bi-clock-history"></i>
            <strong>Aucune transaction trouvée</strong>
            <span>Vos opérations apparaîtront ici dès que vous en effectuerez une.</span>
        </div>
    <?php else : ?>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Détail</th>
                        <th>Opérateur</th>
                        <th>Montant</th>
                        <th>Frais</th>
                        <th>Commission</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historique as $operation) : ?>
                        <?php
                            $isRecu = (int) $operation['client_destinataire'] === (int) $client['id']
                                && (int) $operation['client_id'] !== (int) $client['id'];

                            $typeNom = $operation['type_operation_nom'] ?? '—';

                            if ($isRecu) {
                                $label = 'Transfert reçu';
                                $icon = 'bi-arrow-down-circle-fill';
                                $tone = 'positive';
                                $sign = '+';
                                $montantAffiche = (float) $operation['montant'];
                            } elseif ($typeNom === 'depot') {
                                $label = 'Dépôt';
                                $icon = 'bi-arrow-down-circle-fill';
                                $tone = 'positive';
                                $sign = '+';
                                $montantAffiche = (float) $operation['montant'];
                            } elseif ($typeNom === 'retrait') {
                                $label = 'Retrait';
                                $icon = 'bi-arrow-up-circle-fill';
                                $tone = 'negative';
                                $sign = '-';
                                $montantAffiche = (float) $operation['montant'];
                            } else {
                                $label = 'Transfert envoyé';
                                $icon = 'bi-arrow-left-right';
                                $tone = 'negative';
                                $sign = '-';
                                $montantAffiche = (float) $operation['montant'];
                            }
                        ?>
                        <tr>
                            <td><?= esc(date('d/m/Y H:i', strtotime($operation['date_operation']))) ?></td>
                            <td>
                                <span class="pill">
                                    <i class="bi <?= esc($icon) ?>"></i>
                                    <?= esc($label) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($label === 'Transfert envoyé') : ?>
                                    Vers <?= esc($operation['destinataire_telephone'] ?? '—') ?>
                                    <?php if (!empty($operation['destinataire_nom'])) : ?>
                                        (<?= esc($operation['destinataire_nom']) ?>)
                                    <?php endif; ?>
                                <?php elseif ($label === 'Transfert reçu') : ?>
                                    Depuis un autre client
                                <?php else : ?>
                                    —
                                <?php endif; ?>
                            </td>
                            <td><span class="pill pill-muted"><?= esc($operation['operateur_nom'] ?? '—') ?></span></td>
                            <td class="money <?= $tone ?>">
                                <?= $sign ?><?= number_format($montantAffiche, 0, ',', ' ') ?> Ar
                            </td>
                            <td class="money">
                                <?= number_format((float) $operation['frais'], 0, ',', ' ') ?> Ar
                            </td>
                            <td class="money">
                                <?php if ((float) ($operation['commission'] ?? 0) > 0) : ?>
                                    <?= number_format((float) $operation['commission'], 0, ',', ' ') ?> Ar
                                <?php else : ?>
                                    —
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>

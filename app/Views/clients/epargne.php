<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Epargne<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('partials/alerts') ?>

<div class="page-header">
    <div>
        <h1>Bonjour <?= esc($client['nom']) ?></h1>
    </div>
</div>

<div class="card card-form">
    <div class="card-body">
        <form action="<?= site_url(
            "clients/epargne/valider",
        ) ?>" method="post" class="form-grid">
            <div class="form-group">
                <label for="epargne">Pourcentage de l'epargne</label>
                <input
                    type="number"
                    id="epargne"
                    name="epargne"
                    required
                >
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check2-circle"></i>
                    Valider l'epargne
                </button>
                <a href="<?= site_url(
                    "clients/dashboard",
                ) ?>" class="btn btn-secondary">
                    Annuler
                </a>
            </div>

        </form>
    </div>
</div>

<?= $this->endSection() ?>

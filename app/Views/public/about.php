<?= $this->extend('guest') ?>

<?= $this->section('content') ?>
<div class="bg_4 py-3 mb-3">
    <div class="container fw-bold"><?= strtoupper(menu()['menu']); ?></div>
</div>
<p><?= about_term('about'); ?></p>
<?= $this->endSection() ?>
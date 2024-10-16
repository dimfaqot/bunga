<?= $this->extend('logged') ?>

<?= $this->section('content') ?>

<?php if (count($data) == 0): ?>
    <p class="text_danger"><i class="fa-solid fa-triangle-exclamation"></i> Data tidak ditemukan!.</p>

<?php else: ?>
    <?php foreach (get_cols(menu()['tabel']) as $i): ?>
        <?php if ($i !== "id"): ?>
            <div class="card mb-2">
                <div class="card-body">
                    <div class="mb-2"><?= upper_first(str_replace("_", " ", $i)); ?></div>
                    <form method="post" action="<?= base_url(menu()['controller']); ?>/update">
                        <input type="hidden" name="id" value="<?= $data['id']; ?>">
                        <input type="hidden" name="col" value="<?= $i; ?>">
                        <div class="input-group">
                            <input type="text" class="form-control" name="value" value="<?= $data[$i]; ?>" placeholder="<?= upper_first(str_replace("_", " ", $i)); ?>" required>
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                        </div>

                    </form>
                </div>
            </div>

        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection() ?>
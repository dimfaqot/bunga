<?= $this->extend('logged') ?>

<?= $this->section('content') ?>
<form action="<?= base_url(menu()['controller']); ?>/update" method="post">
    <div class="mb-3">
        <label class="form-label">Term and Condition</label>
        <textarea id="ck_term" class="form-control" name="term" rows="6"><?= about_term('term'); ?></textarea>

    </div>
    <div class="d-grid">
        <button type="submit" class="btn_1 rounded"><i class="fa-solid fa-floppy-disk"></i> Save</button>
    </div>

</form>
<script>
    // CK EDITOR MEMBER IDENTITAS
    let ck_term;
    ClassicEditor
        .create(document.querySelector('#ck_term'))
        .then(newEditor => {
            ck_term = newEditor;
        })
        .catch(error => {
            console.error(error);
        });
</script>
<?= $this->endSection() ?>
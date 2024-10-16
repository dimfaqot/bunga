<?= $this->extend('logged') ?>

<?= $this->section('content') ?>
<form action="<?= base_url(menu()['controller']); ?>/update" method="post">
    <div class="mb-3">
        <label class="form-label">About Us</label>
        <textarea id="ck_about" class="form-control" name="about" rows="6"><?= about_term('about'); ?></textarea>

    </div>
    <div class="d-grid">
        <button type="submit" class="btn_1 rounded"><i class="fa-solid fa-floppy-disk"></i> Save</button>
    </div>

</form>
<script>
    // CK EDITOR MEMBER IDENTITAS
    let ck_about;
    ClassicEditor
        .create(document.querySelector('#ck_about'))
        .then(newEditor => {
            ck_about = newEditor;
        })
        .catch(error => {
            console.error(error);
        });
</script>
<?= $this->endSection() ?>
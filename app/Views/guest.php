<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $judul; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="<?= base_url('berkas'); ?>/logo.png" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>style.css" />

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="<?= base_url('functions_js.js'); ?>"></script>
    <script src="https://kit.fontawesome.com/a193ca89ae.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body id="body">
    <!-- warning alert message -->
    <div class="box_warning" style="position:fixed;z-index:999999;display:none;">

    </div>

    <!-- warning alert message with button -->
    <div class="box_warning_with_button" style="position:fixed;z-index:999999;display:none;"></div>

    <!-- sukses php -->
    <?php if (session()->getFlashdata('sukses')) : ?>
        <script>
            let alert = '<?= session()->getFlashdata('sukses'); ?>';
            sukses(alert);
        </script>

    <?php endif; ?>
    <!-- gagal php -->
    <?php if (session()->getFlashdata('gagal')) : ?>
        <script>
            let alert = '<?= session()->getFlashdata('gagal'); ?>';
            gagal_with_button(alert);
        </script>

    <?php endif; ?>

    <?= view('navbar'); ?>
    <div class="container" style="margin-bottom: 100px;">
        <?= $this->renderSection('content') ?>
    </div>

    <?= view('contents/footer'); ?>

    <!-- modal zoom product-->
    <div class="modal fade" id="zoom_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="d-flex justify-content-between bg_1 p-3 text_light">
                        <div><i class="fa-solid fa-magnifying-glass-plus"></i> Zoom</div>
                        <div><a href="" data-bs-dismiss="modal" class="text_light"><i class="fa-solid fa-circle-xmark"></i></a></div>

                    </div>
                    <div class="zoom_product_body text-center p-5"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
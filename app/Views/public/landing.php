<?= $this->extend('guest') ?>

<?= $this->section('content') ?>
<!-- MD -->
<div class="d-none d-md-block" style="margin-bottom: 160px;">
    <div class="bg_4 py-3 mb-3">
        <div class="container fw-bold">PRODUCTS</div>
    </div>
    <div class="row">
        <div class="col-3">
            <h6>SEARCH PRODUCTS</h6>
            <div class="input-group input-group-sm mb-4">
                <input type="search" class="form-control" placeholder="Search for products">
                <button class="btn btn-outline-secondary" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>

            <h6>URUTKAN SESUAI</h6>
            <select class="form-select form-select-sm mb-4">
                <option selected value="created_at DESC">Terbaru</option>
                <option value="created_at ASC">Terlama</option>
                <option value="harga DESC">Harga Tertinggi</option>
                <option value="harga ASC">Harga Terendah</option>
            </select>
            <h6>PRODUK UNGGULAN</h6>

            <?php foreach (products() as $i): ?>

                <div class="card mb-2 text-center" style="max-width: 200px;">
                    <img style="cursor:zoom-in;" src="<?= base_url('berkas/products/'); ?><?= $i['gambar']; ?>" class="img-fluid zoom_product" alt="<?= $i['nama']; ?>">
                    <div class="card-body">
                        <h6 class="card-title"><?= $i['nama']; ?></h6>
                        <p class="card-text"><?= rupiah($i['harga']); ?></p>
                        <a href="<?= text_wa_pemesanan($i); ?>" class="btn btn-primary">Pesan <i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>


        <div class="col-6">
            <div class="row">
                <?php foreach (products() as $i): ?>
                    <div class="col-6">
                        <div class="card text-center">
                            <img style="cursor:zoom-in;" src="<?= base_url('berkas/products/'); ?><?= $i['gambar']; ?>" class="img-fluid zoom_product" alt="<?= $i['nama']; ?>">
                            <div class="card-body">
                                <h6 class="card-title"><?= $i['nama']; ?></h6>
                                <p class="card-text"><?= rupiah($i['harga']); ?></p>
                                <a href="<?= text_wa_pemesanan($i); ?>" class="btn btn-primary">Pesan <i class="fa-brands fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-3">
            <?= view('contents/right_md'); ?>
        </div>
    </div>
</div>


<!-- SM -->
<div class="d-block d-md-none d-sm-block">
    <div class="fixed-top" style="margin-top: 263px;">

        <div class="bg_4 py-2">
            <div class="container fw-bold">PRODUCTS</div>
        </div>
        <div class="d-flex justify-content-between gap-3 bg_light px-2 pt-2">
            <div class="input-group input-group-sm">
                <input type="search" class="form-control" placeholder="Search for products">
                <button class="btn btn-outline-secondary" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>

            <select class="form-select form-select-sm">
                <option style="font-size: small;" selected value="visited DESC">Unggulan</option>
                <option style="font-size: small;" value="created_at DESC">Terbaru</option>
                <option style="font-size: small;" value="created_at ASC">Terlama</option>
                <option style="font-size: small;" value="harga DESC">Harga Tertinggi</option>
                <option style="font-size: small;" value="harga ASC">Harga Terendah</option>
            </select>
        </div>

    </div>
    <div style="margin-top: 360px;">

        <div class="row g-2">
            <div class="col-6">
                <div class="card">
                    <img style="cursor:zoom-in;" src="<?= base_url('berkas/products/'); ?><?= $i['gambar']; ?>" class="card-img-top zoom_product" alt="<?= $i['nama']; ?>">
                    <div class="card-body">
                        <h6 class="card-title">Card title</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>






<script>
    $(document).on('click', '.pemesanan', function(e) {
        let hp = '+62<?= substr(settings('no_penerima_pesanan'), 1); ?>';

        window.open('whatsapp://send/?phone=' + hp + '&amp;text=Assalamualaikum Wr.Wb. Saya mau pesan jadwal rebana.', '_blank');


    })
</script>
<?= $this->endSection() ?>
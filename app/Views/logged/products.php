<?= $this->extend('logged') ?>

<?= $this->section('content') ?>
<!-- Button trigger modal -->
<button type="button" class="btn_2 rounded mb-3" data-bs-toggle="modal" data-bs-target="#add_<?= menu()['controller']; ?>">
    <i class="<?= menu()['icon']; ?>"></i> Add <?= menu()['menu']; ?>
</button>

<!-- modal add -->
<div class="modal fade" id="add_<?= menu()['controller']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div><i class="<?= menu()['icon']; ?>"></i> Add <?= menu()['menu']; ?></div>
                    <div><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                </div>
                <hr>
                <form action="<?= menu()['controller']; ?>/add" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="col" value="gambar">
                    <div class="input-group input-group-sm mb-2" required>
                        <span style="width: 100px;" class="input-group-text">Kategori</span>
                        <select name="kategori" class="form-select">
                            <?php foreach (options('Products') as $i): ?>
                                <option <?= ($i['value'] == 'Reguler' ? 'selected' : ''); ?> value="<?= $i['value']; ?>"><?= $i['value']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="input-group input-group-sm mb-2">
                        <span style="width: 100px;" class="input-group-text">Nama Bunga</span>
                        <input type="text" placeholder="Nama Bunga" name="nama" class="form-control" required>
                    </div>

                    <div class="input-group input-group-sm mb-2">
                        <span style="width: 100px;" class="input-group-text">Harga</span>
                        <input type="text" placeholder="Harga" name="harga" class="form-control uang" required>
                    </div>
                    <div class="input-group input-group-sm mb-2">
                        <span style="width: 100px;" class="input-group-text">Gambar</span>
                        <input class="form-control form-control-sm" name="file" type="file" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn_1 rounded"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?php if (count($data) == 0): ?>
    <p class="text_danger"><i class="fa-solid fa-triangle-exclamation"></i> Data tidak ditemukan!.</p>

<?php else: ?>
    <?php foreach ($data as $i): ?>
        <div class="card mb-2">
            <div class="card-body">
                <a href="" class="btn_danger rounded fs-6 btn_confirm" data-url="<?= menu()['controller']; ?>/delete" data-alert="Yakin hapus data ini?" data-id="<?= $i['id']; ?>" data-tabel="<?= menu()['tabel']; ?>"><i class="fa-solid fa-square-xmark"></i> Hapus</a>
                <form class="mt-2" method="post" action="<?= base_url(menu()['controller']); ?>/update" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $i['id']; ?>">
                    <input type="hidden" name="col" value="gambar">
                    <div class="input-group input-group-sm mb-2">
                        <span style="width: 100px;" class="input-group-text">Kategori</span>
                        <select name="kategori" class="form-select" required>
                            <?php foreach (options('Products') as $k): ?>
                                <option <?= ($i['kategori'] ==  $k['value'] ? 'selected' : ''); ?> value="<?= $k['value']; ?>"><?= $k['value']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-2">
                        <span style="width: 100px;" class="input-group-text">Nama Bunga</span>
                        <input type="text" placeholder="Nama Bunga" value="<?= $i['nama']; ?>" name="nama" class="form-control" required>
                    </div>

                    <div class="input-group input-group-sm mb-2">
                        <span style="width: 100px;" class="input-group-text">Harga</span>
                        <input type="text" placeholder="Harga" value="<?= rupiah($i['harga']); ?>" name="harga" class="form-control uang" required>
                    </div>
                    <div class="mb-2">
                        <div style="width: 100px;" class="mb-1">Gambar</div>
                        <div>
                            <img style="cursor:zoom-in;" class="zoom_product" width="80" src="<?= base_url('berkas/products'); ?>/<?= $i['gambar']; ?>" alt="<?= $i['nama']; ?>">
                        </div>
                    </div>


                    <div class="input-group mb-3">
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn_1 rounded"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>

                </form>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection() ?>
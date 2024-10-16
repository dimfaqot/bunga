<?= $this->extend('logged') ?>

<?= $this->section('content') ?>
<div class="row g-2">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h6><i class="fa-solid fa-user"></i> User</h6>
                <hr>
                <div>
                    <label style="width: 90px;">Username</label>
                    : <?= session('username'); ?>
                </div>
                <div>
                    <label style="width: 90px;">Role</label>
                    : <?= session('role'); ?>
                </div>
                <div>
                    <label style="width: 90px;">Nama</label>
                    : <?= session('nama'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h6><i class="fa-solid fa-lock"></i> Ganti Password</h6>
                <hr>
                <form action="<?= base_url('home/ganti_password'); ?>" method="post">
                    <div class="input-group input-group-sm mb-3">
                        <span style="width: 150px;" class="input-group-text">Password Saat Ini</span>
                        <input required name="password_saat_ini" placeholder="Current password" type="password" class="form-control">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span style="width: 150px;" class="input-group-text">Password Baru</span>
                        <input required name="password_baru" placeholder="New password" type="password" class="form-control">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span style="width: 150px;" class="input-group-text">Uangi Password Baru</span>
                        <input required name="ulangi_password_baru" placeholder="Rewrite new password" type="password" class="form-control">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn_1 rounded"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h6><i class="fa-solid fa-store"></i> Penjualan</h6>
                <hr>
                <form action="<?= base_url('home/ganti_password'); ?>" method="post">
                    <div class="input-group input-group-sm mb-3">
                        <span style="width: 150px;" class="input-group-text">Password Saat Ini</span>
                        <input required name="password_saat_ini" placeholder="Current password" type="password" class="form-control">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span style="width: 150px;" class="input-group-text">Password Baru</span>
                        <input required name="password_baru" placeholder="New password" type="password" class="form-control">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span style="width: 150px;" class="input-group-text">Uangi Password Baru</span>
                        <input required name="ulangi_password_baru" placeholder="Rewrite new password" type="password" class="form-control">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn_1 rounded"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection() ?>
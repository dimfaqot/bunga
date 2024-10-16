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
                <form action="<?= menu()['controller']; ?>/add" method="post">
                    <div class="input-group input-group-sm mb-2">
                        <span style="width: 100px;" class="input-group-text">Role</span>
                        <select name="role" class="form-select" required>
                            <?php foreach (options('Role') as $i): ?>
                                <option <?= ($i['value'] == 'Member' ? 'selected' : ''); ?> value="<?= $i['value']; ?>"><?= $i['value']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-2">
                        <span style="width: 100px;" class="input-group-text">Menu</span>
                        <input type="text" placeholder="Menu" name="menu" class="form-control" required>
                    </div>

                    <div class="input-group input-group-sm mb-2">
                        <span style="width: 100px;" class="input-group-text">Tabel</span>
                        <input type="text" placeholder="Tabel" name="tabel" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-2">
                        <span style="width: 100px;" class="input-group-text">Controller</span>
                        <input type="text" placeholder="Controller" name="controller" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-2">
                        <span style="width: 100px;" class="input-group-text">Icon</span>
                        <input type="text" placeholder="Icon" name="icon" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-2">
                        <span style="width: 100px;" class="input-group-text">Urutan</span>
                        <input type="number" placeholder="Urutan" name="urutan" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-2">
                        <span style="width: 100px;" class="input-group-text">Grup</span>
                        <input type="text" placeholder="Grup" name="grup" class="form-control" required>
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
    <table class="table table-bordered table striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Role</th>
                <th scope="col">Menu</th>
                <th scope="col">Grup</th>
                <th scope="col">Act</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $k => $i): ?>
                <tr>
                    <th scope="row"><?= ($k + 1); ?></th>
                    <td><?= $i['role']; ?></td>
                    <td><?= $i['menu']; ?></td>
                    <td><?= $i['grup']; ?></td>
                    <td><a href="" data-bs-toggle="modal" data-bs-target="#update_<?= menu()['controller']; ?>_<?= $i['id']; ?>" class="btn_4 rounded fs-6"><i class="fa-solid fa-square-pen"></i> Edit</a> <a href="" class="btn_danger rounded fs-6 btn_confirm" data-url="<?= menu()['controller']; ?>/delete" data-alert="Yakin hapus data ini?" data-id="<?= $i['id']; ?>" data-tabel="<?= menu()['tabel']; ?>"><i class="fa-solid fa-square-xmark"></i> Hapus</a></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<!-- modal update -->
<?php foreach ($data as $i): ?>
    <div class="modal fade" id="update_<?= menu()['controller']; ?>_<?= $i['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <div><i class="<?= menu()['icon']; ?>"></i> Update <?= menu()['menu']; ?></div>
                        <div><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    </div>
                    <hr>
                    <form action="<?= menu()['controller']; ?>/update" method="post">
                        <input type="hidden" name="id" value="<?= $i['id']; ?>">
                        <div class="input-group input-group-sm mb-2">
                            <span style="width: 100px;" class="input-group-text">Role</span>
                            <select name="role" class="form-select" required>
                                <?php foreach (options('Role') as $r): ?>
                                    <option <?= ($i['role'] == $r['value'] ? 'selected' : ''); ?> value="<?= $r['value']; ?>"><?= $r['value']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <span style="width: 100px;" class="input-group-text">Menu</span>
                            <input type="text" placeholder="Menu" value="<?= $i['menu']; ?>" name="menu" class="form-control" required>
                        </div>

                        <div class="input-group input-group-sm mb-2">
                            <span style="width: 100px;" class="input-group-text">Tabel</span>
                            <input type="text" placeholder="Tabel" value="<?= $i['tabel']; ?>" name="tabel" class="form-control" required>
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <span style="width: 100px;" class="input-group-text">Controller</span>
                            <input type="text" placeholder="Controller" value="<?= $i['controller']; ?>" name="controller" class="form-control" required>
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <span style="width: 100px;" class="input-group-text">Icon</span>
                            <input type="text" placeholder="Icon" value="<?= $i['icon']; ?>" name="icon" class="form-control" required>
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <span style="width: 100px;" class="input-group-text">Urutan</span>
                            <input type="text" placeholder="Urutan" value="<?= $i['urutan']; ?>" name="urutan" class="form-control" required>
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <span style="width: 100px;" class="input-group-text">Grup</span>
                            <input type="text" placeholder="Grup" value="<?= $i['grup']; ?>" name="grup" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn_1 rounded"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


<?php endforeach; ?>
<?= $this->endSection() ?>
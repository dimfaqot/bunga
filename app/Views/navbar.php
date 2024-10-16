<!-- MD -->

<div class="d-none d-md-block" style="margin-bottom: 92px;">
    <div class="fixed-top">
        <div class="bg_1 px-5 py-2 text_4 d-flex justify-content-between fs-5 gap-3">
            <div>
                <a href="<?= (session('id') ? base_url('home') : base_url()); ?>" class="link_light"><img width="20" src="<?= base_url('berkas/logo_light.png'); ?>" alt=""> <span class="fw-200"><?= settings('nama_web'); ?></span></a>
            </div>
            <div class="d-flex justify-content-between gap-3">
                <div class="d-flex gap-2">
                    <?php
                    $db = db('menu');
                    $q1[] = ['id' => 0, 'no_urut' => 0, 'role' => (session('role') ? session('role') : 'Public'), 'menu' => 'Home', 'tabel' => 'users', 'controller' => (session('role') ? 'home' : ''), 'icon' => "fa-solid fa-earth-asia", 'url' => 'home', 'logo' => 'file_not_found.jpg', 'grup' => ''];
                    $q2 = $db->where('role', (session('role') ? session('role') : 'Public'))->groupBy('grup')->orderBy('urutan', 'ASC')->get()->getResultArray();

                    $menus = array_merge($q1, $q2);
                    ?>
                    <?php foreach ($menus as $m) : ?>
                        <?php if ($m['menu'] == 'Home') : ?>
                            <a href="<?= base_url($m['controller']); ?>" class="btn_1 rounded fs-6 <?= (url() == $m['controller'] ? 'btn_light' : ''); ?> type=" button">
                                <i class="<?= $m['icon']; ?>"></i> <?= $m['menu']; ?>
                            </a>
                        <?php else : ?>
                            <?php if (count_menu_grup($m['grup']) <= 1): ?>

                                <a href="<?= base_url($m['controller']); ?>" class="btn_1 rounded fs-6 <?= (url() == $m['controller'] ? 'btn_light' : ''); ?> type=" button">
                                    <i class="<?= $m['icon']; ?>"></i> <?= $m['menu']; ?>
                                </a>

                            <?php else: ?>

                                <div class="dropdown">
                                    <a href="" class="btn_1 rounded fs-6 <?= (is_menu_active($m['grup']) ? 'btn_light' : ''); ?> dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="<?= $m['icon']; ?>"></i> <?= $m['grup']; ?>
                                    </a>
                                    <ul class="dropdown-menu p-2 bg_4">
                                        <?php foreach (menus() as $i) : ?>
                                            <?php if ($i['grup'] == $m['grup']) : ?>
                                                <li><a style="border: none;" class="dropdown-item btn_1 rounded mb-1 fs-6 <?= (url() == $i['controller'] ? 'btn_light' : ''); ?>" href="<?= base_url($i['controller']); ?>"><i class="<?= $i['icon']; ?>"></i> <?= $i['menu']; ?></a></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>

                                </div>

                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>
                <div>
                    <?php if (session('id')): ?>
                        <a href="<?= base_url('logout'); ?>" class="btn_danger fs-6 rounded fw-bold"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>

                    <?php else: ?>
                        <a href="" data-bs-toggle="modal" data-bs-target="#login_modal" class="btn_dark fs-6 rounded fw-bold"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>

                    <?php endif; ?>

                </div>
            </div>
        </div>
        <?php if (!session('id')): ?>
            <div class="bg_dark px-5 py-2 d-flex gap-3">
                <a href="" class="link_light"><i class="fa-brands fa-whatsapp"></i> Kritik Saran</a>
                <a href="mailto:<?= settings('email'); ?>" class="link_light"><i class="fa-regular fa-envelope"></i> Email / <?= settings('email'); ?></a>
                <a href="<?= settings('instagram'); ?>" class="link_light"><i class="fa-brands fa-whatsapp"></i> Instagram</a>
                <a href="<?= settings('facebook'); ?>" class="link_light"><i class="fa-brands fa-facebook"></i> Fb</a>
                <a href="<?= settings('tiktok'); ?>" class="link_light"><i class="fa-brands fa-tiktok"></i> Tiktok</a>
            </div>


        <?php endif; ?>

    </div>

</div>


<!-- sm -->

<div class="d-block d-md-none d-sm-block">
    <div class="fixed-top">
        <div class="bg_1 text_4 d-flex justify-content-between p-2">
            <div>
                <a href="<?= (session('id') ? base_url('home') : base_url()); ?>" class="link_light"><img width="15" src="<?= base_url('berkas/logo_light.png'); ?>" alt=""> <span class="fw-200"><?= settings('nama_web'); ?></span></a>
            </div>
            <div class="link_light">
                <i class="<?= menus()[0]['icon']; ?>"></i> <?= menus()[0]['menu']; ?>
            </div>
            <div>

                <a href="" class="link_light" data-bs-toggle="offcanvas" data-bs-target="#menu" aria-controls="offcanvasScrolling"><i class="fa-solid fa-bars"></i></a>
            </div>


        </div>
        <?php if (!session('id')): ?>
            <div class="bg_dark p-2 d-flex gap-3">
                <a href="" class="link_light"><i class="fa-brands fa-whatsapp"></i> Kritik Saran</a>
                <a href="mailto:<?= settings('email'); ?>" class="link_light"><i class="fa-regular fa-envelope"></i> <?= settings('email'); ?></a>
                <a href="<?= settings('instagram'); ?>" class="link_light"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="<?= settings('facebook'); ?>" class="link_light"><i class="fa-brands fa-facebook"></i></a>
                <a href="<?= settings('tiktok'); ?>" class="link_light"><i class="fa-brands fa-tiktok"></i></a>
            </div>

            <div class="bg_5 p-2" style="height: 250px;overflow-y:auto">
                <h6>CARA PEMESANAN</h6>
                <?php foreach (urutan_transaksi() as $k => $i): ?>
                    <h6 class="text_dark"><?= $k + 1; ?>. <i class="<?= $i['icon']; ?>"></i> <?= $i['text']; ?></h6>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>
    </div>
</div>

<!-- canvas sm -->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="menu" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-body p-0">
        <div class="fixed-top">
            <div class="d-flex justify-content-between bg_dark p-3">
                <div>
                    <h6 class="text_light fs-5">Menu</h6>
                </div>
                <div>
                    <a href="" data-bs-dismiss="offcanvas" class="link_light fs-5"><i class="fa-solid fa-circle-xmark"></i></a>
                </div>
            </div>

        </div>
        <div class="p-3" style="margin-top: 60px;">
            <?php foreach (menus() as $i): ?>
                <a href="" class="fs-6 fw-100 mb-1 <?= (url() == $i['controller'] ? 'btn_1' : 'btn_4'); ?>" style="display:block;width:100%;text-align:left"><i class="<?= $i['icon']; ?>"></i> <?= $i['menu']; ?></a>
            <?php endforeach; ?>
            <?php if (session('id')): ?>
                <a href="<?= base_url('logout'); ?>" class="btn_2 fs-6 fw-100 mt-3" style="display:block;width:100%;text-align:left"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>

            <?php else: ?>
                <a href="" data-bs-toggle="modal" data-bs-target="#login_modal" class="btn_2 fs-6 fw-100 mt-3" style="display:block;width:100%;text-align:left"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>

            <?php endif; ?>
        </div>
    </div>
</div>

<!-- modal login-->
<div class="modal fade" id="login_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="d-flex justify-content-between bg_1 p-3 text_light">
                    <div><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</div>
                    <div><a href="" data-bs-dismiss="modal" class="text_light"><i class="fa-solid fa-circle-xmark"></i></a></div>

                </div>

                <div class="p-5 text-center">
                    <img src="<?= base_url('berkas/logo.png'); ?>" alt="Logo" width="90px">
                </div>

                <div class="px-5 py-2">
                    <form action="<?= base_url('landing/auth'); ?>" method="post">
                        <div class="input-group input-group-sm mb-3">
                            <span style="width: 100px;" class="input-group-text">Username</span>
                            <input type="text" name="username" placeholder="Username" class="form-control">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span style="width: 100px;" class="input-group-text">Password</span>
                            <input type="password" name="password" placeholder="Password" class="form-control">
                        </div>
                        <div class="d-grid mt-4 mb-3">
                            <button class="btn_1 rounded"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // const bsOffcanvas = new bootstrap.Offcanvas('#menu');
    // bsOffcanvas.show();
</script>
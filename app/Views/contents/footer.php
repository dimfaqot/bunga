 <!-- MD -->
 <div class="d-none d-md-block">
     <div class="fixed-bottom">
         <div class="bg_1 text_4 d-flex justify-content-between py-2 px-5">
             <div>
                 <a href="<?= base_url(); ?>" class="link_light"><img width="20" src="<?= base_url('berkas/logo_light.png'); ?>" alt=""></a>
             </div>
             <div>
                 <div class="text_light"><?= settings('footer'); ?></div>
             </div>
             <div>
                 <a href="#body" class="link_light"><i class="fa-solid fa-circle-arrow-up"></i></a>
             </div>


         </div>
     </div>

 </div>

 <!-- SM -->
 <div class="d-block d-md-none d-sm-block">
     <div class="fixed-bottom">
         <div class="bg_1 text_4 d-flex justify-content-between p-2">
             <div>
                 <a href="<?= base_url(); ?>" class="link_light"><img width="15" src="<?= base_url('berkas/logo_light.png'); ?>" alt=""></a>
             </div>
             <div>
                 <a href="" class="link_light" data-bs-toggle="offcanvas" data-bs-target="#menu" aria-controls="offcanvasScrolling"><i class="fa-solid fa-bars"></i></a>
             </div>
             <div>
                 <a href="#body" class="link_light"><i class="fa-solid fa-circle-arrow-up"></i></a>
             </div>


         </div>
     </div>
 </div>
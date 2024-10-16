 <h6>CARA PEMESANAN</h6>
 <?php foreach (urutan_transaksi() as $k => $i): ?>
     <h6 class="text_dark"><i class="fa-solid fa-circle-dot text_2"></i> <?= $k + 1; ?>. <i class="<?= $i['icon']; ?>"></i> <?= $i['text']; ?></h6>
     <?php if ($k < count(urutan_transaksi()) - 1): ?>
         <div class="border-end border-success mb-2" style="height:30px;width:8px"></div>
     <?php endif; ?>
 <?php endforeach; ?>
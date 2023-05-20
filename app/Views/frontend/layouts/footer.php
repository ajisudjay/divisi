 <!-- ======= Footer ======= -->
 <footer id="footer" class="footer">

     <div class="footer-content">
         <div class="container">
             <div class="row g-5">
                 <div class="col-lg-6">
                     <h3 class="footer-heading">Tentang Divisi.id</h3>
                     <p><?= $tentangkami['isi'] ?></p>
                     <p><a href="/tentangkami" class="footer-heading">Selengkapnya . . . .</a></p>
                 </div>
                 <div class="col-6 col-lg-2 beritadesktop">
                     <h3 class="footer-heading">Kategori</h3>
                     <ul class="footer-links list-unstyled">
                         <?php foreach ($kategori as $item) : ?>
                             <li><a href="/berita-kategoriall/<?= $item['kategori'] ?>"><i class="bi bi-chevron-right"></i><?= $item['kategori'] ?></a></li>
                         <?php endforeach ?>
                     </ul>
                 </div>
                 <div class="col-8 beritamobile">
                     <h3 class="footer-heading">&nbsp;&nbsp;Kategori</h3>
                     <ul class="footer-links list-unstyled">
                         <li>
                             <?php foreach ($kategori as $item) : ?>
                                 <a href="/berita-kategoriall/<?= $item['kategori'] ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $item['kategori'] ?></a> |
                             <?php endforeach ?>
                         </li>
                     </ul>
                 </div>
                 <div class="col-lg-4">
                     <h3 class="footer-heading">Terbaru</h3>
                     <ul class="footer-links footer-blog-entry list-unstyled">
                         <?php foreach ($terbaru as $terbaru) : ?>
                             <li>
                                 <a href="/berita-detail/<?= $terbaru['slug'] ?>" class="d-flex align-items-center">
                                     <div>
                                         <div class="post-meta d-block"><span class="date" style="font-size: 8px;"><?= $terbaru['tingkat'] ?></span> <span class=" mx-1">&bullet;</span> <span style="font-size: 8px;"><?= $terbaru['nama_kategori'] ?></span><span class="mx-1">&bullet;</span><span style="font-size: 8px;"><?= $terbaru['tanggal'] ?></span></div>
                                         <span><?= $terbaru['judul'] ?></span>
                                     </div>
                                 </a>
                             </li>
                         <?php endforeach ?>
                     </ul>
                 </div>
             </div>
         </div>
     </div>
 </footer>
 <footer id="footer" class="footer">
     <div class="footer-legal">
         <div class="container">
             <div class="row justify-content-between">
                 <div class="col-md-12">
                     <div class="social-links mb-3 mb-lg-0 text-center">
                         <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                         <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                         <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                     </div>
                     <div class="copyright text-center">
                         © Copyright <strong><span>Divisi.id</span></strong>2022
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </footer>
 <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
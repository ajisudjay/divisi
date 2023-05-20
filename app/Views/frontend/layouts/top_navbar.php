  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
      <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

          <a href="/" class="logo d-flex align-items-center">
              <!-- Uncomment the line below if you also wish to use an image logo -->
              <!-- <img src="libraries/assets/img/logo.png" alt=""> -->

              <img src="<?= base_url() ?>/libraries_frontend/assets/img/bg.png">
          </a>

          <nav id="navbar" class="navbar">
              <ul>
                  <li><a href="/">Beranda</a></li>
                  <div class="batas">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>|</strong>
                  </div>
                  <li class="dropdown"><a href="#"><span>Kategori</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                      <ul>
                          <?php foreach ($tingkat_berita as $item2) : ?>
                              <li class="dropdown"><a href="/berita-tingkat/<?= $item2['tingkat'] ?>"><span><?= $item2['tingkat'] ?></span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                                  <ul>
                                      <?php foreach ($kategori as $item) : ?>
                                          <li><a href="/berita-kategori/<?= $item2['tingkat'] ?>/<?= $item['kategori'] ?>"><?= $item['kategori'] ?></a></li>
                                      <?php endforeach ?>
                                  </ul>
                              </li>
                          <?php endforeach ?>

                      </ul>
                  </li>
                  <div class="batas">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>|</strong>
                  </div>
                  <li class="dropdown"><a href="/tentangkami"><span>Tentang Kami</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                      <ul>
                          <?php foreach ($konfigurasi as $item3) : ?>
                              <li><a href="/tentangkami"><?= $item3['judul'] ?></a></li>
                          <?php endforeach ?>
                      </ul>
                  </li>
              </ul>
          </nav><!-- .navbar -->
          <div class="position-relative">

              <a href="#" class="mx-2 js-search-open">
                  <iconify-icon icon="fluent:search-12-filled" style="color: #0b1b4f;"></iconify-icon>
              </a>
              <a href="/login" class="mx-2">
                  <iconify-icon icon="ooui:log-in-ltr" style="color: #0b1b4f;"></iconify-icon>
              </a>
              <i class="bi bi-list mobile-nav-toggle"></i>

              <!-- ======= Search Form ======= -->
              <div class="search-form-wrap js-search-form-wrap">
                  <form action="search-result.html" class="search-form">
                      <span class="el-search-alt"></span>
                      <input type="text" placeholder="Search" class="form-control">
                      <button class="btn js-search-close"><span class="bi-x"></span></button>
                  </form>
              </div><!-- End Search Form -->

          </div>

      </div>

  </header><!-- End Header -->
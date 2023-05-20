<!DOCTYPE html>
<html lang="en">
<?= $this->include('frontend/layouts/header') ?>

<body>
    <?= $this->include('frontend/layouts/top_navbar') ?>
    <?php error_reporting(0); ?>

    <!-- <main id="main"> -->
    <main id="main">
        <!-- ======= Hero Slider Section ======= -->
        <section id="hero-slider" class="hero-slider" style="margin-top:40px">
            <div class="container-md" data-aos="fade-in">
                <div class="swiper sliderFeaturedPosts rounded-4">
                    <div class="swiper-wrapper">
                        <?php foreach ($terbaru as $trend) : ?>
                            <div class="swiper-slide">
                                <a href="berita-detail/<?= $trend['slug'] ?>" class="img-bg d-flex align-items-end rounded-4 slider1" style="background-image: url('content/gambar/<?= $trend['gambar'] ?>');background-size: cover; ">
                                    <!-- background-size: auto|length|cover|contain|initial|inherit; -->
                                    <div class=" img-bg-inner">
                                        <h2><?= $trend['judul'] ?></h2>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <div class="custom-swiper-button-next">
                        <span class="bi-chevron-right"></span>
                    </div>
                    <div class="custom-swiper-button-prev">
                        <span class="bi-chevron-left"></span>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section><!-- End Hero Slider Section -->

        <div class="bgmain" style="background:url(libraries_frontend/assets/img/bg2.png) no-repeat;background-size: contain;background-position-x: center;background-position-y: center; margin:5px;">

            <!-- <div style="background-image: url('libraries_frontend/assets/img/bg.png');background-size: contain;background-repeat: no-repeat; "> -->
            <!-- ======= Post Grid Section ======= -->
            <section id="posts" class="posts">
                <div class="container" data-aos="fade-up">
                    <div class="row g-5">
                        <div class="col-lg-5">
                            <div class="post-entry-1 lg" style="text-align:justify ;">

                                <?php foreach ($hot as $hot) : ?>
                                    <a href="berita-detail/<?= $hot['slug'] ?>"><img src="content/gambar/<?= $hot['gambar'] ?>" style="height:300px;width:100%;" class="img-fluid rounded-2 slider2">
                                        <div class="top-left">Hot</div>
                                    </a>
                                    <div class="post-metaheader"><span class="date"><?= $hot['tingkat'] ?></span> <span class="mx-1">&bullet;</span> <span><?= $hot['nama_kategori'] ?></span><span class="mx-1">&bullet;</span> <span><?= $hot['tanggal'] ?></span><span class="mx-1">&bullet;</span> <span>(<?= $hot['dilihat'] ?> Views)</span></div>
                                    <h3><a href="berita-detail/<?= $hot['slug'] ?>"><?= $hot['judul'] ?></a></h3>
                                <?php endforeach ?>

                                <!-- ======= Iklan Slider Section ======= -->
                                <section id="hero-slider" class="hero-slider">
                                    <div class="container-md" data-aos="fade-in">
                                        <div class="col-12">
                                            <div class="swiper sliderFeaturedPosts">
                                                <div class="swiper-wrapper">
                                                    <?php foreach ($iklan as $item) : ?>
                                                        <div class="swiper-slide ">
                                                            <div class="img-bg-inner">
                                                                <img src="content/iklan/<?= $item['file'] ?>" class="slider1" style="height:185px;width:100%; border-radius: 4%;">
                                                            </div>
                                                            </a>
                                                        </div>
                                                    <?php endforeach ?>
                                                </div>
                                                <div class="custom-swiper-button-next">
                                                    <span class="bi-chevron-right"></span>
                                                </div>
                                                <div class="custom-swiper-button-prev">
                                                    <span class="bi-chevron-left"></span>
                                                </div>
                                                <div class="swiper-pagination"></div>
                                            </div>
                                        </div>
                                    </div>
                                </section><!-- End Hero Slider Section -->

                                <div class="top-left">Hot</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="row g-5" style="text-align:left ;">
                                <div class="col-lg-4 border-start custom-border beritadesktop">
                                    <?php foreach ($berita_1 as $berita1) : ?>
                                        <div class="post-entry-1">
                                            <a href="berita-detail/<?= $berita1['slug'] ?>"><img src="content/gambar/<?= $berita1['gambar'] ?>" class="rounded-1" style="max-width:100% ;height:150px">
                                                <div class="top-leftviews"> <span><?= $berita1['dilihat'] ?> Views</span></div>
                                            </a>
                                            <div class="post-meta"><span class="date"><?= $berita1['tingkat'] ?></span>&bullet;<span class="date"><?= $berita1['kategori'] ?></span>&bullet;<span><?= $berita1['tanggal'] ?></span></div>
                                            <strong><a href="berita-detail/<?= $berita1['slug'] ?>"><?= substr($berita1['judul'], 0, 45) . '-' ?></a></strong>
                                        </div>
                                    <?php endforeach ?>
                                    <?php foreach ($berita_3 as $berita_3) : ?>
                                        <div class="post-entry-1">
                                            <a href="berita-detail/<?= $berita_3['slug'] ?>">
                                                <img src="content/gambar/<?= $berita_3['gambar'] ?>" class="rounded-1" style="max-width:100% ;height:150px">
                                                <div class="top-leftviews"> <span><?= $berita_3['dilihat'] ?> Views</span></div>
                                            </a>
                                            <div class="post-meta"><span class="date"><?= $berita_3['tingkat'] ?></span>&bullet;<span class="date"><?= $berita_3['kategori'] ?></span>&bullet;<span><?= $berita_3['tanggal'] ?></span></div>
                                            <strong><a href="berita-detail/<?= $berita_3['slug'] ?>"><?= substr($berita_3['judul'], 0, 45) . '-' ?></a></strong>
                                        </div>
                                    <?php endforeach ?>
                                    <?php foreach ($berita_5 as $berita5) : ?>
                                        <div class="post-entry-1">
                                            <a href="berita-detail/<?= $berita5['slug'] ?>"><img src="content/gambar/<?= $berita5['gambar'] ?>" class="rounded-1" style="max-width:100% ;height:150px">
                                                <div class="top-leftviews"> <span><?= $berita5['dilihat'] ?> Views</span></div>
                                            </a>
                                            <div class="post-meta"><span class="date"><?= $berita5['tingkat'] ?></span>&bullet;<span class="date"><?= $berita5['kategori'] ?></span>&bullet;<span><?= $berita5['tanggal'] ?></span></div>
                                            <strong><a href="berita-detail/<?= $berita5['slug'] ?>"><?= substr($berita5['judul'], 0, 45) . '-' ?></a></strong>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <div class="col-lg-4 border-start custom-border beritadesktop">
                                    <?php foreach ($berita_2 as $berita2) : ?>
                                        <div class="post-entry-1">
                                            <a href="berita-detail/<?= $berita2['slug'] ?>"><img src="content/gambar/<?= $berita2['gambar'] ?>" class="rounded-1" style="max-width:100% ;height:150px">
                                                <div class="top-leftviews"> <span><?= $berita2['dilihat'] ?> Views</span></div>
                                            </a>
                                            <div class="post-meta"><span class="date"><?= $berita2['tingkat'] ?></span>&bullet;<span class="date"><?= $berita2['kategori'] ?></span>&bullet;<span><?= $berita2['tanggal'] ?></span></div>
                                            <strong><a href="berita-detail/<?= $berita2['slug'] ?>"><?= substr($berita2['judul'], 0, 45) . '-' ?></a></strong>
                                        </div>
                                    <?php endforeach ?>
                                    <?php foreach ($berita_4 as $berita_4) : ?>
                                        <div class="post-entry-1">
                                            <a href="berita-detail/<?= $berita_4['slug'] ?>"><img src="content/gambar/<?= $berita_4['gambar'] ?>" class="rounded-1" style="max-width:100% ;height:150px">
                                                <div class="top-leftviews"> <span><?= $berita_4['dilihat'] ?> Views</span></div>
                                            </a>
                                            <div class="post-meta"><span class="date"><?= $berita_4['tingkat'] ?></span>&bullet;<span class="date"><?= $berita_4['kategori'] ?></span>&bullet;<span><?= $berita_4['tanggal'] ?></span></div>
                                            <strong><a href="berita-detail/<?= $berita_4['slug'] ?>"><?= substr($berita_4['judul'], 0, 45) . '-' ?></a></strong>
                                        </div>
                                    <?php endforeach ?>
                                    <?php foreach ($berita_6 as $berita_6) : ?>
                                        <div class="post-entry-1">
                                            <a href="berita-detail/<?= $berita_6['slug'] ?>"><img src="content/gambar/<?= $berita_6['gambar'] ?>" class="rounded-1" style="max-width:100% ;height:150px">
                                                <div class="top-leftviews"> <span><?= $berita_6['dilihat'] ?> Views</span></div>
                                            </a>
                                            <div class="post-meta"><span class="date"><?= $berita_6['tingkat'] ?></span>&bullet;<span class="date"><?= $berita_6['kategori'] ?></span>&bullet;<span><?= $berita_6['tanggal'] ?></span></div>
                                            <strong><a href="berita-detail/<?= $berita_6['slug'] ?>"><?= substr($berita_6['judul'], 0, 45) . '-' ?></a></strong>
                                        </div>
                                    <?php endforeach ?>
                                </div>

                                <!-- berita mobile -->
                                <div class="col-lg-4 beritamobile">
                                    <table style="margin-left:4% ;margin-right:8% ;" width="350px">
                                        <tr align="center">
                                            <td width="50%">
                                                <?php foreach ($berita_11 as $berita11) : ?>
                                                    <a href="berita-detail/<?= $berita11['slug'] ?>"><img src="content/gambar/<?= $berita11['gambar'] ?>" class="rounded-1" style="width:170px;height:100px;"></a><br>
                                                    <strong style="font-size:8px;"><a href="berita-detail/<?= $berita11['slug'] ?>"><?= substr($berita11['judul'], 0, 30) . '-' ?></a></strong>
                                                <?php endforeach ?>
                                            </td>
                                            <td width="50%">
                                                <?php foreach ($berita_22 as $berita_22) : ?>
                                                    <a href="berita-detail/<?= $berita_22['slug'] ?>"><img src="content/gambar/<?= $berita_22['gambar'] ?>" class="rounded-1" style="width:170px;height:100px;"></a><br>
                                                    <strong style="font-size:8px;"><a href="berita-detail/<?= $berita_22['slug'] ?>"><?= substr($berita_22['judul'], 0, 30) . '-' ?></a></strong>
                                                <?php endforeach ?>
                                            </td>
                                        </tr>
                                        <tr align="center">
                                            <td width="50%">
                                                <?php foreach ($berita_33 as $berita_33) : ?>
                                                    <a href="berita-detail/<?= $berita_33['slug'] ?>"><img src="content/gambar/<?= $berita_33['gambar'] ?>" class="rounded-1" style="width:170px;height:100px;"></a><br>
                                                    <strong style="font-size:8px;"><a href="berita-detail/<?= $berita_33['slug'] ?>"><?= substr($berita_33['judul'], 0, 30) . '-' ?></a></strong>
                                                <?php endforeach ?>
                                            </td>
                                            <td width="50%">
                                                <?php foreach ($berita_44 as $berita_44) : ?>
                                                    <a href="berita-detail/<?= $berita_44['slug'] ?>"><img src="content/gambar/<?= $berita_44['gambar'] ?>" class="rounded-1" style="width:170px;height:100px;"></a><br>
                                                    <strong style="font-size:8px;"><a href="berita-detail/<?= $berita_44['slug'] ?>"><?= substr($berita_44['judul'], 0, 30) . '-' ?></a></strong>
                                                <?php endforeach ?>
                                            </td>
                                        </tr>
                                        <tr align="center">
                                            <td width="50%">
                                                <?php foreach ($berita_55 as $berita_55) : ?>
                                                    <a href="berita-detail/<?= $berita_55['slug'] ?>"><img src="content/gambar/<?= $berita_55['gambar'] ?>" class="rounded-1" style="width:170px;height:100px;"></a><br>
                                                    <strong style="font-size:8px;"><a href="berita-detail/<?= $berita_55['slug'] ?>"><?= substr($berita_55['judul'], 0, 30) . '-' ?></a></strong>
                                                <?php endforeach ?>
                                            </td>
                                            <td width="50%">
                                                <?php foreach ($berita_66 as $berita_66) : ?>
                                                    <a href="berita-detail/<?= $berita_66['slug'] ?>"><img src="content/gambar/<?= $berita_66['gambar'] ?>" class="rounded-1" style="width:170px;height:100px;"></a><br>
                                                    <strong style="font-size:8px;"><a href="berita-detail/<?= $berita_66['slug'] ?>"><?= substr($berita_66['judul'], 0, 30) . '-' ?></a></strong>
                                                <?php endforeach ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- Trending Section -->
                                <div class="col-lg-4">

                                    <!-- ======= Sidebar ======= -->
                                    <div class="aside-block">

                                        <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill" data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular" aria-selected="true"><img src="libraries_frontend/assets/img/trending.png"></button>
                                            </li>
                                        </ul>
                                        <!-- Trending -->
                                        <?php foreach ($trending as $trend) : ?>
                                            <div class="post-entry-1 border-bottom" style="text-align:left ;">
                                                <div class="post-meta"><span class="date"><?= $trend['tingkat'] ?></span> &bullet; <span class="date"><?= $trend['nama_kategori'] ?></span> &bullet;<span><?= $trend['tanggal'] ?></span></div>
                                                <strong class="mb-2"><a href="berita-detail/<?= $trend['slug'] ?>"><?= $trend['judul'] ?></a></strong>
                                                <div class="post-meta-heading"><span class="date">dilihat : <?= $trend['dilihat'] ?></span></div>
                                            </div>
                                        <?php endforeach ?>
                                        <!-- End Trending -->
                                        <div class="container-md beritadesktop" data-aos="fade-in">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="swiper sliderFeaturedPosts rounded-4">
                                                        <div class="swiper-wrapper">
                                                            <?php foreach ($iklanutama as $item) : ?>
                                                                <div class="swiper-slide ">
                                                                    <div class="img-bg-inner">
                                                                        <img src="content/iklan/<?= $item['file'] ?>" style="height:115px;width:100%;border-radius: 4%;">
                                                                    </div>
                                                                    </a>
                                                                </div>
                                                            <?php endforeach ?>
                                                        </div>
                                                        <div class="custom-swiper-button-next">
                                                            <span class="bi-chevron-right"></span>
                                                        </div>
                                                        <div class="custom-swiper-button-prev">
                                                            <span class="bi-chevron-left"></span>
                                                        </div>
                                                        <div class="swiper-pagination"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- End Sidebar Section -->
                                </div>
                            </div>
                        </div> <!-- End .row -->
                    </div>
            </section> <!-- End Post Grid Section -->
            <!-- </div> -->
        </div>
    </main><!-- End #main -->
    <?= $this->include('frontend/layouts/footer') ?>
    <?= $this->include('frontend/layouts/javascript') ?>
</body>

</html>
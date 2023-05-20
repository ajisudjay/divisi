<!DOCTYPE html>
<html lang="en">
<?= $this->include('frontend/layouts/header') ?>

<body>
    <?= $this->include('frontend/layouts/top_navbar') ?>


    <main id="main">
        <section>
            <div class="container">
                <div class="row">

                    <div class="col-md-9" data-aos="fade-up">
                        <h3 class="category-title">Kategori: <?= $tingkat ?> - <?= $nama_kategori ?></h3>
                        <?php foreach ($berita_kategori as $item) : ?>
                            <div class="d-md-flex post-entry-2 half">
                                <a href="/berita-detail/<?= $item['slug'] ?>" class="me-4 thumbnail">
                                    <img src="<?= base_url('content/gambar/' . $item['gambar']); ?>" class="img-fluid" style="height:300px;width:100%;">
                                </a>
                                <div>
                                    <div class=" post-meta"><span class="date"><?= $item['tingkat'] ?></span>&bullet;<span class="date"><?= $item['kategori'] ?></span>&bullet;<span><?= $item['tanggal'] ?></span><span>(<?= $item['dilihat'] ?> Views)</span>
                                    </div>
                                    <h3><a href="/berita-detail/<?= $item['slug'] ?>"><?= $item['judul'] ?></a></h3>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>

                    <div class="col-md-3">
                        <!-- ======= Sidebar ======= -->
                        <div class="aside-block">

                            <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill" data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular" aria-selected="true"><img src="<?= base_url('libraries_frontend/assets/img/trending.png') ?>"></button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">

                                <!-- Trending -->
                                <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                                    <?php foreach ($trending as $trend) : ?>
                                        <div class="post-entry-1 border-bottom">
                                            <div class="post-meta"><span class="date"><?= $trend['tingkat'] ?></span> &bullet; <span class="date"><?= $trend['nama_kategori'] ?></span>&bullet; <span><?= $trend['tanggal'] ?></span></div>
                                            <h2 class="mb-2"><a href="/berita-detail/<?= $trend['slug'] ?>"><?= $trend['judul'] ?></a></h2>
                                            <span class="author mb-3 d-block">dilihat : <?= $trend['dilihat'] ?></span>
                                        </div>
                                    <?php endforeach ?>
                                </div> <!-- End Trending -->
                            </div>
                        </div>                  
                    </div>

                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <?= $this->include('frontend/layouts/footer') ?>
    <?= $this->include('frontend/layouts/javascript') ?>

</body>

</html>
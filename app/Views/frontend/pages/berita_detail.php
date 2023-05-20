<!DOCTYPE html>
<html lang="en">
<?= $this->include('frontend/layouts/header_post') ?>

<body>
    <?= $this->include('frontend/layouts/top_navbar') ?>


    <main id="main">

        <section class="single-post-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 post-content" data-aos="fade-up">

                        <!-- ======= Single Post Content ======= -->
                        <?php foreach ($berita as $item) : ?>
                            <div class="single-post">
                                <div class="post-metaheader"><span class="date"><?= $item['tingkat'] ?></span> <span class="mx-1">&bullet;</span> <span><?= $item['nama_kategori'] ?></span><span class="mx-1">&bullet;</span> <span><?= $item['tanggal'] ?></span><span class="mx-1">&bullet;</span> <span>(<?= $item['dilihat'] ?> Views)</span></div>
                                <h4 class="mb-5" align="center"><?= $item['judul'] ?></h4>
                                <figure class="my-4" align="center">
                                    <img src="<?= base_url('content/gambar/' . $item['gambar']); ?>" class="rounded-1" style="height:40%;width:100%; border-radius: 4%;">
                                    <figcaption align="justify" style="font-size:10px;color:#A9A9A9;;font-family:Calibri;"><?= $item['caption'] ?></figcaption>
                                </figure>
                                <figure class="my-4" style="text-align:center;">
                                    <!-- ======= Iklan Slider Section ======= -->
                                    <section id="hero-slider" class="hero-slider">
                                        <div class="swiper sliderFeaturedPosts">
                                            <div class="swiper-wrapper">
                                                <?php foreach ($iklanutama as $item22) : ?>
                                                    <div class="swiper-slide">
                                                        <img src="<?= base_url('content/iklan/' . $item22['file']) ?>" style="height:100px;width:80%;">
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
                                    </section><!-- End Hero Slider Section -->
                                </figure>
                                <div style="text-align:justify;font-family:Calibri;">
                                    <p><?= $item['isi']; ?></p>
                                </div>
                            </div><!-- End Single Post Content -->
                        <?php endforeach ?>
                        <!-- ======= Comments ======= -->
                        <div class="comments">
                            <h5 class="comment-title py-4"><?= $jum_komentar['jumlah'] ?> Komentar</h5>
                            <?php
                            if ($jum_komentar['jumlah'] < 1) {
                                $komen = 'none';
                            } else {
                                $komen = 'content';
                            }
                            ?>
                            <div class="scrollauto" style="display:<?= $komen ?> ;">
                                <?php foreach ($komentar as $item) : ?>
                                    <div class="comment d-flex mb-4">
                                        <div class="flex-shrink-0">
                                            <div class="avatar avatar-sm rounded-circle">
                                                <img class="avatar-img" src="<?= base_url('libraries_frontend/assets/img/commentator.png') ?>" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-2 ms-sm-3">
                                            <div class="comment-meta d-flex align-items-baseline">
                                                <h6 class="me-2"><?= $item['nama'] ?></h6>
                                                <span class="text-muted"><?= $item['timestamp'] ?></span>
                                            </div>
                                            <div class="comment-body">
                                                <?= $item['komentar'] ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <!-- End Comments -->

                        <!-- ======= Comments Form ======= -->
                        <div class="row justify-content-center mt-5">
                            <form action="<?= base_url('komentar/tambah'); ?>" method="post" class="komen">
                                <?php csrf_field() ?>
                                <div class="col-lg-12">
                                    <h5 class="comment-title">Berikan Komentar Anda</h5>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="comment-name">Nama</label>
                                            <input type="text" name="id_berita" value="<?= $id_berita ?>" class="form-control" hidden>
                                            <input type="text" name="nama" class="form-control" id="comment-name" placeholder="Masukkan Nama Anda" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="comment-message">Komentar</label>
                                            <textarea class="form-control" name="komentar" id="comment-message" placeholder="Berikan Komentar Anda" cols="30" rows="5" required></textarea>
                                        </div>
                                        <div class="col-12" align="center">
                                            <input type="submit" class="btn btn-primary btnSimpan" value="Kirim">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div><!-- End Comments Form -->
                        <br>
                        <div align="center">
                            <a href="/"><button class="btn btn-primary btn-round btn-block" style="background-color:#0B1B4F;">Kembali</button></a>
                        </div>
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
                        <!-- Kategori -->
                        <div class="aside-block" style="text-align:left ;">
                            <h3 class="aside-title">Kategori</h3>
                            <ul class=" footer-links list-unstyled">
                                <?php foreach ($kategori as $item) : ?>
                                    <li><a href="/berita-kategoriall/<?= $item['kategori'] ?>"><i class="bi bi-chevron-right"></i><?= $item['kategori'] ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <!-- Kategori -->

                        <figure class=" my-4">
                            <!-- ======= Iklan Slider Section ======= -->
                            <section id="hero-slider" class="hero-slider">
                                <div class="swiper sliderFeaturedPosts">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($iklan as $item) : ?>
                                            <div class="swiper-slide ">
                                                <div class="img-bg-inner">
                                                    <img src="<?= base_url('content/iklan/' . $item['file']) ?>" style="height:115px;width:100%;border-radius: 4%;">
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
                            </section><!-- End Hero Slider Section -->
                        </figure>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
    <!-- ======= Footer ======= -->
    <?= $this->include('frontend/layouts/footerdetail') ?>

    <!-- SCRIPT AJAX -->
    <script>
        $(document).ready(function() {
            //  function tambah
            $('.komen').submit(function() {
                var nama = $('#nama').val();
                var komentar = $('#komentar').val();
                var id_berita = $('#id_berita').val();
                var fd = new FormData();

                fd.append('nama', nama);
                fd.append('id_berita', id_berita);
                fd.append('komentar', komentar);
                $.ajax({
                    type: "post",
                    data: fd,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('.btnSimpan').attr('disable', 'disabled');
                        $('.btnSimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                    },
                    complete: function() {
                        $('.btnSimpan').removeAttr('disable', 'disabled');
                        $('.btnSimpan').html('Simpan');
                    },
                    success: function(response) {
                        if (response.error) {
                            if (response.error.nama) {
                                $('.nama').addClass('is-invalid');
                                $('.errorNama').html(response.error.nama);
                            } else {
                                $('.nama').removeClass('is-invalid');
                                $('.errorNama').html('');
                            }
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'berhasil',
                                text: response.sukses,
                            });
                            $('body').removeClass('modal-open');
                            //modal-open class is added on body so it has to be removed
                            $('.modal-backdrop').remove();
                            //need to remove div with modal-backdrop class
                            $("#result").html(response.data);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            });

            window.setTimeout(function() {
                $(".flashAjax").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 5000);
        });
    </script>
    <?= $this->include('frontend/layouts/javascript') ?>


</body>

</html>
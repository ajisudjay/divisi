<!DOCTYPE html>
<html lang="en">
<?= $this->include('frontend/layouts/header') ?>

<body>
    <?= $this->include('frontend/layouts/top_navbar') ?>


    <main id="main">
        <section>
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-12 text-center mb-5">
                        <h1 class="page-title">Tentang Kami</h1>
                    </div>
                </div>

                <div class="row mb-5">
                    <?php foreach ($konfigurasi as $item) : ?>
                        <section id="<?= $item['judul'] ?>">
                            <div class="d-md-flex post-entry-2 half">
                                <div class="ps-md-5 mt-4 mt-md-0">
                                    <h2 class="mb-4 display-4"><?= $item['judul'] ?></h2>
                                    <p><?= $item['isi'] ?></p>
                                </div>
                            </div>
                        </section>
                    <?php endforeach ?>
                </div>

            </div>
        </section>
    </main><!-- End #main -->
    <?= $this->include('frontend/layouts/footer') ?>
    <?= $this->include('frontend/layouts/javascript') ?>


</body>

</html>
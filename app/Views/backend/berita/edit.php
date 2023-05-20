<!DOCTYPE html>
<html lang="en">
<?= $this->include('backend/layouts/header') ?>

<body>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <?= $this->include('backend/layouts/top_navbar') ?>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <?php
                    if (session()->get('level') === 'Admin') {
                        $sidenavbar = $this->include('backend/layouts/side_navbar/admin');
                    } elseif (session()->get('level') === 'Superadmin') {
                        $sidenavbar = $this->include('backend/layouts/side_navbar/superadmin');
                    }
                    ?>
                    <?= $sidenavbar ?>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-header start -->
                                    <div class="page-header">
                                        <div class="row align-items-end">
                                            <div class="col-lg-8">
                                                <div class="page-header-title">
                                                    <div class="d-inline">
                                                        <h4><?= $header2 . ' ' . $header ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item">
                                                            <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="#!"><?= $header ?></a>
                                                        <li class="breadcrumb-item"><a href="#!"><?= $header2 ?></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-header end -->
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Content Start -->
                                                <div class="card">
                                                    <div class="card-block">
                                                        <?php if (session()->get('pesanEdit')) { ?>
                                                            <div class="alert alert-success alert-dismissible fade show flash" role="alert">
                                                                <strong>Berhasil !</strong> <?= session()->getFlashdata('pesanEdit') ?>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if (session()->get('pesanHapus')) { ?>
                                                            <div class="alert alert-success alert-dismissible fade show flash" role="alert">
                                                                <strong>Berhasil !</strong> <?= session()->getFlashdata('pesanHapus') ?>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if (session()->get('pesanInput')) { ?>
                                                            <div class="alert alert-success alert-dismissible fade show flash" role="alert">
                                                                <strong>Berhasil !</strong> <?= session()->getFlashdata('pesanInput') ?>
                                                            </div>
                                                        <?php } ?>
                                                        <form action="<?= base_url('berita/edit'); ?>" method="post" enctype="multipart/form-data" class="edit">
                                                            <?php csrf_field() ?>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <label class="text-primary">Judul</label>
                                                                    <input type="text" name="id" class="form-control id" value="<?= $berita['id_berita'] ?>" hidden>
                                                                    <input type="text" name="judul" class="form-control judul" value="<?= $berita['judul'] ?>" required>
                                                                    <div class="invalid-feedback errorJudul"></div>
                                                                    <br>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <label class="text-primary">Tingkat</label>
                                                                    <select name="tingkat" class="form-control tingkat" required>
                                                                        <option value=" <?= $berita['tingkat_berita'] ?>"><?= $berita['nama_tingkat'] ?></option>
                                                                        <?php foreach ($tingkat as $item_tingkat) : ?>
                                                                            <option value=" <?= $item_tingkat['id'] ?>"><?= $item_tingkat['tingkat'] ?></option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                    <div class="invalid-feedback errorTingkat"></div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <label class="text-primary">Kategori</label>
                                                                    <select name="kategori" class="form-control kategori" required>
                                                                        <option value=" <?= $berita['kategori_berita'] ?>"><?= $berita['nama_kategori'] ?></option>
                                                                        <?php foreach ($kategori as $item_kategori) : ?>
                                                                            <option value="<?= $item_kategori['id'] ?>"><?= $item_kategori['kategori'] ?></option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                    <div class="invalid-feedback errorKategori"></div>
                                                                    <br>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <label class="text-primary">Tanggal</label>
                                                                    <input type="date" name="tanggal" class="form-control tanggal" placeholder="Tanggal" value="<?= $berita['tanggal'] ?>" required>
                                                                    <div class="invalid-feedback errorTanggal"></div>
                                                                    <br>
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <img src="content/gambar/<?= $berita['gambar'] ?>" width="100%">
                                                                </div>
                                                                <br>
                                                                <div class="col-lg-2">
                                                                    <label class="text-primary">Jenis File</label>
                                                                    <div>
                                                                        <input type="radio" name="jenis_file" value="Gambar" checked> Gambar
                                                                        <label class="form-check-label"></label>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="col-lg-4">
                                                                    <label class="text-primary">Ganti File</label>
                                                                    <input type="file" name="file" class="form-control gambar" accept="image/*">
                                                                    <div class="invalid-feedback errorGambar"></div>
                                                                    <br>
                                                                </div>
                                                                <div class="col-lg-12   ">
                                                                    <label class="text-primary">Caption</label>
                                                                    <input type="text" name="caption" class="form-control caption" placeholder="Caption" value="<?= $berita['caption'] ?>" required>
                                                                    <div class="invalid-feedback errorCaption"></div>
                                                                </div>
                                                                <br>
                                                                <div class="col-lg-12">
                                                                    <label class="text-primary">Isi</label>
                                                                    <textarea name="isi" class="form-control" id="isi" required><?= $berita['isi'] ?></textarea>
                                                                    <div class="invalid-feedback errorIsi"></div>
                                                                    <script>
                                                                        var isi = CKEDITOR.replace('isi');
																	</script>
                                                                    <br>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <label class="text-primary">Tag <span>(pisahkan dengan tanda (,))</span></label>
                                                                    <input type="text" name="tag" class="form-control tag" value="<?= $berita['tag'] ?>" required>
                                                                    <div class="invalid-feedback errorTag"></div>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                            <div align="center">
                                                                <a href="/berita"><button type="button" class="btn btn-danger">Batalkan</button></a>
                                                                <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
                                                            </div>
                                                        </form>

                                                        <?= $this->include('backend/berita/ajax') ?>
                                                        <?= $this->include('backend/layouts/js_viewData') ?>
                                                    </div>
                                                </div>
                                                <!-- Content end -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?= $this->include('backend/berita/ajax') ?>
<?= $this->include('backend/layouts/js_index') ?>

</html>
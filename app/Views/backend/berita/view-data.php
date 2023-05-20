<h3>Data Berita</h3>
<div class="dt-responsive table-responsive">
    <!-- id dibawah bisa diganti => simpletable -->
    <table id="scr-vtr-dynamic" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th style=" max-width:5%; text-align: center;">No.</th>
                <th style="max-width:10%; text-align: center;">Aksi</th>
                <th style="max-width:35%; text-align: center;">Judul</th>
                <th style="max-width:10%; text-align: center;">Tingkat</th>
                <th style="max-width:10%; text-align: center;">Kategori</th>
                <th style="max-width:10%; text-align: center;">Tanggal</th>
                <th style="max-width:10%; text-align: center;">Status</th>
                <th style="max-width:10%; text-align: center;">Log</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php $no_isi = 2 ?>

            <?php foreach ($berita as $item) : ?>
                <?php
                $id = $item['id_berita'];
                ?>
                <tr style="text-align: center;">
                    <td><?= $no++ ?></td>
                    <td>
                        <!-- Modal Edit-->
                        <a class="feather icon-edit-1 text-primary" href="berita-edit?slug=<?= $item['slug'] ?>">&nbsp;&nbsp;</a>
                        <?php
                        if (session()->get('level') !== 'Superadmin') {
                            $tom_hapus = 'hidden';
                        } else {
                            $tom_hapus = '';
                        }
                        ?>
                        <!-- button hapus modal-->
                        <a href="<?= base_url('berita/hapus/' . $item['id_berita']); ?>" class="hapus" <?= $tom_hapus ?>>
                            <span class="feather icon-trash-2 text-danger"> </span>
                        </a>
                        &nbsp;
                        <!-- button publish -->
                        <a href="<?= base_url('berita/publish/' . $item['id_berita']); ?>" class="publish" <?= $tom_hapus ?>>
                            <span class="fa fa-check-circle-o text-success"> </span>
                        </a>
                        &nbsp;
                        <!-- button unpublish -->
                        <a href="<?= base_url('berita/unpublish/' . $item['id_berita']); ?>" class="unpublish" <?= $tom_hapus ?>>
                            <span class="fa fa-times text-danger"> </span>
                        </a>
                    </td>
                    <!-- ISI VIEW -->
                    <td align="left"><button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#detailmodal<?= $id = $item['id_berita'] ?>"><?= substr($item['judul'], 0, 70) ?></button></td>
                    <td><?= $item['nama_tingkat'] ?></td>
                    <td><?= $item['nama_kategori'] ?></td>
                    <td><?= $item['tanggal'] ?></td>
                    <td><?= $item['status'] ?></td>
                    <td><?= $item['admin'] . ' | ' . $item['timestamp'] ?></td>
                </tr>

                <!-- Modal Detail-->
                <div class="modal fade" id="detailmodal<?= $id = $item['id_berita'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content" style="text-align: center;">
                            <div class="modal-header">
                                <h5 class="modal-title"><?= $item['judul'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="text-align:center ;">
                                <div class="row">
                                    <div class="col-lg-11">
                                        <span><?= $item['admin'] ?> | <?= $item['tanggal'] ?></span>
                                        <label class="label label-primary"><?= $item['tingkat'] ?></label>
                                        <label class="label label-success"><?= $item['nama_kategori'] ?></label>
                                        <label class="label label-info"><?= $item['status'] ?></label>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-11">
                                        <img src="content/gambar/<?= $item['gambar'] ?>" width="40%">
                                        <figcaption><?= $item['caption']; ?></figcaption>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-11">
                                        <i class="fa fa-tags"><?= $item['tag'] ?></i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-11">
                                        <i class="fa fa-clock-o">Terakhir di Ubah : <b> <?= $item['timestamp'] ?></b> </i>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach ?>
        </tbody>
    </table>
</div>
<br>
<br>
<br>
<h3>Tambah Berita</h3>
<form action="<?= base_url('berita/tambah'); ?>" method="post" enctype="multipart/form-data" class="tambah">
    <?php csrf_field() ?>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12">
                <label class="text-primary">Judul</label>
                <input type="text" name="judul" class="form-control judul" placeholder="Judul" required>
                <div class="invalid-feedback errorJudul"></div>
                <br>
            </div>
            <div class="col-lg-4">
                <label class="text-primary">Tingkat</label>
                <select name="tingkat" class="form-control tingkat" required>
                    <option value="">-- Pilih Tingkat --</option>
                    <?php foreach ($tingkat as $item_tingkat) : ?>
                        <option value=" <?= $item_tingkat['id'] ?>"><?= $item_tingkat['tingkat'] ?></option>
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback errorTingkat"></div>
            </div>
            <div class="col-lg-4">
                <label class="text-primary">Kategori</label>
                <select name="kategori" class="form-control kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($kategori as $item_kategori) : ?>
                        <option value="<?= $item_kategori['id'] ?>"><?= $item_kategori['kategori'] ?></option>
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback errorKategori"></div>
                <br>
            </div>
            <div class="col-lg-4">
                <label class="text-primary">Tanggal</label>
                <input type="date" name="tanggal" class="form-control tanggal" placeholder="Tanggal" required>
                <div class="invalid-feedback errorTanggal"></div>
                <br>
            </div>
            <div class="col-lg-4">
                <label class="text-primary">Jenis File</label>
                <div>
                    <input type="radio" name="jenis_file" value="Gambar" checked> Gambar
                    <label class="form-check-label"></label>
                </div>
            </div>
            <br>
            <div class="col-lg-4">
                <img src="libraries_backend/assets/images/ukuran_gambar.png" width="100%">
            </div>
            <br>
            <div class="col-lg-4">
                <label class="text-primary">File</label>
                <input type="file" name="file" class="form-control gambar" accept="image/*" required>
                <div class="invalid-feedback errorGambar"></div>
                <br>
            </div>
            <div class="col-lg-12">
                <label class="text-primary">Caption</label>
                <input type="text" name="caption" class="form-control caption" placeholder="Caption" required>
                <div class="invalid-feedback errorCaption"></div>
            </div>
            <br>
            <div class="col-lg-12">
                <label class="text-primary">Isi</label>
                <textarea name="isi" class="form-control" id="isi" required></textarea>
                <script>
                    CKEDITOR.replace('isi');
                </script>
                <div class="invalid-feedback errorIsi"></div>
                <br>
            </div>
            <div class="col-lg-12">
                <label class="text-primary">Tag <span>(pisahkan dengan tanda (,))</span></label>
                <input type="text" name="tag" class="form-control tag" placeholder="Tag" required>
                <div class="invalid-feedback errorTag"></div>
                <br>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
        <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
    </div>
</form>

<?= $this->include('backend/berita/ajax') ?>
<?= $this->include('backend/layouts/js_viewData') ?>
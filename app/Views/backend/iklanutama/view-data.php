<div class="dt-responsive table-responsive">
    <!-- id dibawah bisa diganti => simpletable -->
    <table id="simpletable" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th style="max-width:5%; text-align: center;">No.</th>
                <th style="max-width:5%; text-align: center;">Aksi</th>
                <th style="max-width:15%; text-align: center;">Nama</th>
                <th style="max-width:75%; text-align: center;">Iklan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ?>

            <?php foreach ($iklan as $item) : ?>
                <?php $id = $item['id'] ?>
                <tr style="text-align: center;">
                    <td><?= $no++ ?></td>
                    <td>


                        <!-- button edit modal -->
                        <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#editmodal<?= $id = $item['id'] ?>">
                            <span class="feather icon-edit-1 text-primary"></span>
                        </button>

                        <!-- Modal Edit-->
                        <div class="modal fade" id="editmodal<?= $id = $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?= $item['nama'] ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?= base_url('iklanutama/edit'); ?>" method="post" enctype="multipart/form-data" class="edit">
                                        <?php csrf_field() ?>
                                        <div class="modal-body" style="text-align: left;">
                                            <div class="row">
                                                <div class="col-lg-11">
                                                    <label class="text-primary">Nama</label>
                                                    <input type="text" name="id" class="form-control id" value="<?= $item['id'] ?>" hidden>
                                                    <input type="text" name="nama" class="form-control iklan" placeholder="Nama" value="<?= $item['nama'] ?>" required>
                                                    <div class=" invalid-feedback errorNama">
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <img src="content/iklan/<?= $item['file'] ?>" width="100%">
                                                    <br>
                                                    <label class="text-primary">File</label>
                                                    <input type="file" name="file" class="form-control gambar" accept="image/*">
                                                    <div class=" invalid-feedback errorGambar">
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                                            <button type="submit" class="btn btn-primary btnEdit">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    <!-- ISI VIEW -->

                    <td><?= substr($item['nama'], 0, 30) ?></td>
                    <td><img src=" content/iklan/<?= $item['file'] ?>" width="30%"></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>


<?= $this->include('backend/iklanutama/ajax') ?>
<?= $this->include('backend/layouts/js_viewData') ?>
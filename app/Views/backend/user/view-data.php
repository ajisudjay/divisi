<!-- button tambah modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmodal">
    <span class="feather icon-plus text-light"></span>
</button>
<!-- tambah modal-->
<div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('user/tambah'); ?>" method="post" class="tambah">
                    <?php csrf_field() ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="text-primary">Nama</label>
                                <input type="text" name="nama" class="form-control nama" placeholder="Nama">
                                <div class="invalid-feedback errorNama"></div>
                                <br>
                            </div>
                            <div class="col-lg-6">
                                <label class="text-primary">Username</label>
                                <input type="text" name="username" class="form-control username" placeholder="Username">
                                <div class="invalid-feedback errorUsername"></div>
                            </div>
                            <div class="col-lg-6">
                                <label class="text-primary">Level</label>
                                <select name="level" class="form-control level">
                                    <option value="">-- Pilih Level --</option>
                                    <option value="Superadmin">Superadmin</option>
                                    <option value="Admin">Admin</option>
                                </select>
                                <div class="invalid-feedback errorLevel"></div>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="text-primary">Password</label>
                                <input type="password" name="password" class="form-control password" placeholder="Password">
                                <div class="invalid-feedback errorPassword"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="invalid-feedback errorUser"></div>
                                <label class="text-primary">Ulangi Password</label>
                                <input type="password" name="repassword" class="form-control repassword" placeholder="Ulangi Password">
                                <div class="invalid-feedback errorRepassword"></div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="dt-responsive table-responsive">
    <!-- id dibawah bisa diganti => simpletable -->
    <table id="scr-vtr-dynamic" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th style="max-width:5%; text-align: center;">No.</th>
                <th style="max-width:10%; text-align: center;">Aksi</th>
                <th style="max-width:20%; text-align: center;">Username</th>
                <th style="max-width:15%; text-align: center;">Password</th>
                <th style="max-width:30%; text-align: center;">Nama</th>
                <th style="max-width:20%; text-align: center;">Level</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php foreach ($user as $item) : ?>
                <?php $username = $item['username'] ?>
                <tr>
                    <td style="text-align: center;"><?= $no++ ?></td>
                    <td style="text-align: center;">
                        <!-- button edit modal -->
                        <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#editmodal<?= $username = $item['username'] ?>">
                            <span class="feather icon-edit-1 text-primary"></span>
                        </button>
                        <!-- edit modal-->
                        <div class="modal fade" id="editmodal<?= $username = $item['username'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ubah User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= base_url('user/edit'); ?>" method="post" class="edit">
                                            <?php csrf_field() ?>
                                            <div class="modal-body" style="text-align:left ;">
                                                <div class="row">
                                                    <div class="col-lg-11">
                                                        <label class="text-primary">Nama</label>
                                                        <input type="text" name="nama" value="<?= $item['nama'] ?>" class="form-control nama" placeholder="Nama">
                                                        <div class="invalid-feedback errorNama"></div>
                                                        <br>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5">
                                                        <label class="text-primary">Username</label>
                                                        <input type="text" name="username" value="<?= $item['username'] ?>" class="form-control username" placeholder="Username">
                                                        <div class="invalid-feedback errorUsername"></div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <label class="text-primary">Level</label>
                                                        <select name="level" class="form-control level" style="height:18px ;">
                                                            <option value="<?= $item['level'] ?>"><?= $item['level'] ?></option>
                                                            <option value="Superadmin">Superadmin</option>
                                                            <option value="Admin">Admin</option>
                                                        </select>
                                                        <div class="invalid-feedback errorLevel"></div>
                                                        <br>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5">
                                                        <label class="text-primary">Password</label>
                                                        <input type="password" name="password" value="<?= base64_decode($item['password']) ?>" class="form-control password" placeholder="Password">
                                                        <div class="invalid-feedback errorPassword"></div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="invalid-feedback errorUser"></div>
                                                        <label class="text-primary">Ulangi Password</label>
                                                        <input type="password" name="repassword" value="<?= base64_decode($item['password']) ?>" class="form-control repassword" placeholder="Ulangi Password">
                                                        <div class="invalid-feedback errorRepassword"></div>
                                                    </div>
                                                    <hr>
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
                        </div>
                        <?php
                        if (session()->get('username') === $item['username']) {
                            $tom_hapus = 'hidden';
                        } else {
                            $tom_hapus = '';
                        }
                        ?>
                        <!-- button hapus modal-->
                        <a href="<?= base_url('user/hapus/' . $item['username']); ?>" class="hapus" <?= $tom_hapus ?>>
                            <span class="feather icon-trash-2 text-danger"></span>
                        </a>
                    </td>

                    <!-- ISI VIEW -->
                    <td style="text-align: center;"><?= $item['username'] ?></td>
                    <td style="text-align: center;">******</td>
                    <td style="text-align: center;"><?= $item['nama'] ?></td>
                    <td style="text-align: center;"><?= $item['level'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<!-- SCRIPT AJAX -->
<script>
    $(document).ready(function() {
        //  function tambah
        $('.tambah').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
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
                        if (response.error.username) {
                            $('.username').addClass('is-invalid');
                            $('.errorUsername').html(response.error.username);
                        } else {
                            $('.username').removeClass('is-invalid');
                            $('.errorUsername').html('');
                        }
                        if (response.error.nama) {
                            $('.nama').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama);
                        } else {
                            $('.nama').removeClass('is-invalid');
                            $('.errorNama').html('');
                        }
                        if (response.error.level) {
                            $('.level').addClass('is-invalid');
                            $('.errorLevel').html(response.error.level);
                        } else {
                            $('.level').removeClass('is-invalid');
                            $('.errorLevel').html('');
                        }
                        if (response.error.password) {
                            $('.password').addClass('is-invalid');
                            $('.errorPassword').html(response.error.password);
                        } else {
                            $('.password').removeClass('is-invalid');
                            $('.errorPassword').html('');
                        }
                        if (response.error.repassword) {
                            $('.repassword').addClass('is-invalid');
                            $('.errorRepassword').html(response.error.repassword);
                        } else {
                            $('.repassword').removeClass('is-invalid');
                            $('.errorRepassword').html('');
                        }
                    } else {
                        if (response.status == 'gagal') {
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL',
                                text: response.sukses,
                            })
                        } else if (response.status == 'berhasil') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            });
                        }
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $('#result').html(response.data);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        });

        $('.edit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnEdit').attr('disable', 'disabled');
                    $('.btnEdit').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnEdit').removeAttr('disable', 'disabled');
                    $('.btnEdit').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.username) {
                            $('.username').addClass('is-invalid');
                            $('.errorUsername').html(response.error.username);
                        } else {
                            $('.username').removeClass('is-invalid');
                            $('.errorUsername').html('');
                        }
                        if (response.error.nama) {
                            $('.nama').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama);
                        } else {
                            $('.nama').removeClass('is-invalid');
                            $('.errorNama').html('');
                        }
                        if (response.error.level) {
                            $('.level').addClass('is-invalid');
                            $('.errorLevel').html(response.error.level);
                        } else {
                            $('.level').removeClass('is-invalid');
                            $('.errorLevel').html('');
                        }
                        if (response.error.password) {
                            $('.password').addClass('is-invalid');
                            $('.errorPassword').html(response.error.password);
                        } else {
                            $('.password').removeClass('is-invalid');
                            $('.errorPassword').html('');
                        }
                        if (response.error.repassword) {
                            $('.repassword').addClass('is-invalid');
                            $('.errorRepassword').html(response.error.repassword);
                        } else {
                            $('.repassword').removeClass('is-invalid');
                            $('.errorRepassword').html('');
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

        //  function hapus
        $('.hapus').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Data Akan Dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            });
        });
        window.setTimeout(function() {
            $(".flashAjax").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);
    });
</script>
<?= $this->include('backend/layouts/js_viewData') ?>
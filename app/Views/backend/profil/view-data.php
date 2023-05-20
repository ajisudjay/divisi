<div class="dt-responsive table-responsive">
    <!-- id dibawah bisa diganti => simpletable -->
    <table id="simpletable" class="table table-striped table-bordered nowrap">
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
                                        <h5 class="modal-title">Ganti Password</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= base_url('profil/edit'); ?>" method="post" class="edit">
                                            <?php csrf_field() ?>
                                            <div class="modal-body" style="text-align:left ;">
                                                <div class="row">
                                                    <div class="col-lg-5">
                                                        <label class="text-primary">Nama</label>
                                                        <input type="text" name="nama" value="<?= $item['nama'] ?>" class="form-control nama" placeholder="Nama">
                                                        <div class="invalid-feedback errorNama"></div>
                                                        <br>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <label class="text-primary">Username</label>
                                                        <input type="text" name="username" value="<?= $item['username'] ?>" class="form-control username" readonly>
                                                        <div class="invalid-feedback errorUsername"></div>
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

        window.setTimeout(function() {
            $(".flashAjax").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);
    });
</script>
<?= $this->include('backend/layouts/js_viewData') ?>
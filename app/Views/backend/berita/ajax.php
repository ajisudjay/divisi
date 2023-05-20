<!-- SCRIPT AJAX -->
<script>
    $(document).ready(function() {
        //  function tambah
        $('.tambah').submit(function() {
            var judul = $('#judul').val();
            var isi = $('#isi').val();
            var tingkat = $('#tingkat').val();
            var kategori = $('#kategori').val();
            var tanggal = $('#tanggal').val();
            var status = $('#status').val();
            var tag = $('#tag').val();
            var caption = $('#caption').val();
            var jenis_file = $('#jenis_file').val();
            var files = $('#file')[0].files;
            var fd = new FormData();

            fd.append('file', files[0]);
            fd.append('judul', judul);
            fd.append('isi', isi);
            fd.append('tanggal', tanggal);
            fd.append('tingkat', tingkat);
            fd.append('kategori', kategori);
            fd.append('status', status);
            fd.append('tag', tag);
            fd.append('caption', caption);
            fd.append('jenis_file', jenis_file);
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
                        if (response.error.judul) {
                            $('.judul').addClass('is-invalid');
                            $('.errorJudul').html(response.error.judul);
                        } else {
                            $('.judul').removeClass('is-invalid');
                            $('.errorJudul').html('');
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

        //  function edit
        $('.edit').submit(function() {
            var id = $('#id').val();
            var judul = $('#judul').val();
            var isi = $('#isi').val();
            var tingkat = $('#tingkat').val();
            var kategori = $('#kategori').val();
            var tanggal = $('#tanggal').val();
            var status = $('#status').val();
            var tag = $('#tag').val();
            var caption = $('#caption').val();
            var jenis_file = $('#jenis_file').val();
            var files = $('#file')[0].files;
            var fd = new FormData();

            fd.append('file', files[0]);
            fd.append('id', id);
            fd.append('judul', judul);
            fd.append('isi', isi);
            fd.append('tanggal', tanggal);
            fd.append('tingkat', tingkat);
            fd.append('kategori', kategori);
            fd.append('status', status);
            fd.append('caption', caption);
            fd.append('tag', tag);
            fd.append('jenis_file', jenis_file);
            $.ajax({
                type: "post",
                data: fd,
                dataType: "json",
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.btnEdit').attr('disable', 'disabled');
                    $('.btnEdit').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnEdit').removeAttr('disable', 'disabled');
                    $('.btnEdit').html('Edit');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.judul) {
                            $('.judul').addClass('is-invalid');
                            $('.errorJudul').html(response.error.judul);
                        } else {
                            $('.judul').removeClass('is-invalid');
                            $('.errorJudul').html('');
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

        //  function publish
        $('.publish').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Data Akan Dipublish!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Publish!'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            });
        });

        //  function unpublish
        $('.unpublish').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Data Akan Diunpublish!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Unpublish!'
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
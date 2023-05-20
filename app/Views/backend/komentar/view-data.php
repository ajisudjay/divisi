<div class="dt-responsive table-responsive">
    <!-- id dibawah bisa diganti => simpletable -->
    <table id="scr-vtr-dynamic" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th style="max-width:5%; text-align: center;">No.</th>
                <th style="max-width:10%; text-align: center;">Aksi</th>
                <th style="max-width:30%; text-align: center;">Judul Berita</th>
                <th style="max-width:35%; text-align: center;">Komentar</th>
                <th style="max-width:20%; text-align: center;">Log</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ?>

            <?php foreach ($komentar as $item) : ?>
                <?php $id = $item['id_komentar'] ?>
                <tr>
                    <td style="text-align:center ;"><?= $no++ ?></td>
                    <td style="text-align:center ;">
                        <!-- button hapus modal-->
                        <a href="<?= base_url('komentar/hapus/' . $item['id_komentar']); ?>" class="hapus">
                            <span class="feather icon-trash-2 text-danger"></span>
                        </a>
                    </td>

                    <!-- ISI VIEW -->
                    <td><?= $item['judul'] ?></td>
                    <td><?= $item['komentar'] ?></td>
                    <td><?= $item['timestamp'] . '|' . $item['nama'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<!-- SCRIPT AJAX -->
<script>
    $(document).ready(function() {
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
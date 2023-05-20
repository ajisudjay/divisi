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
                    <?= $this->include('backend/layouts/side_navbar/superadmin') ?>
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
                                                        <h4><?= $header ?></h4>
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
                                                        <div class="bg-transparent border-0" id="result"></div>
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
<script>
    $(document).ready(function() {
        $.ajax({
            url: '<?= base_url('iklanutama/viewData') ?>',
            dataType: 'json',
            success: function(response) {
                $("#result").html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>
<?= $this->include('backend/layouts/js_index') ?>

</html>
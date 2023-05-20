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
                    if ($lvl === 'Superadmin') {
                        $sidenavbar = $this->include('backend/layouts/side_navbar/superadmin');
                    } elseif ($lvl === 'Admin') {
                        $sidenavbar = $this->include('backend/layouts/side_navbar/admin');
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
                                                        <h4>DIVISI.ID</h4>
                                                        <span>Detail Inovatif dan Berintegritas</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item">
                                                            <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="#!"><?= $top_header ?></a></li>
                                                        <li class="breadcrumb-item"><a href="#!"><?= $header ?></a></li>
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
                                                    <div class="card-header" align="center">
                                                        <br><br><br><br>
                                                        <img src="libraries_backend/assets/images/home.png" alt="">
                                                        <br><br><br><br>
                                                    </div>
                                                </div>
                                                <!-- Content End -->
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
<?= $this->include('backend/layouts/js_index') ?>

</html>
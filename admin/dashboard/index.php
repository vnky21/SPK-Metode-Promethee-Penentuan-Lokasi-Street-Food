<?php 
$menu = "Dashboard";

include '../../includes/header.php'; 
include '../../includes/sidebar.php'; 
include '../../functions/crud.php'; 

$rowKriteria = selectData('tb_kriteria','COUNT(*) as jumlah');
$kriteria = $rowKriteria->fetch_assoc();

$rowSubKriteria = selectData('tb_sub_kriteria','COUNT(*) as jumlah');
$sub_kriteria = $rowSubKriteria->fetch_assoc();

$rowAlternatif = selectData('tb_alternatif','COUNT(*) as jumlah');
$alternatif = $rowAlternatif->fetch_assoc();

?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title mt-3">Dahsboard</h1>

        <?php if(isset($_SESSION['alert']) && $_SESSION['alert'] == 'success') : ?>
        <div id='alert-info'></div>
        <?php
        $_SESSION['alert'] = null;
        endif; ?>

        <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
            <div class="inner">
                <div class="app-card-body p-2">
                    <h3 class="mb-3">Selamat Datang di Sistem Kami</h3>
                    <div class="row gx-5 gy-3">
                        <div class="col-12 col-lg-12">

                            <div>
                                Sistem ini menggunakan metode PROMETHEE untuk membantu memilih lokasi terbaik bagi
                                street food dengan mengevaluasi dan membandingkan berbagai kriteria secara objektif.
                                Metode PROMETHEE menyediakan pendekatan analisis yang komprehensif, memfasilitasi
                                perbandingan berbagai opsi secara sistematis.
                            </div>
                            <!--//col-->

                        </div>
                        <!--//row-->
                    </div>
                    <!--//app-card-body-->
                </div>
                <!--//inner-->
            </div>
            <!--//app-card-->

        </div>
        <!--//container-fluid-->


        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration p-4">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary  mb-1">
                                    Jumlah Data Kriteria</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kriteria['jumlah'] ?> Data
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-gear text-primary fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration p-4">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary  mb-1">
                                    Jumlah Data Sub Kriteria</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sub_kriteria['jumlah']; ?> Data
                                    dari <?= $kriteria['jumlah'] ?> Kriteria</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-gears text-primary fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration p-4">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary  mb-1">
                                    Jumlah Data Lokasi Alternatif</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $alternatif['jumlah']; ?> Data
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-map-location-dot text-primary fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--//app-content-->

        <?php 
include '../../includes/footer.php';   
?>
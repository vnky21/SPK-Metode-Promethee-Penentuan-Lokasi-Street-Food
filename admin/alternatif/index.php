<?php 
$menu = "Alternatif";

include '../../includes/header.php'; 
include '../../includes/sidebar.php'; 
include '../../functions/crud.php';
include '../../functions/hash.php';

$result = selectData("tb_alternatif", "*");
$dataArray = [];
if ($result->num_rows > 0) {
    // Menyimpan data dari setiap baris ke dalam array asosiatif
    while ($row = $result->fetch_object()) {
        $dataArray[] = $row;
    }
}
?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title mb-1 mt-3">Data Lokasi Alternatif</h1>
        <p class="mb-3">Data Alternatif merupakan pilihan-pilihan atau opsi yang tersedia untuk dievaluasi dan dibandingkan dalam proses pengambilan keputusan.</p>
        <?php if(isset($_SESSION['alert']) && $_SESSION['alert'] == 'success') : ?>
        <div id='alert-success' data-message="<?= $_SESSION['message'] ?>"></div>
        <?php
        $_SESSION['alert'] = null;
        endif; ?>

        <?php if(isset($_SESSION['alert']) && $_SESSION['alert'] == 'error') : ?>
        <div id='alert-error' data-message="<?= $_SESSION['message'] ?>"></div>
        <?php
        $_SESSION['alert'] = null;
        endif; ?>
        <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Daftar Data Lokasi Alternatif</h4>
                    </div>
                    <!--//col-->
                    <div class="col-auto">
                        <div class="card-header-action">
                            <a href="./form.php?action=tambah" class="btn app-btn-success">+ Tambah Data</a>
                        </div>
                        <!--//card-header-actions-->
                    </div>
                    <!--//col-->
                </div>
                <!--//row-->
            </div>
            <!--//app-card-header-->
            <div class="app-card-body p-3 p-lg-4">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left display" id="myTable">
                        <thead>
                            <tr>
                                <th class="cell">No</th>
                                <th class="cell">Nama Alternatif</th>
                                <th class="cell" width="300">Alamat</th>
                                <th class="cell">Kontak</th>
                                <th class="cell">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach($dataArray as $value) : ?>
                            <tr>
                                <td class="cell"><?= $i++ ?>.</td>
                                <td class="cell"><?= $value->nama_alternatif; ?></td>
                                <td class="cell"><?= $value->alamat; ?></td>
                                <td class="cell"><?= $value->kontak; ?></td>
                                <td class="cell">
                                    <a class="btn app-btn-primary"
                                        href="form.php?action=edit&id=<?= encryptID($value->id_alternatif); ?>"><i
                                            class="fa fa-edit"></i></a>
                                    <button class="btn app-btn-danger btn-delete-alternatif"
                                        id="<?= encryptID($value->id_alternatif); ?>"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!--//table-responsive-->
            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->



    </div>
    <!--//container-fluid-->
</div>
<!--//app-content-->

<?php 
include '../../includes/footer.php';   
?>
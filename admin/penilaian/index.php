<?php 
$menu = "Penilaian";

include '../../includes/header.php'; 
include '../../includes/sidebar.php'; 
include '../../functions/crud.php';
include '../../functions/hash.php';
include '../../promethee/functions.php';
include '../../promethee/get-electre.php';

?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">


        <h1 class="app-page-title mb-1 mt-3">Penilaian Alternatif</h1>
        <p class="mb-3">Mengisi penilaian alternatif berdasarkan subkriteria dari kriteria yang tersedia.</p>
        <?php if(isset($_SESSION['alert']) && $_SESSION['alert'] == 'success') : ?>
            <div id='alert-success' data-message="<?= $_SESSION['message'] ?>"></div>
        <?php
        $_SESSION['alert'] = null;
        endif; ?>
        <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Penilaian Data Alternatif</h4>
                    </div>

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
                    <table class="table table-bordered app-table-hover mb-0 text-left display" id="miyTable">
                        <thead>
                            <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Alternatif</th>
                                <th colspan="<?= $jumlahKriteria; ?>">Kriteria</th>
                                <th rowspan="2">Aksi</th>
                            </tr>

                            <tr>
                                <?php foreach($dataKriteria as $value) : ?>
                                <th class="cell"><?= $value['nama_kriteria']; ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            
                        <?php $i=1;
                            foreach($dataAlternatif as $value) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $value['nama']; ?></td>
                                <?php for($j = 0; $j < $jumlahKriteria; $j++) : ?>
                                <td>
                                <?= isset($value['bobot_subkriteria'][$j]) ? $value['bobot_subkriteria'][$j] : 'belum dinilai'; ?>
                                </td>
                                <?php endfor; ?>
                                <td class="cell">
                                    <a class="btn app-btn-primary" href="form.php?action=edit&id=<?= encryptID($value['id_alternatif']); ?>" ><i class="fa fa-edit"></i></a>
                                    <button class="btn app-btn-danger btn-delete-penilaian" id=<?= encryptID($value['id_alternatif']); ?>><i class="fa fa-trash"></i></button>
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
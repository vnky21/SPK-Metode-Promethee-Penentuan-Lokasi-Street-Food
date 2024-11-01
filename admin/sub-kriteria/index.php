<?php 
$menu = "Sub Kriteria";

include '../../includes/header.php'; 
include '../../includes/sidebar.php'; 
include '../../functions/crud.php';
include '../../functions/hash.php';

$resultKriteria = selectData("tb_kriteria", ["id_kriteria", "nama_kriteria"]);
$dataKriteria = [];
if ($resultKriteria->num_rows > 0) {
    while ($row = $resultKriteria->fetch_object()) {
        $dataKriteria[] = $row;
    }
}

$id_kriteria = isset($_GET['id_kriteria']) ? decryptId($_GET['id_kriteria']) : '';

if(!empty($id_kriteria)){
    if(isset($_GET['pilih'])){

        $resultSubKriteria = selectData("tb_sub_kriteria", "*", "id_kriteria = $id_kriteria");
        $dataSubKriteria = [];

        if ($resultSubKriteria->num_rows > 0) {
            while ($row = $resultSubKriteria->fetch_object()) {
            $dataSubKriteria[] = $row;
         }
    }
}

    $result = selectData("tb_kriteria", "*");
    $dataArray = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_object()) {
            $dataArray[] = $row;
        }
}
}

?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">


        <h1 class="app-page-title mb-1 mt-3">Data Sub Kriteria</h1>
        <p class="mb-3">Sub Kriteria merupakan parameter spesifik yang mengevaluasi dan membandingkan aspek-aspek rinci dari kriteria utama.</p>
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

        <div class="row">

            <div class="col-lg-6"></div>
            <div class="app-card app-card-chart mb-4 h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-lg-6">
                            <h4 class="app-card-title">Data Sub Kriteria - SPK Promethee</h4>
                        </div>
                        <div class="col-lg-6">

                        </div>
                    </div>
                </div>

                <div class="app-card-body p-3 p-lg-4">
                    <!-- Formulir Pencarian -->
                    <div class="row">
                        <div class="col-lg-5">
                            <form action="" method="GET" class="form-inline">
                                <div class="form-group mb-2">
                                    <label for="searchInput" class="sr-only">Search:</label>
                                    <select class="form-select" name="id_kriteria" aria-label="Default select example">
                                        <option value="<?= '' ?>">--Pilih Kriteria--</option>
                                        <?php foreach($dataKriteria as $value) : ?>
                                        <option value="<?= encryptID($value->id_kriteria); ?>"
                                            <?= ($id_kriteria == $value->id_kriteria) ? 'selected' : '' ?>>
                                            <?= $value->nama_kriteria ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                        </div>
                        <div class="col-lg-4">
                            <button type="submit" name="pilih" class="btn app-btn-success mb-2"><i class="fa fa-search"></i> Pilih Kriteria</button>
                        </div>
                        </form>

                    </div>

                    <!-- Daftar Data atau Hasil Pencarian akan ditampilkan di sini -->
                </div>
            </div>



            <div class="app-card app-card-chart h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Daftar Data Sub Kriteria</h4>
                        </div>
                        <!--//col-->
                        <div class="col-auto">
                            <div class="card-header-action">
                                <?php if(!empty($id_kriteria)) : ?>
                                <a href="./form.php?action=tambah&id_kriteria=<?= encryptID($id_kriteria); ?>"
                                    class="btn app-btn-success">+ Tambah Data</a>
                                <?php endif; ?>
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
                                    <th class="cell">Nama Sub Kriteria</th>
                                    <th class="cell">Bobot Sub Kriteria</th>
                                    <th class="cell">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($dataSubKriteria)) : ?>
                                <?php
                            $i = 1;
                            foreach($dataSubKriteria as $value) : ?>
                                <tr>
                                    <td class="cell"><?= $i++ ?>.</td>
                                    <td class="cell"><?= $value->nama_subkriteria; ?></td>
                                    <td class="cell"><?= $value->bobot_subkriteria ?></td>
                                    <td class="cell">
                                        <a class="btn app-btn-primary"
                                            href="form.php?action=edit&id=<?= encryptID($value->id_subkriteria); ?>&id_kriteria=<?= encryptID($value->id_kriteria); ?>"><i
                                                class="fa fa-edit"></i></a>
                                        <button class="btn app-btn-danger btn-delete-subkriteria"
                                            id="<?= encryptID($value->id_subkriteria); ?>"
                                            id-kriteria="<?= encryptID($value->id_kriteria); ?>"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <!--//table-responsive-->
                </div>
                <!--//app-card-body-->
            </div>
            <!--//app-card-->
        </div>

    </div>
    <!--//container-fluid-->
</div>
<!--//app-content-->

<?php 
include '../../includes/footer.php';   
?>
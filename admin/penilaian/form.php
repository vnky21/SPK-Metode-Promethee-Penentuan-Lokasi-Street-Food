<?php
$menu = "Penilaian";
include '../../includes/header.php';
include '../../includes/sidebar.php';
include '../../functions/crud.php';
include '../../functions/hash.php';

$conn = connectDB();

$action = isset($_GET['action']) ? $_GET['action'] : 'tambah';
$id_alternatif = isset($_GET['id']) ? decryptID($_GET['id']) : null;
$result = resultQuery("SELECT tb_kriteria.id_kriteria,nama_kriteria,tb_sub_kriteria.id_subkriteria,nama_subkriteria,bobot_subkriteria FROM tb_kriteria 
                        LEFT JOIN tb_sub_kriteria 
                        ON tb_kriteria.id_kriteria = tb_sub_kriteria.id_kriteria");
$dataKriteria = [];
if ($result->num_rows > 0) {
    // Menyimpan data dari setiap baris ke dalam array asosiatif
    while ($row = $result->fetch_object()) {
        $kriteria_id = $row->id_kriteria;

        if (!isset($dataKriteria[$kriteria_id])) {
            $dataKriteria[$kriteria_id] = (object) [
                'id_kriteria' => $row->id_kriteria,
                'nama_kriteria' => $row->nama_kriteria,
                'subkriteria' => [],
            ];
        }
        $dataKriteria[$kriteria_id]->subkriteria[] = (object) [
            'id_subkriteria' => $row->id_subkriteria,
            'nama_subkriteria' => $row->nama_subkriteria,
            'bobot_subkriteria' => $row->bobot_subkriteria,
        ];
    }
}

$resulAlternatif = resultQuery("SELECT tb_alternatif.id_alternatif,nama_alternatif FROM tb_alternatif
                                    LEFT JOIN tb_penilaian ON tb_alternatif.id_alternatif = tb_penilaian.id_alternatif
                                    WHERE tb_penilaian.id_penilaian IS NULL");
$dataAlternatif = [];
if ($resulAlternatif->num_rows > 0) {
    // Menyimpan data dari setiap baris ke dalam array asosiatif
    while ($row = $resulAlternatif->fetch_object()) {
        $dataAlternatif[] = $row;
    }
}

if ($action == 'edit' && $id_alternatif) {
    $resultSelect= resultQuery("SELECT tb_sub_kriteria.id_subkriteria,tb_penilaian.id_penilaian
                            FROM tb_penilaian
                            JOIN tb_sub_kriteria ON tb_penilaian.id_subkriteria = tb_sub_kriteria.id_subkriteria
                            JOIN tb_kriteria ON tb_sub_kriteria.id_kriteria = tb_kriteria.id_kriteria
                            WHERE id_alternatif = $id_alternatif");
    $dataSelect = [];
    if ($resultSelect->num_rows > 0) {
    // Menyimpan data dari setiap baris ke dalam array asosiatif
    while ($row = $resultSelect->fetch_object()) {
        $dataSelect[] = $row;
    }

    $resultAlternatif = selectData('tb_alternatif','*',"id_alternatif = '$id_alternatif'");
    $dataAlternatif = $resultAlternatif->fetch_assoc();

    }
}
?>
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title mt-3">Penilaian Data Alternatif</h1>

        <div class="app-card app-card-chart mb-3 h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <?php if ($action == 'tambah') : ?>
                        <h4 class="app-card-title">Pilih Data Alternatif</h4>
                        <?php elseif ($action == 'edit' && $id_alternatif) : ?>
                        <h4 class="app-card-title">Nama Alternatif</h4>
                        <?php endif; ?>
                    </div>
                </div>
                <!--//row-->
            </div>
            <!--//app-card-header-->
            <div class="app-card-body p-3 p-lg-4">
                <form class="settings-form" action="action/proses.php" method="POST">
                    <input type="hidden" name="action" value="<?= $action; ?>">

                    <?php if($action == 'edit') : ?>
                    <input type="hidden" name="id_alternatif" value="<?= isset($id_alternatif) ? encryptID($id_alternatif) : ''; ?>">
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Nama Lokasi Alternatif</label>
                        <input type="text" class="form-control" id="setting-input-2" name="nama_alternatif" readonly
                            value="<?=  $dataAlternatif['nama_alternatif'] ; ?>">
                    </div>
                        
                    <?php else : ?>
                        <div class="form-group mb-2">
                            <label for="searchInput" class="form-label">Nama Lokasi Alternatif</label>
                            <select class="form-select" name="id_alternatif" aria-label="Default select example" required>
                                <option value="">-- Select Name --</option>
                                <?php foreach($dataAlternatif as $value) : ?>
                                <option value="<?= encryptID($value->id_alternatif); ?>"><?= $value->nama_alternatif; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>
            </div>
            <!--//app-card-body-->
        </div>
        <!--//app-card-->

        <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <?php if ($action == 'tambah') : ?>
                        <h4 class="app-card-title">Form Penilaian Data Alterantif</h4>
                        <?php elseif ($action == 'edit' && $id_alternatif) : ?>
                        <h4 class="app-card-title">Form Edit Penilaian Data Alternatif</h4>
                        <?php endif; ?>
                    </div>
                </div>
                <!--//row-->
            </div>
            <!--//app-card-header-->
            <div class="app-card-body p-3 p-lg-4">
                <input type="hidden" name="action" value="<?= $action; ?>">
                        <?php
                        $i = 0;
                        foreach($dataKriteria as $value) : ?>
                        <div class="form-group mb-3">
                        <input type="hidden" name="id_<?= $i + 1; ?>" value="<?= (isset($dataSelect[$i]) && !is_null($dataSelect[$i]->id_penilaian)) ? encryptID($dataSelect[$i]->id_penilaian) : ''; ?>">
                            <label for="searchInput" class="form-label"><?= $value->nama_kriteria ?></label>
                            <select class="form-select" name="form_<?= $i + 1;  ?>" aria-label="Default select example" required>
                                <option value="">-- Select Sub Criteria --</option>

                            <?php if($action == 'edit') : ?>

                                <?php foreach($value->subkriteria as $value_subkriteria) : ?>
                                    <?php $isSelected = in_array($value_subkriteria->id_subkriteria, array_column($dataSelect, 'id_subkriteria')); ?>
                                <option value="<?= encryptID($value_subkriteria->id_subkriteria); ?>" <?= $isSelected ? 'selected' : ''; ?> ><?= $value_subkriteria->bobot_subkriteria; ?> - <?= $value_subkriteria->nama_subkriteria ?></option>
                                <?php endforeach; ?>

                            <?php else : ?>
                                <?php foreach($value->subkriteria as $value_subkriteria) : ?>
                                <option value="<?= encryptID($value_subkriteria->id_subkriteria); ?>"><?= $value_subkriteria->bobot_subkriteria; ?> - <?= $value_subkriteria->nama_subkriteria ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            </select>
                        </div>
                        <?php 
                        $i++;
                        endforeach; ?>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn app-btn-success">
                            <?=  ($action == 'tambah') ? 'Tambah Penilaian' : 'Update Penilaian'; ?>
                        </button>
                    </div>
                </form>
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
<?php
$menu = "Kriteria";
include '../../includes/header.php';
include '../../includes/sidebar.php';
include '../../functions/crud.php';
include '../../functions/hash.php';

$conn = connectDB();

$action = isset($_GET['action']) ? $_GET['action'] : 'tambah';
$id_kriteria = isset($_GET['id']) ? decryptID($_GET['id']) : null;

// Untuk edit, dapatkan data kriteria dari database
if ($action == 'edit' && $id_kriteria) {
    $resultSelect = selectData("tb_kriteria", "*", "id_kriteria = $id_kriteria");
    $kriteria = $resultSelect->fetch_assoc();
}
?>
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title mt-3">Data Kriteria</h1>

        <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <?php if ($action == 'tambah') : ?>
                            <h4 class="app-card-title">Form Tambah Data Kriteria</h4>
                        <?php elseif ($action == 'edit' && $id_kriteria) : ?>
                            <h4 class="app-card-title">Form Edit Data Kriteria</h4>
                        <?php endif; ?>
                    </div>
                </div>
                <!--//row-->
            </div>
            <!--//app-card-header-->
            <div class="app-card-body p-3 p-lg-4">
                <form class="settings-form" action="action/proses.php" method="POST">
                    <input type="hidden" name="action" value="<?= $action; ?>">
                    <input type="hidden" name="id_kriteria" value="<?= isset($id_kriteria) ? encryptID($id_kriteria) : ''; ?>">
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Nama Kriteria</label>
                        <input type="text" class="form-control" id="setting-input-2" name="nama_kriteria" required
                            value="<?= isset($kriteria['nama_kriteria']) ? $kriteria['nama_kriteria'] : ''; ?>">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn app-btn-success">
                            <?=  ($action == 'tambah') ? 'Tambah Kriteria' : 'Update Kriteria'; ?>
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

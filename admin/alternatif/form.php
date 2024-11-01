<?php
$menu = "Alternatif";
include '../../includes/header.php';
include '../../includes/sidebar.php';
include '../../functions/crud.php';
include '../../functions/hash.php';

$conn = connectDB();

$action = isset($_GET['action']) ? $_GET['action'] : 'tambah';
$id_alternatif = isset($_GET['id']) ? decryptID($_GET['id']) : null;

// Untuk edit, dapatkan data kriteria dari database
if ($action == 'edit' && $id_alternatif) {
    $resultSelect = selectData("tb_alternatif", "*", "id_alternatif = $id_alternatif");
    $alt = $resultSelect->fetch_assoc();
}
?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title mt-3">Data Lokasi Alternatif</h1>

        <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <?php if ($action == 'tambah') : ?>
                        <h4 class="app-card-title">Form Tambah Data Lokasi Alternatif</h4>
                        <?php elseif ($action == 'edit' && $id_alternatif) : ?>
                        <h4 class="app-card-title">Form Edit Data Lokasi ALternatif</h4>
                        <?php endif; ?>
                    </div>
                </div>
                <!--//row-->
            </div>
            <!--//app-card-header-->
            <div class="app-card-body p-3 p-lg-4">
                <form class="settings-form" action="action/proses.php" method="POST">
                    <input type="hidden" name="action" value="<?= $action; ?>">
                    <input type="hidden" name="id_alternatif"
                        value="<?= isset($id_alternatif) ? encryptID($id_alternatif) : ''; ?>">
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Nama Alternatif</label>
                        <input type="text" class="form-control" id="setting-input-2" name="nama_alternatif" required
                            value="<?= isset($alt['nama_alternatif']) ? $alt['nama_alternatif'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="setting-input-2" name="alamat" required
                            value="<?= isset($alt['alamat']) ? $alt['alamat'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Link Maps (Iframe)</label>
                        <div id="maps-container" style="margin-bottom: 10px;">
                            <iframe id="maps-iframe" width="600" height="450" style="display:none; border:0;"
                                allowfullscreen loading="lazy"></iframe>
                            <div id="error-message" style="color: red; display: none;"></div>
                        </div>
                        <textarea name="maps" style="height: 125px;" class="form-control" id="maps-input"
                            oninput="updateMap()"><?= isset($alt['maps']) ? $alt['maps'] : ''; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="kontak" class="form-label">No. Telp (WA)</label>
                        <input type="text" class="form-control" id="kontak" name="kontak" required
                            value="<?= isset($alt['kontak']) ? $alt['kontak'] : ''; ?>"
                            oninput="formatPhoneNumber(this)">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn app-btn-success">
                            <?=  ($action == 'tambah') ? 'Tambah Alternatif' : 'Update Alternatif'; ?>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        updateMap();
    });
</script>
<?php
include '../../includes/footer.php';
?>
<?php
$menu = "Admin";
include '../../includes/header.php';
include '../../includes/sidebar.php';
include '../../functions/crud.php';
include '../../functions/hash.php';

$conn = connectDB();

$action = isset($_GET['action']) ? $_GET['action'] : 'tambah';
$id_admin = isset($_GET['id']) ? decryptID($_GET['id']) : null;

// Untuk edit, dapatkan data kriteria dari database
if ($action == 'edit' && $id_admin) {
    $resultSelect = selectData("tb_admin", "*", "id_admin = $id_admin");
    $kriteria = $resultSelect->fetch_assoc();
}
?>
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title">Data Admin</h1>

        <?php if(isset($_SESSION['alert']) && $_SESSION['alert'] == 'error') : ?>
        <div id='alert-error' data-message="<?= $_SESSION['message'] ?>"></div>
        <?php
        $_SESSION['alert'] = null;
        endif; ?>


        <?php if($action == 'edit') : ?>

        <div class="app-card app-card-chart mb-4 h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Form Edit Data Admin</h4>
                    </div>
                </div>
                <!--//row-->
            </div>
            <!--//app-card-header-->
            <div class="app-card-body p-3 p-lg-4">
                <form class="settings-form" action="action/proses.php" method="POST">
                    <input type="hidden" name="action" value="<?= $action; ?>">
                    <input type="hidden" name="id_admin"
                        value="<?= isset($id_admin) ? encryptID($id_admin) : ''; ?>">
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Username</label>
                        <input type="text" class="form-control" id="setting-input-2" name="username" required
                            value="<?= isset($kriteria['username']) ? $kriteria['username'] : ''; ?>">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn app-btn-success">
                            Edit Username
                        </button>
                    </div>
                </form>
            </div>
            <!--//app-card-body-->
        </div>
        <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Form Edit Data Admin</h4>
                    </div>
                </div>
                <!--//row-->
            </div>
            <!--//app-card-header-->
            <div class="app-card-body p-3 p-lg-4">
                <form class="settings-form" action="action/proses.php" method="POST">
                    <input type="hidden" name="action" value="<?= $action; ?>">
                    <input type="hidden" name="id_admin"
                        value="<?= isset($id_admin) ? encryptID($id_admin) : ''; ?>">
                    <div class="mb-3 password-container">
                        <label for="password-1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password-1" name="password" required>
                        <span class="toggle-password" onclick="togglePassword('password-1', 'eye-icon-1')">
                            <i id="eye-icon-1" class="fas fa-eye"></i>
                        </span>
                    </div>

                    <div class="mb-3 password-container">
                        <label for="password-2" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password-2" name="password2" required>
                        <span class="toggle-password" onclick="togglePassword('password-2', 'eye-icon-2')">
                            <i id="eye-icon-2" class="fas fa-eye"></i>
                        </span>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn app-btn-success">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
            <!--//app-card-body-->
        </div>

        <?php else : ?>
        <div class="app-card app-card-chart h-100 shadow-sm">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <?php if ($action == 'tambah') : ?>
                        <h4 class="app-card-title">Form Tambah Data Admin</h4>
                        <?php elseif ($action == 'edit' && $id_admin) : ?>
                        <h4 class="app-card-title">Form Edit Data Admin</h4>
                        <?php endif; ?>
                    </div>
                </div>
                <!--//row-->
            </div>
            <!--//app-card-header-->


            <div class="app-card-body p-3 p-lg-4">
                <form class="settings-form" action="action/proses.php" method="POST">
                    <input type="hidden" name="action" value="<?= $action; ?>">
                    <input type="hidden" name="id_kriteria"
                        value="<?= isset($id_kriteria) ? encryptID($id_kriteria) : ''; ?>">
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Username</label>
                        <input type="text" class="form-control" id="setting-input-2" name="username" required
                            value="<?= isset($kriteria['nama_kriteria']) ? $kriteria['nama_kriteria'] : ''; ?>">
                    </div>
                    <div class="mb-3 password-container">
                        <label for="password-1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password-1" name="password" required>
                        <span class="toggle-password" onclick="togglePassword('password-1', 'eye-icon-1')">
                            <i id="eye-icon-1" class="fas fa-eye"></i>
                        </span>
                    </div>

                    <div class="mb-3 password-container">
                        <label for="password-2" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password-2" name="password2" required>
                        <span class="toggle-password" onclick="togglePassword('password-2', 'eye-icon-2')">
                            <i id="eye-icon-2" class="fas fa-eye"></i>
                        </span>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn app-btn-success">
                        Tambah Data Admin
                        </button>
                    </div>
                </form>
            </div>


            <!--//app-card-body-->
        </div>
        <!--//app-card-->
        <?php endif; ?>

    </div>
    <!--//container-fluid-->
</div>
<!--//app-content-->

<?php
include '../../includes/footer.php';
?>
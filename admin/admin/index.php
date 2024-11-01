<?php 
$menu = "Admin";

include '../../includes/header.php'; 
include '../../includes/sidebar.php'; 
include '../../functions/crud.php';
include '../../functions/hash.php';


$result = selectData("tb_admin", "*");
$dataAdmin = [];
if ($result->num_rows > 0) {
    // Menyimpan data dari setiap baris ke dalam array asosiatif
    while ($row = $result->fetch_object()) {
        $dataAdmin[] = $row;
    }
}

?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">


        <h1 class="app-page-title mb-1 mt-3">Data Admin</h1>
        <p class="mb-3">Admin bertugas untuk mengelola kriteria, sub kriteria, dan alternatif sistem pendukung keputusan.</p>

        <?php if(isset($_SESSION['alert']) && $_SESSION['alert'] == 'success') : ?>
        <div id='alert-success' data-message="<?= $_SESSION['message'] ?>"></div>
        <?php
        $_SESSION['alert'] = null;
        endif; ?>

   

            <div class="app-card app-card-chart h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">List Data Admin</h4>
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
                                    <th class="cell">Username</th>
                                    <th class="cell">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $i = 1;
                            foreach($dataAdmin as $value) : ?>
                                <tr>
                                    <td class="cell"><?= $i++ ?>.</td>
                                    <td class="cell"><?= $value->username; ?></td>
                                    <td class="cell">
                                        <a class="btn app-btn-primary"
                                            href="form.php?action=edit&id=<?= encryptID($value->id_admin); ?>"><i
                                                class="fa fa-edit"></i></a>
                                        <button class="btn app-btn-danger btn-delete-admin" id="<?= encryptID($value->id_admin); ?>"><i class="fa fa-trash"></i></button>
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

    </div>
    <!--//container-fluid-->
</div>
<!--//app-content-->

<?php 
include '../../includes/footer.php';   
?>
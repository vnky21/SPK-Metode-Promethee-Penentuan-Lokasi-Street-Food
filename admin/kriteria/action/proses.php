<?php
session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] !== true){
    header('Location: http://app-electre.test/');
    die;
}
include '../../../functions/hash.php';
include '../../../functions/crud.php';


// Menerima data dari formulir
$action = isset($_POST['action']) ? $_POST['action'] : '';
$id_kriteria = isset($_POST['id_kriteria']) ? htmlspecialchars(decryptID($_POST['id_kriteria'])) : ''; 
$nama_kriteria = isset($_POST['nama_kriteria']) ? htmlspecialchars($_POST['nama_kriteria'])  : ''; 
$bobot_kriteria = isset($_POST['bobot_kriteria']) ? htmlspecialchars($_POST['bobot_kriteria'])  : ''; 

if ($action == 'tambah') {

    // Proses tambah data
    $dataInsert = array(
        'nama_kriteria' => $nama_kriteria,
    );

    $resultInsert = insertData("tb_kriteria", $dataInsert);

    if ($resultInsert) {

        $_SESSION['alert'] = "success";
        $_SESSION['message'] = "di Tambahkan";
        header('Location: '. '../index.php');

    } else {
        echo "Gagal menambahkan data.";
    }
} elseif ($action == 'edit' && $id_kriteria) {
    
    // Proses edit data
    $dataUpdate = array(
        'nama_kriteria' => $nama_kriteria,
    );

    $resultUpdate = updateData("tb_kriteria", $dataUpdate, "id_kriteria = $id_kriteria");

    if ($resultUpdate) {

        $_SESSION['alert'] = "success";
        $_SESSION['message'] = "di Ubah";
        header('Location: '. '../index.php');

    } else {
        echo "Gagal memperbarui data.";
    }
} else {
    // Aksi tidak dikenali
    echo "Aksi tidak dikenali.";
}

?>

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
$id_subkriteria = isset($_POST['id_subkriteria']) ? htmlspecialchars(decryptID($_POST['id_subkriteria'])) : ''; 
$nama_subkriteria = isset($_POST['nama_subkriteria']) ? htmlspecialchars($_POST['nama_subkriteria'])  : ''; 
$bobot_subkriteria = isset($_POST['bobot_subkriteria']) ? htmlspecialchars($_POST['bobot_subkriteria'])  : ''; 

if ($action == 'tambah') {

    // Proses tambah data

    var_dump($id_kriteria);
    $dataInsert = array(
        'id_kriteria' => $id_kriteria,
        'nama_subkriteria' => $nama_subkriteria,
        'bobot_subkriteria' => $bobot_subkriteria 
    );

    $resultInsert = insertData("tb_sub_kriteria", $dataInsert);

    if ($resultInsert) {

        $_SESSION['alert'] = "success";
        $_SESSION['message'] = "di Tambahkan";
        header('Location: '. '../index.php?id_kriteria='. encryptID($id_kriteria) .'&pilih=');

    } else {
        echo "Gagal menambahkan data.";
    }
} elseif ($action == 'edit' && $id_subkriteria) {
    
    // Proses edit data
    $dataUpdate = array(
        'nama_subkriteria' => $nama_subkriteria,
        'bobot_subkriteria' => $bobot_subkriteria 
    );

    $resultUpdate = updateData("tb_sub_kriteria", $dataUpdate, "id_subkriteria = $id_subkriteria");

    if ($resultUpdate) {

        $_SESSION['alert'] = "success";
        $_SESSION['message'] = "di Ubah";
        header('Location: '. '../index.php?id_kriteria='. encryptID($id_kriteria) .'&pilih=');

    } else {
        echo "Gagal memperbarui data.";
    }
} else {
    // Aksi tidak dikenali
    echo "Aksi tidak dikenali.";
}

?>

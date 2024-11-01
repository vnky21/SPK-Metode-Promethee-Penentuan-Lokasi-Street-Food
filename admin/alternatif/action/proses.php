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
$id_alternatif = isset($_POST['id_alternatif']) ? htmlspecialchars(decryptID($_POST['id_alternatif'])) : ''; 
$nama_alternatif = isset($_POST['nama_alternatif']) ? htmlspecialchars($_POST['nama_alternatif'])  : ''; 
$alamat = isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat'])  : ''; 
$maps = isset($_POST['maps']) ? $_POST['maps']  : ''; 
$kontak = isset($_POST['kontak']) ? htmlspecialchars($_POST['kontak'])  : ''; 

$newWidth = 400;
$newHeight = 200; 

$maps = preg_replace('/width="\d+"/', 'width="' . $newWidth . '"', $maps);
$maps = preg_replace('/height="\d+"/', 'height="' . $newHeight . '"', $maps);
    
if ($action == 'tambah') {

    $dataInsert = array(
        'nama_alternatif' => $nama_alternatif,
        'alamat' => $alamat,
        'maps' => $maps,
        'kontak' => $kontak
    );
    
    $resultInsert = insertData("tb_alternatif", $dataInsert);

    if ($resultInsert) {

        $_SESSION['alert'] = "success";
        $_SESSION['message'] = "di Tambahkan";
        header('Location: '. '../index.php');

    } else {
        echo "Gagal menambahkan data.";
    }
} elseif ($action == 'edit' && $id_alternatif) {
    
    // Proses edit data
    $dataUpdate = array(
        'nama_alternatif' => $nama_alternatif,
        'alamat' => $alamat,
        'maps' => $maps,
        'kontak' => $kontak
    );

    $resultUpdate = updateData("tb_alternatif", $dataUpdate, "id_alternatif = $id_alternatif");

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

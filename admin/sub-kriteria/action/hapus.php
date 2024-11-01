<?php
session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] !== true){
    header('Location: http://app-electre.test/');
    die;
}
include '../../../functions/hash.php';
include '../../../functions/crud.php';


$id_subkriteria = isset($_GET['id']) ? htmlspecialchars(decryptID($_GET['id'])) : ''; 
$id_kriteria = isset($_GET['id_kriteria']) ? htmlspecialchars($_GET['id_kriteria']) : ''; 

try {
    $resultDelete = deleteData('tb_sub_kriteria', "id_subkriteria = $id_subkriteria");

    if($resultDelete){
        $_SESSION['alert'] = "success";
        $_SESSION['message'] = "Data berhasil dihapus";
        header('Location: ../index.php?id_kriteria='.$id_kriteria.'&pilih=');
    } else {
        throw new Exception("Gagal menghapus data.");
    }
} catch (Exception $e) {
    $_SESSION['alert'] = "error";
    $_SESSION['message'] = $e->getMessage();
    header('Location: ../index.php?id_kriteria='.$id_kriteria.'&pilih=');
    exit; // Pastikan untuk keluar setelah mengalihkan pengguna
}
?>

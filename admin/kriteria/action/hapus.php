<?php
session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] !== true){
    header('Location: http://app-electre.test/');
    die;
}
include '../../../functions/hash.php';
include '../../../functions/crud.php';



$id_kriteria = isset($_GET['id_kriteria']) ? htmlspecialchars(decryptID($_GET['id_kriteria'])) : ''; 

try {
    $resultDelete = deleteData('tb_kriteria', "id_kriteria = $id_kriteria");

    if($resultDelete){
        $_SESSION['alert'] = "success";
        $_SESSION['message'] = "Data berhasil dihapus";
        header('Location: ../index.php');
    } else {
        throw new Exception("Gagal menghapus data.");
    }
} catch (Exception $e) {
    $_SESSION['alert'] = "error";
    $_SESSION['message'] = $e->getMessage();
    header('Location: ../index.php');
    exit; // Pastikan untuk keluar setelah mengalihkan pengguna
}

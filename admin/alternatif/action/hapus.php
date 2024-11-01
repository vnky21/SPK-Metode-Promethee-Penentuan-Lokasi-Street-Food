<?php
session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] !== true){
    header('Location: http://app-electre.test/');
    die;
}
include '../../../functions/hash.php';
include '../../../functions/crud.php';


$id_alternatif = isset($_GET['id_alternatif']) ? htmlspecialchars(decryptID($_GET['id_alternatif'])) : ''; 

try {
    $resultDelete = deleteData('tb_alternatif', "id_alternatif = $id_alternatif");

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
    exit;
}

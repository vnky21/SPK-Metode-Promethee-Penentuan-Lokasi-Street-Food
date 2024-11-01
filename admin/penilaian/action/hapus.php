<?php
session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] !== true){
    header('Location: http://app-electre.test/');
    die;
}
include '../../../functions/hash.php';
include '../../../functions/crud.php';


$id_alternatif = isset($_GET['id_alternatif']) ? htmlspecialchars(decryptID($_GET['id_alternatif'])) : ''; 

$resultDelete = deleteData('tb_penilaian', "id_alternatif = $id_alternatif");
$resultDelete = deleteData('tb_hasil', "id_alternatif = $id_alternatif");

if($resultDelete){

    $_SESSION['alert'] = "success";
    $_SESSION['message'] = "di Hapus";
    header('Location: '. '../index.php');

} else {
    echo "Gagal menambahkan data.";
}

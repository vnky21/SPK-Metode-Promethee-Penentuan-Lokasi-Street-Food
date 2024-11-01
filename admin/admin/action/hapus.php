<?php
session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] !== true){
    header('Location: http://app-electre.test/');
    die;
}
include '../../../functions/hash.php';
include '../../../functions/crud.php';


$id_admin = isset($_GET['id_admin']) ? htmlspecialchars(decryptID($_GET['id_admin'])) : ''; 

$resultDelete = deleteData('tb_admin', "id_admin = $id_admin");

if($resultDelete){

    $_SESSION['alert'] = "success";
    $_SESSION['message'] = "di Hapus";
    header('Location: '. '../index.php');

} else {
    echo "Gagal menambahkan data.";
}

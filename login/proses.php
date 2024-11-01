<?php
include '../functions/crud.php';

session_start();

$username = isset($_POST['username']) ? htmlspecialchars($_POST['username'])  : ''; 
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password'])  : ''; 

$result = selectData('tb_admin', '*', "username = '$username'");

if($result->num_rows > 0){

    $row = $result->fetch_assoc();


    if(password_verify($password, $row['password'])){

        $_SESSION['login'] = true;
        $_SESSION['username'] = $row['username'];
        $_SESSION['alert'] = "success";
        header('Location: '. '../admin/dashboard');

    }else{

        $_SESSION['alert'] = "error";
        $_SESSION['message'] = 'Password yang anda masukkan salah';
        header('Location: '. '../index.php');
    }
}else{

    $_SESSION['alert'] = "error";
    $_SESSION['message'] = 'Akun yang anda masukkan salah';
    header('Location: '. '../index.php');

}

?>
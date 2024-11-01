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
$id_admin = isset($_POST['id_admin']) ? htmlspecialchars(decryptID($_POST['id_admin'])) : ''; 
$username = isset($_POST['username']) ? htmlspecialchars($_POST['username'])  : ''; 
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password'])  : ''; 
$password2 = isset($_POST['password2']) ? htmlspecialchars($_POST['password2'])  : ''; 

if ($action == 'tambah') {
    
    if($password !== $password2){

        $_SESSION['alert'] = "error";
        $_SESSION['message'] = 'Confirm Password tidak sama';
        header('Location: '. '../form.php?action=tambah');

    }else{

        if(strlen($password) < 8){

            $_SESSION['alert'] = "error";
            $_SESSION['message'] = 'Password minimal 8 karakter';
            header('Location: '. '../form.php?action=tambah');
    
        }else{

            $result = selectData('tb_admin','*',"username = '$username'");

            if($result->num_rows > 0){

                $_SESSION['alert'] = "error";
                $_SESSION['message'] = 'Username sudah terdaftar';
                header('Location: '. '../form.php?action=tambah');

            }else{

                
                // Proses tambah data
                $dataInsert = array(
                    'username' => $username,
                    'password' => password_hash($password, PASSWORD_DEFAULT) 
                );

                $resultInsert = insertData("tb_admin", $dataInsert);

                if ($resultInsert) {

                    $_SESSION['alert'] = "success";
                    $_SESSION['message'] = "di Tambahkan";
                    header('Location: '. '../index.php');

                } else {
                    echo "Gagal menambahkan data.";
                }

            }

        }
        
    }
    
} elseif ($action == 'edit' && $id_admin) {
    
    if($password){
        if(strlen($password) < 8){

            $_SESSION['alert'] = "error";
            $_SESSION['message'] = 'Password minimal 8 karakter';
            header('Location: '. '../form.php?action=edit&id='.encryptID($id_admin));
        }else{
            
            if($password !== $password2){

                $_SESSION['alert'] = "error";
                $_SESSION['message'] = 'Confirm Password tidak sama';
                header('Location: '. '../form.php?action=edit&id='.encryptID($id_admin));
        
            }else{

                $dataUpdate = [
                    'password' => password_hash($password,PASSWORD_DEFAULT)
                ];

                $resultUpdate = updateData("tb_admin", $dataUpdate, "id_admin = $id_admin");
                if ($resultUpdate) {
    
                    $_SESSION['alert'] = "success";
                    $_SESSION['message'] = "di Ubah";
                    header('Location: '. '../index.php');
            
                } else {
                    echo "Gagal memperbarui data.";
                }
            }
        }

    }else{
        $dataUpdate = array(
            'username' => $username,
        );
    
        $resultUpdate = updateData("tb_admin", $dataUpdate, "id_admin = $id_admin");
    
        if ($resultUpdate) {
    
            $_SESSION['alert'] = "success";
            $_SESSION['message'] = "di Ubah";
            header('Location: '. '../index.php');
    
        } else {
            echo "Gagal memperbarui data.";
        }
    }


}
?>

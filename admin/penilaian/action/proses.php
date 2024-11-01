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

$result = resultQuery("SELECT COUNT(*) FROM tb_kriteria");
$data = $result->fetch_row();
$jml_kriteria = $data[0];

if ($action == 'tambah') {

    $values = [];
    for($i=1; $i<=$jml_kriteria; $i++){

        $form = "form_".$i;
        $data = isset($_POST[$form]) ? htmlspecialchars(decryptID($_POST[$form])) : '';

        $values[] = "('$id_alternatif','$data')";
    }

    $values_string = implode(',',$values);

    $sql = "INSERT INTO tb_penilaian (id_alternatif,id_subkriteria) VALUES $values_string";

    $result = connectDB()->query($sql);
    closeDB(connectDB());

    if ($result) {

        $_SESSION['alert'] = "success";
        $_SESSION['message'] = "di Tambahkan";
        header('Location: '. '../index.php');

    } else {
        echo "Gagal menambahkan data.";
    }

} elseif ($action == 'edit' && $id_alternatif) {
    
    $values = [];
    for($i=1; $i<=$jml_kriteria; $i++){
        $form = "form_".$i;
        $id = "id_".$i;
        $id_penilaian = htmlspecialchars(decryptID($_POST[$id]));
        $id_subkriteria = htmlspecialchars(decryptID($_POST[$form]));
    
        // Cek apakah id_penilaian sudah ada
        $checkSql = "SELECT COUNT(*) as count FROM tb_penilaian WHERE id_penilaian = '$id_penilaian'";
        $checkResult = connectDB()->query($checkSql);
        $row = $checkResult->fetch_assoc();
    
        if($row['count'] > 0) {
            // Jika id_penilaian ada, lakukan UPDATE
            $sql = "UPDATE tb_penilaian SET id_subkriteria = '$id_subkriteria' WHERE id_penilaian = '$id_penilaian'";
        } else {
 
            $sql = "INSERT INTO tb_penilaian (id_alternatif, id_subkriteria) VALUES ('$id_alternatif', '$id_subkriteria')";
        }
        
        $result = connectDB()->query($sql);
    }

    closeDB(connectDB());

    if ($result) {

        $_SESSION['alert'] = "success";
        $_SESSION['message'] = "di Update";
        header('Location: '. '../index.php');

    } else {
        echo "Gagal menambahkan data.";
    }
} else {
    // Aksi tidak dikenali
    echo "Aksi tidak dikenali.";
}

?>

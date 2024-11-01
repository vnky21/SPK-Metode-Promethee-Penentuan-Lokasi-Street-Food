<?php
function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "app_promethee";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $database);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    return $conn;
}


function closeDB($conn) {
    // Menutup koneksi
    $conn->close();
}

function selectData($table, $columns = "*", $condition = "") {
    $conn = connectDB();

    if (is_array($columns)) {
        // Jika $columns adalah array, ubah menjadi string kolom yang dipilih
        $columns = implode(", ", $columns);
    }

    $sql = "SELECT $columns FROM $table";
    if (!empty($condition)) {
        $sql .= " WHERE $condition";
    }

    $result = $conn->query($sql);

    closeDB($conn);

    return $result;
}


function insertData($table, $data) {
    $conn = connectDB();

    $columns = implode(", ", array_keys($data));
    $values = "'" . implode("', '", array_values($data)) . "'";

    $sql = "INSERT INTO $table ($columns) VALUES ($values)";

    $result = $conn->query($sql);

    closeDB($conn);

    return $result;
}

function updateData($table, $data, $condition) {
    $conn = connectDB();

    $updates = [];
    foreach ($data as $key => $value) {
        $updates[] = "$key = '$value'";
    }

    $updatesStr = implode(", ", $updates);

    $sql = "UPDATE $table SET $updatesStr WHERE $condition";

    $result = $conn->query($sql);

    closeDB($conn);

    return $result;
}

function deleteData($table, $condition) {
    $conn = connectDB();

    $sql = "DELETE FROM $table WHERE $condition";

    $result = $conn->query($sql);

    closeDB($conn);

    return $result;
}   

function resultQuery($sql) {
    $conn = connectDB();

    $result = $conn->query($sql);

    closeDB($conn);

    return $result;
}   

function inputHasilPenilaian($array1,$array2){

    foreach ($array1 as $item1) {
        $kode = $item1['kode'];

        foreach ($array2 as $item2) {
            if ($item2['kode'] === $kode) {

                $jumlah = $item2['netFlow'];
                $arrayNew = [
                    'id_alternatif' => $item1['id_alternatif'],
                    'skor_total' => $jumlah
                ];
                break;
            }
        }
        $combinedArray[] = $arrayNew;
    }

    foreach($combinedArray as $value){

        $dataQuery = [
            'id_alternatif' => $value['id_alternatif'],
            'skor_total' => $value['skor_total']
        ];

        $id_alternatif = $value['id_alternatif'];

        $resultCheck = selectData("tb_hasil", "*", "id_alternatif = '$id_alternatif'");
        if($resultCheck->num_rows > 0){

            $resultUpdate = updateData("tb_hasil", $dataQuery, "id_alternatif = $id_alternatif");
        }else{

            $resultInsert = insertData("tb_hasil", $dataQuery);
        }
    }

}

?>

<?php
session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] !== true){
    header('Location: http://app-electre.test/');
    die;
}

function inputHasil($array1,$array2){

    foreach ($array1 as $item1) {
        $kode = $item1['kode'];

        foreach ($array2 as $item2) {
            if ($item2['kode'] === $kode) {

                $jumlah = $item2['jumlah'];
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

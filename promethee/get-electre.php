<?php
$result = selectData("tb_kriteria", "*");
$dataKriteria = [];
if ($result->num_rows > 0) {
    $i = 1;
    while ($row = $result->fetch_object()) {
        $dataKriteria[] = [
            'kode' => "C".$i,
            'nama_kriteria' => $row->nama_kriteria,
        ];
        $i++;
    }
}

$jumlahKriteria = count($dataKriteria);
$resultAlternatif = resultQuery("SELECT tb_alternatif.id_alternatif, tb_alternatif.nama_alternatif, GROUP_CONCAT(tb_sub_kriteria.bobot_subkriteria) AS bobot_subkriteria
                                    FROM tb_penilaian
                                    LEFT JOIN tb_sub_kriteria ON tb_penilaian.id_subkriteria = tb_sub_kriteria.id_subkriteria
                                    LEFT JOIN tb_kriteria ON tb_sub_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                    LEFT JOIN tb_alternatif ON tb_penilaian.id_alternatif = tb_alternatif.id_alternatif
                                    GROUP BY tb_alternatif.id_alternatif, tb_alternatif.nama_alternatif");
$dataAlternatif = [];
if ($resultAlternatif->num_rows > 0) {
    $i = 1;
    while ($row = $resultAlternatif->fetch_object()) {
        $bobotSubkriteria = explode(',',$row->bobot_subkriteria);
        $dataAlternatif[] = [
            'id_alternatif' => $row->id_alternatif,
            'kode' => "A". $i,
            'nama' => $row->nama_alternatif,
            'bobot_subkriteria' => array_map('floatval', $bobotSubkriteria),
        ];
        $i++;
    }
}


if(count($dataAlternatif) > 1){

    $result = promethee($dataAlternatif, $dataKriteria);

    if($menu == 'Penilaian'){
        inputHasilPenilaian($dataAlternatif,$result['netFlow']);
    }

}


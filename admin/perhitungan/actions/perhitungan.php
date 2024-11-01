<?php
session_start();
if(!isset($_SESSION['login']) && $_SESSION['login'] !== true){
    header('Location: http://app-electre.test/');
    die;
}

$result = selectData("tb_kriteria", "*");
$dataKriteria = [];
if ($result->num_rows > 0) {
    // Menyimpan data dari setiap baris ke dalam array asosiatif
    $i = 1;
    while ($row = $result->fetch_object()) {
        $dataKriteria[] = [
            'kode' => "C".$i,
            'nama_kriteria' => $row->nama_kriteria,
            'bobot_kriteria' => $row->bobot_kriteria
        ];
        $i++;
    }
}

$resultAlternatif = resultQuery("SELECT tb_alternatif.id_alternatif, tb_alternatif.nama_alternatif, GROUP_CONCAT(tb_sub_kriteria.bobot_subkriteria) AS bobot_subkriteria
                                    FROM tb_penilaian
                                    LEFT JOIN tb_sub_kriteria ON tb_penilaian.id_subkriteria = tb_sub_kriteria.id_subkriteria
                                    LEFT JOIN tb_kriteria ON tb_sub_kriteria.id_kriteria = tb_kriteria.id_kriteria
                                    LEFT JOIN tb_alternatif ON tb_penilaian.id_alternatif = tb_alternatif.id_alternatif
                                    GROUP BY tb_alternatif.id_alternatif, tb_alternatif.nama_alternatif");
$dataAlternatif = [];
if ($resultAlternatif->num_rows > 0) {
    // Menyimpan data dari setiap baris ke dalam array asosiatif
    $i = 1;
    while ($row = $resultAlternatif->fetch_object()) {
        $bobotSubkriteria = explode(',',$row->bobot_subkriteria);
        $dataAlternatif[] = [
            'id_alternatif' => $row->id_alternatif,
            'kode' => "A".$i,
            'nama_alternatif' => $row->nama_alternatif,
            'bobot_subkriteria' => array_map('floatval', $bobotSubkriteria),
        ];
        $i++;
    }
}

$matrix_normalisasi = normalisasiMatrix($dataAlternatif);
$matrix_bobot_normalisasi = hitungBobotMatriks($matrix_normalisasi,$dataKriteria);
$matrix_concordance = hitungConcordanceMatrix($matrix_bobot_normalisasi,$dataKriteria);
$matrix_concordance = hitungConcordanceMatrix($matrix_bobot_normalisasi,$dataKriteria);
$matrix_discordance = hitungDiscordanceMatrix($matrix_bobot_normalisasi);
$threshold_concord = hitungThresholdConcord($matrix_concordance);
$matrix_bobot_concordance = buatMatriksDominanConcordance($matrix_concordance,$threshold_concord);
$threshold_discord = hitungThresholdDescord($matrix_discordance);
$matrix_bobot_discordance = buatMatriksDominanDiscordance($matrix_discordance,$threshold_discord);
$matrix_agregate = generateDominanceMatrix($matrix_bobot_concordance,$matrix_bobot_discordance);

inputHasil($dataAlternatif,$matrix_agregate);

$resultData= resultQuery("SELECT tb_alternatif.nama_alternatif,tb_hasil.skor_total FROM tb_hasil
                         LEFT JOIN tb_alternatif ON tb_hasil.id_alternatif = tb_alternatif.id_alternatif");
$dataHasil = [];
if ($resultData->num_rows > 0) {
    while ($row = $resultData->fetch_object()) {
        $dataHasil[] = $row;
    }
}
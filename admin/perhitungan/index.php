<?php 
$menu = "Perhitungan";

include '../../includes/header.php'; 
include '../../includes/sidebar.php'; 
include '../../functions/crud.php';
include '../../functions/hash.php';
include '../../promethee/functions.php';
include '../../promethee/get-electre.php';

$resultData = resultQuery("SELECT tb_alternatif.nama_alternatif,alamat,maps,kontak, tb_hasil.skor_total FROM tb_hasil
                         LEFT JOIN tb_alternatif ON tb_hasil.id_alternatif = tb_alternatif.id_alternatif ORDER BY skor_total DESC");
$dataHasil = [];

$dataTertinggi = null;
if ($resultData->num_rows > 0) {
    while ($row = $resultData->fetch_object()) {
        $dataHasil[] = $row;
    }

    foreach ($dataHasil as $row) {
        if ($dataTertinggi === null || $row->skor_total > $dataTertinggi->skor_total) {
            $dataTertinggi = $row;
        }
    }
}
?>

<div class="app-content pt-3 p-md-3 p-lg-4" style="display : block !important;">


    <div class="container-xl">
        <h1 class="app-page-title mt-3 mb-1">Data Hasil Perhitungan</h1>
        <p class="mb-3">Berikut ini merupakan hasil perhitungan menggunakan metode promethee yang menghasilkan peringkat
            rekomendasi lokasi street food.</p>


        <?php if(count($dataHasil) < 2) : ?>
        <div class="app-card app-card-chart mb-4 h-100 shadow-sm">
            <div class="app-card app-card-chart mb-4 h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Hasil Perhitungan</h4>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <div class="app-card-body p-3 mb-3">
                    <div class="table-responsive">
                        <p class="text-center">Belum dapat menampilkan hasil perhitungan</p>
                    </div>

                </div>
            </div>
        </div>
        <?php die; endif; ?>


        <!--app-card-->
        <div class="app-card app-card-chart mb-4 h-100 shadow-sm">
            <div class="app-card app-card-chart mb-4 h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Hasil Perhitungan</h4>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <div class="app-card-body p-3 mb-3">
                    <div class="table-responsive">
                        <!-- <table class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="cell">No.</th>
                                    <th class="cell">Nama Alternatif</th>
                                    <th class="cell">Net Flow</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center !important;">

                                <?php
                                $i = 1;
                                foreach($dataHasil as $value) : ?>
                                <tr>
                                    <td class="cell"><?= $i++; ?>.</td>
                                    <td class="cell"><?= $value->nama_alternatif ?></td>
                                    <td class="cell"><?= round($value->skor_total,3) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table> -->

                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="cell">Peringkat</th>
                                    <th class="cell">Nama Alternatif</th>
                                    <th class="cell">Net Flow</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center !important;">
                                <?php
                            $i = 1;
                            foreach ($dataHasil as $value) : ?>
                                <tr>
                                    <td class="cell">
                                        <button class="btn btn-link toggle-description"
                                            onclick="toggleDescription(this)">+</button>
                                        <?= $i++; ?>.
                                    </td>
                                    <td class="cell" style="text-align: left;">
                                        <?= $value->nama_alternatif ?>
                                        <div class="description">
                                            <p class="desc">Deskripsi Alternatif :</p>
                                            <p><i style="margin-right: 10px !important;"
                                                    class="fa-solid fa-location-dot"></i>
                                                <?= (!empty($value->alamat)) ? $value->alamat : 'belum diinput' ?></p>
                                            <p><i style="margin-right: 10px !important;" class="fa-solid fa-phone"></i>
                                                <?= (!empty($value->kontak)) ? $value->kontak : 'belum diinput' ?></p>
                                            <p><i style="margin-right: 10px !important;"
                                                    class="fa-solid fa-map"></i>Google Maps</p>
                                            <?= (!empty($value->maps)) ? $value->maps : '-' ?>

                                        </div>
                                    </td>
                                    <td class="cell"><?= round($value->skor_total, 3) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <p class="mt-3">
                            Berdasarkan hasil perhitungan menggunakan Metode Promethee, maka didapatkan alternatif
                            terbaik adalah
                            <b>
                                <?php 
                            if ($resultData->num_rows > 0) {
                                while ($row = $resultData->fetch_object()) {
                                    $dataHasil[] = $row;
                                }

                                $dataTertinggi = null;
                                foreach ($dataHasil as $row) {
                                    if ($dataTertinggi === null || $row->skor_total > $dataTertinggi->skor_total) {
                                        $dataTertinggi = $row;
                                    }
                                }

                                echo $dataTertinggi->nama_alternatif .", dengan Net Flow = ". $dataTertinggi->skor_total;
                            }
                            ?>
                            </b>
                        </p>
                    </div>

                    <!-- Button to show detail calculation -->

                    <!--//table-responsive-->
                </div>
            </div>
        </div>

        <button id="buttonHide" onclick="toggleDiv()" class="d-block mx-auto  btn app-btn-success mt-3 mb-2">Lihat
            Detail Perhitungan</button>



        <div id="hiddenDiv" style="display: none;">
            <!--app-card-->
            <div class="app-card app-card-chart mb-4 h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Matriks X (Data Nilai)</h4>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-card-header-->
                <div class="app-card-body p-3 p-lg-4">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 text-left" style="text-align: center !important;">
                            <thead>
                                <tr>
                                    <th class="cell">Nama</th>
                                    <th class="cell">Kode</th>
                                    <?php foreach($dataKriteria as $value) : ?>
                                    <th class="cell"><?= $value['nama_kriteria']."(".$value['kode'].")"; ?></th>
                                    <?php endforeach; ?>
                            </thead>
                            <tbody>

                                <?php foreach($dataAlternatif as $value) : ?>
                                <tr>
                                    <td class="cell"><?= $value['nama']; ?></td>
                                    <td class="cell"><?= $value['kode']; ?></td>
                                    <?php foreach($value['bobot_subkriteria'] as $valueBobot) : ?>
                                    <td class="cell"><?= $valueBobot; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    <!--//table-responsive-->
                </div>
                <!--//app-card-body-->
            </div>
            <!--//app-card-->

            <!--app-card-->
            <div class="app-card app-card-chart mb-4 h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Difference Matrix</h4>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-card-header-->
                <div class="app-card-body p-3 p-lg-4">
                    <div class="table-responsive">

                        <table class="table table-bordered mb-0 text-left" style="text-align: center !important;">
                            <thead>
                                <tr>
                                    <th class="cell"></th>
                                    <?php foreach($result['matriksSelisih'] as $value) : ?>
                                    <th class="cell"><?= $value['kode']; ?></th>
                                    <?php endforeach; ?>
                            </thead>
                            <tbody>
                                <?php foreach($result['matriksSelisih'] as $matriksSelisih) : ?>
                                <tr>
                                    <td class="cell"><?= $matriksSelisih['kode']; ?></td>

                                    <?php foreach($matriksSelisih['matrix'] as $value) : ?>

                                    <td class="cell"><?= $value; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!--//table-responsive-->
                </div>
                <!--//app-card-body-->
            </div>
            <!--//app-card-->

            <!--app-card-->
            <div class="app-card app-card-chart mb-4 h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Nilai Index Preference</h4>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-card-header-->
                <div class="app-card-body p-3 p-lg-4">
                    <div class="table-responsive">

                        <table class="table table-bordered mb-0 text-left" style="text-align: center !important;">
                            <thead>
                                <tr>
                                    <th class="cell"></th>
                                    <?php foreach($result['indeksPreferensi'] as $value) : ?>
                                    <th class="cell"><?= $value['kode']; ?></th>
                                    <?php endforeach; ?>
                            </thead>
                            <tbody>
                                <?php foreach($result['indeksPreferensi'] as $indeksPreferensi) : ?>
                                <tr>
                                    <td class="cell"><?= $indeksPreferensi['kode']; ?></td>
                                    <?php foreach($indeksPreferensi['matrix'] as $value) : ?>
                                    <td class="cell"><?= $value; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!--//table-responsive-->
                </div>
                <!--//app-card-body-->
            </div>
            <!--//app-card-->

            <!--app-card-->
            <div class="app-card app-card-chart mb-4 h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Nilai Preference Matrix</h4>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-card-header-->
                <div class="app-card-body p-3 p-lg-4">
                    <div class="table-responsive">

                        <table class="table table-bordered mb-0 text-left" style="text-align: center !important;">
                            <thead>

                                <tr>
                                    <th class="cell"></th>
                                    <?php foreach($result['matriksPreferensi'] as $value) : ?>
                                    <th class="cell"><?= $value['kode']; ?></th>
                                    <?php endforeach; ?>

                                </tr>

                            </thead>
                            <tbody>
                                <?php foreach($result['matriksPreferensi'] as $matriksPreferensi) : ?>
                                <tr>
                                    <th class="cell"><?= $matriksPreferensi['kode']; ?></th>
                                    <?php foreach($matriksPreferensi['value'] as $value) : ?>
                                    <td class="cell"><?= round($value, 3); ?></td>
                                    <?php endforeach ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!--//table-responsive-->
                </div>
                <!--//app-card-body-->
            </div>
            <!--//app-card-->

            <!--app-card-->
            <div class="app-card app-card-chart mb-4 h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Hasil Leaving Flow dan Entering Flow</h4>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-card-header-->
                <div class="app-card-body p-3 p-lg-4">
                    <div class="table-responsive">

                        <table class="table table-bordered mb-0 text-left" style="text-align: center !important;">
                            <thead>

                                <tr>
                                    <th class="cell">Nama Alternatif</th>
                                    <th class="cell">Kode Alterantif</th>
                                    <th class="cell">Leaving Flow</th>
                                    <th class="cell">Entering Flow</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php foreach($result['flow'] as $value) : ?>
                                <tr>
                                    <td class="cell"><?= $value['nama']; ?></td>
                                    <td class="cell"><?= $value['kode']; ?></td>
                                    <td class="cell"><?= $value['leavingFlow']; ?></td>
                                    <td class="cell"><?= $value['enteringFlow']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!--//table-responsive-->
                </div>
                <!--//app-card-body-->
            </div>
            <!--//app-card-->

            <!--app-card-->
            <div class="app-card app-card-chart mb-4 h-100 shadow-sm">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Hasil Net Flow</h4>
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-card-header-->
                <div class="app-card-body p-3 p-lg-4">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 text-left" style="text-align: center !important;">
                            <thead>

                                <tr>
                                    <th class="cell">Nama Alternatif</th>
                                    <th class="cell">Kode Alterantif</th>
                                    <th class="cell">Net Flow</th>
                                    <th class="cell">Peringkat</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php foreach($result['netFlow'] as $value) : ?>
                                <tr>
                                    <td style="width: 405px" class="cell"><?= $value['nama']; ?></th>
                                    <td style="width: 205px" class="cell"><?= $value['kode']; ?></th>
                                    <td class="cell"><?= $value['netFlow']; ?></th>
                                    <td class="cell"><?= $value['peringkat']; ?></th>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!--//table-responsive-->
                </div>
                <!--//app-card-body-->
            </div>
            <!--//app-card-->


        </div>


    </div>
    <!--//container-fluid-->
</div>
<!--//app-content-->

<?php 
include '../../includes/footer.php';   
?>
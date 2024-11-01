<?php
session_start();

include 'functions/crud.php';

$resultData = resultQuery("SELECT tb_alternatif.nama_alternatif,alamat,maps,kontak, tb_hasil.skor_total FROM tb_hasil
                         LEFT JOIN tb_alternatif ON tb_hasil.id_alternatif = tb_alternatif.id_alternatif ORDER BY skor_total DESC");
$dataHasil = [];

if ($resultData->num_rows > 0) {
    while ($row = $resultData->fetch_object()) {
        $dataHasil[] = $row;
    }

    // Inisialisasi nilai tertinggi
    $highestScore = null;

    // Iterasi pada array hasil query
    foreach ($dataHasil as $row) {
        // Jika nilai tertinggi belum diatur atau nilai saat ini sama dengan nilai tertinggi
        if ($highestScore === null || $row->skor_total == $highestScore) {
            // Tambahkan data ke array
            $dataTertinggi[] = $row;
            // Perbarui nilai tertinggi
            $highestScore = $row->skor_total;
        } elseif ($row->skor_total > $highestScore) {
            // Jika nilai saat ini lebih tinggi dari nilai tertinggi
            // Bersihkan array dan tambahkan data baru
            $dataTertinggi = [$row];
            // Perbarui nilai tertinggi
            $highestScore = $row->skor_total;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>SISTEM PENDUKUNG KEPUTUSAN</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

    <style>
        /* Pastikan latar belakang dan gambar mencakup seluruh layar */
        .auth-background-col {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            min-height: 100vh; /* Mengatur tinggi agar mencakup seluruh layar */
        }

        .auth-background-holder {
            height: 100%;
        }

        .auth-main-col {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #ffffff;
        }

        .app-auth-wrapper {
            display: flex;
            flex-wrap: wrap;
            height: 100vh;
        }

        .app-card {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
        }

        .table {
            margin-bottom: 0; /* Menghilangkan margin bawah dari tabel */
        }

        .overlay-content {
            background-color: rgba(0, 0, 0, 0.5); /* Tambahkan overlay transparan */
            color: #ffffff; /* Warna teks putih untuk overlay */
        }
    </style>

</head>

<body class="app app-login p-0">
    <div class="app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-12 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-center">
                <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] == 'error') : ?>
                <div id='alert-error' data-message="<?= $_SESSION['message'] ?>"></div>
                <?php
                $_SESSION['alert'] = null;
                endif; ?>
                <div class="app-auth-branding mb-1 mt-2">
                    <a class="app-logo" href="./index.php"><img class="logo-icon me-2" src="assets/images/logo-blue.png" alt="logo"></a>
                </div>
                <div class="app-card app-card-chart mt-3 mb-4 h-100 shadow-sm">
                    <div class="app-card-header p-3">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <h4 class="app-card-title">Hasil Perhitungan</h4>
                            </div>
                        </div>
                    </div>
                    <div class="app-card-body p-3 mb-3">
                        <div class="table-responsive">
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

                            <p class="mt-3" style="text-align : left;">
                                Berdasarkan hasil perhitungan menggunakan Metode Promethee, maka didapatkan alternatif terbaik adalah
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
                        <div class="auth-option text-center pt-5">Ingin kembali ke halaman sebelumnya? Klik <a class="text-link" href="index.php">disini</a>.</div>
                    </div>
                </div>
                <footer class="app-auth-footer">
                    <div class="text-center">
                        <small class="copyright">Copyright &copy; <?= date('Y'); ?> SPK Pemilihan Lokasi Street Food Menggunakan Metode Promethee | Imelda Lukas</small>
                    </div>
                </footer>
            </div>
        </div>

        <div class="col-12 col-md-5 col-lg-0 ">

    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Javascript -->
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Charts JS -->
    <script src="assets/plugins/chart.js/chart.min.js"></script>
    <script src="assets/js/index-charts.js"></script>

    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script>
    <script src="assets/js/alert.js"></script>

</body>

</html>

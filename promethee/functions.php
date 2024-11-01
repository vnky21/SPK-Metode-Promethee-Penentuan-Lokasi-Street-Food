<?php

function hitungMatriksSelisih($alternatif, $kriteria) {
    $jumlahAlternatif = count($alternatif);
    $jumlahKriteria = count($kriteria);

    $matriksSelisih = array();
    for ($i = 0; $i < $jumlahAlternatif; $i++) {
        $hasilSelisih = [];
        for ($k = 0; $k < $jumlahAlternatif; $k++) {
            $hasilSementara = array();
            if ($i != $k) {
                for ($j = 0; $j < $jumlahKriteria; $j++) {
                    // Mengambil nilai bobot dari masing-masing alternatif, atau 0 jika tidak ada
                    $bobot_i = isset($alternatif[$i]['bobot_subkriteria'][$j]) ? $alternatif[$i]['bobot_subkriteria'][$j] : 0;
                    $bobot_k = isset($alternatif[$k]['bobot_subkriteria'][$j]) ? $alternatif[$k]['bobot_subkriteria'][$j] : 0;
                    // Menghitung selisih bobot
                    $hasilSementara[$j] = $bobot_i - $bobot_k;
                }
            } else {
                // Jika $i == $k, set hasil selisih ke 0
                for ($j = 0; $j < $jumlahKriteria; $j++) {
                    $hasilSementara[$j] = 0;
                }
            }
            // Menyimpan hasil sementara untuk setiap alternatif k
            $hasilSelisih[] = implode(', ', $hasilSementara);
        }
        // Menyimpan hasil selisih untuk setiap alternatif i
        $matriksSelisih[] = [
            'kode' => $alternatif[$i]['kode'],
            'nama' => $alternatif[$i]['nama'],
            'matrix' => $hasilSelisih
        ];
    }
    return $matriksSelisih;
}


function hitungIndeksPreferensi($matriksSelisih) {
    $jumlahAlternatif = count($matriksSelisih);

    $indeksPreferensi = array();
    for ($i = 0; $i < $jumlahAlternatif; $i++) {
        $hasilSementara = [];
        $hasil = [];
        $matrix = [];
        for ($k = 0; $k < $jumlahAlternatif; $k++) {
            $hasilSementara[$i][$k] = array();
            $matrix[] = explode(', ', $matriksSelisih[$i]['matrix'][$k]);
            
            if ($i != $k) {
                foreach ($matrix[$k] as $selisih) {
                    $hasilSementara[$i][$k][] = $selisih > 0 ? 1 : 0;
                }
            } else {
                foreach ($matrix[$k] as $selisih) {
                    $hasilSementara[$i][$k][] = 0;
                }
            }
            $hasil[] = implode(', ', $hasilSementara[$i][$k]);
        }
    
        $indeksPreferensi[] = [
            'kode' => $matriksSelisih[$i]['kode'],
            'nama' => $matriksSelisih[$i]['nama'],
            'matrix' => $hasil
        ];
    }
    return $indeksPreferensi;
}

function hitungMatriksPreferensi($indeksPreferensi) {

    $jumlahAlternatif = count($indeksPreferensi);

    $matriksPreferensi = [];
    for ($i = 0; $i < $jumlahAlternatif; $i++) {
        $hasilSementara = [];
        $hasil = [];
        $matrix = [];
        for ($k = 0; $k < $jumlahAlternatif; $k++) {
            $matrix[] = explode(', ', $indeksPreferensi[$i]['matrix'][$k]);
            $jumlahKriteria = count($matrix[$k]);
            if ($i != $k) {
                $hasilSementara[$i][$k] = array_sum($matrix[$k]) / $jumlahKriteria;
            } else {
                $hasilSementara[$i][$k] = 0;
            }

            $hasil[] =  $hasilSementara[$i][$k];
        
        }
        $matriksPreferensi[] = [
            'kode' => $indeksPreferensi[$i]['kode'],
            'nama' => $indeksPreferensi[$i]['nama'],
            'value' => $hasil
        ];

    }
    return $matriksPreferensi;
}

function hitungFlow($matriksPreferensi) {
    $jumlahAlternatif = count($matriksPreferensi);

    $leavingFlow = array_fill(0, $jumlahAlternatif, 0);
    $enteringFlow = array_fill(0, $jumlahAlternatif, 0);
    $hasilFlow = [];
    for ($i = 0; $i < $jumlahAlternatif; $i++) {
        for ($k = 0; $k < $jumlahAlternatif; $k++) {
            $leavingFlow[$i] += round($matriksPreferensi[$i]['value'][$k],2);
            $enteringFlow[$i] += round($matriksPreferensi[$k]['value'][$i],2);
        }

        $leavingFlow[$i] /= ($jumlahAlternatif - 1);
        $enteringFlow[$i] /= ($jumlahAlternatif - 1);

        $hasilFlow[] = [
            'kode' => $matriksPreferensi[$i]['kode'],
            'nama' => $matriksPreferensi[$i]['nama'],
            'leavingFlow' => $leavingFlow[$i],
            'enteringFlow' => $enteringFlow[$i]
        ];

    }
    return $hasilFlow;
}

function hitungNetFlow($hasilFlow) {
    $jumlahAlternatif = count($hasilFlow);
    $netFlow = [];

    for ($i = 0; $i < $jumlahAlternatif; $i++) {
        $netFlowSementara = $hasilFlow[$i]['leavingFlow'] - $hasilFlow[$i]['enteringFlow'];

        $netFlow[] = [
            'kode' => $hasilFlow[$i]['kode'],
            'nama' => $hasilFlow[$i]['nama'],
            'netFlow' => $netFlowSementara
        ];
    }

    $sortedNetFlow = $netFlow;

    usort($sortedNetFlow, function($a, $b) {
        return $b['netFlow'] <=> $a['netFlow'];
    });

    foreach ($netFlow as &$item) {
        foreach ($sortedNetFlow as $index => $sortedItem) {
            if ($item['kode'] == $sortedItem['kode']) {
                $item['peringkat'] = $index + 1;
                break;
            }
        }
    }

    return $netFlow;
}


function promethee($alternatif, $kriteria) {
    $matriksSelisih = hitungMatriksSelisih($alternatif, $kriteria);
    $indeksPreferensi = hitungIndeksPreferensi($matriksSelisih);
    $matriksPreferensi = hitungMatriksPreferensi($indeksPreferensi);
    $flow = hitungFlow($matriksPreferensi);
    $netFlow = hitungNetFlow($flow);

    return [
        'matriksSelisih' => $matriksSelisih,
        'indeksPreferensi' => $indeksPreferensi,
        'matriksPreferensi' => $matriksPreferensi,
        'flow' => $flow,
        'netFlow' => $netFlow
    ];
}
?>

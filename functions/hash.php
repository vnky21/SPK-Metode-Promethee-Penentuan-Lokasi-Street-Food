<?php

// Fungsi untuk mengenkripsi ID
function encryptID($id) {
    // Ganti dengan kunci enkripsi yang aman
    $key = 'fdgsgsgs';

    // Enkripsi ID menggunakan base64_encode dan XOR
    $encryptedID = base64_encode($id ^ $key);

    return $encryptedID;
}

// Fungsi untuk mendekripsi ID
function decryptID($encryptedID) {
    // Ganti dengan kunci enkripsi yang aman
    $key = 'fdgsgsgs';

    // Dekripsi ID menggunakan base64_decode dan XOR
    $decryptedID = base64_decode($encryptedID) ^ $key;

    return $decryptedID;
}
?>

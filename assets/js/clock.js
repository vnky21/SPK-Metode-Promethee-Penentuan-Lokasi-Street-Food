function updateClock() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();

    // Mengatur format jam (HH:mm:ss)
    var formattedTime = hours.toString().padStart(2, '0') + ':' +
                        minutes.toString().padStart(2, '0') + ':' +
                        seconds.toString().padStart(2, '0');

    // Menampilkan waktu pada elemen dengan id "clock"
    document.getElementById('clock').innerHTML = '<i class="fa-regular fa-clock"></i> ' + formattedTime + ' WITA';
}

// Memanggil fungsi updateClock setiap detik
setInterval(updateClock, 1000);

// Memanggil fungsi untuk memperbarui jam saat halaman dimuat
updateClock();
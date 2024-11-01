$('#alert-success').each(function () {

    var messageValue = $(this).data('message');

    // Panggil SweetAlert
    Swal.fire({
        title: 'Succeed!',
        text: 'Data Berhasil ' + messageValue+'!',
        icon: 'success',
        timer: 2000,
        timerProgressBar: true,
    });
});

$('#alert-error').each(function () {

    var messageValue = $(this).data('message');

    // Panggil SweetAlert
    Swal.fire({
        title: 'Gagal!',
        text: messageValue,
        icon: 'error',
        timer: 2000,
        timerProgressBar: true,
    });
});

$('#alert-info').each(function () {

    var messageValue = $(this).data('message');

    // Panggil SweetAlert
    Swal.fire({
        title: 'Selamat Datang!',
        text: 'Admin berhasil Log In',
        icon: 'info',
        timer: 2000,
        timerProgressBar: true,
    });
});


$('.btn-delete').on('click', function () {
    // Ambil nilai ID atau parameter lainnya dari atribut data
    var dataId = $(this).attr('id');

    // Tampilkan SweetAlert konfirmasi
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Anda yakin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
    }).then((result) => {
        // Jika pengguna mengklik "Ya"
        if (result.isConfirmed) {
            // Redirect ke halaman PHP setelah konfirmasi
            window.location.href = 'action/hapus.php?id_kriteria=' + dataId;
        }
    });
});

$('.btn-delete-subkriteria').on('click', function () {
    // Ambil nilai ID atau parameter lainnya dari atribut data
    var dataId = $(this).attr('id');
    var dataIdKriteria = $(this).attr('id-kriteria');
    
    // Tampilkan SweetAlert konfirmasi
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Anda yakin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
    }).then((result) => {
        // Jika pengguna mengklik "Ya"
        if (result.isConfirmed) {
            // Redirect ke halaman PHP setelah konfirmasi
            window.location.href = 'action/hapus.php?id=' + dataId + '&id_kriteria=' + dataIdKriteria;
        }
    });
});

$('.btn-delete-alternatif').on('click', function () {
    // Ambil nilai ID atau parameter lainnya dari atribut data
    var dataId = $(this).attr('id');
    
    // Tampilkan SweetAlert konfirmasi
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Anda yakin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
    }).then((result) => {
        // Jika pengguna mengklik "Ya"
        if (result.isConfirmed) {
            // Redirect ke halaman PHP setelah konfirmasi
            window.location.href = 'action/hapus.php?id_alternatif=' + dataId;
        }
    });
});

$('.btn-delete-penilaian').on('click', function () {
    // Ambil nilai ID atau parameter lainnya dari atribut data
    var dataId = $(this).attr('id');
    
    // Tampilkan SweetAlert konfirmasi
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Anda yakin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
    }).then((result) => {
        // Jika pengguna mengklik "Ya"
        if (result.isConfirmed) {
            // Redirect ke halaman PHP setelah konfirmasi
            window.location.href = 'action/hapus.php?id_alternatif=' + dataId;
        }
    });
});

$('.btn-delete-admin').on('click', function () {
    // Ambil nilai ID atau parameter lainnya dari atribut data
    var dataId = $(this).attr('id');
    
    // Tampilkan SweetAlert konfirmasi
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Anda yakin menghapus data penilaian ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
    }).then((result) => {
        // Jika pengguna mengklik "Ya"
        if (result.isConfirmed) {
            // Redirect ke halaman PHP setelah konfirmasi
            window.location.href = 'action/hapus.php?id_admin=' + dataId;
        }
    });
});

$('.alert-logout').on('click', function () {

    // Tampilkan SweetAlert konfirmasi
    Swal.fire({
        title: 'Konfirmasi Log Out',
        text: 'Anda yakin ingin log out?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'YES',
    }).then((result) => {
        // Jika pengguna mengklik "Ya"
        if (result.isConfirmed) {
            // Redirect ke halaman PHP setelah konfirmasi
            window.location.href = '../../login/logout.php';
        }
    });
});
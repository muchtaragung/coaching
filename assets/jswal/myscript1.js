const flashData = $('.flash-data').data('flashdata');


if (flashData) {
    Swal({
        title: 'Login Gagal',
           text: 'email atau password salah',
        type: 'warning'
    });
}

//TOMBOL HAPUS

$('.tombol-hapus').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal({
        title: 'Apakah anda yakin',
        text: "Data akan dihapus",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus data'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })

});
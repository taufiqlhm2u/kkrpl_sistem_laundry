// untuk halaman pelanggan
$(function() {

    $('#btnTambah').on('click', function() {
         $('#tambahPel .modal-title').html(`Tambah Pelanggan`);
          $('.modal-footer button[type=submit]').html('Simpan');
            $('.modal-body #nama').val('');
             $('.modal-content form').attr('action', `http://localhost/laundrymvc/pelanggan/tambah`);
                $('.modal-body #nohp').val('');
                $('.modal-body #alamat').val('');
                $('.modal-body #idUbah').val('');
    })

    $('.btnUbah').on('click', function() {

        $('#tambahPel .modal-title').html(`Edit Pelanggan`);
        $('.modal-footer button[type=submit]').html('Edit');
        $('.modal-content form').attr('action', `http://localhost/laundrymvc/pelanggan/update`);

        const id = $(this).data('id');

        $.ajax({
            url: `http://localhost/laundrymvc/pelanggan/getUbah`,
            method: 'post',
            data: {id : id},
            dataType: 'json',
            success: function(data) {
                $('.modal-body #nama').val(data.pelanggan_nama);
                $('.modal-body #nohp').val(data.pelanggan_hp);
                $('.modal-body #alamat').val(data.pelanggan_alamat);
                $('.modal-body #idUbah').val(data.pelanggan_id);
            }
        });
    })
})
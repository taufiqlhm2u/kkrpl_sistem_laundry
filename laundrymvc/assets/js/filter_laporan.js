$(function() {
    $('#formFilter').on('submit', function(e) {
        e.preventDefault();

        var dari = $('#dari').val();
        var sampai = $('#sampai').val();
        // console.log(`http://localhost/laundrymvc/${searchUrl}/${key}`);
        window.location.href = `http://localhost/laundrymvc/laporan/${dari}/${sampai}`;
    });
})
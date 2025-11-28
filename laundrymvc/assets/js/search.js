$(function() {
    $('#formSearch').on('submit', function(e) {
        e.preventDefault();

        var key = $('#key').val();
        const searchUrl = $(this).data('search');
        // console.log(`http://localhost/laundrymvc/${searchUrl}/${key}`);
        window.location.href = `http://localhost/laundrymvc/${searchUrl}/${key}`;
    });
})
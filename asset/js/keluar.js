        function confirms() {
    $('.konfirmasi').css({
        'position': 'absolute',
        'top': '50%',
        'left': '50%',
        'transform': 'translate(-50%, -50%)',
        'background': 'rgba(0,0,0,0.5)',
        'width': '100%',
        'height': '100%',
        'z-index': '1',
        'display': 'flex',
        'justify-content': 'center',
        'align-items': 'center'
    }).html("<div class='cekKonfir'> <h4>Konfirmasi Logout </h4> <p>Apakah kamu yakin ingin keluar dari akun ini?</p> <div class='klik'><button onclick='cancel()' class='btn btn-light'>Cancel</button> <a href='logout'><button class='btn btn-danger'>Log Out</button></a> </div> </div>");
}

function cancel() {
    $('.konfirmasi').fadeOut(300);
}
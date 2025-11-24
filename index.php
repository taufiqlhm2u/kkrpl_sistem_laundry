<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Laundry</title>
    <link rel="stylesheet" href="asset/css/bootstrap.css">
    <script src="asset/js/jquery.js"></script>
    <script src="asset/js/bootstrap.js"></script>
    <style>
        .alert {
            display: none;
        }
        form .panel {
            box-shadow: 0 0 4px rgb(0,0,0,0.5);
        }
    </style>
</head>

<body style="background-color: #f0f0f0;">
    <br><br><br>
    <center>
        <h2>SISTEM INFORMASI LAUNDRY <br> REKAYASA PERANGKAT LUNAK SMKN 3 KENDAL</h2>
    </center>
    <br>
    <!-- bootstrap v3 -->
    <div class="container">
        <div class="col-md-4 col-md-offset-4">
            <?php
            $pesan = isset($_GET['pesan']) ? $_GET['pesan'] : 'belum_login';
            if ($pesan == 'gagal') {
                echo "<div class='alert alert-danger'>Login gagal! Username atau Password salah</div>";
            } elseif ($pesan == 'logout') {
                echo "<div class='alert alert-info'>Anda berhasil Log Out</div>";
            } elseif ($pesan == 'belum_login') {
                echo "<div class='alert alert-danger'>Anda harus login untu mengakses halaman admin</div>";
            }

            ?>
            <form action="login" method="post">
                <div class="panel">
                    <br>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="username" class="text-capitalize">username</label>
                            <input type="text" name="username" id="username" placeholder="Masukan Username" required class="form-control">
                        </div>     
                        <div class="form-group">
                            <label for="password" class="text-capitalize">password</label>
                            <input type="password" name="password" id="password" placeholder="Masukan Password" required class="form-control">
                        </div>
                    </div>
                     <div style="width:100%; display:flex; justify-content:center; margin-bottom:10px;">
                        <button type="submit" class="btn btn-primary">Log In</button>
                     </div>
                </div>
            </form>
        </div>    
    </div> 
    <script>
        $(document).ready(function() {
            $('.alert').slideDown(800).delay(3000).slideUp(1000);
            // $('.alert').fadeIn(1000).delay(2000).fadeOut(1000);
        })
    </script>
</body>

</html>
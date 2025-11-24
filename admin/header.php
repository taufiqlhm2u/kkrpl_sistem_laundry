<?php
session_start();
if ($_SESSION['status'] !== 'login') {
    header('Location:../');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Laundry</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.css">
    <link rel="stylesheet" href="../asset/css/keluar.css">
    <script src="../asset/js/jquery.js"></script>
    <script src="../asset/js/bootstrap.js"></script>
    <script src="../asset/js/keluar.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="background-color: #eaeaea;">
    <nav class="navbar navbar-inverse" style="border-radius:0; border: none;">
        <div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapse" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only"></span>
                </button>
                <a href="index.php" class="navbar-brand">Laundry</a>
            </div>

            <div class="navbar navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li><a href="pelanggan"><i class="glyphicon glyphicon-user"></i> Pelanggan</a></li>
                    <li><a href="transaksi"><i class="glyphicon glyphicon-random"></i> Transaksi</a></li>
                    <li><a href="laporan"><i class="glyphicon glyphicon-list-alt"></i> Laporan</a></li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                            aria-expanded="false"><i class="glyphicon glyphicon-wrench"></i>Pengaturan <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="harga"><i class="glyphicon glyphicon-usd"></i> Pengaturan Harga</a></li>
                            <li><a href="password"><i class="glyphicon glyphicon-lock"></i> Ganti Password</a></li>
                        </ul>
                    <li><a onclick="confirms()" role="button"><i class="glyphicon glyphicon-log-out"></i> Keluar</a></li>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right" style="color: #fff; margin-top: 15px; margin-left: 10px;">
                    <li>
                        <p>Halo <?= $_SESSION['username'] ?></p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="konfirmasi"></div>
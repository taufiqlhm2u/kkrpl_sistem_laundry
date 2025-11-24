<?php
// include_once 'header.php';
include_once '../config/koneksi.php';
if (empty($_GET['id'])) {
    header('Location: transaksi');
}

try {
    $transaksi = $db->prepare('SELECT * FROM transaksi t JOIN pelanggan p ON t.pelanggan_id = p.pelanggan_id WHERE t.transaksi_id = :id');

    $transaksi->execute(array('id' => $_GET['id']));

    $tr = $transaksi->fetch(PDO::FETCH_ASSOC);


    $pakaian = $db->prepare('SELECT * FROM pakaian WHERE transaksi_id = :id');

    $pakaian->execute(array('id' => $_GET['id']));

    $p = $pakaian->fetchAll(PDO::FETCH_ASSOC);


    if ($pakaian->rowCount() < 1 && $transaksi->rowCount() < 1) {
        header('Location: transaksi');
    }

    $del = $db->query("DELETE FROM pakaian WHERE pakaian_jenis = ''");
    $del->execute();

} catch (PdoException $d) {
    throw $d;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVOICE</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.css">
    <script src="../asset/js/jquery.js"></script>
    <script src="../asset/js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        tbody tr td span {
            display: inline-block;
            width: 80px;
            text-align: center;
            border-radius: 4px;
            padding: 3px 10px;
        }
    </style>
</head>

<body>
    <div class="col-md-10 col-md-offset-1">
        <center>
            <h2>Laundry RPL</h2>
        </center>
        <a href="transaksi_invoice_cetak?id=<?= $tr['transaksi_id'] ?>" target="_blank"
            class="btn btn-primary pull-right">
            <i class="bi bi-printer-fill"></i>
            Cetak
        </a>
        <br>
        <br>
        <br>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>Transaksi Id</th>
                <th width="1%">:</th>
                <td>INVOICE - <?= $tr['transaksi_id'] ?></td>
            </tr>
            <tr>
                <th>Tgl Masuk</th>
                <th width="1%">:</th>
                <td>INVOICE - <?= $tr['transaksi_tgl'] ?></td>
            </tr>
            <tr>
                <th>Pelanggan</th>
                <th width="1%">:</th>
                <td>INVOICE - <?= ucwords($tr['pelanggan_nama']) ?></td>
            </tr>
            <tr>
                <th>Berat(kg)</th>
                <th width="1%">:</th>
                <td>INVOICE - <?= $tr['transaksi_berat'] ?></td>
            </tr>
            <tr>
                <th>Tgl Selesai</th>
                <th width="1%">:</th>
                <td><?php if ($tr['transaksi_tgl_selesai']) {
                    echo 'INVOICE - '. $tr['transaksi_tgl_selesai'];
                } else {
                    echo '<i>Masih Proses</i>';
                } ?></td>
            </tr>
            <tr>
                <th>Harga</th>
                <th width="1%">:</th>
                <td><?= 'Rp ' . number_format($tr['transaksi_harga'], 0, '.', '.') ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <th width="1%">:</th>
                <td>
                    <?php if ($tr['transaksi_status'] == 0): ?>
                        <span style="background:#feeed2; color:#e39b17;">Proses</span>
                    <?php elseif ($tr['transaksi_status'] == 1): ?>
                        <span style="background:#d8eefe; color:#2994f2;">Dicuci</span>
                    <?php else: ?>
                        <span style="background:#ddf8e6; color:#35c36c;">Selesai</span>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
        <h3>Daftar Cucian</h3>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr class="bg-info">
                    <th>Jenis Pakaian</th>
                    <th>Jumlah Pakaian</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($p as $pk): ?>
                    <tr>
                        <td><?= ucwords($pk['pakaian_jenis']) ?></td>
                        <td><?= $pk['pakaian_jumlah'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p class="row">
            <center>
                <i>"Terima Kasih Atas Kepercayaan Anda"</i>
            </center>
        </p>
    </div>
</body>

</html>
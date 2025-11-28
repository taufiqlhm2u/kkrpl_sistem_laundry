<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="<?= BASEURL . 'css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'css/style.css' ?>">
    <script src="<?= BASEURL . 'js/jquery.js' ?>"></script>
    <script src="<?= BASEURL . 'js/bootstrap.js' ?>"></script>
    <!-- icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css" rel="stylesheet" />
    <style>
        table th, table td {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
     <div class="card">
        <div class="card-header">
            <h2>Laundry RPL</h2>
        </div>
        <div class="card-body">
               <div class="table-reponsive">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Transaksi Id</th>
                        <th width="1%">:</th>
                        <td>INVOICE - <?= $data['transaksi']['transaksi_id'] ?></td>
                    </tr>
                    <tr>
                        <th>Tgl Masuk</th>
                        <th width="1%">:</th>
                        <td><?= $data['transaksi']['transaksi_tgl'] ?></td>
                    </tr>
                    <tr>
                        <th>Pelanggan</th>
                        <th width="1%">:</th>
                        <td><?= $data['transaksi']['pelanggan_nama'] ?></td>
                    </tr>
                    <tr>
                        <th>Berat(kg)</th>
                        <th width="1%">:</th>
                        <td><?= $data['transaksi']['transaksi_berat'] ?></td>
                    </tr>
                    <tr>
                        <th>Tgl Selesai</th>
                        <th width="1%">:</th>
                        <td><?php if ($data['transaksi']['transaksi_tgl_selesai']) {
                            echo $data['transaksi']['transaksi_id'];
                        } else {
                            echo '<i>Masih Proses</i>';
                        } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <th width="1%">:</th>
                        <td><?= 'Rp ' . number_format($data['transaksi']['transaksi_harga'], 0, '.') ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <th width="1%">:</th>
                        <td class=" border-0" style="white-space: nowrap;">
                            <?php if ($data['transaksi']['transaksi_status'] == 0): ?>
                                <span
                                    style="background: #e8e3fd; color: #6e42f5; display: inline-block; width: 100px; text-align: center; border-radius:4px; padding: 3px 10px;">Masuk</span>
                            <?php elseif ($data['transaksi']['transaksi_status'] == 1): ?>
                                <span
                                    style="background: #feeed2; color: #e39b17; display: inline-block; width: 100px; text-align: center; border-radius:4px; padding: 3px 10px;">Diproses</span>
                            <?php elseif ($data['transaksi']['transaksi_status'] == 2): ?>
                                <span
                                    style="background: #ddf8e6; color: #35c36c; display: inline-block; width: 100px; text-align: center; border-radius:4px; padding: 3px 10px;">Selesai</span>
                            <?php else: ?>
                                <p>Status Invalid</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-responsive mt-5">
            <h4>Pakaian</h4>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th>Jenis Pakaian</th>
                        <th>Jumlah Pakaian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach($data['pakaian'] as $p) : ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $p['pakaian_jenis'] ?></td>
                        <td><?= $p['pakaian_jumlah'] ?></td>
                    </tr>
                    <?php $no++; endforeach; ?>
                </tbody>
            </table>

            <p class="text-center mt-5"><i>"Terima kasih atas kepercayaan anda"</i></p>
        </div>
        </div>
     </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
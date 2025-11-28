<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="stylesheet" href="<?= BASEURL . 'css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= BASEURL . 'css/style.css' ?>">
    <script src="<?= BASEURL . 'js/jquery.js' ?>"></script>
    <script src="<?= BASEURL . 'js/bootstrap.js' ?>"></script>
    <!-- icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css" rel="stylesheet" />
    <style>
        table th,
        table td {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Data Dari <?= $data['dari'] . ' sampai ' . $data['sampai'] ?> </h4>
            </div>
            <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="2%" class="text-left">No</th>
                                <th class="text-left">Invoice</th>
                                <th class="text-left">Tanggal</th>
                                <th class="text-left">Pelanggan</th>
                                <th class="text-left">Berat</th>
                                <th class="text-left">Tanggal Selesai</th>
                                <th class="text-left">Harga</th>
                                <th class="text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data['laporan'] as $d):
                                ?>
                                <tr class="row-data">
                                    <th class="text-center border-0" style="padding: 4px;"><?= $no ?>
                                    </th>
                                    <td class="text-left border-0 text-primary" style="padding: 4px;">
                                        INVOICE-<?= ucwords($d['transaksi_id']) ?></td>
                                    <td class="text-left border-0" style="padding: 4px;">
                                        <?= $d['transaksi_tgl'] ?>
                                    </td>
                                    <td class="text-left border-0" style="padding: 4px;">
                                        <?= ucwords($d['pelanggan_nama']) ?>
                                    </td>
                                    <td class="text-left border-0" style="padding: 4px;">
                                        <?= $d['transaksi_berat'] ?>
                                    </td>
                                    <td class="text-left border-0" style="padding: 4px;">
                                        <?php if ($d['transaksi_tgl_selesai']) {
                                            echo $d['transaksi_tgl_selesai'];
                                        } else {
                                            echo "<i class='text-secondary'>Proses</i>";
                                        } ?>
                                    </td>
                                    <td class="text-left border-0" style="padding: 4px;">
                                        <?= 'Rp ' . number_format($d['transaksi_harga'], 0, '.', '.') ?>
                                    </td>
                                    <td class=" border-0" style= 4px;                            <?php if ($d['transaksi_status'] == 0): ?>
                                            <span
                                                style="background: #e8e3fd; color: #6e42f5; display: inline-block; width: 100px; text-align: center; border-radius:4px; padding: 3px 10px;">Masuk</span>
                                        <?php elseif ($d['transaksi_status'] == 1): ?>
                                            <span
                                                style="background: #feeed2; color: #e39b17; display: inline-block; width: 100px; text-align: center; border-radius:4px; padding: 3px 10px;">Diproses</span>
                                        <?php elseif ($d['transaksi_status'] == 2): ?>
                                            <span
                                                style="background: #ddf8e6; color: #35c36c; display: inline-block; width: 100px; text-align: center; border-radius:4px; padding: 3px 10px;">Selesai</span>
                                        <?php else: ?>
                                            <p>Status Invalid</p>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
            </div>

        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
    <?php 
    
    if (isset($_GET['tgl_dari']) && isset($_GET['tgl_sampai'])){
        $dari =(string) $_GET['tgl_dari'];
        $sampai =(string) $_GET['tgl_sampai'];
    } else {
        header('Location:laporan');
    }

    include_once '../config/koneksi.php';
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
     <script src="../asset/js/jquery.js"></script>
    <script src="../asset/js/bootstrap.js"></script>
    <link rel="stylesheet" href="../asset/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    tbody tr td span {
        display: inline-block;
        width: 80px;
        text-align: center;
        border-radius: 4px;
        padding: 5px 10px;
    }

    tbody td a:hover,
    .panel-body a:hover {
        transform: scale(1.1);
        box-shadow: 0 5px 7px rgba(0, 0, 0, 0.5);
    }
</style>
</head>
<body>
      <div class="container">
          <div class="panel">
            <div class="panel-heading">
                <h3 class="text-center">Data laporan dari tgl <i> <?= $dari ?></i> sampai <i><?= $sampai ?></i> </h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped laporan">
                    <thead>
                       <tr>
                        <th width="1%">No</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Berat (Kg)</th>
                        <th>Tgl. Selesai</th>
                        <th>Harga</th>
                        <th>Status</th>
                       </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $filter = $db->prepare('SELECT * FROM transaksi t
                            JOIN pelanggan p on t.pelanggan_id = p.pelanggan_id
                            WHERE t.transaksi_tgl BETWEEN :dari AND :sampai');

                       $filter->execute(array(
                            'dari' => $dari,
                            'sampai' => $sampai
                        ));

                        $filter = $filter->fetchAll(PDO::FETCH_ASSOC);

                        $no = 1;
                        foreach ($filter as $f) :
                        ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td>INVOICE-<?= $f['transaksi_id']?></td>
                            <td><?= $f['transaksi_tgl']?></td>
                            <td><?= $f['pelanggan_nama']?></td>
                            <td><?= $f['transaksi_berat']?></td>
                            <td><?php if ($f['transaksi_tgl_selesai']) { 
                                echo $f['transaksi_tgl_selesai']; } else { echo '<i>Proses</i>'; }?></td>
                            <td><?= 'Rp' . number_format($f['transaksi_harga'], 0, '.') ?></td>
                                <td style="text-align: center;">
                                <?php if ($f['transaksi_status'] == 0): ?>
                                    <span style="background:#feeed2; color:#e39b17;">Proses</span>
                                <?php elseif ($f['transaksi_status'] == 1): ?>
                                    <span style="background:#d8eefe; color:#2994f2;">Dicuci</span>
                                <?php else: ?>
                                    <span style="background:#ddf8e6; color:#35c36c;">Selesai</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php $no++; endforeach; ?>
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
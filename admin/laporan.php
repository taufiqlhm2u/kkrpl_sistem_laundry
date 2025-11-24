<?php
include_once '../config/koneksi.php';
include_once 'header.php';
?>
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
<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Filter Laporan</h4>
        </div>
        <div class="panel-body" style="display: flex; justify-content: center; gap: 10px; align-items: center;">
            <form action="">
                <table class="table table-bordered table-striped" style="width: 400px;">
                    <thead>
                        <tr>
                            <th><label for="tgl_dari">Dari Tanggal</label></th>
                            <th><label for="tgl_sampai">Sampai Tanggal</label></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="date" name="tgl_dari" id="tgl_dari" class="form-control">
                            </td>
                            <td>
                                <input type="date" name="tgl_sampai" id="tgl_sampai" class="form-control">
                            </td>
                            <td colspan="2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
              <?php if (isset($_GET['tgl_dari']) && isset($_GET['tgl_sampai'])): ?>
                                    <a href="laporan" class="btn btn-secondary">
                                        Refresh
                                    </a>
                            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($_GET['tgl_dari']) && isset($_GET['tgl_sampai'])):
        $dari = (string) $_GET['tgl_dari'];
        $sampai = (string) $_GET['tgl_sampai'];
        ?>
        <div class="panel">
            <div class="panel-heading">
                <h4 class="text-center">Data laporan dari tgl <i> <?= $dari ?></i> sampai <i><?= $sampai ?></i> </h4>
            </div>
            <div class="panel-body">
                <a href="cetak_laporan?tgl_dari=<?= $dari; ?>&tgl_sampai=<?= $sampai ?>" target="blank"
                    class="btn btn-primary pull-right">
                    <i class="bi bi-printer-fill" id="print"></i>
                    Cetak
                </a>
                <br><br><br>
                <table class="table table-bordered table-striped laporan">
                    <thead>
                        <tr>
                            <th>No</th>
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
                        try {
                            $filter = $db->prepare('SELECT * FROM transaksi t
                            JOIN pelanggan p on t.pelanggan_id = p.pelanggan_id
                            WHERE t.transaksi_tgl BETWEEN :dari AND :sampai');

                            $filter->execute(array(
                                'dari' => $dari,
                                'sampai' => $sampai
                            ));

                            $filter = $filter->fetchAll(PDO::FETCH_ASSOC);

                            $no = 1;
                            foreach ($filter as $f):
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td>INVOICE-<?= $f['transaksi_id'] ?></td>
                                    <td><?= $f['transaksi_tgl'] ?></td>
                                    <td><?= $f['pelanggan_nama'] ?></td>
                                    <td><?= $f['transaksi_berat'] ?></td>
                                    <td><?php if ($f['transaksi_tgl_selesai']) {
                                        echo $f['transaksi_tgl_selesai'];
                                    } else {
                                        echo '<i>Proses</i>';
                                    } ?></td>
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
                                <?php $no++; endforeach;
                        } catch (PDOException $e) {
                            ?>
                            <p>Tidak Ada Data</p>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>
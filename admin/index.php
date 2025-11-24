<?php
include_once '../config/koneksi.php';
include_once 'header.php';

$admins = $db->query('select * from admin');
?>

<style>
    .alertAdmin {
        display: none;
        margin-top: 10px;
    }

    .container {
        /* max-width: 950px; */
        margin-top: 10px;
    }

    .data-admin {
        width: 100%;
        overflow: auto;
    }

    .card {
        border: none;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.5);
    }

    tbody tr td span {
        display: inline-block;
        width: 150px;
        text-align: center;
        border-radius: 4px;
        padding: 5px 10px;
    }
</style>

<div class="container">
    <div class="alert alert-info alertAdmin">Selamat Datang <b><?= $_SESSION['username'] ?></b> di Sistem Informasi
        Laundry</div>

    <div class="panel">
        <div class="panel-heading">
            <h4>Dashboard</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h1>
                                <i class="bi bi-person me-auto"></i>
                                <span class="pull-right">
                                    <?php
                                    $pelanggan = $db->query('SELECT * FROM pelanggan');
                                    echo $pelanggan->rowCount(); ?>
                                </span>
                            </h1>
                            Jumlah Pelanggan
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h1>
                                <i class="bi bi-repeat me-auto"></i>
                                <span class="pull-right">
                                    <?php
                                    $proses = $db->query('SELECT * FROM transaksi where transaksi_status = 0');
                                    echo $proses->rowCount(); ?>
                                </span>
                            </h1>
                            Jumlah Cucian Diproses
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h1>
                                <i class="bi bi-info me-auto"></i>
                                <span class="pull-right">
                                    <?php
                                    $proses = $db->query('SELECT * FROM transaksi where transaksi_status = 1');
                                    echo $proses->rowCount(); ?>
                                </span>
                            </h1>
                            Jumlah Cucian Siap Diambil
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h1>
                                <i class="bi bi-check2-circle me-auto"></i>
                                <span class="pull-right">
                                    <?php
                                    $proses = $db->query('SELECT * FROM transaksi where transaksi_status = 2');
                                    echo $proses->rowCount();
                                    ?>
                                </span>
                            </h1>
                            Jumlah Cucian Selesai
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <div class="panel mt-5">
        <div class="panel-heading">
            <h4>Riwayat Transaksi Terakhir</h4>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
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
                    <?php $data = $db->query('SELECT * FROM transaksi t JOIN pelanggan p ON t.pelanggan_id = p.pelanggan_id ORDER BY t.transaksi_id DESC limit 10');
                    $no = 1;
                    foreach ($data as $row):
                        ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $row['transaksi_id']; ?></td>
                            <td><?= $row['transaksi_tgl']; ?></td>
                            <td><?= $row['pelanggan_nama']; ?></td>
                            <td><?= $row['transaksi_berat']; ?></td>
                            <td><?= $row['transaksi_tgl_selesai']; ?></td>
                            <td><?= 'Rp ' . number_format($row['transaksi_harga']); ?></td>
                            <td style="text-align: center;">
                                <?php if ($row['transaksi_status'] == 0): ?>
                                    <span style="background:#feeed2; color:#e39b17;">Proses</span>
                                <?php elseif ($row['transaksi_status'] == 1): ?>
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

<footer class="mt-5"
    style="height: 100px; display: flex; justify-content: center; align-items: center; background: #969696ff; color: white;">
    <p class="fw-semibold fs-5">2025 &copy; </p>
</footer>
<script>
    $(document).ready(function () {
        $('.alertAdmin').slideDown(500).delay(1500).slideUp(500);
    });
</script>
</body>

</html>
<?php

include_once 'header.php';
include_once '../config/koneksi.php';

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

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Data Transaksi</h4>
        </div>
        <div class="panel-body">
            <a href="transaksi_tambah" class="btn btn-info pull-right" style="margin-bottom: 10px;">Transaksi Baru</a>
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
                        <th width="15%">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $limit = 5;
                    $pageActive = (int) (isset($_GET['page'])) ? $_GET['page'] : 1;
                    $offset = ($limit * $pageActive) - $limit;
           
                    $data = $db->query('SELECT * FROM transaksi t JOIN pelanggan p ON t.pelanggan_id = p.pelanggan_id ORDER BY transaksi_id DESC LIMIT ' . $offset . ',' . $limit);
                    $no = 1;
                    foreach ($data as $row):
                        ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td>INVOICE-<?= $row['transaksi_id']; ?></td>
                            <td><?= $row['transaksi_tgl']; ?></td>
                            <td><?= $row['pelanggan_nama']; ?></td>
                            <td><?= $row['transaksi_berat']; ?></td>
                            <td><?php if(isset($row['transaksi_tgl_selesai'])) { 
                                echo $row['transaksi_tgl_selesai']; 
                            } else { ?>
                            <i style="color: #6e6e6eff;">masih proses</i>
                            <?php } ?></td>
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
                            <td style="text-align: center; display:flex; flex-wrap: wrap; gap:7px;">
                                <a href="transaksi_invoice?id=<?= $row['transaksi_id']?>" class="btn btn-warning"><i class="bi bi-receipt"></i></a>
                                <a href="transaksi_edit?id=<?= $row['transaksi_id']?>" class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i></a>
                                <a onclick="return confirm('apakah kamu yakin ingin membatalkannya');" href="transaksi_hapus?id=<?= $row['transaksi_id']?>" class="btn btn-danger"><i class="bi bi-x-square"></i></a>
                            </td>
                        </tr>
                        <?php $no++; endforeach; ?>
                </tbody>
            </table>
            <?php 
                     $row = $db->query('SELECT * FROM transaksi t JOIN pelanggan p ON t.pelanggan_id = p.pelanggan_id');
                    $row = $row->rowCount();
                    $pages = (int) ceil($row / $limit);
            ?>
            <div style="display: flex; justify-content: center;">
                <ul class="pagination">
                    <?php if ($pageActive > 1) : ?>
                        <li><a href="?page=<?= $pageActive - 1 ?>">Previus</a></li>
                    <?php else : ?>
                        <li><a href="">Previus</a></li>
                    <?php 
                    endif;
                    for ($a = 1; $a <= $pages; $a++) : 
                    if ($a == $pageActive) :
                    ?>
                <li><a href="?page=<?= $a ?>" style="background:#d8eefe; color:#2994f2;"><?= $a ?></a></li>
                <?php else: ?>
                <li><a href="?page=<?= $a ?>"><?= $a ?></a></li>
                <?php
                endif;
                 endfor;
                 if ($pageActive < $pages) :
                ?>
                 <li><a href="?page=<?= $pageActive + 1 ?>">Next</a></li>
                 <?php else: ?>
                 <li><a href="">Next</a></li>
                 <?php endif;?>
            </ul>
            </div>
        </div>
    </div>

</div>
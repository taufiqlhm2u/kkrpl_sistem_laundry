<?php
include_once 'header.php';
include_once '../config/koneksi.php';
?>
<style>
    tbody td a:hover, .panel-body a:hover{
        transform: scale(1.1);
        box-shadow: 0 5px 7px rgba(0,0,0,0.5);
    }
</style>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Data Pelanggan</h4>
        </div>
        <div class="panel-body">
            <a href="pelanggan_tambah" class="btn btn-sm btn-info pull-right" style="margin-bottom: 10px;">Tambah</a>

            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th>Nama</th>
                        <th>HP</th>
                        <th>Alamat</th>
                        <th width="15%">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $data = $db->query('SELECT * FROM pelanggan');
                    $no = 1;
                    foreach ($data as $row):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['pelanggan_nama']; ?></td>
                            <td><?= $row['pelanggan_hp']; ?></td>
                            <td><?= $row['pelanggan_alamat']; ?></td>
                            <td style="text-align: center;">
                                <a href="pelanggan_edit?id=<?= $row['pelanggan_id']; ?>"
                                    class="btn btn-sm btn-info"><i class="glyphicon glyphicon-pencil"></i></a>
                                <a onclick="return confirm('Apakah kamu yakin?');"
                                    href="pelanggan_hapus?id=<?= $row['pelanggan_id']; ?>"
                                    class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
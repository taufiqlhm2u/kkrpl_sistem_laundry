<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location:pelanggan');
}

include_once 'header.php';
include_once '../config/koneksi.php';

$data = $db->prepare('SELECT * FROM pelanggan WHERE pelanggan_id = :id');
$data->execute(['id' => $id]);
$row = $data->fetch();
?>

<div class="container" style="display: flex; justify-content: center;">
    <div style="width: 450px; box-shadow: 0 0 6px rgba(0,0,0,0.5); border-radius: 10px;">
        <div class="panel">
            <div class="panel-heading">
                <h4>Edit Pelanggan</h4>
            </div>
            <div class="panel-body">
                <form method="POST" action="pelanggan_update">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $row['pelanggan_id'] ?>">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control"
                            value="<?= $row['pelanggan_nama'] ?>" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="hp">No.HP</label>
                        <input type="number" name="hp" id="hp" class="form-control" value="<?= $row['pelanggan_hp'] ?>"
                            placeholder="0812xxxx" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control"
                            value="<?= $row['pelanggan_alamat'] ?>" placeholder="Masukan Alamat" required>
                    </div>
                    <div style="width: 100%; margin-top:20px;">
                        <burton type="submit" style="width: 100%;" class="btn btn-primary">Edit</burton>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
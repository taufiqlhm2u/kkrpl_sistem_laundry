<?php
include_once 'header.php';
include_once '../config/koneksi.php';

$harga = $db->query('SELECT * FROM harga');
?>

<div class="container" style="display: flex; justify-content: center; align-items: center;">
    <div style="width: 450px; box-shadow: 0 0 6px rgba(0,0,0,0.5); border-radius: 10px; margin-top: 50px;">
        <div class="panel">
            <div class="panel-heading">
                <h4>Ganti Harga</h4>
            </div>
            <div class="panel-body">
                <form method="POST" action="harga_update">
                    <?php foreach ($harga as $row): ?>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control" value="<?= $row['harga_perkilo']?>" required>
                    </div>
                    <?php endforeach; ?>
                    <div style="width: 100%; margin-top:20px; display: flex; justify-content: center;">
                        <button type="submit" class="btn btn-primary">Ganti</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
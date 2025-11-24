<?php
include_once 'header.php';
?>

<div class="container" style="display: flex; justify-content: center;">
    <div style="width: 450px; box-shadow: 0 0 6px rgba(0,0,0,0.5); border-radius: 10px;">
        <div class="panel">
            <div class="panel-heading">
                <h4>Tambah Pelanggan Baru</h4>
            </div>
            <div class="panel-body">
                <form method="POST" action="pelanggan_aksi">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="hp">No.HP</label>
                        <input type="number" name="hp" id="hp" class="form-control" placeholder="0812xxxx" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukan Alamat"
                            required>
                    </div>
                    <div style="width: 100%; margin-top:20px;">
                        <button type="submit" style="width: 100%;" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
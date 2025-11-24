<?php
include_once 'header.php';
?>
<style>
    .alert {
        display: none;
    }
</style>
<div class="container">
    <div class="col-md-4 col-md-offset-4" style="margin-top: 40px;">
        <?php
        $gagal = isset($_GET['gagal']) ? $_GET['gagal'] : '';
        if ($gagal == 'old') {
            echo "<div class='alert alert-danger'>Password Lama Salah!</div>";
        } elseif ($gagal == 'konfir') {
            echo "<div class='alert alert-danger'>Konfirmasi Password Dengan Benar!</div>";
        }
        ?>
        <div class="panel">
            <div class="panel-heading">
                <h4>Ganti Password</h4>
            </div>
            <div class="panel-body">
                <form method="POST" action="password_update">
                    <div class="form-group">
                        <label for="pw_lama">Password Lama</label>
                        <input type="password" name="pw_lama" id="pw_lama" class="form-control"
                            placeholder="Masukkan Password Lama" required>
                    </div>
                    <div class="form-group">
                        <label for="pw_baru">Password Baru</label>
                        <input type="password" name="pw_baru" id="pw_baru" class="form-control"
                            placeholder="Masukan Password Baru" required>
                    </div>
                    <div class="form-group">
                        <label for="cek_pw">Konfirmasi Password</label>
                        <input type="password" name="cek_pw" id="cek_pw" class="form-control"
                            placeholder="Konfirmasi Password Baru" required>
                    </div>
                    <div style="width: 100%; margin-top:20px;">
                        <button type="submit" style="width: 100%;" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('.alert').slideDown(800).delay(3000).slideUp(800);
</script>
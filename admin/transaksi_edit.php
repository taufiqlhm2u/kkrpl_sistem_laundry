<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location:pelanggan');
}
include_once 'header.php';
include_once '../config/koneksi.php';

$pel = $db->query('SELECT * FROM pelanggan');
$data = $db->prepare('SELECT * FROM transaksi WHERE transaksi_id = :id');
$data->execute(array('id' => $id));
$d = $data->fetch(PDO::FETCH_ASSOC);

$pakaian = $db->prepare('SELECT * FROM pakaian WHERE transaksi_id = :id');
$pakaian->execute(array('id' => $id));
$pk = $pakaian->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container" style="display: flex; justify-content: center;">
    <div style="width: 500px; box-shadow: 0 0 6px rgba(0,0,0,0.5); border-radius: 10px;">
        <div class="panel">
            <div class="panel-heading">
                <h4>Edit Transaksi</h4>
            </div>
            <div class="panel-body">
                <form method="POST" action="transaksi_update" style="display:flex; flex-direction: column; gap:10px;">
                    <input type="hidden" name="id_t" value="<?= $d['transaksi_id'] ?>">
                    <div style="display: flex; flex-direction: column;">
                        <div style="display: flex; justify-content: space-between;">
                            <div style="width: 48%">
                                <div class="form-group">
                                    <label for="tgl">Tanggal</label>
                                    <input type="date" name="tgl" id="tgl" class="form-control"
                                        value="<?= $d['transaksi_tgl'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="id">Pelanggan</label><br>
                                    <select name="id" id="id"
                                        style="width: 100%; padding: 8px 5px; border-radius: 4px;">
                                        <option>-- Pilih --</option>
                                        <?php foreach ($pel as $row): ?>
                                            <option value="<?= $row['pelanggan_id'] ?>" <?php if ($row['pelanggan_id'] == $d['pelanggan_id'])
                                                  echo 'selected' ?>>
                                                <?= ucwords($row['pelanggan_nama']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" name="harga" id="harga" class="form-control"
                                        placeholder="Masukan Harga" value="<?= $d['transaksi_harga'] ?>" readonly>
                                </div>
                            </div>
                            <div style="width: 48%">
                                <div class="form-group">
                                    <label for="berat">Berat Pakain (KG)</label>
                                    <input type="number" name="berat" id="berat" class="form-control"
                                        placeholder="Masukan Berat" value="<?= $d['transaksi_berat'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_selesai">Tanggal Selesai</label>
                                    <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control"
                                        value="<?= $d['transaksi_tgl_selesai'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Status">Status</label><br>
                                    <select name="status" id="status"
                                        style="width: 100%; padding: 8px 5px; border-radius: 4px;">
                                        <option value="0" <?php if ($d['transaksi_status'] == '0')
                                            echo 'selected' ?>>
                                                Proses</option>
                                            <option value="1" <?php if ($d['transaksi_status'] == '1')
                                            echo 'selected' ?>>
                                                Dicuci</option>
                                            <option value="2" <?php if ($d['transaksi_status'] == '2')
                                            echo 'selected' ?>>
                                                Selesai</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                                                <table>
                            <tr>
                                <th>Jenis Pakaian</th>
                                <th>Jumlah</th>
                            </tr>
                            <?php 
                            foreach ($pk as $p) : ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="id_pakaian[]" value="<?= $p['pakaian_id']?>">
                                    <div class="form-group">
                                        <input type="text" name="jenisPakaian[]" class="form-control"
                                            placeholder="Kaos, celana dll"  value="<?= $p['pakaian_jenis'] ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="jumlahPakaian[]" class="form-control" value="<?= $p['pakaian_jumlah'] ?>" 
                                            style="width: 70px;">
                                    </div>
                                </td>
                            </tr>
                                <?php endforeach; 
                                $c = count($pk);
                                // $c = ($c < 3) ? 3 : 2;
                                if ($c < 3) {
                                    $c = 3;
                                } else if ($c  < 4) {
                                    $c = 2;
                                } else if ($c < 5) {
                                    $c = 1;
                                } else {
                                    $c = 0;
                                }
                                var_dump($c);
                                for ($a = 0; $a < $c; $a++) :
                                ?>
                                  <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="tambahJenis[]" class="form-control"
                                            placeholder="Kaos, celana dll">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="tambahJumlah[]" class="form-control" 
                                            style="width: 70px;">
                                    </div>
                                </td>
                            </tr>
                            <?php endfor; ?>
                                
                        </table>
                        <div style="width: 100%; margin-top:20px;">
                            <button type="submit" style="width: 100%;" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br>
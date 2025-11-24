<?php
include_once 'header.php';
include_once '../config/koneksi.php';

$pel = $db->query('SELECT * FROM pelanggan');
?>

<div class="container" style="display: flex; justify-content: center;">
    <div style="width: 500px; box-shadow: 0 0 6px rgba(0,0,0,0.5); border-radius: 10px;">
        <div class="panel">
            <div class="panel-heading">
                <h4>Tambah Transaksi</h4>
            </div>
            <div class="panel-body">
                <form method="POST" action="transaksi_aksi" style="display: flex; flex-direction: column;">
                    <div>
                        <div class="form-group">
                            <label for="id">Pelanggan</label><br>
                            <select name="id" id="id" style="width: 100%; padding: 8px 5px; border-radius: 4px;">
                                <option>-- Pilih --</option>
                                <?php foreach ($pel as $row): ?>
                                    <option value="<?= $row['pelanggan_id'] ?>"><?= ucwords($row['pelanggan_nama']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="berat">Berat Pakain (KG)</label>
                            <input type="number" name="berat" id="berat" class="form-control"
                                placeholder="Masukan Berat" required>
                        </div>
                        <table>
                            <tr>
                                <th>Jenis Pakaian</th>
                                <th>Jumlah</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="jenisPakaian[]" class="form-control"
                                            placeholder="Kaos, celana dll" required>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="jumlahPakaian[]" class="form-control" required
                                            style="width: 70px;">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="jenisPakaian[]" class="form-control"
                                            placeholder="Kaos, celana dll">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="jumlahPakaian[]" class="form-control"
                                            style="width: 70px;">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="jenisPakaian[]" class="form-control"
                                            placeholder="Kaos, celana dll">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="jumlahPakaian[]" class="form-control"
                                            style="width: 70px;">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="jenisPakaian[]" class="form-control"
                                            placeholder="Kaos, celana dll">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="jumlahPakaian[]" class="form-control"
                                            style="width: 70px;">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div style="width: 100%; margin-top:20px;">
                        <button type="submit" style="width: 100%;" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br>
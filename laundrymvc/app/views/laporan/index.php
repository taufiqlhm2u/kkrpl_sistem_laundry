<main class="content px-3 py-4 mb-5 mt-4">
    <div class="container-fluid">
        <div class="mb-4">
            <h4 class="fw-bold">Filter Laporan</h4>
            <form id="formFilter" class="d-flex justify-content-center align-items-center w-50 gap-4">
                <table class="table">
                    <tr>
                        <th style="background: #F8F9FB;">Dari Tanggal</th>
                        <th style="background: #F8F9FB;">Sampai Tanggal</th>
                    </tr>
                    <tr>
                        <td style="background: #F8F9FB;"><input type="date" id="dari" name="tgl_dari"
                                class="form-control"></td>
                        <td style="background: #F8F9FB;"><input type="date" id="sampai" name="tgl_dari"
                                class="form-control"></td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>

        <div class="bg-white shadow" style="min-height: 300px;">
            <!-- Table untuk menampilkan data pelanggan -->
            <?php if (isset($data['dari']) && isset($data['sampai'])): ?>
                <div class="p-3">
                    <h4>Data Dari <?=$data['dari'] . ' sampai ' . $data['sampai']?> </h4>
                     <a href="<?= REDIRECT . 'laporan/cetak_laporan/' . $data['dari'] . '/' . $data['sampai']?>" class="btn btn-primary" target="_blank"><i class="ri-printer-fill"></i> Print</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" style="width: 100%;">
                        <thead>
                            <tr>
                                <th width="2%" class="text-left" style="white-space: nowrap;">No</th>
                                <th class="text-left" style="white-space: nowrap;">Invoice</th>
                                <th class="text-left" style="white-space: nowrap;">Tanggal</th>
                                <th class="text-left" style="white-space: nowrap;">Pelanggan</th>
                                <th class="text-left" style="white-space: nowrap;">Berat</th>
                                <th class="text-left" style="white-space: nowrap;">Tanggal Selesai</th>
                                <th class="text-left" style="white-space: nowrap;">Harga</th>
                                <th class="text-left" style="white-space: nowrap;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data['laporan'] as $d):
                                ?>
                                <tr class="row-data">
                                    <th class="text-center border-0" style="white-space: nowrap; padding: 10px;"><?= $no ?></th>
                                    <td class="text-left border-0 text-primary" style="white-space: nowrap; padding: 10px;">
                                        INVOICE-<?= ucwords($d['transaksi_id']) ?></td>
                                    <td class="text-left border-0" style="white-space: nowrap; padding: 10px;">
                                        <?= $d['transaksi_tgl'] ?>
                                    </td>
                                    <td class="text-left border-0" style="white-space: nowrap; padding: 10px;">
                                        <?= ucwords($d['pelanggan_nama']) ?>
                                    </td>
                                    <td class="text-left border-0" style="white-space: nowrap; padding: 10px;">
                                        <?= $d['transaksi_berat'] ?>
                                    </td>
                                    <td class="text-left border-0" style="white-space: nowrap; padding: 10px;">
                                        <?php if ($d['transaksi_tgl_selesai']) {
                                            echo $d['transaksi_tgl_selesai'];
                                        } else {
                                            echo "<i class='text-secondary'>Proses</i>";
                                        } ?>
                                    </td>
                                    <td class="text-left border-0" style="white-space: nowrap; padding: 10px;">
                                        <?= 'Rp ' . number_format($d['transaksi_harga'], 0, '.', '.') ?>
                                    </td>
                                    <td class=" border-0" style="white-space: nowrap;">
                                        <?php if ($d['transaksi_status'] == 0): ?>
                                            <span
                                                style="background: #e8e3fd; color: #6e42f5; display: inline-block; width: 100px; text-align: center; border-radius:4px; padding: 3px 10px;">Masuk</span>
                                        <?php elseif ($d['transaksi_status'] == 1): ?>
                                            <span
                                                style="background: #feeed2; color: #e39b17; display: inline-block; width: 100px; text-align: center; border-radius:4px; padding: 3px 10px;">Diproses</span>
                                        <?php elseif ($d['transaksi_status'] == 2): ?>
                                            <span
                                                style="background: #ddf8e6; color: #35c36c; display: inline-block; width: 100px; text-align: center; border-radius:4px; padding: 3px 10px;">Selesai</span>
                                        <?php else: ?>
                                            <p>Status Invalid</p>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>

                <?php else: ?>

                    <div class="d-flex justify-content-center" >
                        <p class="mt-5 text-secondary fst-italic">Tidak ada data</p>
                    </div>

            <?php endif ?>
        </div>

    </div>

</main>
<script src="<?= BASEURL . 'js/filter_laporan.js' ?>"></script>
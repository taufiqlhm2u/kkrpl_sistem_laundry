<main class="content px-3 py-4 mt-3">
    <div class="container-fluid">
        <div class="mb-3">
            <h3 class="fw-bold mb-3">
                Admin Dashboard
            </h3>
            <div class="row">
                <div class="col-10 col-md-3">
                    <div class="card shadow pelanggan">
                        <div class="card-body py-4 d-flex align-items-end gap-3">
                            <div class="icon-pelanggan d-flex justify-content-center align-items-center rounded-2">
                                <i class="ri-group-fill" style="font-size: 30px; "></i>
                            </div>
                            <div>
                                <h4 class="fw-bold" style="margin-bottom: -5px;">
                                    <?= $data['rowPelanggan']; ?>
                                </h4>
                                <p class="fw-semibold">Pelanggan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-10 col-md-3">
                    <div class="card shadow masuk">
                        <div class="card-body py-4 d-flex align-items-end gap-3">
                            <div class="icon-masuk d-flex justify-content-center align-items-center rounded-2">
                                <i class="ri-t-shirt-line" style="font-size: 30px; "></i>
                            </div>
                            <div>
                                <h4 class="fw-bold" style="margin-bottom: -5px;">
                                    <?= $data['masuk']; ?>
                                </h4>
                                <p class="fw-semibold">Masuk</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-10 col-md-3">
                    <div class="card shadow proses">
                        <div class="card-body py-4 d-flex align-items-end gap-3">
                            <div class="icon-proses d-flex justify-content-center align-items-center rounded-2">
                                <i class="ri-loop-left-line" style="font-size: 30px; "></i>
                            </div>
                            <div>
                                <h4 class="fw-bold" style="margin-bottom: -5px;">
                                    <?= $data['proses']; ?>
                                </h4>
                                <p class="fw-semibold">Proses</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-10 col-md-3">
                    <div class="card shadow finish">
                        <div class="card-body py-4 d-flex align-items-end gap-3">
                            <div class="icon-finish d-flex justify-content-center align-items-center rounded-2">
                                <i class="ri-checkbox-circle-line" style="font-size: 30px;"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold" style="margin-bottom: -5px;">
                                    <?= $data['selesai']; ?>
                                </h4>
                                <p class="fw-semibold">Selesai</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <h3 class="fw-bold fs-4 my-3">
                        Transaksi Terakhir
                    </h3>
                    <div class="table-responsive shadow rounded bg-white">
                        <table class="table table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col" width="1%" style="white-space: nowrap;">No</th>
                                    <th scope="col" style="white-space: nowrap;">Invoice</th>
                                    <th scope="col" style="white-space: nowrap;">Tgl Masuk</th>
                                    <th scope="col" style="white-space: nowrap;">Pelanggan</th>
                                    <th scope="col" style="white-space: nowrap;">Berat (kg)</th>
                                    <th scope="col" style="white-space: nowrap;">Tgl Selesai</th>
                                    <th scope="col" style="white-space: nowrap;">Harga</th>
                                    <th scope="col" width="15%" style="white-space: nowrap;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data['last'] as $d): ?>
                                    <tr>
                                        <th><?= $no ?></th>
                                        <td class="text-primary">Invoice-<?= $d['transaksi_id'] ?></td>
                                        <td><?= $d['transaksi_tgl'] ?></td>
                                        <td><?= $d['pelanggan_nama'] ?></td>
                                        <td><?= $d['transaksi_berat'] ?></td>
                                        <td><?= (isset($d['transaksi_tgl_selesai'])) ? $d['transaksi_tgl_selesai'] : "<i class='text-secondary'>Proses</i>"; ?>
                                        </td>
                                        <td>Rp <?= number_format($d['transaksi_harga'], 0, ' ', '.') ?></td>
                                        <td>
                                            <?php if ($d['transaksi_status'] == 0): ?>
                                                <span
                                                    style="background: #e8e3fd; color: #6e42f5; display: inline-block; width: 100px; text-align: center; border-radius:4px; padding: 5px 10px;">Masuk</span>
                                            <?php elseif ($d['transaksi_status'] == 1): ?>
                                                <span
                                                    style="background: #feeed2; color: #e39b17; display: inline-block; width: 100px; text-align: center; border-radius:4px; padding: 5px 10px;">Diproses</span>
                                            <?php elseif ($d['transaksi_status'] == 2): ?>
                                                <span
                                                    style="background: #ddf8e6; color: #35c36c; display: inline-block; width: 100px; text-align: center; border-radius:4px; padding: 5px 10px;">Selesai</span>
                                            <?php else: ?>
                                                <p>Status Invalid</p>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php $no++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $('.content').fadeIn(1000);
</script>
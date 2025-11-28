<main class="content px-3 py-4 mb-5 mt-4">
    <div class="container-fluid">
        <div class="d-flex justify-content-between flex-wrap mb-4">
            <h4 class="fw-bold">Kelola transaksi</h4>
            <!-- Button trigger modal -->
            <button type="button" class="add-button" id="btnTambah" data-bs-toggle="modal" data-bs-target="#modalMain"
                data-tambah="transaksi">
                Tambah Transaksi
            </button>

            <!-- Modal untuk tambah data transaksi -->
            <div class="modal fade" id="modalMain" tabindex="-1" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-capitalize" id="exampleModalLabel">Tambah Transaksi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= REDIRECT . 'transaksi/tambah' ?>" method="post">
                            <div class="modal-body">
                                <div>
                                    <input type="hidden" id="idUbah" name="id">
                                    <div class="form-group mb-3">
                                        <label for="pelanggan" class="form-label">Pelanggan</label>
                                        <select name="pelanggan" class="form-select" id="pelanggan" required>
                                            <option value="">pilih</option>
                                            <?php foreach ($data['pelanggan'] as $p): ?>
                                                <option value="<?= $p['pelanggan_id'] ?>"><?= $p['pelanggan_nama'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3 hilang">
                                        <label for="tglTransaksi" class="form-label">Tgl Transaksi</label>
                                        <input type="date" name="tglTransaksi" id="tglTransaksi" class="form-control"
                                            autocomplete="off" placeholder="">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="berat" class="form-label">Berat</label>
                                        <input type="number" name="berat" id="berat" class="form-control"
                                            autocomplete="off" placeholder="Berat per kilo" required>
                                    </div>
                                    <div class="form-group mb-3 hilang">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="number" name="harga" id="harga" class="form-control"
                                            autocomplete="off" placeholder="" disabled>
                                    </div>
                                    <div class="form-group mb-3 hilang">
                                        <label for="tglSelesai" class="form-label">Tgl Transaksi Selesai</label>
                                        <input type="date" name="tglSelesai" id="tglSelesai" class="form-control"
                                            autocomplete="off" placeholder="">
                                    </div>
                                      <div class="form-group mb-3 hilang">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="form-select" id="status">
                                            <option value="">pilih</option>
                                            <option value="0">Masuk</option>
                                            <option value="1">Proses</option>
                                            <option value="2">Selesai</option>
                                        </select>
                                    </div>
                                </div>
                                <table class="table">
                                    <tr>
                                        <th>Jenis Pakaian</th>
                                        <th width="1%">Jumlah</th>
                                    </tr>
                                   <tbody class="pakaianUpdate"></tbody>
                                    <?php
                                    for ($a = 1; $a <= 5; $a++): ?>
                                        <tr class="formjenis">
                                            <td><input type="text" placeholder="Masukan Jenis" class="form-control"
                                                    name="jenis[]"></td>
                                            <td width="5%"><input type="number" class="form-control" style="width: 100px;"
                                                    placeholder="0" name="jumlah[]"></td>
                                        </tr>
                                    <?php endfor; ?>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow">
            <div class="d-flex flex-wrap justify-content-between px-5 py-4">
                <h5>Data Transaksi</h5>

                <!-- Seacrh data transaksi -->
                <form method='post' id="formSearch"
                    data-search="transaksi/<?= $data['pagination']['limit'] . '/' . $data['pagination']['hal_aktive'] ?>">
                    <div class="input-group">
                        <input type="text" id="key" name="key" class="form-control" placeholder="Cari transaksi"
                            aria-describedby="basic-addon2" autocomplete="off">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-secondary rounded-0 rounded-end-1"><i
                                    class="ri-search-2-line fw-bold"></i></button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Table untuk menampilkan data transaksi -->
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
                            <th width="25%" class="text-left" style="white-space: nowrap;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $c = $data['pagination']['awal_data'];
                        foreach ($data['transaksi'] as $d):
                            ?>
                            <tr class="row-data">
                                <th class="text-center border-0" style="white-space: nowrap; padding: 10px;"><?= $c ?></th>
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
                                <td class="border-0" style="white-space: nowrap; padding: 10px; text-align: left;">
                                    <a href="<?= REDIRECT . 'transaksi/invoice/' . $d['transaksi_id'] ?>">
                                        <button class="btninvoice">
                                            <i class="ri-bill-fill"></i>
                                            <span>Invoice</span>
                                        </button>
                                    </a>

                                    <a href="<?= REDIRECT . 'transaksi/update/' . $d['transaksi_id'] ?>" class="btnUbah"
                                        data-bs-toggle="modal" data-id="<?= $d['transaksi_id'] ?>" data-edit="transaksi"
                                        data-bs-target="#modalMain">
                                        <button class="btnedit">
                                            <i class="ri-edit-2-fill"></i>
                                            <span>Edit</span>
                                        </button>
                                    </a>

                                    <a href="<?= REDIRECT . 'transaksi/hapus/' . $d['transaksi_id'] ?>"
                                        onclick="return confirm('Apakah Kamu Yakin?')">
                                        <button class="btnhapus">
                                            <i class="ri-delete-bin-6-line"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <?php
                            $c++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination  -->
            <!-- Jumlah data yang ingin ditampilkan -->
            <div class="mt-3 px-2 py-3 d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex gap-1" style="font-size: 14px;">
                    <span class="text-secondary">Jumlah Data</span>
                    <div class="dropdown">
                        <a href="#" class="collapsed text-black d-flex align-items-baseline" role="button"
                            data-bs-toggle="collapse" data-bs-target="#dataPerPage" aria-expanded="false"
                            aria-controls="dataPerPage">
                            <span style="margin-right: -2px;"
                                class="fw-semibold"><?= $data['pagination']['limit'] ?></span>
                            <i class="ri-arrow-drop-down-line"></i>
                        </a>
                        <ul id="dataPerPage" class="dropdown-menu collapase">
                            <a href="<?= REDIRECT . 'transaksi/5' ?>" class="text-black">
                                <li class="dropdown-item">
                                    <span>5</span>
                                </li>
                            </a>
                            <a href="<?= REDIRECT . 'transaksi/10' ?>" class="text-black">
                                <li class="dropdown-item">
                                    <span>10</span>
                                </li>
                            </a>
                            <a href="<?= REDIRECT . 'transaksi/15' ?>" class="text-black">
                                <li class="dropdown-item">
                                    <span>15</span>
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>

                <!-- Halaman yang ditampilkan -->
                <div class="d-flex align-items-center " style="font-size: 14px;">
                    <span class="text-secondary">Menampilkan
                        <?= $data['pagination']['awal_data'] . '-' . $data['pagination']['akhir_data'] . ' dari ' . $data['pagination']['jumlah_data'] . ' Data' ?></span>
                    <div>
                        <?php if ($data['pagination']['hal_aktive'] == 1): ?>
                            <a href="" class="text-black">
                                <i class="ri-arrow-drop-left-line" style="font-size: 28px;"></i>
                            </a>
                        <?php else: ?>
                            <a href="<?= REDIRECT . 'transaksi/' . $data['pagination']['limit'] . '/' . $data['pagination']['hal_aktive'] - 1 ?>"
                                class="text-black">
                                <i class="ri-arrow-drop-left-line" style="font-size: 28px;"></i>
                            </a>
                        <?php endif ?>


                        <?php if ($data['pagination']['hal_aktive'] == $data['pagination']['jumlah_hal']): ?>
                            <a href="" class="text-black">
                                <i class="ri-arrow-drop-right-line" style="font-size: 28px;"></i>
                            </a>
                        <?php else: ?>
                            <a href="<?= REDIRECT . 'transaksi/' . $data['pagination']['limit'] . '/' . $data['pagination']['hal_aktive'] + 1 ?>"
                                class="text-black">
                                <i class="ri-arrow-drop-right-line" style="font-size: 28px;"></i>
                            </a>
                        <?php endif ?>
                    </div>
                </div>

            </div>

        </div>

    </div>

</main>
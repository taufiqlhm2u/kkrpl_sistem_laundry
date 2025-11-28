<main class="content px-3 py-4 mb-5 mt-4">
    <div class="container-fluid">
        <div class="d-flex justify-content-between flex-wrap mb-4">
            <h4 class="fw-bold">Kelola Pelanggan</h4>
            <!-- Button trigger modal -->
            <button type="button" class="add-button" id="btnTambah" data-bs-toggle="modal" data-bs-target="#tambahPel" data-tambah="pelanggan">
                Tambah Pelanggan
            </button>

            <!-- Modal untuk tambah data pelanggan -->
            <div class="modal fade" id="tambahPel" tabindex="-1" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-capitalize" id="exampleModalLabel">Tambah Pelanggan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= REDIRECT . 'pelanggan/tambah' ?>" method="post">
                            <div class="modal-body">
                                <input type="hidden" id="idUbah" name="id">
                                <div class="form-group mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control" autocomplete="off"
                                        placeholder="Masukan nama" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nohp" class="form-label">No. Hp</label>
                                    <input type="number" name="nohp" id="nohp" class="form-control" autocomplete="off"
                                        placeholder="0812xxxxxxx" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" rows="5"
                                        placeholder="Masukan alamat lengkap" required></textarea>
                                </div>
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
                <h5>Daftar Pelanggan</h5>

                <!-- Seacrh data pelanggan -->
                <form
                    method='post' id="formSearch" data-search="pelanggan/<?= $data['pagination']['limit'] . '/' . $data['pagination']['hal_aktive'] ?>">
                    <div class="input-group">
                        <input type="text" id="key" name="key" class="form-control" placeholder="Cari Pelanggan"
                            aria-describedby="basic-addon2" autocomplete="off">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-secondary rounded-0 rounded-end-1"><i
                                    class="ri-search-2-line fw-bold"></i></button>
                        </div>
                    </div>
                </form>
            </div>

             <!-- Table untuk menampilkan data pelanggan -->
            <div class="table-responsive">
                <table class="table table-hover" style="width: 100%;">
                    <thead>
                        <tr>
                            <th width="2%" class="text-left" style="white-space: nowrap;">No</th>
                            <th class="text-left" style="white-space: nowrap;">Nama</th>
                            <th class="text-left" style="white-space: nowrap;">No HP</th>
                            <th class="text-left" style="white-space: nowrap;">Alamat</th>
                            <th width="25%" class="text-left" style="white-space: nowrap;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $c = $data['pagination']['awal_data'];
                        foreach ($data['pelanggan'] as $p):
                            ?>
                            <tr class="row-data">
                                <th class="text-center border-0"
                                    style="white-space: nowrap; padding-top: 5px; padding-bottom: 5px;"><?= $c ?></th>
                                <td class="text-left border-0"
                                    style="white-space: nowrap; padding-top: 5px; padding-bottom: 5px;">
                                    <?= ucwords($p['pelanggan_nama']) ?></td>
                                <td class="text-left border-0"
                                    style="white-space: nowrap; padding-top: 5px; padding-bottom: 5px;">
                                    <?= $p['pelanggan_hp'] ?></td>
                                <td class="text-left border-0"
                                    style="wword-wrap: break-word; padding-top: 5px; padding-bottom: 5px;">
                                    <?= ucwords($p['pelanggan_alamat']) ?></td>
                                <td class="border-0"
                                    style="white-space: nowrap; padding-top: 5px; padding-bottom: 5px; text-align: left;">
                                    <a href="<?= REDIRECT . 'pelanggan/update/' . $p['pelanggan_id'] ?>" class="btnUbah" data-bs-toggle="modal" data-id="<?= $p['pelanggan_id']?>" data-edit="pelanggan" data-bs-target="#tambahPel">
                                        <button class="btnedit">
                                            <i class="ri-edit-2-fill"></i>
                                            <span>Edit</span>
                                        </button>
                                    </a>
                                    <a href="<?= REDIRECT . 'pelanggan/hapus/' . $p['pelanggan_id'] ?>"
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
                            <a href="<?= REDIRECT . 'pelanggan/5' ?>" class="text-black">
                                <li class="dropdown-item">
                                    <span>5</span>
                                </li>
                            </a>
                            <a href="<?= REDIRECT . 'pelanggan/10' ?>" class="text-black">
                                <li class="dropdown-item">
                                    <span>10</span>
                                </li>
                            </a>
                            <a href="<?= REDIRECT . 'pelanggan/15' ?>" class="text-black">
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
                            <a href="<?= REDIRECT . 'pelanggan/' . $data['pagination']['limit'] . '/' . $data['pagination']['hal_aktive'] - 1 ?>"
                                class="text-black">
                                <i class="ri-arrow-drop-left-line" style="font-size: 28px;"></i>
                            </a>
                        <?php endif ?>


                        <?php if ($data['pagination']['hal_aktive'] == $data['pagination']['jumlah_hal']): ?>
                            <a href="" class="text-black">
                                <i class="ri-arrow-drop-right-line" style="font-size: 28px;"></i>
                            </a>
                        <?php else: ?>
                            <a href="<?= REDIRECT . 'pelanggan/' . $data['pagination']['limit'] . '/' . $data['pagination']['hal_aktive'] + 1 ?>"
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
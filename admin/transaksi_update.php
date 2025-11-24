<?php

include_once '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // harga 
    $harga = $db->query('SELECT * FROM harga');
    $harga = $harga->fetch(PDO::FETCH_ASSOC);

    $tgl = $_POST['tgl'];
    $id_p = (int) $_POST['id'];
    $berat = (int) $_POST['berat'];
    $tgl_selesai = $_POST['tgl_selesai'];
    $tgl_selesai = (isset($tgl_selesai)) ? $tgl_selesai : null;
    $status = (int) $_POST['status'];
    $id_t = $_POST['id_t'];
    $harga = $berat * (int) $harga['harga_perkilo'];

    // pakaian
    $id_pakaian = $_POST['id_pakaian'];
    $jenisPakaian = $_POST['jenisPakaian'];
    $jumlahPakaian = $_POST['jumlahPakaian'];

    function filterArray($array)
    {
        $filter = array_filter($array, function ($value) {
            return !empty($value) || $value === 0;
        });
        return $filter;
    }
    // tambah
    if (isset($_POST['tambahJenis']) && isset($tambahJumlah)) {
        $jenis = filterArray($_POST['tambahJenis']);
        $jumlah = filterArray($_POST['tambahJumlah']);
    }

    try {

        // cek apakah tgl_selesai kosong
        if (empty($tgl_selesai)) {
            $update = $db->prepare('UPDATE transaksi SET 
                transaksi_tgl = :tgl, 
                pelanggan_id = :id_p, 
                transaksi_harga = :harga, 
                transaksi_berat = :berat, 
                transaksi_tgl_selesai = :tgl_selesai, 
                transaksi_status = :status WHERE transaksi_id = :id_t');
            $upd = $update->execute([
                'tgl' => $tgl,
                'id_p' => $id_p,
                'berat' => $berat,
                'harga' => $harga,
                'tgl_selesai' => NULL,
                'status' => $status,
                'id_t' => $id_t,
            ]);
        } else {
            $update = $db->prepare('UPDATE transaksi SET 
                transaksi_tgl = :tgl, 
                pelanggan_id = :id_p, 
                transaksi_harga = :harga, 
                transaksi_berat = :berat, 
                transaksi_tgl_selesai = :tgl_selesai, 
                transaksi_status = :status WHERE transaksi_id = :id_t');
            $upd = $update->execute([
                'tgl' => $tgl,
                'id_p' => $id_p,
                'berat' => $berat,
                'harga' => $harga,
                'tgl_selesai' => $tgl_selesai,
                'status' => $status,
                'id_t' => $id_t,
            ]);
        }


        for ($a = 0; $a < count($jenisPakaian); $a++) {
            $jumlahPakaian[$a] = (int) $jumlahPakaian[$a];
            $pakaian_update = $db->prepare('UPDATE pakaian SET 
                          pakaian_jenis = :jenis,
                          pakaian_jumlah = :jumlah
                          WHERE pakaian_id = :id');
            $pakaian_upd = $pakaian_update->execute(array(
                'jenis' => $jenisPakaian[$a],
                'jumlah' => $jumlahPakaian[$a],
                'id' => $id_pakaian[$a],
            ));
        }

        if (isset($jenis) && isset($jumlah)) {
            for ($c = 0; $c < count($jenis); $c++) {
                $tambah = $db->prepare('INSERT INTO pakaian VALUES (NULL, :id, :jenis, :jumlah)');

                $tambah->execute(array(
                    'id' => $id_t,
                    'jenis' => $jenis[$c],
                    'jumlah' => $jumlah[$c]
                ));
            }
        }


        // cek apakah update berhasil
        if ($upd) {
            echo "<script> alert('Data berhasil diupdate '); document.location.href='transaksi';</script>";
        } else {
            throw new Exception('ERROR');
        }
    } catch (Exception $e) {
        echo "<script> alert('Data GAGAL diupdate ')";
        throw $e;
    }

} else {
    header('Location:transaksi');
}

// EOF
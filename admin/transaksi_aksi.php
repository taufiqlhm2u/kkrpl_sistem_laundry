<?php
date_default_timezone_set('Asia/Jakarta');
include_once '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     
        // ambil harga 
    $harga = $db->query('SELECT * FROM harga');
    $harga = $harga->fetch(PDO::FETCH_ASSOC);
    $harga = (int) $harga['harga_perkilo'];

    
    $tgl = date('Y-m-d');
    $id = (int) $_POST['id'];
    $berat = (int) $_POST['berat'];
    $harga = $harga * $berat;
    $status = 0;
    
    function filterArray($array) {
    $filter = array_filter($array, function($value) {
    return !empty($value) || $value === 0;
    });
    return $filter;
    }

    $jenisPakaian = filterArray($_POST['jenisPakaian']);
    $jumlahPakaian = filterArray($_POST['jumlahPakaian']);
    
    try {
        $tambah = $db->prepare('INSERT INTO transaksi(transaksi_tgl, pelanggan_id, transaksi_harga, transaksi_berat, transaksi_status) VALUES (:tgl, :id_p, :harga, :berat, :status)');
        $ins = $tambah->execute([
            'tgl' => $tgl,
            'id_p' => $id,
            'berat' => $berat,
            'harga' => $harga,
            'status' => $status,
        ]);

        $lastId = $db->lastInsertId();
        for ($a = 0; $a < count($jenisPakaian); $a++) {
            $jumlahPakaian[$a] = (int) $jumlahPakaian[$a];
            $ins2 = $db->prepare('INSERT INTO pakaian(transaksi_id, pakaian_jenis, pakaian_jumlah) VALUES (:transaksi, :jenis, :jumlah )');
            $ins2->execute(array(
                'transaksi'=> $lastId,
                'jenis'=> $jenisPakaian[$a],
                'jumlah'=> $jumlahPakaian[$a],
            ));
        }
        if ($ins && $ins2) {
            echo "<script> alert('Data Berhasil ditambahkan'); document.location.href='transaksi';</script>";
        } else {
            throw new Exception('ERROR');
        }
    } catch (Exception $e) {
        echo "<script> alert('Data gagal ditambahkan'); document.location.href='transaksi_tambah';</script>";
    }

} else {
    header('Location: transaksi_tambah');
}

// EOF
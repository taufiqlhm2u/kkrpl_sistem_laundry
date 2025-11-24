<?php

include_once '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $hp = $_POST['hp'];
    $alamat = htmlspecialchars($_POST['alamat']);

    try {
        $insert = $db->prepare('INSERT INTO pelanggan(pelanggan_nama, pelanggan_hp, pelanggan_alamat) VALUES (:nama, :hp, :alamat)');
        $ins = $insert->execute([
            'nama' => $nama,
            'hp' => $hp,
            'alamat' => $alamat
        ]);

        if ($ins) {
            echo "<script> alert('Data telah di tambahkan '); document.location.href='pelanggan';</script>";
        } else {
            throw new Exception('ERROR');
        }
    } catch (Exception $e) {
        echo "<script> alert('Data gagal ditambahkan'); document.location.href='pelanggan_tambah';</script>";

    }
} else {
    header('Location:pelanggan');
}

// EOF
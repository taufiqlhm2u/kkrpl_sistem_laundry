<?php

include_once '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $hp = $_POST['hp'];
    $alamat = htmlspecialchars($_POST['alamat']);
    $id = $_POST['id'];

    try {
        $update = $db->prepare('UPDATE pelanggan SET pelanggan_nama = :nama,
                            pelanggan_hp = :hp,
                            pelanggan_alamat = :alamat 
                            WHERE pelanggan_id = :id');
        $upd = $update->execute([
            'nama' => $nama,
            'hp' => $hp,
            'alamat' => $alamat,
            'id' => $id,
        ]);

        if ($upd) {
            echo "<script> alert('Data berhasil diupdate'); document.location.href='pelanggan';</script>";
        } else {
            throw new Exception('Gagal diupdate');
        }
    } catch (PDOException $e) {
        echo "<script> alert('Data gagal diupdate'); document.location.href='pelanggan_edit';</script>";
    }
} else {
    header('location: pelanggan_edit');
}

// EOF
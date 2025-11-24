<?php

include_once '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $harga = $_POST['harga'];

    $price = $db->prepare('UPDATE harga SET harga_perkilo = :harga');
    $upd = $price->execute(array('harga' => $harga));
    if ($upd) {
        echo "<script> alert('Harga berhasil diupdate'); document.location.href='pelanggan';</script>";
    } else {
        echo "<script> alert('Harga GAGAL diupdate'); document.location.href='pelanggan';</script>";
    }
}

// EOF
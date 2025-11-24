<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location:pelanggan');
}

include_once '../config/koneksi.php';

try {
    $hapus_pk = $db->prepare('DELETE FROM pakaian WHERE transaksi_id = :id');
    $hapus_pk->execute(array('id'=> $id));

    $hapus = $db->prepare('DELETE FROM transaksi WHERE transaksi_id = :id');
    $del = $hapus->execute(array('id' => $id));
    if ($del) {
        echo "<script> alert('Data berhasil dihapus'); document.location.href='transaksi';</script>";
    } else {
        throw new Exception('Error');
    }
} catch (PDOException $e) {
    echo "<script> alert('Gagal Dihapus'); document.location.href='transaksi';</script>";
}

// EOF
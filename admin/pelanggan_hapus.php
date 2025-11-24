<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location:pelanggan');
}

include_once '../config/koneksi.php';

try {
    $delete = $db->prepare('DELETE FROM pelanggan WHERE pelanggan_id = :id');
    $del = $delete->execute(['id' => $id]);
    if ($del) {
        echo "<script> alert('Data telah berhasil dihapus '); document.location.href='pelanggan';</script>";
    } else {
        throw new Exception("Error");
    }
} catch (PDOException $e) {
    echo "<script> alert('404 Data masih digunakan di tabel lain!! '); document.location.href='pelanggan';</script>";

}

// EOF
<?php

session_start();
include_once('../config/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pw_lama = htmlspecialchars($_POST['pw_lama']);
    $pw_baru = htmlspecialchars($_POST['pw_baru']);
    $cek = htmlspecialchars($_POST['cek_pw']);

    $pw_admin = $db->prepare('SELECT * FROM admin WHERE id = :id');
    $pw_admin->execute(array('id' => $_SESSION['id'], ));
    $pw_admin = $pw_admin->fetch(PDO::FETCH_ASSOC);

    if (password_verify($pw_lama, $pw_admin['password'])) {
        if ($pw_baru === $cek) {
            $new_pass = password_hash($pw_baru, PASSWORD_DEFAULT);
            try {
                $password = $db->prepare('UPDATE admin SET password = :pass');
                $ganti_password = $password->execute(array('pass' => $new_pass));
                if ($ganti_password) {
                    echo "<script> alert('Password berhasil diganti'); document.location.href='index';</script>";
                } else {
                    throw new Exception('ERROR');
                }
            } catch (Exception $e) {
                echo "<script> alert('Password gagal diganti'); document.location.href='password';</script>";
            }
        } else {
                header("Location:password?gagal=konfir");
        }
    } else {
    header("Location:password.php?gagal=old");
    }
} else {
    header("Location:password");
}
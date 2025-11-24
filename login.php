<?php
session_start();
include_once 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    
    // $data = mysqli_query($db, "SELECT * FROM `admin` WHERE username = '$username' && password = '$pass'");
    // $cek = mysqli_num_rows($data);
    $data = $db->prepare('SELECT * FROM `admin` WHERE username = :username');
    $data->execute([
        'username' => $username,
    ]);

    $cek = $data->fetch();

    if ($cek) {
        if (password_verify($password, $cek['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $cek['id'];
            $_SESSION['status'] = 'login';
            header('Location:admin/');
            exit;
        } else {
            header("Location:index?pesan=gagal");
            exit;
        }
    } else {
        header("Location:index?pesan=gagal");
        exit;
    }
}

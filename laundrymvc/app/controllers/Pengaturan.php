<?php 

class Pengaturan extends Controller
{
    public function ubahHarga()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $harga = $_POST['harga'];

            if ($this->model('Pengaturan_model')->ubahHarga($harga) > 0) {
                Flasher::setFlash('Harga', 'Berhasil', 'Di Ubah', 'alert-success');
            } else {
                Flasher::setFlash('Harga', 'Gagal', 'Di Ubah', 'alert-danger');
            }

            header('Location:'. REDIRECT . 'dashboard');
        }
         header('Location:'. REDIRECT. 'dashboard');
    }

    public function ubahPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $oldpass = htmlspecialchars($_POST['oldpass']);
            $newpass = password_hash(htmlspecialchars($_POST['newpass']), PASSWORD_DEFAULT);

            if ($this->model('Pengaturan_model')->ubahPassword($oldpass, $newpass) == 'berhasil') {
                Flasher::setFlash('Password', 'Berhasil', 'Di Ubah', 'alert-success');
            } elseif ($this->model('Pengaturan_model')->ubahPassword($oldpass, $newpass) == 'beda') {
                Flasher::setFlash('', 'Password Lama', 'Salah', 'alert-danger');
            } else {
                Flasher::setFlash('Password', 'Gagal', 'Di Ubah', 'alert-danger');
            }

            header('Location:'. REDIRECT . 'dashboard');
        }
         header('Location:'. REDIRECT. 'dashboard');
    }
}
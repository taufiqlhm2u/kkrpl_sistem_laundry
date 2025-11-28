<?php

class Flasher
{
    public static function setFlash($pesan, $cond, $status, $alert)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'cond' => $cond,
            'status' => $status,
            'alert' => $alert
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo '<div class="alert ' . $_SESSION['flash']['alert'] . ' alert-dismissible fade show flash" role="alert">
                 ' . $_SESSION['flash']['pesan'] . '
                <strong>' . $_SESSION['flash']['cond'] . '</strong> ' . $_SESSION['flash']['status'] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['flash']);
        }
    }
}
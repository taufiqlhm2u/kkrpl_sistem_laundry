<?php

class Login extends Controller
{
    public function index()
    {
        $data['judul'] = 'Login';
        $this->view('templates/headerLogin', $data);
        $this->view('login/index', );
    }

    public function loginCek()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $log = $this->model('Login_model')->loginCek($_POST);
            echo $log;
        }
    }

    public function logOut()
    {
        session_destroy();
        session_unset();
        $_SESSION= [];

        echo "<script>alert('Anda Telah Log out'); document.location.href='" . REDIRECT . "login'" . "</script>";
    }
}
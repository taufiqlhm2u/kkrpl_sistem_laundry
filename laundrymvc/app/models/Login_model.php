<?php

class Login_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function loginCek($data)
    {
        $log = '';
        $username = htmlspecialchars($data['username']);
        $pass = htmlspecialchars($data['pass']);
        $this->db->query('SELECT * FROM admins WHERE username = :user');
        $this->db->bind('user', $username);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            $user = $this->db->single();
            if (password_verify($pass, $user['password'])) {
                $_SESSION['ID_LOGIN'] = $user['id'];
                $_SESSION['USER_LOGIN'] = $user['username'];
                $_SESSION['USER_PROFILE'] = $user['profile'];
                $log = "<script>alert('Selamat Datang'); document.location.href='" . REDIRECT . "dashboard'" . "</script>";
            } else {
                $log = "<script>alert('Password Salah'); document.location.href='" . REDIRECT . "login'" . "</script>";
            }
        } else {
            $log = "<script>alert('Username Tidak Ditemukan'); document.location.href='" . REDIRECT . "login'" . "</script>";
        }
       
        return $log;  
    }
}
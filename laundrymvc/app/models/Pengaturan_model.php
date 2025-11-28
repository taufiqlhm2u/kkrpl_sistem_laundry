<?php


class Pengaturan_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function ubahHarga($harga)
    {
        try {
            $this->db->query('UPDATE harga SET harga_perkilo = :harga');
            $this->db->bind('harga', $harga);
            $this->db->execute();
            return $this->db->rowCount();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function ubahPassword($oldpass, $newpass)
    {

        $verify = '';

       try {
         $this->db->query('SELECT * FROM admins WHERE id = :id');
        $this->db->bind('id', $_SESSION['ID_LOGIN']);
        $this->db->execute();
        $log = $this->db->single();

        if (password_verify($oldpass, $log['password'])){
            $this->db->query('UPDATE admins SET password = :pass');
            $this->db->bind('pass', $newpass);
            $this->db->execute();
            $this->db->rowCount();

            $verify = 'berhasil';
        } else {
            $verify = 'beda';
        }
       } catch (PDOException $e) {
        $verify = $e;
       }

        return $verify;
    }
}
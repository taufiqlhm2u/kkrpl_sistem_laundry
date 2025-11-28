<?php

class Dashboard_model {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function row($tabel) {
        $this->db->query('SELECT * FROM ' . $tabel);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function status ($status) {
        $this->db->query('SELECT * FROM transaksi WHERE transaksi_status = ' . $status);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function lastTransaction () {
        $this->db->query('SELECT * FROM transaksi t JOIN pelanggan p ON t.pelanggan_id = p.pelanggan_id ORDER BY t.transaksi_id DESC LIMIT 5');
        $this->db->execute();
        return $this->db->fetch();
    }
}
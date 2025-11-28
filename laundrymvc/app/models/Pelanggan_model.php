<?php

class Pelanggan_model
{
    private $db;
    private $table = 'pelanggan';

    public function __construct()
    {
        $this->db = new Database();
    }

    public function idPelanggan($id)
    {
        $this->db->query('SELECT * FROM pelanggan WHERE pelanggan_id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // Select pelanggan dengan pagination
    public function getPelanggan($limit, $offset)
    {
        $this->db->query("SELECT * FROM pelanggan ORDER BY pelanggan_nama ASC LIMIT $limit OFFSET $offset");
        $this->db->execute();
        return $this->db->fetch();
    }

    public function tambahPelanggan($pelanggan)
    {
        $nama = htmlspecialchars($pelanggan['nama']);
        $nohp = htmlspecialchars($pelanggan['nohp']);
        $alamat = htmlspecialchars($pelanggan['alamat']);

        $this->db->query('INSERT INTO pelanggan (pelanggan_nama, pelanggan_hp, pelanggan_alamat) VALUES(:nama, :hp, :alamat)');
        $this->db->bind('nama', $nama);
        $this->db->bind('hp', $nohp);
        $this->db->bind('alamat', $alamat);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function rowPelanggan()
    {
        $this->db->query('SELECT * FROM pelanggan');
        $this->db->execute();
        return $this->db->rowCount();
    }

    // logic pagination
    public function pagination($limit, $page)
    {
        switch ($limit) {
            case 5:
                $l = 5;
                break;
            case 10:
                $l = 10;
                break;
            case 15:
                $l = 15;
                break;
            default:
                $l = 5;
                break;
        }

        $jumlahHal = ceil($this->rowPelanggan() / $l);
        $halAktive = ($page <= $jumlahHal) ? $hal = $page : 1;
        $awalData = ($l * $halAktive) - $l + 1;
        $akhirData = $l * $halAktive;
        $akhirData = ($akhirData < $this->rowPelanggan()) ? $akhirData : $this->rowPelanggan();
        $offset = ($halAktive * $l) - $l;

        $pagination = [
            'limit' => $l,
            'jumlah_hal' => $jumlahHal,
            'hal_aktive' => $halAktive,
            'awal_data' => $awalData,
            'akhir_data' => $akhirData,
            'jumlah_data' => $this->rowPelanggan(),
            'offset' => $offset
        ];
        return $pagination;
    }

    public function search($nama)
    {
        $key = '%' . $nama . '%';
        $this->db->query("SELECT * FROM pelanggan WHERE pelanggan_nama LIKE CONCAT('%',:key,'%')");
        $this->db->bind('key', $key);
        $this->db->execute();
        return $this->db->fetch();
    }

    public function hapus($id)
    {
        try {
            $this->db->query('DELETE FROM pelanggan WHERE pelanggan_id = :id');
            $this->db->bind('id', $id);
            $this->db->execute();
        } catch (PDOException $e) {
            Flasher::setFlash('Data Pelangga', 'Gagal', 'Dihapus', 'alert-danger');
            return 0;
        }
        return $this->db->rowCount();
    }

    public function getPelangganById($id)
    {
        $this->db->query('SELECT * FROM pelanggan WHERE pelanggan_id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->single();
    }

    public function update($pelanggan)
    {
        $nama = htmlspecialchars($pelanggan['nama']);
        $nohp = htmlspecialchars($pelanggan['nohp']);
        $alamat = htmlspecialchars($pelanggan['alamat']);
        $id = htmlspecialchars($pelanggan['id']);

        try {
            $this->db->query('UPDATE pelanggan SET
                        pelanggan_nama = :nama,
                        pelanggan_hp = :hp,
                        pelanggan_alamat = :alamat
                        WHERE pelanggan_id = :id');

            $this->db->bind('nama', $nama);
            $this->db->bind('hp', $nohp);
            $this->db->bind('alamat', $alamat);
            $this->db->bind('id', $id);

            $this->db->execute();
        } catch (PDOException $d) {
            return false;
        }

        return $this->db->rowCount();

    }
}
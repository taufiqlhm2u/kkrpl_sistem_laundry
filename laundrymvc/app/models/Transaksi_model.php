<?php
date_default_timezone_set('Asia/Jakarta');
class Transaksi_model
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }


    // mendapatkan data transakasi
    public function getTransaksi($limit, $offset)
    {
        $this->db->query('SELECT * FROM transaksi t 
                         JOIN pelanggan p ON p.pelanggan_id = t.pelanggan_id
                         ORDER BY t.transaksi_id DESC LIMIT :limit OFFSET :offset');

        $this->db->bind('limit', $limit);
        $this->db->bind('offset', $offset);

        $this->db->execute();
        return $this->db->fetch();
    }


    // mencari data transaksi
    public function search($search)
    {
        $this->db->query("SELECT * FROM transaksi t 
                         JOIN pelanggan p ON p.pelanggan_id = t.pelanggan_id
                         JOIN pakaian pk on pk.transaksi_id = t.transaksi_id
                         WHERE p.pelanggan_nama LIKE concat('%', :key, '%') || 
                         t.transaksi_tgl LIKE concat('%' , :key, '%') ||
                         t.transaksi_tgl_selesai LIKE concat('%' , :key, '%') ||
                         t.transaksi_berat LIKE concat('%' , :key, '%') || 
                         t.transaksi_harga LIKE concat('%' , :key, '%') ");

        $this->db->bind('key', $search);

        $this->db->execute();
        return $this->db->fetch();
    }


    // menghitung jumlah baris 
    public function rowTransaksi()
    {
        $this->db->query('SELECT * FROM transaksi t 
                         JOIN pelanggan p ON p.pelanggan_id = t.pelanggan_id
                         ORDER BY t.transaksi_id DESC');

        $this->db->execute();
        return $this->db->rowCount();
    }


    // untuk pagination
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

        $jumlahHal = ceil($this->rowTransaksi() / $l);
        $halAktive = ($page <= $jumlahHal) ? $hal = $page : 1;
        $awalData = ($l * $halAktive) - $l + 1;
        $akhirData = $l * $halAktive;
        $akhirData = ($akhirData < $this->rowTransaksi()) ? $akhirData : $this->rowTransaksi();
        $offset = ($halAktive * $l) - $l;

        $pagination = [
            'limit' => $l,
            'jumlah_hal' => $jumlahHal,
            'hal_aktive' => $halAktive,
            'awal_data' => $awalData,
            'akhir_data' => $akhirData,
            'jumlah_data' => $this->rowTransaksi(),
            'offset' => $offset
        ];
        return $pagination;
    }

    // data harga 
    private function harga()
    {
        $this->db->query('SELECT harga_perkilo FROM harga');
        $this->db->execute();
        $harga = $this->db->single();
        return $harga['harga_perkilo'];
    }

    private function filterArray($ar)
    {
        $filter = array_filter($ar, function ($value) {
            return !empty($value) || $value === 0;
        });
        return $filter;
    }


    // tambah data
    public function tambah($t)
    {


        // harga
        $harga = (int) $this->harga();
        // data tanggal hari ini
        $tgl = date('Y/m/d');

        // ambil data
        $pelanggan = $t['pelanggan'];
        $berat = htmlspecialchars($t['berat']);

        // mencari harga
        $harga = $berat * $harga;


        // pakaian 


        $jenisPakaian = $this->filterArray($t['jenis']);
        $jumlahPakaian = $this->filterArray($t['jumlah']);

        // tambahkan
        try {
            $this->db->query('INSERT INTO transaksi(transaksi_tgl, pelanggan_id, transaksi_harga, transaksi_berat) VALUES (:tgl, :pelanggan, :harga, :berat)');
            $this->db->bind('tgl', $tgl);
            $this->db->bind('pelanggan', $pelanggan);
            $this->db->bind('harga', $harga);
            $this->db->bind('berat', $berat);
            $this->db->execute();

            $last = $this->db->last();
            for ($a = 0; $a < count($jenisPakaian); $a++) {

                $this->db->query('INSERT INTO pakaian (transaksi_id, pakaian_jenis, pakaian_jumlah) VALUES (:last, :jenis, :jumlah)');
                $this->db->bind('last', $last);
                $this->db->bind('jenis', $jenisPakaian[$a]);
                $this->db->bind('jumlah', $jumlahPakaian[$a]);
                $this->db->execute();
            }

            return $this->db->rowCount();
        } catch (PDOException $e) {
            throw $e;
        }

    }

    // guna mendapatkan nama pelanggan
    public function getPelanggan()
    {
        $this->db->query('SELECT * FROM pelanggan');
        $this->db->execute();
        return $this->db->fetch();
    }

    // untuk menapilkan data pada fitur update
    public function getTransaksiId($id)
    {
        $this->db->query('SELECT * FROM transaksi t 
                         JOIN pelanggan p ON p.pelanggan_id = t.pelanggan_id Where t.transaksi_id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->single();
    }

    public function getPakaian($id)
    {
        $this->db->query('SELECT * FROM pakaian Where transaksi_id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->fetch();
    }


    // ubah data
    public function update($u)
    {
        $harga = (int) $this->harga();

        $idTransaksi = $u['id'];
        $pelanggan = $u['pelanggan'];
        $tglTransaksi = $u['tglTransaksi'];
        $berat = $u['berat'];
        $harga = $berat * $harga;
        $tglSelesai = $u['tglSelesai'];
        $tglSelesai = (isset($tglSelesai)) ? $tglSelesai : null;
        $status = $u['status'];

        $idPakaian = $u['idPakaian'];

        $jenisUpdate = $this->filterArray($u['jenisUpdate']);
        $jumlahUpdate = $this->filterArray($u['jumlahUpdate']);

        // tambahan
        $jenis = $this->filterArray($u['jenis']);
        $jumlah = $this->filterArray($u['jumlah']);

        $row = '';


        try {

            /*
             ** update transaksi
             ** dengan mengecek apakah tgl_selesai ada isinya atau tidak 
             */

            if (empty($tglSelesai)) {
                $this->db->query('UPDATE transaksi SET transaksi_tgl = :tgl ,pelanggan_id = :pelanggan,
                   transaksi_berat = :berat, transaksi_harga = :harga , transaksi_status = :status
                    WHERE transaksi_id = :id');

                $this->db->bind('tgl', $tglTransaksi);
                $this->db->bind('pelanggan', $pelanggan);
                $this->db->bind('berat', $berat);
                $this->db->bind('harga', $harga);
                $this->db->bind('status', $status);
                $this->db->bind('id', $idTransaksi);

            } else {

                $this->db->query('UPDATE transaksi SET transaksi_tgl = :tgl ,pelanggan_id = :pelanggan,
                     transaksi_berat = :berat, transaksi_harga = :harga , transaksi_tgl_selesai = :tglselesai,
                     transaksi_status = :status WHERE transaksi_id = :id');

                $this->db->bind('tgl', $tglTransaksi);
                $this->db->bind('pelanggan', $pelanggan);
                $this->db->bind('berat', $berat);
                $this->db->bind('harga', $harga);
                $this->db->bind('tglselesai', $tglSelesai);
                $this->db->bind('status', $status);
                $this->db->bind('id', $idTransaksi);

            }
            $this->db->execute();
            $row = $this->db->rowCount();


            // update pakaian
            for ($a = 0; $a < count($jenisUpdate); $a++) {

                $this->db->query('UPDATE pakaian SET pakaian_jenis = :jenisUp , pakaian_jumlah = :jumlahUp
                WHERE pakaian_id = :id');

                $this->db->bind('jenisUp', $jenisUpdate[$a]);
                $this->db->bind('jumlahUp', $jumlahUpdate[$a]);
                $this->db->bind('id', $idPakaian[$a]);

                $this->db->execute();

                $row = $row + $this->db->rowCount();
            }

            // tambah pakaian apabila ada
            if (isset($jenis) && isset($jumlah)) {
                for ($a = 0; $a < count($jenis); $a++) {
                    $this->db->query('INSERT INTO pakaian(transaksi_id, pakaian_jenis, pakaian_jumlah) VALUES
                 (:id, :jenis, :jumlah)');
                    $this->db->bind('id', $idTransaksi);
                    $this->db->bind('jenis', $jenis[$a]);
                    $this->db->bind('jumlah', $jumlah[$a]);
                    $this->db->execute();
                }
                $row = $row + $this->db->rowCount();
            }

            return $row;

        } catch (PDOException $e) {
            return 0;
        }


    }

    // hapus pakaian
    public function hapuspakaian($id)
    {
        try {
            $this->db->query('DELETE FROM pakaian WHERE pakaian_id = :id');
            $this->db->bind('id', $id);
            $this->db->execute();
            return $this->db->rowCount();
        } catch (\Throwable $th) {
            return 0;
        }
    }

    // hapus transaksi
    public function hapus($id)
    {
        $row = '';

        $this->db->query('DELETE FROM pakaian WHERE transaksi_id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
        $row = $this->db->rowCount();

        $this->db->query('DELETE FROM transaksi WHERE transaksi_id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
        $row = $row + $this->db->rowCount();

        return $row;
    }

    // invoice 

    public function invoiceTransaksi($id)
    {
        $this->db->query('SELECT * FROM transaksi t 
                        JOIN pelanggan p on t.pelanggan_id = p.pelanggan_id
                        WHERE t.transaksi_id = :id');

        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->single();
    }

    public function invoicePakaian($id)
    {
        $this->db->query('SELECT * FROM pakaian WHERE transaksi_id = :id');

        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->fetch();
    }

    // untuk laporan
    public function transaksiDate($dari, $sampai)
    {
       try {
         $this->db->query('SELECT * FROM transaksi t 
                        JOIN pelanggan p on t.pelanggan_id = p.pelanggan_id
                        WHERE t.transaksi_tgl BETWEEN :dari AND :sampai');

        $this->db->bind('dari', $dari);
        $this->db->bind('sampai', $sampai);
        $this->db->execute();
        return $this->db->fetch();

       } catch (PDOException $e) {
        return 0;
       }
    } 
}
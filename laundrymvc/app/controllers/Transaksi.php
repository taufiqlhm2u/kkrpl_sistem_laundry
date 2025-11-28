<?php

class Transaksi extends Controller
{
    public function index($limit = 5, $page = 1, $search = null)
    {
        $data['judul'] = 'Transaksi';
        $pagination = $this->model('Transaksi_model')->pagination($limit, $page);
        if (is_null($search)) {
            $data['transaksi'] = $this->model('Transaksi_model')->getTransaksi($pagination['limit'], $pagination['offset']);
        } else {
            $data['transaksi'] = $this->model('Transaksi_model')->search($search);
        }

        $data['pelanggan'] = $this->model('Transaksi_model')->getPelanggan();
        $data['pagination'] = $pagination;
        $data['update'] = 'transaksi.js';
        $data['css'] = BASEURL . 'css/table.css';
        $this->view('templates/header', $data);
        $this->view('transaksi/index', $data);
        $this->view('templates/footer', $data);
    }

    public function tambah()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->model('Transaksi_model')->tambah($_POST) > 0) {
                Flasher::setFlash('Data Transaksi', 'Berhasil', 'Ditambahkan', 'alert-success');
            } else {
                Flasher::setFlash('Data Transaksi', 'Gagal', 'Ditambahkan', 'alert-danger');
            }

            header('Location:' . REDIRECT . 'transaksi');
        } else {
            header('Location:' . REDIRECT . 'transaksi');
        }
    }

    public function getTransaksiId()
    {
        echo json_encode([
            'transaksi' => $this->model('Transaksi_model')->getTransaksiId($_POST['id']),
            'pakaian' => $this->model('Transaksi_model')->getPakaian($_POST['id'])
        ]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->model('Transaksi_model')->update($_POST) > 0) {
                Flasher::setFlash('Data Transaksi', 'Berhasil', 'DiUbah', 'alert-success');
            } else {
                Flasher::setFlash('Data Transaksi', 'Gagal', 'DiUbah', 'alert-danger');
            }
            header('Location:' . REDIRECT . 'transaksi');
        } else {
            header('Location:' . REDIRECT . 'transaksi');
        }
    }

    public function hapuspakaian($id)
    {
         if ($this->model('Transaksi_model')->hapuspakaian($id) > 0) {
                Flasher::setFlash('Data Pakaian', 'Berhasil', 'Di Hapus', 'alert-success');
            } else {
                Flasher::setFlash('Data Pakaian', 'Gagal', 'Di Hapus', 'alert-danger');
            }
            header('Location:' . REDIRECT . 'transaksi');
        
    }

    public function hapus($id)
    {
         if ($this->model('Transaksi_model')->hapus($id) > 0) {
                Flasher::setFlash('Data Transaksi', 'Berhasil', 'Di Hapus', 'alert-success');
            } else {
                Flasher::setFlash('Data Transaksi', 'Gagal', 'Di Hapus', 'alert-danger');
            }
            header('Location:' . REDIRECT . 'transaksi');
        
    }
    
    public function invoice($id)
    {
        $data['transaksi'] = $this->model('Transaksi_model')->invoiceTransaksi($id);
     
        $data['pakaian'] = $this->model('Transaksi_model')->invoicePakaian($id);

        $this->view('transaksi/invoice', $data);
    }

    public function cetak_invoice($id)
    {
        $data['transaksi'] = $this->model('Transaksi_model')->invoiceTransaksi($id);
     
        $data['pakaian'] = $this->model('Transaksi_model')->invoicePakaian($id);

        $this->view('transaksi/cetak_invoice', $data);
    }
}
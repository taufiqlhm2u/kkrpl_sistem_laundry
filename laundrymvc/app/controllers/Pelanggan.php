<?php


class Pelanggan extends Controller
{

    public function index($dataPerPage = 5, $page = 1, $search = null)
    {
        $data['judul'] = 'Pelanggan';
        $pagination = $this->model('Pelanggan_model')->pagination($dataPerPage, $page);
        if (is_null($search)) {
            $data['pelanggan'] = $this->model('Pelanggan_model')->getPelanggan($pagination['limit'], $pagination['offset']);
        } else {
            $data['pelanggan'] = $this->model('Pelanggan_model')->search($search);
        }
        $data['pagination'] = $pagination;
        $data['css'] = BASEURL . 'css/table.css';
        $data['update'] = 'update.js';
        $this->view('templates/header', $data);
        $this->view('pelanggan/index', $data);
        $this->view('templates/footer', $data);
    }

    public function tambah()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->model('Pelanggan_model')->tambahPelanggan($_POST) > 0) {
                Flasher::setFlash('Data Pelanggan', 'Berhasil', 'Ditambahkan', 'alert-success');
            } else {
                Flasher::setFlash('Data Pelanggan', 'Gagal', 'Ditambahkan', 'alert-danger');
            }
            header('Location:' . REDIRECT . 'pelanggan');
        } else {
            header('Location:' . REDIRECT . 'pelanggan');
        }
    }

    public function hapus($id)
    {
        if ($this->model('Pelanggan_model')->idPelanggan($id) > 0) {
            
            if ($this->model('Pelanggan_model')->hapus($id) > 0) {
                Flasher::setFlash('Data Pelanggan', 'Berhasil', 'Dihapus', 'alert-success');
            } else {
                Flasher::setFlash('Data Pelanggan', 'Gagal', 'Dihapus', 'alert-danger');
            }

            header('Location:' . REDIRECT . 'pelanggan');
        } else {
            header('Location:' . REDIRECT . 'pelanggan');
        }
    }

    public function getUbah() 
    {
     echo json_encode($this->model('Pelanggan_model')->getPelangganById($_POST['id']));
    }

    public function update()
    {
       if ($this->model('Pelanggan_model')->update($_POST) > 0) {
        Flasher::setFlash('Data Pelanggan', 'Berhasil', 'Diubah', 'alert-success');
       } else {
        Flasher::setFlash('Data Pelanggan', 'Gagal', 'Diubah', 'alert-danger');
       }

       header('Location:' . REDIRECT . 'pelanggan');
    }
}
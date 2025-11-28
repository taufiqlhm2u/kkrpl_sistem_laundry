<?php 

class Laporan extends Controller
{
    public function index($dari = null, $sampai = null) 
    {
        $data['judul'] = 'Laporan';
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $data['laporan'] = $this->model('Transaksi_model')->transaksiDate($dari, $sampai);
        
        $this->view('templates/header', $data);
        $this->view('laporan/index', $data);
        $this->view('templates/footer');
    }

    public function cetak_laporan($dari = null, $sampai = null) 
    {
        $data['judul'] = 'Laporan';
        $data['dari'] = $dari;
        $data['sampai'] = $sampai;

        $data['laporan'] = $this->model('Transaksi_model')->transaksiDate($dari, $sampai);
        
        $this->view('laporan/cetak_laporan', $data);
    }
}
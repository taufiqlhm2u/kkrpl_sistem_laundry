<?php

class Dashboard extends Controller{
    public function index() {

        $data['judul'] = 'Dashboard';
        $data['rowPelanggan'] = $this->model('Dashboard_model')->row('pelanggan');
        $data['masuk'] = $this->model('Dashboard_model')->status(0);
        $data['proses'] = $this->model('Dashboard_model')->status(1);
        $data['selesai'] = $this->model('Dashboard_model')->status(2);
        $data['last'] = $this->model('Dashboard_model')->lastTransaction();
        $data['css'] = BASEURL . 'css/dashboard.css';
        $this->view('templates/header', $data);
        $this->view('dashboard/index', $data);
        $this->view('templates/footer');
    }
}
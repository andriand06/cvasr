<?php

namespace App\Controllers;

use App\Models\barang_model;
use App\Models\barangkeluar_model;
use App\Models\pelanggan_model;

class Admin extends BaseController
{
    protected $barangmodel;
    protected $barangkeluarmodel;
    protected $pelangganmodel;
    public function __construct()
    {
        $this->barangmodel = new barang_model();
        $this->barangkeluarmodel = new barangkeluar_model();
        $this->pelangganmodel = new pelanggan_model();
    }
    public function index()
    {
        if ($this->cek_status()) {
            return redirect()->to('login');
        }
        $session = \config\Services::session();
        $data = [
            'judul' => 'Admin CV.ASR',
            'isi' => 'Admin',
            'username' => $session->get('username'),
            'datecreated' => $session->get('datecreated'),
            'barang' => $this->barangmodel->getBarang(),
        ];
        $session->set($data);
        return view('admin/index.php', $data);
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\pelanggan_model;

class Pelanggan extends BaseController
{
    protected $pelangganmodel;
    public function __construct()
    {
        $this->pelangganmodel = new pelanggan_model();
        $this->cek_status();
    }
    public function index()
    {
        if ($this->cek_status()) {
            return redirect()->to('login');
        }
        $session = \Config\Services::session();
        $pager = \Config\Services::pager();
        $keyword = $this->request->getPost('keyword');
        if ($keyword) {
            $pelanggan = $this->pelangganmodel->getLike($keyword);
        } else {
            $pelanggan = $this->pelangganmodel;
        }
        $data =
            [
                'judul' => 'Data Pelanggan',
                'isi' => $pelanggan->paginate(6),
                'pager' => $this->pelangganmodel->pager,
                'username' => $session->get('username'),
                'datecreated' => $session->get('datecreated'),

            ];
        return view('pelanggan/index', $data);
    }
    public function tambah()
    {
        if ($this->cek_status()) {
            return redirect()->to('/login');
        }

        $session = \config\Services::session();
        $data = [
            'judul' => 'Tambah Data Pelanggan',
            'username' =>  $session->get('username'),
            'datecreated' => $session->get('datecreated'),
            'validation' => \Config\Services::validation()
        ];
        return view('pelanggan/tambah', $data);
    }
    public function save()
    {
        if ($this->cek_status()) {
            return redirect()->to('/login');
        }
        $session = \config\Services::session();
        if (!$this->validate([
            'namapelanggan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ],
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ],
            ],
            'notelp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} Format harus dalam bentuk angka',
                ],
            ],

        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/pelanggan/tambah')->withInput()->with('validation', $validation);
        }
        $this->pelangganmodel->save([
            'namapelanggan' => $this->request->getVar('namapelanggan'),
            'alamat' => $this->request->getVar('alamat'),
            'notelp' => (string)$this->request->getVar('notelp'),
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('tambah');
    }
    public function delete($id)
    {
        if ($this->cek_status()) {
            return redirect()->to('/login');
        }
        $this->pelangganmodel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to('/pelanggan');
    }
    public function edit($id)
    {
        if ($this->cek_status()) {
            return redirect()->to('/login');
        }
        $session = \config\Services::session();
        $data = [
            'judul' => 'Ubah Data Pelanggan',
            'validation' => \Config\Services::validation(),
            'isi' =>  $this->pelangganmodel->getData($id),
            'username' =>  $session->get('username'),
            'datecreated' => $session->get('datecreated'),
        ];

        return view('pelanggan/edit', $data);
    }
    public function update($id)
    {
        if ($this->cek_status()) {
            return redirect()->to('/login');
        }

        if (!$this->validate([
            'namapelanggan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',

                ],
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',

                ],
            ],

            'notelp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} Format harus dalam bentuk angka',
                ],
            ],

        ])) {

            $validation = \Config\Services::validation();

            return redirect()->to('/barang/edit/' . $id)->withInput()->with('validation', $validation);
        }

        $this->pelangganmodel->save([
            'id' => $id,
            'namapelanggan' => $this->request->getVar('namapelanggan'),
            'alamat' => $this->request->getVar('alamat'),
            'notelp' => $this->request->getVar('notelp'),


        ]);
        session()->setFlashdata('pesan', 'Data Berhasil diubah');
        return redirect()->to('/pelanggan');
    }
}

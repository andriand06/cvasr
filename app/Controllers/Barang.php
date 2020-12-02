<?php

namespace App\Controllers;

use App\Models\barang_model;

class Barang extends BaseController
{
    protected $barangmodel;
    public function __construct()
    {
        $this->barangmodel = new barang_model();
    }
    public function index()
    {
        $session = \config\Services::session();
        $data = [
            'judul' => 'Data Barang',
            'isi' => $this->barangmodel->getBarang(),

            'username' =>  $session->get('username'),
            'datecreated' => $this->request->getPost('datecreated'),

        ];

        echo view('barang/index.php', $data);
    }
    public function tambah()
    {
        session();
        $session = \config\Services::session();
        $data = [

            'username' =>  $session->get('username'),
            'datecreated' => $session->get('datecreated'),
            'validation' => \Config\Services::validation()
        ];
        echo view('barang/tambah.php', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'kode' => [
                'rules' => 'required|is_unique[barang.kode]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
            'namabarang' => [
                'rules' => 'required|is_unique[barang.namabarang]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ],
            ],
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} Format harus dalam bentuk angka',
                ],
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} Format harus dalam bentuk angka',
                ],
            ],
        ])) {

            $validation = \Config\Services::validation();

            return redirect()->to('/barang/tambah')->withInput()->with('validation', $validation);
        }
        //$slug = url_title($this->request->getVar('kode'), '-', true);
        $this->barangmodel->save([
            'Kode' => $this->request->getVar('kode'),
            //'slug' => $slug,
            'NamaBarang' => $this->request->getVar('namabarang'),
            'Satuan' => $this->request->getVar('satuan'),
            'Jumlah' => $this->request->getVar('jumlah'),
            'Harga' => $this->request->getVar('harga'),

        ]);
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
        return redirect()->to('tambah');
    }

    public function delete($id)
    {
        $this->barangmodel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to('/barang');
    }
    public function edit($id)
    {

        $session = \config\Services::session();
        $data = [

            'validation' => \Config\Services::validation(),
            'isi' =>  $this->barangmodel->getData($id),
            'username' =>  $session->get('username'),
            'datecreated' => $session->get('datecreated'),
        ];

        return view('barang/edit', $data);
    }
    public function update($id)
    {
        $barangLama = $this->barangmodel->getData($id);

        if ($barangLama['Kode'] == $this->request->getVar('kode')) {
            $rule = 'required';
        } else {
            $rule = 'required|is_unique[barang.kode]';
        }
        if (!$this->validate([
            'kode' => [
                'rules' => $rule,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
            'namabarang' => [
                'rules' => 'required|is_unique[barang.namabarang]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ],
            ],
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} Format harus dalam bentuk angka',
                ],
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} Format harus dalam bentuk angka',
                ],
            ],
        ])) {

            $validation = \Config\Services::validation();

            return redirect()->to('/barang/edit/' . $barangLama['id'])->withInput()->with('validation', $validation);
        }

        $this->barangmodel->save([
            'id' => $id,
            'Kode' => $this->request->getVar('kode'),

            'NamaBarang' => $this->request->getVar('namabarang'),
            'Satuan' => $this->request->getVar('satuan'),
            'Jumlah' => $this->request->getVar('jumlah'),
            'Harga' => $this->request->getVar('harga'),

        ]);
        session()->setFlashdata('pesan', 'Data Berhasil diubah');
        return redirect()->to('/barang');
    }
}

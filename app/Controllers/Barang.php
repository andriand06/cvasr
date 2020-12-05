<?php

namespace App\Controllers;

use App\Models\barang_model;

class Barang extends BaseController
{
    protected $barangmodel;
    public function __construct()
    {
        $this->barangmodel = new barang_model();
        $this->cek_status();
    }
    public function index()
    {
        if ($this->cek_status()) {
            return redirect()->to('login');
        }
        $session = \config\Services::session();
        $pager = \Config\Services::pager();
        $keyword = $this->request->getPost('keyword');
        if ($keyword) {
            $barang = $this->barangmodel->getLike($keyword);
            // $data = [
            //'judul' => 'Barang',
            //'isi' => $this->barangmodel->getLike($keyword),
            //'username' => $session->get('username'),
            //'datecreated' => $session->get('datecreated')

            // ];
            //echo view('barang/index.php', $data);
        } else {
            $barang = $this->barangmodel;
        }
        $data = [
            'judul' => 'Data Barang',
            'isi' => $barang->paginate(6),
            'pager' => $this->barangmodel->pager,
            'username' =>  $session->get('username'),
            'datecreated' => $session->get('datecreated'),

        ];

        echo view('barang/index.php', $data);
    }
    public function tambah()
    {
        if ($this->cek_status()) {
            return redirect()->to('/login');
        }
        session();
        $session = \config\Services::session();
        $data = [
            'judul' => 'Tambah Data Barang',
            'username' =>  $session->get('username'),
            'datecreated' => $session->get('datecreated'),
            'validation' => \Config\Services::validation()
        ];
        echo view('barang/tambah.php', $data);
    }

    public function save()
    {
        if ($this->cek_status()) {
            return redirect()->to('/login');
        }
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
        if ($this->cek_status()) {
            return redirect()->to('/login');
        }
        $this->barangmodel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to('/barang');
    }
    public function edit($id)
    {
        if ($this->cek_status()) {
            return redirect()->to('/login');
        }
        $session = \config\Services::session();
        $data = [
            'judul' => 'Ubah Data Barang',
            'validation' => \Config\Services::validation(),
            'isi' =>  $this->barangmodel->getData($id),
            'username' =>  $session->get('username'),
            'datecreated' => $session->get('datecreated'),
        ];

        return view('barang/edit', $data);
    }
    public function update($id)
    {
        if ($this->cek_status()) {
            return redirect()->to('/login');
        }
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
    public function penjualan()
    {
        $session = \Config\Services::session();
        $validation = \Config\Services::validation();

        if (isset($_GET['namabarang'])) {
            $isi = $_GET['namabarang'];
            $barang = $this->barangmodel->where('namabarang', $isi)->get()->getRowArray();

            if (!$this->validate([
                'jumlah' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'numeric' => '{field} Format harus dalam bentuk angka',
                    ],
                ],
            ])) {
                $data = [
                    'judul' => 'Penjualan Barang',
                    'username' => $session->get('username'),
                    'datecreated' => $session->get('datecreated'),

                    'barang' => $barang,
                    'validation' => $validation,
                    'Kode' => $this->request->getVar('kode'),
                    'NamaBarang' => $isi,
                    'Jumlah' => $this->request->getVar('jumlah'),
                    'Satuan' => $this->request->getVar('satuan'),
                    'Harga' => $this->request->getVar('harga'),
                    'Total' => $this->request->getVar('jumlah') * $this->request->getVar('harga')
                ];
            }

            session()->setFlashdata('error', 'Mohon Lengkapi Form');
            return view('barang/penjualan', $data);
        }

        $barang = $this->barangmodel->getBarang();

        $data = [
            'judul' => 'Penjualan Barang',

            'username' => $session->get('username'),
            'datecreated' => $session->get('datecreated'),
            'barang' => $barang,

            'Kode' => '',
            'Jumlah' => '',
            'Satuan' => '',
            'Harga' => '',
            'Total' => $this->request->getVar('jumlah') * $this->request->getVar('harga')

        ];

        return view('barang/penjualan', $data);
    }
    public function transaksi()
    {
        $session = \Config\Services::session();
        $validation = \Config\Services::validation();
        $selected = $this->request->getVar('namabarang');
        if (!$this->validate([
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} Format harus dalam bentuk angka',
                ],
            ],
        ])) {

            $data = [
                'judul' => 'Penjualan Barang',
                'username' => $session->get('username'),
                'datecreated' => $session->get('datecreated'),
                'selected' => $selected,
                'barang' => $this->barangmodel->getNamaBarang($selected),
                'validation' => $validation,
                'Kode' => $this->request->getVar('kode'),
                'NamaBarang' => $selected,
                'Jumlah' => $this->request->getVar('jumlah'),
                'Satuan' => $this->request->getVar('satuan'),
                'Harga' => $this->request->getVar('harga'),
                'Total' => $this->request->getVar('jumlah') * $this->request->getVar('harga')
            ];
            session()->setFlashdata('error', 'Mohon Lengkapi Form');
            return view('/barang/penjualan', $data);
        }

        $data = [
            'judul' => 'Penjualan Barang',
            'username' => $session->get('username'),
            'datecreated' => $session->get('datecreated'),
            'selected' => $selected,
            'barang' => $this->barangmodel->getNamaBarang($selected),
            'validation' => $validation,
            'Kode' => $this->request->getVar('kode'),
            'NamaBarang' => $selected,
            'Jumlah' => $this->request->getVar('jumlah'),
            'Satuan' => $this->request->getVar('satuan'),
            'Harga' => $this->request->getVar('harga'),
            'Total' => $this->request->getVar('jumlah') * $this->request->getVar('harga')
        ];
        return view('barang/penjualan', $data);
    }
    public function read()
    {
        $validation = \Config\Services::validation();
        $selected = $this->request->getVar('namabarang');
        $session = \Config\Services::session();
        $data = [
            'judul' => 'Penjualan Barang',
            'username' => $session->get('username'),
            'datecreated' => $session->get('datecreated'),
            'selected' => $selected,
            'barang' => $this->barangmodel->getNamaBarang($selected),
            'validation' => $validation,
            'Kode' => $this->request->getVar('kode'),
            'NamaBarang' => $selected,
            'Jumlah' => $this->request->getVar('jumlah'),
            'Satuan' => $this->request->getVar('satuan'),
            'Harga' => $this->request->getVar('harga'),
            'Total' => $this->request->getVar('jumlah') * $this->request->getVar('harga')
        ];
        return view('barang/penjualan', $data);
    }
}

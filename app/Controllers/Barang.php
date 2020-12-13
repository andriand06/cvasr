<?php

namespace App\Controllers;

use App\Models\barang_keluar_model;
use App\Models\barang_model;
use App\Models\barangkeluar_model;
use App\Models\pelanggan_model;
use CodeIgniter\I18n\Time;
use CodeIgniter\Session\Session;
use TheSeer\Tokenizer\Token;

class Barang extends BaseController
{
    protected $barangmodel;
    protected $barangkeluar_model;
    protected $pelanggan_model;
    public $namapelanggan;

    public $nb;

    public function __construct()
    {
        $this->barangmodel = new barang_model();
        $this->cek_status();
        $this->barangkeluar_model = new barangkeluar_model();
        $this->pelanggan_model = new pelanggan_model();
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
    // public function barangkeluar()
    // {
    //     if ($this->cek_status()) {
    //         return redirect()->to('/login');
    //     }
    //     $session = \Config\Services::session();
    //     $validation = \Config\Services::validation();

    //     if (isset($_GET['namabarang'])) {
    //         $isi = $_GET['namabarang'];
    //         $barang = $this->barangmodel->where('namabarang', $isi)->get()->getRowArray();
    //         $tgl = new Time('now');

    //         if (!$this->validate([
    //             'jumlah' => [
    //                 'rules' => 'required|numeric',
    //                 'errors' => [
    //                     'required' => '{field} harus diisi',
    //                     'numeric' => '{field} Format harus dalam bentuk angka',
    //                 ],
    //             ],
    //         ])) {
    //             $jumlah = $this->request->getVar('jumlah');
    //             if ($jumlah == '' | $jumlah == null) {
    //                 $total = 0;
    //             }
    //             $total = (int)$jumlah * (int)$this->request->getVar('harga');
    //             $data = [
    //                 'judul' => 'Barang Keluar',
    //                 'username' => $session->get('username'),
    //                 'datecreated' => $session->get('datecreated'),
    //                 'tgl' => $tgl,
    //                 'barang' => $barang,
    //                 'validation' => $validation,
    //                 'KodeTransaksi' => $this->barangmodel->getKodeTransaksi(),
    //                 'Kode' => $this->request->getVar('kode'),
    //                 'NamaBarang' => $isi,
    //                 'Jumlah' =>  $jumlah = $this->request->getVar('jumlah'),
    //                 'Satuan' => $this->request->getVar('satuan'),
    //                 'Harga' => $this->request->getVar('harga'),
    //                 'Total' => $total
    //             ];
    //         }

    //         session()->setFlashdata('error', 'Mohon Lengkapi Form');

    //         return view('barang/barangkeluar', $data);
    //     } else {
    //         $data = [
    //             'judul' => 'Barang Keluar',

    //             'username' => $session->get('username'),
    //             'datecreated' => $session->get('datecreated'),
    //             'barang' => $this->barangmodel->getBarang(),
    //             'KodeTransaksi' => $this->barangmodel->getKodeTransaksi(),
    //             'Kode' => '',
    //             'Jumlah' => '',
    //             'Satuan' => '',
    //             'Harga' => '',
    //             'Total' => $this->request->getVar('jumlah') * $this->request->getVar('harga')

    //         ];

    //         return view('barang/barangkeluar', $data);
    //     }
    // }
    public function barangkeluar()
    {
        list($day, $month, $year, $hour, $min, $sec) = explode("/", date('d/m/Y/h/i/s'));
        $tgl = $month . $day . $year . $hour . $min . $sec;
        $session = \Config\Services::session();

        if ($this->cek_status()) {
            return redirect()->to('/login');
        }


        if (isset($_POST['namabarang'])) {
            $this->nb = $_POST['namabarang'];
            $b = $this->barangmodel->where('namabarang', $this->nb)->get()->getRowArray();
            $jumlah = $_POST['jumlah'];
            $isi = [

                'kode' => $b['Kode'],
                'namabarang' => $b['NamaBarang'],
                'satuan' => $b['Satuan'],
                'jumlah' => $jumlah,
                'harga' => $b['Harga'],


            ];


            $_SESSION['isi'][] = $isi;



            $data = [
                'judul' => 'Barang Keluar',
                'username' => $session->get('username'),
                'datecreated' => $session->get('datecreated'),
                'namabarang' => $this->nb,
                'tgl' => $tgl,
                'isi' => $_SESSION['isi'],




                'barang' => $this->barangmodel->getBarang()
            ];
            return view('barang/barangkeluar', $data);
        } elseif ($this->nb == null | $this->nb == '') {

            $data = [
                'judul' => 'Barang Keluar',
                'username' => $session->get('username'),
                'datecreated' => $session->get('datecreated'),
                'namabarang' => $this->nb,


                'kode' => '',
                'barang' => $this->barangmodel->getBarang()
            ];

            return view('barang/barangkeluar', $data);
        }

        $data = [
            'judul' => 'Barang Keluar',
            'username' => $session->get('username'),
            'datecreated' => $session->get('datecreated'),
            'nonota' => $tgl,


            'barang' => $this->barangmodel->getBarang(),
            'kode' => $session->get('kode')


        ];
        return view('barang/barangkeluar', $data);
    }
    public function read()
    {
        if ($this->cek_status()) {
            return redirect()->to('/login');
        }

        $validation = \Config\Services::validation();
        if (isset($_GET['namabarang'])) {
            $isi = $_GET['namabarang'];
        }
        $brg = $this->barangmodel->where('namabarang', $isi)->get()->getRowArray();
        $jumlah = $this->request->getVar('jumlah');
        $total = $jumlah * $this->request->getVar('harga');
        $session = \Config\Services::session();
        $data = [
            'judul' => 'Barang Keluar',
            'username' => $session->get('username'),
            'datecreated' => $session->get('datecreated'),
            'brg' => $brg,
            'barang' => $this->barangmodel->getBarang(),
            'validation' => $validation,
            'Kode' => $this->request->getVar('kode'),
            'KodeTransaksi' => $this->barangmodel->getKodeTransaksi(),
            'NamaBarang' => $isi,
            'Jumlah' => $this->request->getVar('jumlah'),
            'Satuan' => $this->request->getVar('satuan'),
            'Harga' => $this->request->getVar('harga'),
            'Total' => $this->request->getVar('jumlah') * $this->request->getVar('harga')
        ];
        return view('barang/barangkeluar', $data);
    }
    public function transaksi()
    {
        if ($this->cek_status()) {
            return redirect()->to('/login');
        }
        $jumlah = $this->request->getVar('jumlah');
        $total = (int)$jumlah * (int)$this->request->getVar('harga');

        $tanggal = date("Y-m-d H:i:s");


        // $this->barangkeluar_model->save([
        //     'Tanggal' => $tanggal,
        //     'Kode' => $this->request->getVar('kode'),
        //     'NamaBarang' => $this->request->getVar('namabarang'),
        //     'Jumlah' =>  $jumlah,
        //     'Satuan' => $this->request->getVar('satuan'),
        //     'Harga' => $this->request->getVar('harga'),
        //     'Total' => $total,
        $this->barangkeluar_model->save([]);
        $result = array();
        foreach ($_POST['namabarang'] as $key => $val) {
            $result[] = array(
                'Tanggal' => $tanggal,
                'Kode' => $_POST['kode'][$key],
                'NamaBarang' => $_POST['namabarang'][$key],
                'Satuan' => $_POST['satuan'][$key],
                'Jumlah' => $_POST['jumlah'][$key],
                'Harga' => $_POST['harga'][$key],
                'Total' => $_POST['subtotal'][$key],
            );
        }
        $this->barangkeluar_model->insertBatch($result);


        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
        return redirect()->to('/barang/barangkeluar');
    }
    public function penjualan()
    {
        list($day, $month, $year, $hour, $min, $sec) = explode("/", date('d/m/Y/h/i/s'));
        $tgl = $month . $day . $year . $hour . $min . $sec;
        $session = \Config\Services::session();

        if ($this->cek_status()) {
            return redirect()->to('/login');
        }
        if (isset($_GET['namapelanggan'])) {
            $this->namapelanggan = $_GET['namapelanggan'];
        }

        $query = $this->pelanggan_model->where('namapelanggan', $this->namapelanggan)->first();
        if (isset($_POST['namabarang'])) {
            $this->nb = $_POST['namabarang'];
            $b = $this->barangmodel->where('namabarang', $this->nb)->get()->getRowArray();
            $jumlah = $_POST['jumlah'];
            $isi = [

                'kode' => $b['Kode'],
                'namabarang' => $b['NamaBarang'],
                'satuan' => $b['Satuan'],
                'jumlah' => $jumlah,
                'harga' => $b['Harga'],

            ];


            $_SESSION['isi'][] = $isi;



            $data = [
                'judul' => 'Penjualan Barang',
                'username' => $session->get('username'),
                'datecreated' => $session->get('datecreated'),
                'namabarang' => $this->nb,
                'pelanggan' => $this->pelanggan_model->getPelanggan(),
                'query' => $query,
                'isi' => $_SESSION['isi'],


                'barang' => $this->barangmodel->getBarang()
            ];
            return view('barang/penjualan', $data);
        } elseif ($this->nb == null | $this->nb == '') {

            $data = [
                'judul' => 'Penjualan Barang',
                'username' => $session->get('username'),
                'datecreated' => $session->get('datecreated'),
                'namabarang' => $this->nb,
                'pelanggan' => $this->pelanggan_model->getPelanggan(),
                'query' => $query,
                'kode' => '',
                'barang' => $this->barangmodel->getBarang()
            ];

            return view('barang/penjualan', $data);
        }

        $data = [
            'judul' => 'Penjualan Barang',
            'username' => $session->get('username'),
            'datecreated' => $session->get('datecreated'),
            'nonota' => $tgl,
            'pelanggan' => $this->pelanggan_model->getPelanggan(),
            'query' => $query,
            'barang' => $this->barangmodel->getBarang(),
            'kode' => $session->get('kode')


        ];
        return view('barang/penjualan', $data);
    }


    public function reset()
    {
        if ($this->cek_status()) {
            return redirect()->to('login');
        }
        $_SESSION['isi'] = [];
        return redirect()->to('/barang/penjualan');
    }
    public function resetbarang()
    {
        if ($this->cek_status()) {
            return redirect()->to('login');
        }
        $_SESSION['isi'] = [];
        return redirect()->to('/barang/barangkeluar');
    }
    public function hapustransaksi()
    {
        if ($this->cek_status()) {
            return redirect()->to('login');
        }
        $kode = $_GET['kode'];

        $isi = $_SESSION['isi'];


        $k = array_filter($isi, function ($i) use ($kode) {
            return ($i['kode'] == $kode);
        });

        foreach ($k as $key => $value) {

            unset($_SESSION['isi'][$key]);
        }

        $_SESSION['isi'] = array_values($_SESSION['isi']);

        session()->setFlashdata('pesan', 'data berhasil dihapus!');

        return redirect()->to('/barang/penjualan')->withInput();
    }
    // public function perbarui()
    // {
    //     $jumlah = $_POST['jumlah'];

    //     foreach ($_SESSION['isi'] as $key) {
    //         $key['jumlah'] = $jumlah[$key];
    //     }
    //     return redirect()->to('/barang/penjualan');
    // }
}

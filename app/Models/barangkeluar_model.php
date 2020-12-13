<?php

namespace App\Models;

use CodeIgniter\Model;

class barangkeluar_model extends Model
{
    protected $table = 'barang_keluar';

    protected $allowedFields = ['Tanggal', 'Kode', 'NamaBarang', 'Satuan', 'Jumlah', 'Harga', 'Total'];
}

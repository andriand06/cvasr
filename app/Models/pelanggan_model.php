<?php

namespace App\Models;

use CodeIgniter\Model;

class pelanggan_model extends Model
{
    protected $table = 'pelanggan';
    protected $allowedFields = ['namapelanggan', 'alamat', 'notelp'];
    public function getPelanggan()
    {
        return $this->findAll();
    }
    public function getLike($keyword)
    {

        return $this->table('pelanggan')->like('namapelanggan', $keyword)->orLike('alamat', $keyword)->orLike('notelp', $keyword);
    }
    public function getData($id)
    {
        return $this->where(['id' => $id])->first();
    }
}

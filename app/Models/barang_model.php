<?php

namespace App\Models;

use CodeIgniter\Model;

class barang_model extends Model
{
    protected $table = 'barang';
    protected $useTimestamps = true;
    protected $allowedFields = ['Kode', 'NamaBarang', 'Satuan', 'Jumlah', 'Harga'];

    public function getBarang($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }
    public function getData($id)
    {
        return $this->where(['id' => $id])->first();
    }
    public function editBarang($id)
    {
        return $this->db->table('barang')->where('id', $id)->get()->getRowArray();
    }
    public function updateBarang($data, $id)
    {
        return $this->db->table('barang')->update($data, array('id' => $id));
    }
    public function getLike($keyword)
    {

        return $this->db->table('barang')->like('namabarang', $keyword)->orLike('jumlah', $keyword)->orLike('harga', $keyword)->orLike('kode', $keyword)->get()->getResultArray();
    }
}

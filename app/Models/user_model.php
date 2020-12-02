<?php

namespace App\Models;

use CodeIgniter\Model;

class user_model extends Model
{
    protected $table = 'user';
    public function get()
    {
        return $this->db->table('user')->get()->getResultArray();
    }

    public function insertUser($data)
    {
        return $this->db->table('user')->insert($data);
    }

    public function getWhere($username)
    {
        return $this->db->table('user')->getWhere(['username' => $username])->getRowArray();
    }
    public function deleteUser($id)
    {
        $this->db->table('user')->delete(['id' => $id]);
    }

    public function editUser($id)
    {
        return $this->db->table('user')->where('id', $id)->get()->getRowArray();
    }
    public function updateUser($data, $username)
    {
        return $this->db->table('user')->update($data, array('username' => $username));
    }
    public function getLike($keyword)
    {

        return $this->db->table('user')->like('namabarang', $keyword)->orLike('jumlah', $keyword)->orLike('harga', $keyword)->get()->getResultArray();
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $user = $this->db->table('user')->getWhere(['username' => $username])->getRowArray();
        if ($user) {

            if (password_verify($password, $user['password'])) {
                $data = [
                    'username' => $user['username'],

                ];
                session()->set($data);
            }
        }
    }
}

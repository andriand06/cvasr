<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index($data)
    {
        $session = \config\Services::session();
        $data = [
            'judul' => 'Admin CV.ASR',
            'isi' => 'Admin',
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'email' => $this->request->getPost('email'),
            'datecreated' => $this->request->getPost('datecreated'),
        ];
        $session->set($data);
        echo view('admin/index.php', $data);
    }
}

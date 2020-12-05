<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $session = \config\Services::session();
        $data = [
            'judul' => 'Admin CV.ASR',
            'isi' => 'Admin',
            'username' => $session->get('username'),
            'datecreated' => $session->get('datecreated'),
        ];
        $session->set($data);
        echo view('admin/index.php', $data);
    }
}

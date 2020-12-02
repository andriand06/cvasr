<?php

namespace App\Controllers;

use App\Models\user_model;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class Login extends BaseController
{
    protected $usermodel;
    public function __construct()
    {
        $this->usermodel = new user_model();
    }
    public function index()
    {
        $session = \config\Services::session();
        helper(['form', 'url']);
        $val = $this->validate([
            'username' => 'required|min_length[8]',
            'password' => 'required|min_length[8]|regex_match[/^[A-Za-z0-9]+$/]',

        ]);

        if ($val == false) {
            $data = [
                'judul' => 'Login',
                'isi' => 'Auth/index',
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),



            ];

            return view('login/login.php', $data);
        } else {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $user = $this->usermodel->getWhere($username);

            if ($user) {

                if (password_verify($password, $user['password'])) {

                    $data = [
                        'username' => $user['username'],
                        'datecreated' => $user['datecreated']

                    ];

                    $session->set($data);
                    return view('admin/index.php', $data);
                } else {
                    session()->setFlashdata('error', 'Maaf Username atau password salah');
                    return redirect()->to(base_url('Login'));
                }
            }
        }
    }
    public function Registration()
    {



        helper(['form', 'url', 'date']);
        $val = $this->validate([
            'username' => 'required|is_unique[user.username]|min_length[8]',
            'password' => 'required|min_length[8]|regex_match[/^[A-Za-z0-9]+$/]',
            'ulangipassword' => 'required|matches[password]',
            'email' => 'required|valid_email|is_unique[user.email]'

        ]);

        if ($val == false) {
            $data = [
                'judul' => 'Registrasi',
                'isi' => 'Login/registration',
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'email' => $this->request->getPost('email'),


            ];

            echo view('login/registration', $data);
        } else {
            $data = [

                'id' => '',
                'username' => htmlspecialchars($this->request->getPost('username')),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'ulangipassword' => password_hash($this->request->getPost('ulangipassword'), PASSWORD_DEFAULT),
                'email' => htmlspecialchars($this->request->getPost('email')),
                'datecreated' => new Time('now'),

            ];
            $this->usermodel->insertUser($data);
            session()->setFlashdata('success', 'Anda Berhasil Registrasi!');
            return redirect()->to(base_url('Login/index'));
            $data1 = [
                'isi' => 'Login/registration',
                'judul' => 'Registrasi',
            ];
            echo view('login/registration', $data1);
        }
    }
    public function logout()
    {
        // unset($_SESSION['username']);
        //unset($_SESSION['role_id']);
        session()->removeTempdata('username');
        session()->removeTempdata('role_id');
        session()->setFlashdata('success', 'Anda Berhasil Logout!');
        return redirect()->to(base_url('login'));
    }
}

<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }
    public function index()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        if ($request->isAJAX()) {
            $username = $request->getPost('username');
            $password = $request->getPost('password');

            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $user = $this->UserModel->where('username', $username)->first();
                if ($user < 1) {
                    $msg = [
                        'title' => 'gagallogin',
                        'usernamelogin' => 'Username Tidak Terdaftar',
                    ];
                    echo json_encode($msg);
                } else {
                    $level = $user['level'];
                    $hash_pass = $user['password'];
                    if ($user['username'] === $username && $user['password'] === base64_encode("$password")) {
                        if ($level == 'Superadmin') {
                            session()->set('username', $user['username']);
                            session()->set('password', $user['password']);
                            session()->set('nama', $user['nama']);
                            session()->set('level', $user['level']);
                            $msg = [
                                'title' => 'berhasiloperator',
                                'urloperator' => '/auth/superadmin',
                            ];
                            echo json_encode($msg);
                        } else if ($level == 'Admin') {
                            session()->set('username', $user['username']);
                            session()->set('password', $user['password']);
                            session()->set('nama', $user['nama']);
                            session()->set('level', $user['level']);
                            $msg = [
                                'title' => 'berhasiloperator',
                                'urloperator' => '/auth/admin',
                            ];
                            echo json_encode($msg);
                        }
                    } else {
                        $msg = [
                            'title' => 'gagaluser',
                            'usernamegagal' => 'Username dan Password Tidak Sesuai',
                        ];
                        echo json_encode($msg);
                    }
                }
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function superadmin()
    {
        $password = session()->get('password');
        $username = session()->get('username');

        $cek = $this->UserModel->where(['username' => $username, 'password' => $password])->first();

        session()->set('username', $cek['username']);
        session()->set('password', $cek['password']);
        session()->set('nama', $cek['nama']);
        session()->set('level', $cek['level']);
        session()->setFlashdata('loginBerhasil', 'Login Berhasil');
        return redirect()->to(base_url('/superadmin'));
    }

    public function admin()
    {
        $password = session()->get('password');
        $username = session()->get('username');

        $cek = $this->UserModel->where(['username' => $username, 'password' => $password])->first();
        session()->set('username', $cek['username']);
        session()->set('password', $cek['password']);
        session()->set('nama', $cek['nama']);
        session()->set('level', $cek['level']);
        session()->setFlashdata('loginBerhasil', 'Login Berhasil');
        return redirect()->to(base_url('/admin'));
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        session()->setFlashdata('pesanLogout', 'Berhasil Keluar !');
        return redirect()->to(base_url('/login'));
    }
}

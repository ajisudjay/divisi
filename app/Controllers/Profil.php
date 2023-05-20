<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\UserModel;
use App\Controllers\BaseController;

class Profil extends BaseController
{
    protected $BeritaModel;
    protected $UserModel;
    public function __construct()
    {
        $this->BeritaModel = new BeritaModel();
        $this->UserModel = new UserModel();
    }
    public function index()
    {
        if (session()->get('username') == NULL || session()->get('level') === 'Superadmin') {
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $data = [
                'title' => 'Beranda - Divisi.id',
                'top_header' => 'Beranda',
                'header' => 'Ubah Profil',
                'admin' => $admin,
                'lvl' => $lvl,
                'berita_belum_publish' => $this->BeritaModel->select('*')->select('berita.id as id_berita')->select('berita.kategori as kategori_berita')->select('kategori.kategori as nama_kategori')->join('kategori', 'kategori.id=berita.kategori')->where('status', 'Belum Publish')->orderBy('tanggal', 'DESC')->findAll(),
            ];
            return view('backend/profil/index', $data);
        } elseif (session()->get('username') == NULL || session()->get('level') === 'Admin') {
            $admin = session()->get('nama');
            $lvl = session()->get('level');
            $data = [
                'title' => 'Beranda - Divisi.id',
                'top_header' => 'Beranda',
                'header' => 'Ubah Profil',
                'admin' => $admin,
                'lvl' => $lvl,
                'berita_belum_publish' => $this->BeritaModel->select('*')->select('berita.id as id_berita')->select('berita.kategori as kategori_berita')->select('kategori.kategori as nama_kategori')->join('kategori', 'kategori.id=berita.kategori')->where('status', 'Belum Publish')->orderBy('tanggal', 'DESC')->findAll(),
            ];
            return view('backend/profil/index', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
    public function viewData()
    {
        if (session()->get('username') == NULL || session()->get('level') === 'Superadmin') {
            $request = \Config\Services::request();
            $username = session()->get('username');
            if ($request->isAJAX()) {
                $data = [
                    'user' => $this->UserModel->where('username', $username)->orderBy('username', 'ASC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/profil/view-data', $data)
                ];
                echo json_encode($msg);
            } else {
                exit('Data Tidak Dapat diproses');
            }
        } elseif (session()->get('username') == NULL || session()->get('level') === 'Admin') {
            $request = \Config\Services::request();
            $username = session()->get('username');
            if ($request->isAJAX()) {
                $data = [
                    'user' => $this->UserModel->where('username', $username)->orderBy('username', 'ASC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/profil/view-data', $data)
                ];
                echo json_encode($msg);
            } else {
                exit('Data Tidak Dapat diproses');
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }


    public function edit()
    {
        if (session()->get('username') == NULL || session()->get('level') === 'Superadmin') {
            $request = \Config\Services::request();
            if ($request->isAJAX()) {
                $username = $request->getVar('username');
                $nama = $request->getVar('nama');
                $password = $request->getVar('password');
                $repassword = $request->getVar('repassword');
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'username' => [
                        'label' => 'Username',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ],
                    'nama' => [
                        'label' => 'Nama',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ],
                    'password' => [
                        'label' => 'Password',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ],
                    'repassword' => [
                        'label' => 'Repassword',
                        'rules' => 'required|matches[password]',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                            'matches' => 'Konfirmasi Password Tidak Sesuai'
                        ]
                    ],
                ]);

                if (!$valid) {
                    $msg = [
                        'error' => [
                            'username' => $validation->getError('username'),
                            'nama' => $validation->getError('nama'),
                            'password' => $validation->getError('password'),
                            'repassword' => $validation->getError('repassword'),
                        ],
                    ];
                    echo json_encode($msg);
                } else {
                    $data = [
                        'username' => $username,
                        'nama' => $nama,
                        'password' => base64_encode("$password"),
                    ];

                    $this->UserModel->update($username, $data);

                    $data2 = [
                        'user' => $this->UserModel->where('username', $username)->orderBy('username', 'ASC')->get()->getResultArray(),
                    ];
                    $msg = [
                        'sukses' => 'Profil Berhasil Diubah !',
                        'status' => 'berhasil',
                        'data' => view('backend/profil/view-data', $data2)
                    ];
                    echo json_encode($msg);
                }
            } else {
                exit('Data Tidak Dapat diproses');
            }
        } elseif (session()->get('username') == NULL || session()->get('level') === 'Admin') {
            $request = \Config\Services::request();
            if ($request->isAJAX()) {
                $username = $request->getVar('username');
                $nama = $request->getVar('nama');
                $password = $request->getVar('password');
                $repassword = $request->getVar('repassword');
                $validation = \Config\Services::validation();
                $valid = $this->validate([
                    'username' => [
                        'label' => 'Username',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ],
                    'nama' => [
                        'label' => 'Nama',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ],
                    'password' => [
                        'label' => 'Password',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ],
                    'repassword' => [
                        'label' => 'Repassword',
                        'rules' => 'required|matches[password]',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                            'matches' => 'Konfirmasi Password Tidak Sesuai'
                        ]
                    ],
                ]);

                if (!$valid) {
                    $msg = [
                        'error' => [
                            'username' => $validation->getError('username'),
                            'nama' => $validation->getError('nama'),
                            'password' => $validation->getError('password'),
                            'repassword' => $validation->getError('repassword'),
                        ],
                    ];
                    echo json_encode($msg);
                } else {
                    $data = [
                        'username' => $username,
                        'nama' => $nama,
                        'password' => base64_encode("$password"),
                    ];

                    $this->UserModel->update($username, $data);

                    $data2 = [
                        'user' => $this->UserModel->where('username', $username)->orderBy('username', 'ASC')->get()->getResultArray(),
                    ];
                    $msg = [
                        'sukses' => 'Profil Berhasil Diubah !',
                        'status' => 'berhasil',
                        'data' => view('backend/profil/view-data', $data2)
                    ];
                    echo json_encode($msg);
                }
            } else {
                exit('Data Tidak Dapat diproses');
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
}

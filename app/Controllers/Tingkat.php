<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\TingkatModel;
use App\Controllers\BaseController;

class Tingkat extends BaseController
{
    protected $BeritaModel;
    protected $TingkatModel;
    public function __construct()
    {
        $this->BeritaModel = new BeritaModel();
        $this->TingkatModel = new TingkatModel();
    }
    public function index()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $admin = session()->get('nama');
        $data = [
            'title' => 'Beranda - Divisi.id',
            'top_header' => 'Beranda',
            'header' => 'Tingkat',
            'admin' => $admin,
            'berita_belum_publish' => $this->BeritaModel->select('*')->select('berita.id as id_berita')->select('berita.kategori as kategori_berita')->select('kategori.kategori as nama_kategori')->join('kategori', 'kategori.id=berita.kategori')->where('status', 'Belum Publish')->orderBy('tanggal', 'DESC')->findAll(),
        ];
        return view('backend/tingkat/index', $data);
    }
    public function viewData()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $data = [
                'tingkat' => $this->TingkatModel->orderBy('tingkat', 'ASC')->get()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            $msg = [
                'data' => view('backend/tingkat/view-data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function tambah()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $tingkat = $request->getVar('tingkat');
            $urutan = $request->getVar('urutan');
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'tingkat' => [
                    'label' => 'Tingkat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'urutan' => [
                    'label' => 'Urutan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'tingkat' => $validation->getError('tingkat'),
                        'urutan' => $validation->getError('urutan'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'tingkat' => $tingkat,
                    'urutan' => $urutan,
                ];
                $this->TingkatModel->insert($data);

                $data2 = [
                    'tingkat' => $this->TingkatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                ];
                $msg = [
                    'sukses' => 'Tingkat Berhasil Ditambahkan !',
                    'status' => 'berhasil',
                    'data' => view('backend/tingkat/view-data', $data2)
                ];
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function edit()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $id = $request->getVar('id');
            $tingkat = $request->getVar('tingkat');
            $urutan = $request->getVar('urutan');
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'tingkat' => [
                    'label' => 'Tingkat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'urutan' => [
                    'label' => 'Urutan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'tingkat' => $validation->getError('tingkat'),
                        'urutan' => $validation->getError('urutan'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'tingkat' => $tingkat,
                    'urutan' => $urutan,
                ];

                $this->TingkatModel->update($id, $data);

                $data2 = [
                    'tingkat' => $this->TingkatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                ];
                $msg = [
                    'sukses' => 'Tingkat Berhasil Diubah !',
                    'status' => 'berhasil',
                    'data' => view('backend/tingkat/view-data', $data2)
                ];
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }



    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $this->TingkatModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Tingkat Berhasil Di Hapus !');
        return redirect()->to(base_url('/tingkat'));
    }
}

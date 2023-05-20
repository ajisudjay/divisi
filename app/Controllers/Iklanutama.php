<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\IklanutamaModel;
use App\Controllers\BaseController;

class Iklanutama extends BaseController
{
    protected $BeritaModel;
    protected $IklanutamaModel;
    public function __construct()
    {
        $this->BeritaModel = new BeritaModel();
        $this->IklanutamaModel = new IklanutamaModel();
    }
    public function index()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $admin = session()->get('nama');
        $data = [
            'title' => 'Iklan Utama - Divisi.id',
            'top_header' => 'Iklan Utama',
            'header' => 'Iklan Utama',
            'admin' => $admin,
            'berita_belum_publish' => $this->BeritaModel->select('*')->select('berita.id as id_berita')->select('berita.kategori as kategori_berita')->select('kategori.kategori as nama_kategori')->join('kategori', 'kategori.id=berita.kategori')->where('status', 'Belum Publish')->orderBy('tanggal', 'DESC')->findAll(),
        ];
        return view('backend/iklanutama/index', $data);
    }
    public function viewData()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $data = [
                'iklan' => $this->IklanutamaModel->orderBy('id', 'DESC')->get()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            $msg = [
                'data' => view('backend/iklanutama/view-data', $data)
            ];
            echo json_encode($msg);
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
        $id = $request->getVar('id');
        $nama = $request->getVar('nama');
        $file = $request->getFile('file');
        $filelama = $this->IklanutamaModel->where('id', $id)->first();
        $namafilelama = $filelama['file'];
        if (!file_exists($_FILES['file']['tmp_name'])) {
            $data = [
                'nama' => $nama,
            ];
            $this->IklanutamaModel->update($id, $data);

            session()->setFlashdata('pesanInput', 'Berhasil Mengubah Iklan');
            return redirect()->to(base_url('/iklanutama'));
        } else {
            $newName = $file->getRandomName();
            $file->move('content/iklan/', $newName);
            $nama_foto = $newName;
            unlink('content/iklan/' . $namafilelama);
            $data = [
                'nama' => $nama,
                'file' => $nama_foto,
            ];
            $this->IklanutamaModel->update($id, $data);

            session()->setFlashdata('pesanInput', 'Berhasil Mengubah Iklan');
            return redirect()->to(base_url('/iklanutama'));
        }
    }
}

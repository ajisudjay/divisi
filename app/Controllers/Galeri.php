<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\GaleriModel;
use App\Controllers\BaseController;

class Galeri extends BaseController
{
    protected $BeritaModel;
    protected $GaleriModel;
    public function __construct()
    {
        $this->BeritaModel = new BeritaModel();
        $this->GaleriModel = new GaleriModel();
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
            'header' => 'Galeri',
            'admin' => $admin,
            'berita_belum_publish' => $this->BeritaModel->select('*')->select('berita.id as id_berita')->select('berita.kategori as kategori_berita')->select('kategori.kategori as nama_kategori')->join('kategori', 'kategori.id=berita.kategori')->where('status', 'Belum Publish')->orderBy('tanggal', 'DESC')->findAll(),
        ];
        return view('backend/galeri/index', $data);
    }
    public function viewData()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $data = [
                'galeri' => $this->GaleriModel->orderBy('id', 'DESC')->get()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            $msg = [
                'data' => view('backend/galeri/view-data', $data)
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

        $nama = $request->getVar('nama');
        $file = $request->getFile('file');

        $newName = $file->getRandomName();
        $file->move('content/galeri/', $newName);
        $nama_foto = $newName;
        $data = [
            'nama' => $nama,
            'file' => $nama_foto,
            'url' => 'iniurlnya',
        ];
        $this->GaleriModel->insert($data);

        session()->setFlashdata('pesanInput', 'Berhasil Menambahkan Galeri');
        return redirect()->to(base_url('/galeri'));
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
        $filelama = $this->GaleriModel->where('id', $id)->first();
        $namafilelama = $filelama['file'];
        if (!file_exists($_FILES['file']['tmp_name'])) {
            $data = [
                'nama' => $nama,
                'url' => 'urlsudahdiganti',
            ];
            $this->GaleriModel->update($id, $data);

            session()->setFlashdata('pesanInput', 'Berhasil Mengubah Gambar');
            return redirect()->to(base_url('/galeri'));
        } else {
            $newName = $file->getRandomName();
            $file->move('content/galeri/', $newName);
            $nama_foto = $newName;
            unlink('content/galeri/' . $namafilelama);
            $data = [
                'nama' => $nama,
                'file' => $nama_foto,
                'url' => 'urlsudahdiganti',
            ];
            $this->GaleriModel->update($id, $data);

            session()->setFlashdata('pesanInput', 'Berhasil Mengubah Gambar');
            return redirect()->to(base_url('/galeri'));
        }
    }



    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $cekfile = $this->GaleriModel->where('id', $id)->first();
        $namafile = $cekfile['file'];
        unlink('content/galeri/' . $namafile);
        $this->GaleriModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Gambar Berhasil Di Hapus !');
        return redirect()->to(base_url('/galeri'));
    }
}

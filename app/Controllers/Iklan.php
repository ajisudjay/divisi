<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\IklanModel;
use App\Controllers\BaseController;

class Iklan extends BaseController
{
    protected $BeritaModel;
    protected $IklanModel;
    public function __construct()
    {
        $this->BeritaModel = new BeritaModel();
        $this->IklanModel = new IklanModel();
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
            'header' => 'Iklan',
            'admin' => $admin,
            'berita_belum_publish' => $this->BeritaModel->select('*')->select('berita.id as id_berita')->select('berita.kategori as kategori_berita')->select('kategori.kategori as nama_kategori')->join('kategori', 'kategori.id=berita.kategori')->where('status', 'Belum Publish')->orderBy('tanggal', 'DESC')->findAll(),
        ];
        return view('backend/iklan/index', $data);
    }
    public function viewData()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $data = [
                'iklan' => $this->IklanModel->orderBy('id', 'DESC')->get()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            $msg = [
                'data' => view('backend/iklan/view-data', $data)
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
        $jenis_file = $request->getVar('jenis_file');
        $file = $request->getFile('file');

        $newName = $file->getRandomName();
        $file->move('content/iklan/', $newName);
        $nama_foto = $newName;
        $data = [
            'nama' => $nama,
            'file' => $nama_foto,
            'jenis_file' => $jenis_file,
            'status' => 'Belum Publish',
        ];
        $this->IklanModel->insert($data);

        session()->setFlashdata('pesanInput', 'Berhasil Menambahkan Iklan');
        return redirect()->to(base_url('/iklan'));
    }

    public function edit()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $nama = $request->getVar('nama');
        $jenis_file = $request->getVar('jenis_file');
        $file = $request->getFile('file');
        $filelama = $this->IklanModel->where('id', $id)->first();
        $namafilelama = $filelama['file'];
        if (!file_exists($_FILES['file']['tmp_name'])) {
            $data = [
                'nama' => $nama,
                'jenis_file' => $jenis_file,
            ];
            $this->IklanModel->update($id, $data);

            session()->setFlashdata('pesanInput', 'Berhasil Mengubah Iklan');
            return redirect()->to(base_url('/iklan'));
        } else {
            $newName = $file->getRandomName();
            $file->move('content/iklan/', $newName);
            $nama_foto = $newName;
            unlink('content/iklan/' . $namafilelama);
            $data = [
                'nama' => $nama,
                'file' => $nama_foto,
                'jenis_file' => $jenis_file,
            ];
            $this->IklanModel->update($id, $data);

            session()->setFlashdata('pesanInput', 'Berhasil Mengubah Iklan');
            return redirect()->to(base_url('/iklan'));
        }
    }



    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $cekfile = $this->IklanModel->where('id', $id)->first();
        $namafile = $cekfile['file'];
        unlink('content/iklan/' . $namafile);
        $this->IklanModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Iklan Berhasil Di Hapus !');
        return redirect()->to(base_url('/iklan'));
    }

    public function publish($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $data = [
            'status' => 'Publish',
        ];
        $this->IklanModel->update($id, $data);

        session()->setFlashdata('pesanInput', 'Berhasil Publish Iklan');
        return redirect()->to(base_url('/iklan'));
    }

    public function unpublish($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $data = [
            'status' => 'Belum Publish',
        ];
        $this->IklanModel->update($id, $data);

        session()->setFlashdata('pesanInput', 'Berhasil Unpublish Iklan');
        return redirect()->to(base_url('/iklan'));
    }
}

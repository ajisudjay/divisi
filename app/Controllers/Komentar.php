<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\KomentarModel;
use App\Models\TingkatModel;
use App\Models\KategoriModel;
use App\Models\KonfigurasiModel;
use App\Models\IklanModel;
use App\Controllers\BaseController;

class Komentar extends BaseController
{
    protected $BeritaModel;
    protected $KomentarModel;
    public function __construct()
    {
        $this->BeritaModel = new BeritaModel();
        $this->KomentarModel = new KomentarModel();
    }

    public function tambah()
    {
        $request = \Config\Services::request();
        $timestamp = date("Y-m-d H:i:s");
        $id_berita = $request->getVar('id_berita');
        $nama = $request->getVar('nama');
        $komentar = $request->getVar('komentar');
        $cekberita = $this->BeritaModel->where('id', $id_berita)->first();
        $slug = $cekberita['slug'];
        $data = [
            'id_berita' => $id_berita,
            'nama' => $nama,
            'komentar' => $komentar,
            'timestamp' => $timestamp,
            'id_berita' => $id_berita,

        ];
        $this->KomentarModel->insert($data);
        return redirect()->to(base_url("/berita-detail/$slug"));
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
            'header' => 'Komentar',
            'admin' => $admin,
            'berita_belum_publish' => $this->BeritaModel->select('*')->select('berita.id as id_berita')->select('berita.kategori as kategori_berita')->select('kategori.kategori as nama_kategori')->join('kategori', 'kategori.id=berita.kategori')->where('status', 'Belum Publish')->orderBy('tanggal', 'DESC')->findAll(),
        ];
        return view('backend/komentar/index', $data);
    }
    public function viewData()
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $data = [
                'komentar' => $this->KomentarModel->select('*')->select('komentar.id as id_komentar')->orderBy('komentar.timestamp', 'DESC')->orderBy('id_berita', 'DESC')->join('berita', 'berita.id=komentar.id_berita')->get()->getResultArray(),
                'validation' => \Config\Services::validation(),
            ];
            $msg = [
                'data' => view('backend/komentar/view-data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $this->KomentarModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Komentar Berhasil Di Hapus !');
        return redirect()->to(base_url('/komentar'));
    }
}

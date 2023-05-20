<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\KategoriModel;
use App\Models\TingkatModel;
use App\Controllers\BaseController;

class Berita extends BaseController
{
    protected $BeritaModel;
    protected $KategoriModel;
    protected $TingkatModel;
    public function __construct()
    {
        $this->BeritaModel = new BeritaModel();
        $this->KategoriModel = new KategoriModel();
        $this->TingkatModel = new TingkatModel();
    }

    public function editForm()
    {
        $request = \Config\Services::request();
        $admin = session()->get('nama');
        $slugx = $_GET['slug'];
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            $data = [
                'title' => 'Beranda - Divisi.id',
                'top_header' => 'Beranda',
                'header' => 'Berita',
                'header2' => 'Ubah',
                'admin' => $admin,
                'slugx' => $slugx,
                'kategori' => $this->KategoriModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                'tingkat' => $this->TingkatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                'berita' => $this->BeritaModel->select('*')->select('berita.id as id_berita')->select('berita.kategori as kategori_berita')->select('kategori.kategori as nama_kategori')->select('berita.tingkat as tingkat_berita')->select('tingkat.tingkat as nama_tingkat')->join('kategori', 'kategori.id=berita.kategori')->join('tingkat', 'tingkat.id=berita.tingkat')->where('berita.slug', $slugx)->first(),
                'validation' => \Config\Services::validation(),
                'berita_belum_publish' => $this->BeritaModel->select('*')->select('berita.id as id_berita')->select('berita.kategori as kategori_berita')->select('kategori.kategori as nama_kategori')->join('kategori', 'kategori.id=berita.kategori')->where('status', 'Belum Publish')->orderBy('tanggal', 'DESC')->findAll(),
            ];
            return view('backend/berita/edit', $data);
        } elseif (session()->get('username') == NULL || session()->get('level') !== 'Admin') {
            $data = [
                'title' => 'Beranda - Divisi.id',
                'top_header' => 'Beranda',
                'header' => 'Berita',
                'header2' => 'Ubah',
                'admin' => $admin,
                'slugx' => $slugx,
                'kategori' => $this->KategoriModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                'tingkat' => $this->TingkatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                'berita' => $this->BeritaModel->select('*')->select('berita.id as id_berita')->select('berita.kategori as kategori_berita')->select('kategori.kategori as nama_kategori')->select('berita.tingkat as tingkat_berita')->select('tingkat.tingkat as nama_tingkat')->join('kategori', 'kategori.id=berita.kategori')->join('tingkat', 'tingkat.id=berita.tingkat')->where('berita.slug', $slugx)->first(),
                'validation' => \Config\Services::validation(),
                'berita_belum_publish' => $this->BeritaModel->select('*')->select('berita.id as id_berita')->select('berita.kategori as kategori_berita')->select('kategori.kategori as nama_kategori')->join('kategori', 'kategori.id=berita.kategori')->where('status', 'Belum Publish')->orderBy('tanggal', 'DESC')->findAll(),
            ];
            return view('backend/berita/edit', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function index()
    {
        $admin = session()->get('nama');
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            $data = [
                'title' => 'Beranda - Divisi.id',
                'top_header' => 'Beranda',
                'header' => 'Berita',
                'admin' => $admin,
                'berita_belum_publish' => $this->BeritaModel->select('*')->select('berita.id as id_berita')->select('berita.kategori as kategori_berita')->select('kategori.kategori as nama_kategori')->join('kategori', 'kategori.id=berita.kategori')->where('status', 'Belum Publish')->orderBy('tanggal', 'DESC')->findAll(),
            ];
            return view('backend/berita/index', $data);
        } elseif (session()->get('username') == NULL || session()->get('level') !== 'Admin') {
            $data = [
                'title' => 'Beranda - Divisi.id',
                'top_header' => 'Beranda',
                'header' => 'Berita',
                'admin' => $admin,
                'berita_belum_publish' => $this->BeritaModel->select('*')->select('berita.id as id_berita')->select('berita.kategori as kategori_berita')->select('kategori.kategori as nama_kategori')->join('kategori', 'kategori.id=berita.kategori')->where('status', 'Belum Publish')->orderBy('tanggal', 'DESC')->findAll(),

            ];
            return view('backend/berita/index', $data);
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function viewData()
    {
        $request = \Config\Services::request();
        $admin = session()->get('username');
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            if ($request->isAJAX()) {
                $data = [
                    'kategori' => $this->KategoriModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                    'tingkat' => $this->TingkatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                    'berita' => $this->BeritaModel->select('*')->select('berita.id as id_berita')->select('berita.kategori as kategori_berita')->select('kategori.kategori as nama_kategori')->join('kategori', 'kategori.id=berita.kategori')->where('berita.admin', $admin)->orderBy('berita.tanggal', 'DESC')->orderBy('berita.timestamp', 'DESC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/berita/view-data', $data)
                ];
                echo json_encode($msg);
            } else {
                exit('Data Tidak Dapat diproses');
            }
        } elseif (session()->get('username') == NULL || session()->get('level') !== 'Admin') {
            if ($request->isAJAX()) {
                $data = [
                    'kategori' => $this->KategoriModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                    'tingkat' => $this->TingkatModel->orderBy('urutan', 'ASC')->get()->getResultArray(),
                    'berita' => $this->BeritaModel->select('*')->select('berita.id as id_berita')->select('berita.kategori as kategori_berita')->select('kategori.kategori as nama_kategori')->select('tingkat.tingkat as nama_tingkat')->join('kategori', 'kategori.id=berita.kategori')->join('tingkat', 'tingkat.id=berita.tingkat')->orderBy('berita.tanggal', 'DESC')->orderBy('berita.timestamp', 'DESC')->get()->getResultArray(),
                    'validation' => \Config\Services::validation(),
                ];
                $msg = [
                    'data' => view('backend/berita/view-data', $data)
                ];
                echo json_encode($msg);
            } else {
                exit('Data Tidak Dapat diproses');
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function tambah()
    {

        $admin = session()->get('username');
        $timestamp = date("Y-m-d H:i:s");
        $request = \Config\Services::request();

        $judul = $request->getVar('judul');
        $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($judul)));
        $tingkat = $request->getVar('tingkat');
        $kategori = $request->getVar('kategori');
        $caption = $request->getVar('caption');
        $tanggal = $request->getVar('tanggal');
        $file = $request->getFile('file');
        $isi = $request->getVar('isi');
        $tag = $request->getVar('tag');
        $jenis_file = $request->getVar('jenis_file');

        $newName = $file->getRandomName();
        $file->move('content/gambar/', $newName);
        $nama_foto = $newName;

        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            $data = [
                'judul' => $judul,
                'slug' => $slug,
                'tingkat' => $tingkat,
                'kategori' => $kategori,
                'caption' => $caption,
                'tanggal' => $tanggal,
                'gambar' => $nama_foto,
                'isi' => $isi,
                'tag' => $tag,
                'jenis_file' => $jenis_file,
                'status' => 'Belum Publish',
                'admin' => $admin,
                'timestamp' => $timestamp,
            ];
            $this->BeritaModel->insert($data);

            session()->setFlashdata('pesanInput', 'Berhasil Menambahkan Berita');
            return redirect()->to(base_url('/berita'));
        } elseif (session()->get('username') == NULL || session()->get('level') !== 'Admin') {
            $data = [
                'judul' => $judul,
                'slug' => $slug,
                'tingkat' => $tingkat,
                'kategori' => $kategori,
                'caption' => $caption,
                'tanggal' => $tanggal,
                'gambar' => $nama_foto,
                'isi' => $isi,
                'tag' => $tag,
                'jenis_file' => $jenis_file,
                'status' => 'Belum Publish',
                'admin' => $admin,
                'timestamp' => $timestamp,
            ];
            $this->BeritaModel->insert($data);

            session()->setFlashdata('pesanInput', 'Berhasil Menambahkan Berita');
            return redirect()->to(base_url('/berita'));
        } else {
            return redirect()->to(base_url('/login'));
        }
    }

    public function edit()
    {
        $admin = session()->get('username');
        $timestamp = date("Y-m-d H:i:s");
        $request = \Config\Services::request();

        $id = $request->getVar('id');
        $filelama = $this->BeritaModel->where('id', $id)->first();
        $namafilelama = $filelama['gambar'];
        $judul = $request->getVar('judul');
        $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($judul)));
        $tingkat = $request->getVar('tingkat');
        $kategori = $request->getVar('kategori');
        $tanggal = $request->getVar('tanggal');
        $file = $request->getFile('file');
        $isi = $request->getVar('isi');
        $tag = $request->getVar('tag');
        $caption = $request->getVar('caption');
        $jenis_file = $request->getVar('jenis_file');
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            if (!file_exists($_FILES['file']['tmp_name'])) {
                $data = [
                    'judul' => $judul,
                    'slug' => $slug,
                    'tingkat' => $tingkat,
                    'kategori' => $kategori,
                    'tanggal' => $tanggal,
                    'isi' => $isi,
                    'caption' => $caption,
                    'tag' => $tag,
                    'jenis_file' => $jenis_file,
                    'admin' => $admin,
                    'timestamp' => $timestamp,
                ];
                $this->BeritaModel->update($id, $data);

                session()->setFlashdata('pesanInput', 'Berhasil Mengubah Berita');
                return redirect()->to(base_url('/berita'));
            } else {
                $newName = $file->getRandomName();
                $file->move('content/gambar/', $newName);
                $nama_foto = $newName;
                unlink('content/gambar/' . $namafilelama);
                $data = [
                    'judul' => $judul,
                    'slug' => $slug,
                    'tingkat' => $tingkat,
                    'kategori' => $kategori,
                    'tanggal' => $tanggal,
                    'gambar' => $nama_foto,
                    'isi' => $isi,
                    'tag' => $tag,
                    'caption' => $caption,
                    'jenis_file' => $jenis_file,
                    'admin' => $admin,
                    'timestamp' => $timestamp,
                ];
                $this->BeritaModel->update($id, $data);

                session()->setFlashdata('pesanInput', 'Berhasil Mengubah Berita');
                return redirect()->to(base_url('/berita'));
            }
        } elseif (session()->get('username') == NULL || session()->get('level') !== 'Admin') {
            if (!file_exists($_FILES['file']['tmp_name'])) {
                $data = [
                    'judul' => $judul,
                    'slug' => $slug,
                    'tingkat' => $tingkat,
                    'kategori' => $kategori,
                    'tanggal' => $tanggal,
                    'isi' => $isi,
                    'tag' => $tag,
                    'caption' => $caption,
                    'jenis_file' => $jenis_file,
                    'admin' => $admin,
                    'timestamp' => $timestamp,
                ];
                $this->BeritaModel->update($id, $data);

                session()->setFlashdata('pesanInput', 'Berhasil Mengubah Berita');
                return redirect()->to(base_url('/berita'));
            } else {
                $newName = $file->getRandomName();
                $file->move('content/gambar/', $newName);
                $nama_foto = $newName;
                unlink('content/gambar/' . $namafilelama);
                $data = [
                    'judul' => $judul,
                    'slug' => $slug,
                    'tingkat' => $tingkat,
                    'kategori' => $kategori,
                    'tanggal' => $tanggal,
                    'gambar' => $nama_foto,
                    'isi' => $isi,
                    'tag' => $tag,
                    'caption' => $caption,
                    'jenis_file' => $jenis_file,
                    'admin' => $admin,
                    'timestamp' => $timestamp,
                ];
                $this->BeritaModel->update($id, $data);

                session()->setFlashdata('pesanInput', 'Berhasil Mengubah Berita');
                return redirect()->to(base_url('/berita'));
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }



    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $cekfile = $this->BeritaModel->where('id', $id)->first();
        $namafile = $cekfile['gambar'];
        unlink('content/gambar/' . $namafile);
        $this->BeritaModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Berita Berhasil Di Hapus !');
        return redirect()->to(base_url('/berita'));
    }

    public function publish($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $timestamp = date("Y-m-d H:i:s");
        $data = [
            'status' => 'Publish',
            'timestamp' => $timestamp,
        ];
        $this->BeritaModel->update($id, $data);

        session()->setFlashdata('pesanInput', 'Berhasil Publish Berita');
        return redirect()->to(base_url('/berita'));
    }

    public function unpublish($id)
    {
        if (session()->get('username') == NULL || session()->get('level') !== 'Superadmin') {
            return redirect()->to(base_url('/login'));
        }
        $timestamp = date("Y-m-d H:i:s");
        $data = [
            'status' => 'Belum Publish',
            'timestamp' => $timestamp,
        ];
        $this->BeritaModel->update($id, $data);

        session()->setFlashdata('pesanInput', 'Berhasil Unpublish Berita');
        return redirect()->to(base_url('/berita'));
    }
}

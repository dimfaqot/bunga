<?php

namespace App\Controllers;

class Products extends BaseController
{
    function __construct()
    {
        helper('functions');
        check_role();
    }

    public function index(): string
    {
        $db = db(menu()['tabel']);

        $data = $db->orderBy('updated_at', 'DESC')->get()->getResultArray();
        return view('logged/' . menu()['controller'], ['judul' => settings('nama_web') . ' - ' . menu()['menu'] . ' -', 'data' => $data]);
    }

    public function add()
    {
        $kategori = clear($this->request->getVar('kategori'));
        $nama = upper_first(clear($this->request->getVar('nama')));
        $harga = rp_to_int(clear($this->request->getVar('harga')));
        $col = clear($this->request->getVar('col'));
        $time = time();
        $url = base_url(menu()['controller']);
        $file = $_FILES['file'];
        if ($file['error'] == 4) {
            gagal(base_url(menu()['controller']), 'File gambar belum dipilih!.');
        }
        if ($file['error'] == 0) {
            $size = $file['size'];

            if ($size > 2000000) {
                gagal($url, 'Ukuran file maksimal 2 MB.');
            }

            $ext = ['jpg', 'jpeg', 'png'];

            $exp = explode(".", $file['name']);
            $exe = strtolower(end($exp));

            if (array_search($exe, $ext) === false) {
                gagal($url, 'Gagal!. Format file harus ' . implode(", ", $ext) . '.');
            }

            $nama_file = "product_" . strtolower(str_replace(" ", "_", $nama)) . '_' . $time . '.' . $exe;
            $dir = 'berkas/' . menu()['controller'] . '/';
            $upload = $dir .  $nama_file;

            if (!move_uploaded_file($file['tmp_name'], $upload)) {
                gagal($url, 'File gagal diupload.');
            } else {

                $db = db(menu()['tabel']);
                $data = [
                    'kategori' => $kategori,
                    'nama' => $nama,
                    'tgl' => time(),
                    'updated_at' => time(),
                    'harga' => $harga
                ];
                $data[$col] = $nama_file;

                if ($db->insert($data)) {
                    sukses($url, 'Data berhasil ditambahkan.');
                } else {
                    gagal($url, 'Data gagal ditambahkan.!');
                }
            }
        }
    }
    public function update()
    {
        $kategori = clear($this->request->getVar('kategori'));
        $nama = upper_first(clear($this->request->getVar('nama')));
        $harga = rp_to_int(clear($this->request->getVar('harga')));
        $col = clear($this->request->getVar('col'));
        $id = clear($this->request->getVar('id'));
        $time = time();
        $db = db(menu()['tabel']);
        $q = $db->where('id', $id)->get()->getRowArray();
        if (!$q) {
            gagal(base_url(menu()['controller']), 'Id tidak ditemukan!.');
        }

        $url = base_url(menu()['controller']);
        $file = $_FILES['file'];
        if ($file['error'] == 4) {

            $q['kategori'] = $kategori;
            $q['nama'] = $nama;
            $q['updated_at'] = time();
            $q['harga'] = $harga;

            $db->where('id', $id);
            if ($db->update($q)) {
                sukses($url, 'Data berhasil diedit.');
            } else {
                gagal($url, 'Data gagal diedit.!');
            }
        }
        if ($file['error'] == 0) {
            $size = $file['size'];

            if ($size > 2000000) {
                gagal($url, 'Ukuran file maksimal 2 MB.');
            }

            $ext = ['jpg', 'jpeg', 'png'];

            $exp = explode(".", $file['name']);
            $exe = strtolower(end($exp));

            if (array_search($exe, $ext) === false) {
                gagal($url, 'Gagal!. Format file harus ' . implode(", ", $ext) . '.');
            }

            $nama_file = "product_" . strtolower(str_replace(" ", "_", $nama)) . '_' . $time . '.' . $exe;
            $dir = 'berkas/' . menu()['controller'] . '/';
            $upload = $dir .  $nama_file;

            if (!move_uploaded_file($file['tmp_name'], $upload)) {
                gagal($url, 'File gagal diupload.');
            } else {

                if (!unlink($dir . $q[$col])) {
                    gagal($url, 'File lama gagal dihapus.');
                }



                $q['kategori'] = $kategori;
                $q['nama'] = $nama;
                $q['updated_at'] = time();
                $q['harga'] = $harga;
                $q[$col] = $nama_file;

                $db->where('id', $id);
                if ($db->update($q)) {
                    sukses($url, 'Data berhasil diedit.');
                } else {
                    gagal($url, 'Data gagal diedit.!');
                }
            }
        }
    }

    public function delete()
    {
        $data = json_decode(json_encode($this->request->getVar('data')), true);

        $db = db(menu()['tabel']);

        $q = $db->where('id', $data['id'])->get()->getRowArray();
        if (!$q) {
            gagal(base_url(menu()['controller']), 'Id tidak ditemukan!.');
        }
        $dir = 'berkas/' . menu()['controller'] . '/';
        if (!unlink($dir . $q['gambar'])) {
            gagal(base_url(menu()['controller']), 'File lama gagal dihapus.');
        } else {
            $db->where('id', $data['id']);
            if ($db->delete()) {
                sukses_js('Data berhasil dihapus.');
            } else {
                gagal_js('Data gagal dihapus!.');
            }
        }
    }
}

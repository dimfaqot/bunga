<?php

namespace App\Controllers;

class Options extends BaseController
{
    function __construct()
    {
        helper('functions');
        check_role();
    }

    public function index(): string
    {
        $db = db(menu()['tabel']);

        $data = $db->orderBy('id', 'DESC')->get()->getResultArray();
        return view('logged/' . menu()['controller'], ['judul' => settings('nama_web') . ' - ' . menu()['menu'] . ' -', 'data' => $data]);
    }

    public function add()
    {
        $kategori = upper_first(clear($this->request->getVar('kategori')));
        $value = upper_first(clear($this->request->getVar('value')));


        $db = db(menu()['tabel']);
        $q = $db->where('value', $value)->where('kategori', $kategori)->get()->getRowArray();

        if ($q) {
            gagal(base_url(menu()['controller']), 'Value pada kategori sudah ada!.');
        }
        $data = [
            'kategori' => $kategori,
            'value' => $value
        ];

        if ($db->insert($data)) {
            sukses(base_url(menu()['controller']), 'Data berhasil ditambahkan.');
        } else {
            gagal(base_url(menu()['controller']), 'Data gagal ditambahkan!.');
        }
    }
    public function update()
    {
        $kategori = upper_first(clear($this->request->getVar('kategori')));
        $value = upper_first(clear($this->request->getVar('value')));
        $id = clear($this->request->getVar('id'));

        $db = db(menu()['tabel']);

        $q = $db->where('id', $id)->get()->getRowArray();
        $exist = $db->whereIn('kategori', [$kategori])->whereNotIn('id', [$id])->where('value', $value)->get()->getRowArray();

        if (!$q) {
            gagal(base_url(menu()['controller']), 'Id tidak ditemukan!.');
        }
        if ($exist) {
            gagal(base_url(menu()['controller']), 'Value pada kategori sudah ada!.');
        }

        $q['kategori'] = $kategori;
        $q['value'] = $value;



        $db->where('id', $id);
        if ($db->update($q)) {
            sukses(base_url(menu()['controller']), 'Data berhasil diupdate.');
        } else {
            gagal(base_url(menu()['controller']), 'Data gagal diupdate!.');
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


        $db->where('id', $data['id']);
        if ($db->delete()) {
            sukses_js('Data berhasil dihapus.');
        } else {
            gagal_js('Data gagal dihapus!.');
        }
    }
}

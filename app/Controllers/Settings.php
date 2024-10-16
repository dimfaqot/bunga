<?php

namespace App\Controllers;

class Settings extends BaseController
{
    function __construct()
    {
        helper('functions');
        check_role();
    }

    public function index(): string
    {
        $db = db(menu()['tabel']);

        $data = $db->get()->getRowArray();
        return view('logged/' . menu()['controller'], ['judul' => settings('nama_web') . ' - ' . menu()['menu'] . ' -', 'data' => $data]);
    }


    public function update()
    {
        $value = clear($this->request->getVar('value'));
        $col = clear($this->request->getVar('col'));
        $id = clear($this->request->getVar('id'));

        $db = db(menu()['tabel']);

        $q = $db->where('id', $id)->get()->getRowArray();

        if (!$q) {
            gagal(base_url(menu()['controller']), 'Id tidak ditemukan!.');
        }

        $q[$col] = $value;

        $db->where('id', $id);
        if ($db->update($q)) {
            sukses(base_url(menu()['controller']), 'Data berhasil diupdate.');
        } else {
            gagal(base_url(menu()['controller']), 'Data gagal diupdate!.');
        }
    }
}

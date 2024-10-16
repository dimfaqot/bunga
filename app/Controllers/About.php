<?php

namespace App\Controllers;

class About extends BaseController
{
    function __construct()
    {
        helper('functions');
        check_role();
    }

    public function index(): string
    {
        return view('logged/' . menu()['controller'], ['judul' => settings('nama_web') . ' - ' . menu()['menu'] . ' -']);
    }


    public function update()
    {
        $about = $this->request->getVar('about');

        $db = db(menu()['tabel']);

        $q = $db->get()->getRowArray();

        if (!$q) {
            gagal(base_url(menu()['controller']), 'Id tidak ditemukan!.');
        }


        $q['about'] = $about;

        $db->where('id', $q['id']);
        if ($db->update($q)) {
            sukses(base_url(menu()['controller']), 'Data berhasil diupdate.');
        } else {
            gagal(base_url(menu()['controller']), 'Data gagal diupdate!.');
        }
    }
}

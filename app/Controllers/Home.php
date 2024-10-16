<?php

namespace App\Controllers;

class Home extends BaseController
{
    function __construct()
    {
        helper('functions');
        check_role();
    }

    public function index(): string
    {

        return view('logged/home', ['judul' => settings('nama_web') . ' - Home -']);
    }

    public function ganti_password()
    {


        $password_saat_ini = clear($this->request->getVar('password_saat_ini'));
        $password_baru = clear($this->request->getVar('password_baru'));
        $ulangi_password_baru = clear($this->request->getVar('ulangi_password_baru'));

        $db = db('user');
        $q = $db->where('id', session('id'))->get()->getRowArray();

        if ($password_baru !== $ulangi_password_baru) {
            gagal(base_url(), 'Password baru dan ulangi password baru harus sama!.');
        }

        if (!password_verify($password_saat_ini, $q['password'])) {
            gagal(base_url(), 'Password saat ini salah!.');
        }

        $q['password'] = password_hash($password_baru, PASSWORD_DEFAULT);

        $db->where('id', session('id'));

        if ($db->update($q)) {
            sukses(base_url('home'), 'Ganti password sukses.');
        } else {
            gagal(base_url(), 'Password saat ini gagal!.');
        }
    }
}

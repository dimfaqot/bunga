<?php

namespace App\Controllers;

class Landing extends BaseController
{
    public function index(): string
    {
        if (session('id')) {
            sukses(base_url('home'), 'Anda sedang login.');
        }
        return view('public/landing', ['judul' => settings('nama_web')]);
    }

    public function auth()
    {
        $username = clear($this->request->getVar('username'));
        $password = clear($this->request->getVar('password'));


        $db = db('user');
        $data = [
            'username' => $username,
            'password' => $password
        ];

        $q = $db->where('username', $username)->get()->getRowArray();

        if (!$q) {
            gagal(base_url(), 'Username tidak ditemukan!.');
        }

        if (!password_verify($password, $q['password'])) {
            gagal(base_url(), 'Password salah!.');
        }

        $data = [
            'id' => $q['id'],
            'username' => $q['username'],
            'role' => $q['role'],
            'nama' => $q['nama']
        ];

        session()->set($data);

        sukses(base_url('home'), 'Login sukses');
    }

    public function logout()
    {
        session()->remove('id');
        session()->remove('username');
        session()->remove('nama');
        session()->remove('role');

        sukses(base_url(), 'Logout sukses!.');
    }
}

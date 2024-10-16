<?php

namespace App\Controllers;

class User extends BaseController
{
    function __construct()
    {
        helper('functions');
        check_role();
    }

    public function index(): string
    {
        $db = db(menu()['tabel']);

        $db;
        if (session('role') == 'Admin') {
            $db->whereNotIn('role', ['Root']);
        }
        if (session('role') == 'Staff') {
            $db->whereNotIn('role', ['Root', 'Admin']);
        }

        $data = $db->orderBy('nama', 'ASC')->get()->getResultArray();
        return view('logged/' . menu()['controller'], ['judul' => settings('nama_web') . ' - ' . menu()['menu'] . ' -', 'data' => $data]);
    }

    public function add()
    {
        $role = clear($this->request->getVar('role'));
        $username = strtolower(clear($this->request->getVar('username')));
        $password = clear($this->request->getVar('password'));
        $nama = upper_first(clear($this->request->getVar('nama')));


        $db = db(menu()['tabel']);
        $q = $db->where('username', $username)->get()->getRowArray();

        if ($q) {
            gagal(base_url(menu()['controller']), 'Username sudah ada, silahkan ganti yang lain!.');
        }
        $data = [
            'role' => $role,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'nama' => $nama
        ];

        if ($db->insert($data)) {
            sukses(base_url(menu()['controller']), 'User berhasil ditambahkan.');
        } else {
            gagal(base_url(menu()['controller']), 'User gagal ditambahkan!.');
        }
    }
    public function update()
    {
        $role = clear($this->request->getVar('role'));
        $username = strtolower(clear($this->request->getVar('username')));
        $password = clear($this->request->getVar('password'));
        $nama = upper_first(clear($this->request->getVar('nama')));
        $id = clear($this->request->getVar('id'));

        $db = db(menu()['tabel']);

        $q = $db->where('id', $id)->get()->getRowArray();
        $exist = $db->whereNotIn('id', [$id])->where('username', $username)->get()->getRowArray();

        if (!$q) {
            gagal(base_url(menu()['controller']), 'Id tidak ditemukan!.');
        }
        if ($exist) {
            gagal(base_url(menu()['controller']), 'Username sudah ada, silahkan ganti yang lain!.');
        }

        $q['role'] = $role;
        $q['username'] = $username;
        $q['nama'] = $nama;


        if ($password !== "") {
            $q['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $db->where('id', $id);
        if ($db->update($q)) {
            sukses(base_url(menu()['controller']), 'User berhasil diupdate.');
        } else {
            gagal(base_url(menu()['controller']), 'User gagal diupdate!.');
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

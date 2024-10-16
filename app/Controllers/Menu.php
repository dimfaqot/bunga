<?php

namespace App\Controllers;

class Menu extends BaseController
{
    function __construct()
    {
        helper('functions');
        check_role();
    }

    public function index(): string
    {
        $db = db(menu()['tabel']);

        $data = $db->orderBy('urutan', 'ASC')->get()->getResultArray();
        return view('logged/' . menu()['controller'], ['judul' => settings('nama_web') . ' - ' . menu()['menu'] . ' -', 'data' => $data]);
    }

    public function add()
    {
        $role = upper_first(clear($this->request->getVar('role')));
        $menu = upper_first(clear($this->request->getVar('menu')));
        $tabel = strtolower(clear($this->request->getVar('tabel')));
        $controller = strtolower(clear($this->request->getVar('controller')));
        $icon = strtolower(clear($this->request->getVar('icon')));
        $grup = strtolower(clear($this->request->getVar('grup')));
        $urutan = clear($this->request->getVar('urutan'));


        $db = db(menu()['tabel']);
        $q = $db->where('menu', $menu)->where('role', $role)->get()->getRowArray();

        if ($q) {
            gagal(base_url(menu()['controller']), 'Menu sudah pada role sudah ada!.');
        }
        $data = [
            'role' => $role,
            'menu' => $menu,
            'tabel' => $tabel,
            'controller' => $controller,
            'icon' => $icon,
            'grup' => $grup,
            'urutan' => $urutan,
        ];

        if ($db->insert($data)) {
            sukses(base_url(menu()['controller']), 'Data berhasil ditambahkan.');
        } else {
            gagal(base_url(menu()['controller']), 'Data gagal ditambahkan!.');
        }
    }
    public function update()
    {
        $role = upper_first(clear($this->request->getVar('role')));
        $menu = upper_first(clear($this->request->getVar('menu')));
        $tabel = strtolower(clear($this->request->getVar('tabel')));
        $controller = strtolower(clear($this->request->getVar('controller')));
        $icon = strtolower(clear($this->request->getVar('icon')));
        $grup = strtolower(clear($this->request->getVar('grup')));
        $urutan = clear($this->request->getVar('urutan'));
        $id = clear($this->request->getVar('id'));

        $db = db(menu()['tabel']);

        $q = $db->where('id', $id)->get()->getRowArray();
        $exist = $db->whereIn('role', [$role])->whereNotIn('id', [$id])->where('menu', $menu)->get()->getRowArray();

        if (!$q) {
            gagal(base_url(menu()['controller']), 'Id tidak ditemukan!.');
        }
        if ($exist) {
            gagal(base_url(menu()['controller']), 'Menu sudah pada role sudah ada!.');
        }

        $q['menu'] = $menu;
        $q['role'] = $role;
        $q['tabel'] = $tabel;
        $q['controller'] = $controller;
        $q['icon'] = $icon;
        $q['grup'] = $grup;
        $q['urutan'] = $urutan;



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

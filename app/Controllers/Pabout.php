<?php

namespace App\Controllers;

class Pabout extends BaseController
{

    public function index(): string
    {
        return view('public/about', ['judul' => settings('nama_web') . ' - ' . menu()['menu'] . ' -']);
    }
}

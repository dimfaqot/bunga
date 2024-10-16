<?php

namespace App\Controllers;

class Pterm extends BaseController
{

    public function index(): string
    {
        return view('public/term', ['judul' => settings('nama_web') . ' - ' . menu()['menu'] . ' -']);
    }
}

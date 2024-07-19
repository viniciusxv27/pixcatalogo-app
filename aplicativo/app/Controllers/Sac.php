<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Sac extends Controller
{

    public function index()
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        return view('__header') . view('sac/restrito') . view('__footer');
    }
}

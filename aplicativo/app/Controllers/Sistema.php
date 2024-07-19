<?php

namespace App\Controllers;

use App\Models\SistemaModel;
use CodeIgniter\Controller;

class Sistema extends Controller
{
    protected $sistemaModel;

    public function __construct()
    {
        $this->sistemaModel = new SistemaModel();
    }

    public function index()
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $data['sistemas'] = $this->sistemaModel->listarSistemas();
        return view('__header') . view('sistema/lista_sistemas', $data) . view('__footer');
    }

    public function criar_editar($id = null)
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $data = [];

        if ($this->request->getMethod() === 'post') {
            $data = [
                'nome' => $this->request->getPost('nome')
            ];

            if ($id !== null) {
                $this->sistemaModel->atualizarSistema($id, $data);
            } else {
                $this->sistemaModel->inserirSistema($data);
            }

            return redirect()->to(site_url('sistema'));
        } else {
            if ($id !== null) {
                $data['sistema'] = $this->sistemaModel->obterSistema($id);
            }
            return view('__header') . view('sistema/criar_editar_sistema', $data) . view('__footer');
        }
    }

    public function excluir($id)
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }
        
        $this->sistemaModel->excluirSistema($id);
        return redirect()->to(site_url('sistema'));
    }
}

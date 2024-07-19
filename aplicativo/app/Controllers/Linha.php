<?php

namespace App\Controllers;

use App\Models\LinhaModel;
use CodeIgniter\Controller;

class Linha extends Controller
{
    protected $linhaModel;

    public function __construct()
    {
        $this->linhaModel = new LinhaModel();
    }

    public function index()
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $data['linhas'] = $this->linhaModel->listarLinhas();
        return view('__header') . view('linha/lista_linhas', $data) . view('__footer');
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

            // Upload de Imagem
            $foto = $this->request->getFile('foto');
            if ($foto->isValid() && !$foto->hasMoved()) {
                $newName = $foto->getRandomName();
                $foto->move('./uploads', $newName);
                $data['img_url'] = 'uploads/' . $newName;
            } else {
                $error = $foto->getErrorString();
                print_r($error); // Lida com erros de upload
            }

            if ($id !== null) {
                $this->linhaModel->atualizarLinha($id, $data);
            } else {
                $id = $this->linhaModel->inserirLinha($data);
                if ($id !== null) {
                    return redirect()->to(site_url('linha/criar_editar/' . $id));
                }
            }

            return redirect()->to(site_url('linha')); // Redirecionar para a lista de linhas
        } else {
            if ($id !== null) {
                $data['linha'] = $this->linhaModel->obterLinha($id);
            }
            return view('__header') . view('linha/criar_editar_linha', $data) . view('__footer');
        }
    }

    public function excluir($id)
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $this->linhaModel->excluirLinha($id);
        return redirect()->to(site_url('linha'));
    }
}

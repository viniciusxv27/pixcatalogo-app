<?php

namespace App\Controllers;

use App\Models\SegmentoModel;
use CodeIgniter\Controller;

class Segmento extends Controller
{
    protected $segmentoModel;

    public function __construct()
    {
        $this->segmentoModel = new SegmentoModel();
    }

    public function index()
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $data['segmentos'] = $this->segmentoModel->listarSegmentos();
        return view('__header') . view('segmento/lista_segmentos', $data) . view('__footer');
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
                $this->segmentoModel->atualizarSegmento($id, $data);
            } else {
                $this->segmentoModel->inserirSegmento($data);
            }

            return redirect()->to(site_url('segmento'));
        } else {
            if ($id !== null) {
                $data['segmento'] = $this->segmentoModel->obterSegmento($id);
            }
            return view('__header') . view('segmento/cria_edita_segmento', $data) . view('__footer');
        }
    }

    public function excluir($id)
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $this->segmentoModel->excluirSegmento($id);
        return redirect()->to(site_url('segmento'));
    }
}

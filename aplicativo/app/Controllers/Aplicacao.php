<?php

namespace App\Controllers;

use App\Models\AplicacaoModel;
use App\Models\SegmentoModel;
use CodeIgniter\Controller;

class Aplicacao extends Controller
{
    protected $aplicacaoModel;
    protected $segmentoModel;

    public function __construct()
    {
        $this->aplicacaoModel = new AplicacaoModel();
        $this->segmentoModel = new SegmentoModel();
    }

    public function index()
    {

        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $data['aplicacoes'] = $this->aplicacaoModel->listarAplicacoes();
        return view('__header') . view('aplicacao/lista_aplicacoes', $data) . view('__footer');
    }

    public function criar_editar($id = null)
    {

        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $data = [];
        $data['segmentos'] = $this->segmentoModel->listarSegmentos();
        if ($this->request->getMethod() === 'post') {
            $data = [
                'segmento_id' => $this->request->getPost('segmento'),
                'montadora' => $this->request->getPost('montadora'),
                'veiculo' => $this->request->getPost('veiculo'),
                'modelo' => $this->request->getPost('modelo'),
                'motor' => $this->request->getPost('motor'),
                'conf_motor' => $this->request->getPost('conf_motor'),
                'inicio' => $this->request->getPost('inicio'),
                'fim' => $this->request->getPost('fim')
            ];

            if ($id !== null) {
                $this->aplicacaoModel->atualizarAplicacao($id, $data);
            } else {
                $this->aplicacaoModel->inserirAplicacao($data);
            }

            return redirect()->to(site_url('aplicacao'));
        } else {
            if ($id !== null) {
                $data['aplicacao'] = $this->aplicacaoModel->obterAplicacao($id);
            }
            return view('__header') . view('aplicacao/criar_editar_aplicacao', $data) . view('__footer');
        }
    }

    public function adicionar_aplicacao()
    {
        $data = [
            'segmento_id' => $this->request->getPost('segmento'),
            'montadora' => $this->request->getPost('montadora'),
            'veiculo' => $this->request->getPost('veiculo'),
            'modelo' => $this->request->getPost('modelo'),
            'motor' => $this->request->getPost('motor'),
            'conf_motor' => $this->request->getPost('config_motor'),
            'inicio' => $this->request->getPost('inicio'),
            'fim' => $this->request->getPost('fim')
        ];

        $aplicacao_id = $this->aplicacaoModel->inserirAplicacao($data);

        if ($aplicacao_id) {
            $aplicacoes = $this->aplicacaoModel->listarAplicacoes();

            $response = [
                'success' => true,
                'aplicacoes' => $aplicacoes
            ];
        } else {
            $response = ['success' => false];
        }
        return $this->response->setJSON($response);
    }

    public function excluir($id)
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }
        
        $this->aplicacaoModel->excluirAplicacao($id);
        return redirect()->to(site_url('aplicacao'));
    }
}

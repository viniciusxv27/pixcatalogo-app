<?php

namespace App\Controllers;

use App\Models\LeadModel;
use CodeIgniter\Controller;

class Lead extends Controller
{
    protected $leadModel;

    public function __construct()
    {
        $this->leadModel = new LeadModel();
    }

    public function index()
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $data['leads'] = $this->leadModel->listarLeads();
        return view('__header') . view('lead/lista_leads', $data) . view('__footer');
    }
    
    public function logar()
    {
        $vars = json_decode($this->request->getBody(), true);
        $email = $vars['email'];

        $data['lead'] = $this->leadModel->loginLead($email);

        return $this->response->setJSON($data);
    }
    
    public function cadastrar()
    {
        $vars = json_decode($this->request->getBody(), true);

        $data = [
            'nome' => $vars['nome'] ,
            'email' => $vars['email'] ,
            'empresa' => $vars['empresa'] ,
            'cargo' => $vars['cargo'] ,
            'telefone' => $vars['telefone'] ,
        ];

        $this->leadModel->inserirLead($data);

        return $this->response->setJSON($data);
    }

    public function criar_editar($id = null)
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $data = [];

        if ($this->request->getMethod() === 'post') {
            $data = [
                'nome' => $this->request->getPost('cadNomeInput'),
                'email' => $this->request->getPost('cadEmailInput'),
                'empresa' => $this->request->getPost('cadEmpresaInput'),
                'cargo' => $this->request->getPost('cadCargoInput'),
                'telefone' => $this->request->getPost('cadTelefoneInput')
            ];

            if ($id !== null) {
                $this->leadModel->atualizarLead($id, $data);
            } else {
                $this->leadModel->inserirLead($data);
            }

            return redirect()->to(site_url('lead'));
        } else {
            if ($id !== null) {
                $data['lead'] = $this->leadModel->obterLead($id);
            }
            return view('__header') . view('lead/criar_editar_lead', $data) . view('__footer');
        }
    }

    public function excluir($id)
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $this->leadModel->excluirLead($id);
        return redirect()->to(site_url('lead'));
    }
}

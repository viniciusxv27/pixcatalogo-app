<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use App\Models\ConfiguracaoModel;
use CodeIgniter\Controller;
use CodeIgniter\Validation\Rules;

class Cliente extends Controller
{
    protected $clienteModel;
    protected $configuracaoModel;

    public function __construct()
    {
        $this->clienteModel = new ClienteModel();
        $this->configuracaoModel = new ConfiguracaoModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        return redirect()->to(site_url('cliente/logar'));
    }

    public function editar()
    {
        $this->auth_user();

        $cliente_id = session('cliente_id');

        if ($this->request->getMethod() === 'post') {
            $data = [
                'nome' => $this->request->getPost('nome'),
                'sobrenome' => $this->request->getPost('sobrenome'),
                'email' => $this->request->getPost('email'),
                'data_nascimento' => $this->request->getPost('data_nascimento'),
                'telefone' => $this->request->getPost('telefone'),
                'nome_empresa' => $this->request->getPost('nome_empresa'),
                'ramo_atividade' => $this->request->getPost('ramo_atividade'),
            ];

            $senha = $this->request->getPost('senha');
            if (!empty($senha)) {
                $data['senha'] = password_hash($senha, PASSWORD_BCRYPT);
            }

            $this->clienteModel->update($cliente_id, $data);

            return redirect()->to(site_url('cliente/conta'));
        }

        $data['cliente'] = $this->clienteModel->find($cliente_id);

        echo view('cliente/editar', $data);
    }

    public function conta()
    {
        if (!$this->auth_user()) {
            return redirect()->to(site_url('cliente/logar'));
        }

        $data['cliente'] = $this->clienteModel->find(session('cliente_id'));
        $data['configuracao'] = $this->configuracaoModel->obterConfiguracao();

        echo view('cliente/conta', $data);
    }

    public function cadastrar()
    {
        if ($this->auth_user()) {
            return redirect()->to(site_url('cliente/conta'));
        }

        $data = [];

        $data['configuracao'] = $this->configuracaoModel->obterConfiguracao();

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nome' => 'required',
                'sobrenome' => 'required',
                'email' => 'required|valid_email|is_unique[clientes.email]',
                'data_nascimento' => 'required',
                'telefone' => 'required',
                'nome_empresa' => 'required',
                'ramo_atividade' => 'required',
                'senha' => 'required|min_length[6]',
                'confirma_senha' => 'required|matches[senha]'
            ];

            if ($this->validate($rules)) {
                $data = [
                    'nome' => $this->request->getPost('nome'),
                    'sobrenome' => $this->request->getPost('sobrenome'),
                    'email' => $this->request->getPost('email'),
                    'data_nascimento' => $this->request->getPost('data_nascimento'),
                    'telefone' => $this->request->getPost('telefone'),
                    'nome_empresa' => $this->request->getPost('nome_empresa'),
                    'ramo_atividade' => $this->request->getPost('ramo_atividade'),
                    'senha' => password_hash($this->request->getPost('senha'), PASSWORD_BCRYPT)
                ];

                $cliente_id = $this->clienteModel->insert($data);
                if ($cliente_id) {
                    return redirect()->to(site_url('cliente/logar'));
                } else {
                    $data['error'] = 'Erro ao cadastrar o cliente. Tente novamente.';
                }
            }
        }

        return view('cliente/header', $data) . view('cliente/cadastro', $data);
    }

    public function logar()
    {

        if ($this->auth_user()) {
            return redirect()->to(site_url('cliente/conta'));
        }

        $data = [];

        $data['configuracao'] = $this->configuracaoModel->obterConfiguracao();

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'email' => 'required|valid_email',
                'senha' => 'required'
            ];

            if ($this->validate($rules)) {
                $email = $this->request->getPost('email');
                $senha = $this->request->getPost('senha');

                $cliente = $this->clienteModel->where('email', $email)->first();

                if ($cliente && password_verify($senha, $cliente['senha'])) {
                    session()->set('cliente_id', $cliente['id']);
                    session()->set('cliente_email', $cliente['email']);
                    session()->set('status', 'user-C@357%');
                    return redirect()->to(site_url('cliente/conta'));
                } else {
                    $data['error'] = 'E-mail ou senha incorretos.';
                }
            }
        }

        echo view('cliente/header', $data) . view('cliente/login', $data);
    }

    protected function auth_user()
    {
        // Verifica se a sessão do usuário está configurada corretamente
        if (session()->has('status') && session('status') === 'user-C@357%') {
            // O usuário está autenticado
            return true;
        } else {
            // O usuário não está autenticado
            return false;
        }
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('cliente/logar'));
    }
}

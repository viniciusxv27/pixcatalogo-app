<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ConfiguracaoModel;
use App\Models\LoginModel;

class Login extends Controller
{
    protected $M_login;
    protected $configuracaoModel;

    public function __construct()
    {
        $this->M_login = new LoginModel();
        $this->configuracaoModel = new ConfiguracaoModel();
    }

    public function index()
    {
        $data['configuracao'] = $this->configuracaoModel->obterConfiguracao();
        return view('login', $data);
    }

    public function newpass()
    {
      if($this->request->getMethod() === 'post'){
            $data = [
                'password' => md5($this->request->getPost('password')),
                'codigo' => '',
            ];
            
            $this->M_login->definirCred($data);
            
            return redirect()->to(base_url("login"));
        }  
    }
    
    public function definepass($codigo)
    {
        
        if(!$this->M_login->getCode($codigo) || $codigo == 0){
            return redirect()->to(base_url("login"));
        }

        $data['configuracao'] = $this->configuracaoModel->obterConfiguracao();
        
        return view('novasenha', $data);
    }
    
    public function recover()
    {

        $codigo = '';
        $caracteres_permitidos = '0123456789';

        for ($i = 0; $i < 6; $i++) {
            $codigo .= $caracteres_permitidos[rand(0, strlen($caracteres_permitidos) - 1)];
        }

        $data['configuracao'] = $this->configuracaoModel->obterConfiguracao();
        $data['url'] = base_url('login/codigo/'.$codigo);

        $datacode = [
            'codigo' => $codigo,
        ];

        $this->M_login->definirCred($datacode);

        $email = \Config\Services::email();

        $config = [
            'mailType' => 'html',
        ];

        $email->initialize($config);

        $email->setTo($data['configuracao']['rodape_email']);

        $template = view('emails/recover', $data);

        $email->setSubject('Recuperação de Senha | Pix Catalogo');
        $email->setMessage($template);

        $send = $email->send();
    
        if(!$send){
            var_dump($email->printDebugger());
        } else{
            return redirect()->to(base_url("login"));
        }

    }

    public function masuk()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $where = [
            'username' => $username,
            'password' => md5($password)
        ];
        $lihat = $this->M_login->status($where);
        if ($lihat->getNumRows() > 0) {
            foreach ($lihat->getResult() as $xx) {
                $sess_data = [
                    'user' => $xx->username,
                    'role' => $xx->role,
                    'status' => "AezakmiHesoyamWhosyourdaddy"
                ];
                session()->set($sess_data);
            }

            return redirect()->to(base_url("dashboard"));
        } else {
            echo "<script type='text/javascript'>alert('Usuário e/ou Senha Incorretos');window.location = './';</script>";
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}

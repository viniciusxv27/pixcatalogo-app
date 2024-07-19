<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ConfiguracaoModel;

class Configuracao extends Controller
{
    protected $configuracaoModel;

    public function __construct()
    {
        $this->configuracaoModel = new ConfiguracaoModel();
    }

    public function index()
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $data['configuracao'] = $this->configuracaoModel->obterConfiguracao();
        return view('__header') . view('configuracao/index', $data) . view('__footer');
    }

    public function salvarOpcoes()
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        if ($this->request->getMethod() === 'post') {
            $data = [
                "forcar_login" => $this->request->getPost('forcar_login'),
            ];

            $this->configuracaoModel->atualizarConfiguracao($data);
            session()->setFlashdata('notificacaoPop', 'Configuração salva.');
            return redirect()->to(site_url('configuracao'));

        } else {
            return redirect()->to(site_url('configuracao'));
        }
    }
    public function salvarLogo()
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        if ($this->request->getMethod() === 'post') {
            $logo = $this->request->getFile('logo');

            $filepath = 'assets/';

            $nome = 'logo.' . pathinfo($logo->getName(), PATHINFO_EXTENSION);

            if (file_exists($filepath . $nome)) {
                unlink($filepath . $nome);
            }

            $logo->move($filepath, $nome);

            $data = [
                'logo' => 'assets/' . $nome,
            ];

            $this->configuracaoModel->atualizarConfiguracao($data);
            session()->setFlashdata('notificacaoPop', 'Configuração salva.');
            return redirect()->to(site_url('configuracao'));


        } else {
            return redirect()->to(site_url('configuracao'));
        }
    }
    public function salvarIcone()
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        if ($this->request->getMethod() === 'post') {
            $icone = $this->request->getFile('icone');

            $filepath = 'assets/';

            $nome = 'icone.' . pathinfo($icone->getName(), PATHINFO_EXTENSION);

            if (file_exists($filepath . $nome)) {
                unlink($filepath . $nome);
            }

            $icone->move($filepath, $nome);

            $data = [
                'icone' => 'assets/' . $nome,
            ];

            $this->configuracaoModel->atualizarConfiguracao($data);
            session()->setFlashdata('notificacaoPop', 'Configuração salva.');
            return redirect()->to(site_url('configuracao'));


        } else {
            return redirect()->to(site_url('configuracao'));
        }
    }
    public function salvarPoliticas()
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        if ($this->request->getMethod() === 'post') {
            $politicas = $this->request->getFile('politicas');

            if ($politicas->isValid() && !$politicas->hasMoved()) {
                $filepath = 'assets/';

                $nome = 'politicasdeprivacidades.pdf';

                if (file_exists($filepath . $nome)) {
                    unlink($filepath . $nome);
                }

                $politicas->move($filepath, $nome);

                $data = [
                    'rodape_politicas' => $filepath . $nome,
                ];

                $this->configuracaoModel->atualizarConfiguracao($data);
                session()->setFlashdata('notificacaoPop', 'Configurações salva.');
                return redirect()->to(site_url('configuracao'));
            }

        } else {
            return redirect()->to(site_url('configuracao'));
        }
    }
    public function salvarRodape()
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        if ($this->request->getMethod() === 'post') {
            $data = [
                "marca" => $this->request->getPost('nome_marca'),
                "rodape_email" => $this->request->getPost('rodape_email'),
                "rodape_site" => $this->request->getPost('rodape_site'),
                "rodape_telefone" => $this->request->getPost('rodape_telefone'),
                "rodape_facebook" => $this->request->getPost('rodape_facebook'),
                "rodape_instagram" => $this->request->getPost('rodape_instagram'),
                "rodape_youtube" => $this->request->getPost('rodape_youtube'),
                "rodape_local" => $this->request->getPost('rodape_local'),
            ];

            $this->configuracaoModel->atualizarConfiguracao($data);
            session()->setFlashdata('notificacaoPop', 'Configuração salva.');
            return redirect()->to(site_url('configuracao'));
        } else {
            return redirect()->to(site_url('configuracao'));
        }
    }

}

<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AcessosModel;
use App\Models\ProdutoModel;
use App\Models\AplicacaoModel;

class Dashboard extends Controller
{
    protected $acessosModel;
    protected $produtoModel;
    protected $aplicacaoModel;

    public function __construct()
    {

        $this->acessosModel = new AcessosModel();
        $this->produtoModel = new ProdutoModel();
        $this->aplicacaoModel = new AplicacaoModel();

    }

    public function index()
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $this->log();

        $data['dadosM'] = $this->total_acessos_mes();
        $data['total_produtos'] = $this->produtoModel->totalProdutos();
        $data['total_aplicacaos'] = $this->aplicacaoModel->totalAplicacoes();
        $data['chart_data'] = json_encode($data['dadosM']);
        return view('__header') . view('dashboard_u', $data) . view('__footer');
    }

    public function log()
    {
        $ip_address = $this->request->getIPAddress();
        $user_agent = $this->request->getUserAgent();

        // Verifica se o agente do usuário corresponde a padrões de dispositivos móveis
        $is_mobile = $this->isMobileUserAgent($user_agent);

        $tipo = $is_mobile ? 'Mobile' : 'PC';

        $data = [
            'ip' => $ip_address,
            'navegador' => $user_agent,
            'tipo' => $tipo,
            'data' => date('Y-m-d')
        ];

        $this->acessosModel->inserir_acesso($data);
    }

    private function isMobileUserAgent($user_agent)
    {
        // Padrões de agentes de usuário de dispositivos móveis
        $mobile_keywords = ['Mobile', 'Android', 'iPhone', 'iPad', 'Windows Phone'];

        foreach ($mobile_keywords as $keyword) {
            if (stripos($user_agent, $keyword) !== false) {
                return true;
            }
        }

        return false;
    }


    public function total_acessos_mes()
    {
        $ano = date('Y');
        $total_acessos = [];

        for ($mes = 1; $mes <= 12; $mes++) {
            $total_acessos[$mes] = $this->acessosModel->where('YEAR(data)', $ano)
                ->where('MONTH(data)', $mes)
                ->countAllResults();
        }

        return $total_acessos;
    }
}

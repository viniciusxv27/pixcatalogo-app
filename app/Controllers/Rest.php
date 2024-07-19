<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AplicacaoModel;
use App\Models\LinhaModel;
use App\Models\ProdutoModel;
use App\Models\LeadModel;

class Rest extends Controller
{
    protected $aplicacaoModel;
    protected $linhaModel;
    protected $produtoModel;
    protected $leadModel;

    public function __construct()
    {
        $this->aplicacaoModel = new AplicacaoModel();
        $this->linhaModel = new LinhaModel();
        $this->produtoModel = new ProdutoModel();
        $this->leadModel = new LeadModel();
    }

    public function index()
    {
        // $data['segmentos'] = $this->segmento_model->listar_segmentos();
        // $this->load->view('segmento/lista_segmentos', $data);
    }

    public function segmento()
    {
        $data['segmento'] = $this->aplicacaoModel->segmentos();
        return $this->response->setJSON($data);
    }

    public function montadora()
    {
        $vars = $this->request->getPost();
        if ($vars) {
            $data['montadoras'] = $this->aplicacaoModel->montadoras($vars['segmento_id']);
            return $this->response->setJSON($data);
        }
    }

    public function veiculo()
    {
        $vars = $this->request->getPost();
        if ($vars) {
            $data['veiculos'] = $this->aplicacaoModel->veiculo($vars['segmento_id'], $vars['montadora']);
            return $this->response->setJSON($data);
        }
    }

    public function gerarSequenciaDeAnos($anoInicial, $anoFinal)
    {
        $sequencia = [];
        for ($ano = $anoInicial; $ano <= $anoFinal; $ano++) {
            $sequencia[] = $ano;
        }
        return $sequencia;
    }

    public function ano()
    {
        $vars = $this->request->getPost();
        if ($vars) {
            $sequenciaDeAnos['anos'] = $this->gerarSequenciaDeAnos('1960', '2024');
            return $this->response->setJSON($sequenciaDeAnos);
        }
    }

    public function modelo()
    {
        $vars = $this->request->getPost();
        if ($vars) {
            $data['modelo'] = $this->aplicacaoModel->modelo($vars['segmento_id'], $vars['montadora'], $vars['veiculo']);
            return $this->response->setJSON($data);
        }
    }

    public function linha()
    {
        $data['linhas'] = $this->linhaModel->listarLinhas();
        return $this->response->setJSON($data);
    }

    public function sistema()
    {
        $data['sistemas'] = $this->aplicacaoModel->sistema();
        return $this->response->setJSON($data);
    }

    public function busca_avancada()
    {
        $vars = $this->request->getPost();
        if ($vars) {
            $data['aplicacao'] = $this->aplicacaoModel->aplicacaoIds($vars['segmento_id'], $vars['montadora'], $vars['veiculo'], $vars['modelo']);
            $ids = [];
            foreach ($data['aplicacao'] as $key => $value) {
                array_push($ids, $value->id);
            }
            $produtos = $this->aplicacaoModel->aplicacaoProdutos($ids, $vars['sistema']);
            return $this->response->setJSON($produtos);
        }
    }

    public function buscar_codigo()
    {
        $palavra_chave = $this->request->getPost('palavra_chave');
        $data['produtos'] = $this->produtoModel->pesquisarProdutos($palavra_chave);
        return $this->response->setJSON($data['produtos']);
    }

    public function produtos_linha($id)
    {
        $data['produtos'] = $this->produtoModel->listarProdutosLinha($id);
        return $this->response->setJSON($data['produtos']);
    }

    public function buscar_geral()
    {
        $palavra_chave = $this->request->getPost('palavra_chave');
        $data['produtos'] = $this->produtoModel->pesquisarProdutosGeral($palavra_chave);
        return $this->response->setJSON($data['produtos']);
    }

    public function buscar_sistema()
    {
        $sistema_id = $this->request->getPost('sistema_id');
        $data['produtos'] = $this->produtoModel->pesquisarProdutosSistema($sistema_id);
        return $this->response->setJSON($data['produtos']);
    }
    
    public function filtros()
    {
        $data['filtros'] = $this->produtoModel->pesquisarFiltros();
        return $this->response->setJSON($data['filtros']);
    }
    public function filtrar()
    {
        $marcas = $this->request->getPost('marcas');
        $sistemas = $this->request->getPost('sistemas');
        $linhas = $this->request->getPost('linhas');
        $data['produtos'] = $this->produtoModel->pesquisarFiltro($marcas, $linhas, $sistemas);
        return $this->response->setJSON($data['produtos']);
    }

    public function login_lead()
    {
        $data['emails'] = $this->leadModel->loginEmail();
        return $this->response->setJSON($data['emails']);
    }

    public function cadastro_lead()
    {
        $data = [];

        $data = [
            'nome' => $this->request->getPost('cadNomeInput'),
            'email' => $this->request->getPost('cadEmailInput'),
            'empresa' => $this->request->getPost('cadEmpresaInput'),
            'cargo' => $this->request->getPost('cadCargoInput'),
            'telefone' => $this->request->getPost('cadTelefoneInput')
        ];

        $this->leadModel->loginEmail();

        return $this->response->setJSON($data, true);;
    }

    public function gerar_pdf()
    {
        $codigos = $this->request->getPost('codigos');

        $produtos = $this->produtoModel->gerarPdf($codigos);

        return $this->response->setJSON($produtos);
        
    }
}

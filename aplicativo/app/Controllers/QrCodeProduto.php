<?php

namespace App\Controllers;

use App\Models\ProdutoModel;
use App\Models\AplicacaoModel;
use App\Models\SistemaModel;
use App\Models\ConfiguracaoModel;
use App\Models\FotoModel;
use CodeIgniter\Controller;

class QrCodeProduto extends Controller
{
    protected $produtoModel;
    protected $aplicacaoModel;
    protected $sistemaModel;
    protected $fotoModel;
    protected $configuracaoModel;

    public function __construct()
    {
        $this->produtoModel = new ProdutoModel();
        $this->aplicacaoModel = new AplicacaoModel();
        $this->sistemaModel = new SistemaModel();
        $this->fotoModel = new FotoModel();
        $this->configuracaoModel = new ConfiguracaoModel();
    }

    public function index()
    {
        // Implementação da função index se necessário
    }

    function extrairNumerosDaString($jsonString)
    {
        $array = json_decode($jsonString);

        if ($array === null && json_last_error() !== JSON_ERROR_NONE) {
            return [];
        }
        $numeros = [];
        foreach ($array as $element) {
            $numero = filter_var($element, FILTER_VALIDATE_INT);

            if ($numero !== false) {
                $numeros[] = $numero;
            }
        }
        return $numeros;
    }

    public function get($id)
    {
        $produto = $this->produtoModel->obterProduto($id);

        if (!empty($produto)) {
            $numeros = $this->extrairNumerosDaString($produto['aplicacao_ids']);

            $data['produto'] = $produto;
            $data['configuracao'] = $this->configuracaoModel->obterConfiguracao();
            $data['sistemas'] = $this->sistemaModel->obterSistema($produto['sistema_id']);
            $data['fotos'] = $this->fotoModel->obterFotosPorProduto($id);
            $data['aplicacoes'] = $this->aplicacaoModel->produtoAplicacao($numeros);
            return view('__header_qr_code', $data) . view('qr_code', $data);
        } else {
            return 'erro QRCODE invalido!';
        }
    }
}

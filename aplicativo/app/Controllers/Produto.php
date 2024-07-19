<?php
namespace App\Controllers;

use App\Models\ProdutoModel;
use App\Models\SistemaModel;
use App\Models\AplicacaoModel;
use App\Models\LinhaModel;
use App\Models\FotoModel;
use App\Models\SegmentoModel;
use CodeIgniter\Controller;

class Produto extends Controller
{

    protected $produtoModel;
    protected $sistemaModel;
    protected $aplicacaoModel;
    protected $linhaModel;
    protected $fotoModel;
    protected $segmentoModel;

    public function __construct()
    {
        $this->produtoModel = new ProdutoModel();
        $this->sistemaModel = new SistemaModel();
        $this->aplicacaoModel = new AplicacaoModel();
        $this->linhaModel = new LinhaModel();
        $this->fotoModel = new FotoModel();
        $this->segmentoModel = new SegmentoModel();
    }

    public function index()
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }
        
        $data['produtos'] = $this->produtoModel->listarProdutos();
        $data['sistemas'] = $this->sistemaModel->listarSistemas();
        $data['segmentos'] = $this->segmentoModel->listarSegmentos();
        echo view('__header') . view('produto/lista_produtos', $data) . view('__footer');
    }

    public function criar_editar($id = null)
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $data = [];
        $data['linhas'] = $this->linhaModel->listarLinhas();
        $data['segmentos'] = $this->segmentoModel->listarSegmentos();
        $data['sistemas'] = $this->sistemaModel->listarSistemas();
        $data['aplicacoes'] = $this->aplicacaoModel->listarAplicacoes();

        if ($this->request->getMethod() === 'post') {

            $aplicacao_ids = $this->request->getPost('aplicacao[]');

            $foto = $this->request->getFile('foto');

            if (empty($aplicacao_ids)) {
                $aplicacao_ids = '["0"]';
            } else {
                $aplicacao_ids = json_encode($aplicacao_ids);
            }

            $produtoData = [
                'nome' => $this->request->getPost('nome'),
                'marca' => $this->request->getPost('marca'),
                'codigo' => $this->request->getPost('codigo'),
                'descricao' => $this->request->getPost('descricao'),
                'observacao' => $this->request->getPost('observacao'),
                'codigo_ean' => $this->request->getPost('codigo_ean'),
                'codigo_ncm' => $this->request->getPost('codigo_ncm'),
                'garantia' => $this->request->getPost('garantia'),
                'garantia_km' => $this->request->getPost('garantia_km'),
                'altura' => $this->request->getPost('altura'),
                'comprimento' => $this->request->getPost('comprimento'),
                'largura' => $this->request->getPost('largura'),
                'peso' => $this->request->getPost('peso'),
                'quantidade' => $this->request->getPost('quantidade'),
                'terminal' => $this->request->getPost('terminal'),
                'combustivel' => $this->request->getPost('combustivel'),
                'sistema_id' => $this->request->getPost('sistema'),
                'linha_id' => $this->request->getPost('linha'),
                'aplicacao_ids' => $aplicacao_ids,
                'injecao' => $this->request->getPost('injecao')
            ];

            if ($foto->isValid() && !$foto->hasMoved()) {
                $filepath = 'uploads/produtos/';

                $originalName = $foto->getName();

                $novoNome = $this->request->getPost('codigo') . '.' . pathinfo($originalName, PATHINFO_EXTENSION);

                if (file_exists($filepath . $novoNome)) {
                    unlink($filepath . $novoNome);
                }

                $foto->move($filepath, $novoNome);
                $produtoData['foto'] = '/produtos/' . $novoNome;
            }

            if ($id !== null) {

                $this->produtoModel->atualizarProduto($id, $produtoData);
                session()->setFlashdata('notificacaoPop', 'Atualização salva.');
                return redirect()->to(base_url('produto/criar_editar/' . $id));
            } else {

                if (!$foto->isValid()) {
                    $produtoData['foto'] = 'sem_foto.jpg';
                }

                $id = $this->produtoModel->inserirProduto($produtoData);

                if ($id) {
                    return redirect()->to(site_url('produto/criar_editar/' . $id));
                }

                session()->setFlashdata('notificacaoPop', 'Produto cadastrado.');
            }
        } else {
            if ($id !== null) {
                $data['produto'] = $this->produtoModel->obterProduto($id);
            }
            return view('__header') . view('produto/criar_editar_produto', $data) . view('__footer');
        }
    }

    public function gerar_qrcode($produto_id)
    {
        // Implemente a geração do QR code aqui
    }

    public function upload_foto($produto_id)
    {
        $upload = $this->request->getFile('file');
        if ($upload->isValid() && !$upload->hasMoved()) {
            $upload_dir = './uploads/' . $produto_id . '/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $upload->move($upload_dir);

            $data = [
                'produto_id' => $produto_id,
                'img_url' => $upload->getName()
            ];
            $this->fotoModel->inserirFoto($data);
            return 'Arquivo enviado com sucesso';
        } else {
            return 'Erro no upload do arquivo: ' . $upload->getErrorString();
        }
    }

    public function obter_fotos($id_produto)
    {
        $fotos = $this->fotoModel->obterFotosPorProduto($id_produto);
        return json_encode($fotos);
    }

    public function excluirfoto($id)
    {
        if ($this->fotoModel->excluirFoto($id)) {
            return 'deletada';
        } else {
            return 'falha';
        }
    }

    public function excluir($id)
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $this->produtoModel->excluirProduto($id);
        return redirect()->to(site_url('produto')); // Redirecionar para a lista de produtos
    }
}

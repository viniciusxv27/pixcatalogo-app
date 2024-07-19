<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PdfModel;
use App\Models\ProdutoModel;
use App\Models\SistemaModel;
use App\Models\AplicacaoModel;
use App\Models\LinhaModel;
use App\Models\SegmentoModel;
use TCPDF;

class Pdf extends Controller
{

    protected $pdfModel;
    protected $produtoModel;
    protected $sistemaModel;
    protected $aplicacaoModel;
    protected $linhaModel;
    protected $segmentoModel;


    public function __construct()
    {
        $this->pdfModel = new PdfModel();
        $this->produtoModel = new ProdutoModel();
        $this->sistemaModel = new SistemaModel();
        $this->aplicacaoModel = new AplicacaoModel();
        $this->linhaModel = new LinhaModel();
        $this->segmentoModel = new SegmentoModel();
    }

    public function index()
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }
        
        $data['pdfs'] = $this->pdfModel->listarPdfs();
        return view('__header') . view('pdf/lista_pdfs', $data) . view('__footer');
    }

    public function criar_editar($id = null)
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $data = [];
        $data['produtos'] = $this->produtoModel->listarProdutos();
        $data['segmentos'] = $this->segmentoModel->listarSegmentos();


        if ($this->request->getMethod() === 'post') {

            $capa = $this->request->getFile('foto');
            $capa_2 = $this->request->getFile('foto2');
            $capa_3 = $this->request->getFile('foto3');

            $produtos_ids = $this->request->getPost('produtos[]');

            if (empty($produtos_ids)) {
                $produtos_ids = '["0"]';
            } else {
                $produtos_ids = json_encode($produtos_ids);
            }

            $data = [
                'nome' => $this->request->getPost('nome'),
                'produtos_ids' => $produtos_ids,
            ];

            if ($capa->isValid() && !$capa->hasMoved()) {
                $filepath = 'uploads/pdfs/capa/';

                $originalName = $capa->getName();

                $novoNome = $this->request->getPost('nome') . '.' . pathinfo($originalName, PATHINFO_EXTENSION);

                if (file_exists($filepath . $novoNome)) {
                    unlink($filepath . $novoNome);
                }

                $capa->move($filepath, $novoNome);
                $data['capa'] = 'uploads/pdfs/capa/' . $novoNome;
            }

            if ($capa_2->isValid() && !$capa_2->hasMoved()) {
                $filepath = 'uploads/pdfs/capa2/';

                $originalName = $capa_2->getName();

                $novoNome = $this->request->getPost('nome') . '.' . pathinfo($originalName, PATHINFO_EXTENSION);

                if (file_exists($filepath . $novoNome)) {
                    unlink($filepath . $novoNome);
                }

                $capa_2->move($filepath, $novoNome);
                $data['capa_2'] = 'uploads/pdfs/capa2/' . $novoNome;
            }

            if ($capa_3->isValid() && !$capa_3->hasMoved()) {
                $filepath = 'uploads/pdfs/capa3/';

                $originalName = $capa->getName();

                $novoNome = $this->request->getPost('nome') . '.' . pathinfo($originalName, PATHINFO_EXTENSION);

                if (file_exists($filepath . $novoNome)) {
                    unlink($filepath . $novoNome);
                }

                $capa_3->move($filepath, $novoNome);
                $data['capa_3'] = 'uploads/pdfs/capa3/' . $novoNome;
            }

            $data['caminho'] = $this->criar_pdf($data['nome'], $data['capa'], $data['capa_2'], $data['capa_3']);

            if ($id !== null) {
                $this->pdfModel->atualizarPdf($id, $data);

                session()->setFlashdata('notificacaoPop', 'PDF salvo.');
            } else {


                $id = $this->pdfModel->inserirPdf($data);


                if (isset($id)) {
                    return redirect()->to(base_url('pdf/criar_editar/' . $id));
                }

                session()->setFlashdata('notificacaoPop', 'PDF criado.');
            }
            return redirect()->to(base_url('pdf/criar_editar/' . $id));
        } else {
            if ($id !== null) {
                $data['pdf'] = $this->pdfModel->obterPdf($id);
            }
            return view('__header') . view('pdf/criar_editar_pdf', $data) . view('__footer');
        }
    }

    public function criar_pdf($nome, $capa1, $capa2, $capa3)
    {

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $caminho = './uploads/pdfs/' . $nome . '.pdf';

        $pdf->Output($caminho, 'F');

        return $caminho;
    }

    public function excluir($id)
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $pdf = $this->pdfModel->obterPdf($id);

        $caminhoPDF = './uploads/pdfs/' . $pdf['nome'] . '.pdf';

        if (file_exists($caminhoPDF)) {
            unlink($pdf['capa']);
            unlink($pdf['capa_2']);
            unlink($pdf['capa_3']);
            unlink($caminhoPDF);
        }

        $this->pdfModel->excluirPdf($id);

        return redirect()->to(base_url('pdf'));
    }

}

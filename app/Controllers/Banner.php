<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BannerModel;

class Banner extends Controller
{

    protected $bannerModel;

    public function __construct()
    {
        $this->bannerModel = new BannerModel();
    }

    public function index()
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $data['banners'] = $this->bannerModel->listar_banners();
        return view('__header') . view('banner/lista_banners', $data) . view('__footer');
    }

    public function criar_editar($id = null)
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }

        $data = [];

        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[userfile,100]',
                    'max_dims[userfile,1024,768]',
                ],
            ],
        ];

        if ($this->request->getMethod() === 'post') {

            $img = $this->request->getFile('arquivo_banner');

            if ($img->isValid() && !$img->hasMoved()) {
                // Corrigindo o caminho de upload
                $filepath = 'uploads/banner/';

                // Movendo o arquivo para o destino correto
                $img->move($filepath, $img->getName());

                $dados['arquivo_banner'] = $img->getName();

            }

            $dados['texto'] = $this->request->getPost('texto');

            if ($id !== null) {
                $this->bannerModel->atualizar_banner($id, $dados);
                session()->setFlashdata('notificacaoPop', 'Atualização salva.');
                return redirect()->to(site_url('banner/criar_editar/' . $id));
            } else {

                if (!$img->isValid()) {
                    $dados['arquivo_banner'] = '../sem_foto.jpg';
                }

                $id_do_banner = $this->bannerModel->inserir_banner($dados);
                session()->setFlashdata('notificacaoPop', 'Banner adicionado.');
                return redirect()->to(site_url('banner/criar_editar/' . $id_do_banner));
            }

        } else {
            if ($id !== null) {
                $data['banner'] = $this->bannerModel->obter_banner($id);
            }
            return view('__header') . view('banner/criar_editar_banner', $data) . view('__footer');
        }
    }

    public function excluir($id)
    {
        if (!session()->has('status') || session()->get('status') !== "AezakmiHesoyamWhosyourdaddy") {
            return redirect()->to(base_url("login"));
        }
        
        $this->bannerModel->excluir_banner($id);
        session()->setFlashdata('notificacaoPop', 'Banner removido.');
        return redirect()->to(site_url('banner/'));
    }
}

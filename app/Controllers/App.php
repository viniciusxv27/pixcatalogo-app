<?php

namespace App\Controllers;

use App\Models\BannerModel;
use App\Models\ConfiguracaoModel;
use CodeIgniter\Controller;

class App extends Controller
{
    protected $bannerModel;
    protected $configuracaoModel;

    public function __construct()
    {
        $this->bannerModel = new BannerModel();
        $this->configuracaoModel = new ConfiguracaoModel();
    }

    public function index()
    {
        $data['banners'] = $this->bannerModel->listar_banners();
        $data['configuracao'] = $this->configuracaoModel->obterConfiguracao();
        return view('app/index', $data);
    }

}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfiguracaoModel extends Model
{
    protected $table = 'configuracao';
    protected $primaryKey = 'id_config';
    protected $allowedFields = ['marca', 'logo', 'icone', 'forcar_login', 'rodape_email', 'rodape_site', 'rodape_telefone', 'rodape_facebook', 'rodape_instagram', 'rodape_youtube', 'rodape_politicas', 'rodape_local'];

    public function obterConfiguracao()
    {
        return $this->find(1);
    }
    
    public function atualizarConfiguracao($dados)
    {
        return $this->update(1, $dados);
    }

}

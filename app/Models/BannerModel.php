<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $table = 'banners';
    protected $primaryKey = 'id';
    protected $allowedFields = ['texto', 'arquivo_banner'];

    public function inserir_banner($dados)
    {
        $this->insert($dados);
        return $this->getInsertID();
    }

    public function listar_banners()
    {
        return $this->findAll();
    }

    public function obter_banner($id)
    {
        return $this->find($id);
    }

    public function atualizar_banner($id, $dados)
    {
        return $this->update($id, $dados);
    }

    public function excluir_banner($id)
    {
        return $this->delete($id);
    }
}

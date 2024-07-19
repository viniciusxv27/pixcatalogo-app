<?php

namespace App\Models;

use CodeIgniter\Model;

class LinhaModel extends Model
{
    protected $table = 'linha';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'img_url'];

    public function listarLinhas()
    {
        return $this->distinct()->findAll();
    }

    public function obterLinha($id)
    {
        return $this->find($id);
    }

    public function inserirLinha($data)
    {
        $this->insert($data);
        return $this->getInsertID();
    }

    public function atualizarLinha($id, $data)
    {
        return $this->update($id, $data);
    }

    public function excluirLinha($id)
    {
        return $this->delete($id);
    }
}

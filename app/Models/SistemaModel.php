<?php

namespace App\Models;

use CodeIgniter\Model;

class SistemaModel extends Model
{
    protected $table = 'sistema';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome'];

    public function inserirSistema($data)
    {
        return $this->insert($data);
    }

    public function atualizarSistema($id, $data)
    {
        return $this->update($id, $data);
    }

    public function obterSistema($id)
    {
        return $this->find($id);
    }

    public function listarSistemas()
    {
        return $this->findAll();
    }

    public function excluirSistema($id)
    {
        return $this->delete($id);
    }
}

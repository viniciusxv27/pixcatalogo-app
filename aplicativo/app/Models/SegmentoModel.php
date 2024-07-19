<?php

namespace App\Models;

use CodeIgniter\Model;

class SegmentoModel extends Model
{
    protected $table = 'segmento';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome'];

    public function inserirSegmento($data)
    {
        return $this->insert($data);
    }

    public function atualizarSegmento($id, $data)
    {
        return $this->update($id, $data);
    }

    public function obterSegmento($id)
    {
        return $this->find($id);
    }

    public function listarSegmentos()
    {
        return $this->findAll();
    }

    public function excluirSegmento($id)
    {
        return $this->delete($id);
    }
}

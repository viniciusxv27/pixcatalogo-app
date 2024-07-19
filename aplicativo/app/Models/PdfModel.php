<?php

namespace App\Models;

use CodeIgniter\Model;

class PdfModel extends Model
{
    protected $table = 'pdf';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nome', 'caminho', 'capa', 'capa_2', 'capa_3', 'produtos_ids'];

    public function inserirPdf($data)
    {
        $this->insert($data);
        return $this->getInsertID();
    }

    public function totalPdfs()
    {
        return $this->countAllResults();
    }

    public function atualizarPdf($id, $data)
    {
        return $this->update($id, $data);
    }

    public function obterPdf($id)
    {
        return $this->find($id);
    }

    public function listarPdfs()
    {
        return $this->findAll();
    }

    public function excluirPdf($id)
    {
        return $this->delete($id);
    }
}

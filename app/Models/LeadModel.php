<?php

namespace App\Models;

use CodeIgniter\Model;

class LeadModel extends Model
{
    protected $table = 'lead';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'email', 'empresa', 'cargo', 'telefone'];

    public function inserirLead($dados)
    {
        $this->insert($dados);
        return $this->getInsertID();
    }

    public function listarLeads()
    {
        return $this->findAll();
    }
    
    public function loginLead($email)
    {
        return $this->where('email', $email)->findAll();
    }

    public function obterLead($id)
    {
        return $this->find($id);
    }

    public function atualizarLead($id, $dados)
    {
        return $this->update($id, $dados);
    }

    public function excluirLead($id)
    {
        return $this->delete($id);
    }

    public function loginEmail()
    {
        return 1;
    }


}

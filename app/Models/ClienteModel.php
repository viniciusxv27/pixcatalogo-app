<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'sobrenome', 'email', 'data_nascimento', 'telefone', 'nome_empresa', 'ramo_atividade', 'senha'];

    public function cadastrar_cliente($data)
    {
        $this->insert($data);
        return $this->insertID();
    }

    public function obter_cliente($id)
    {
        return $this->find($id);
    }

    public function atualizar_cliente($cliente_id, $data)
    {
        $this->update($cliente_id, $data);
    }

    public function obter_cliente_por_email($email)
    {
        return $this->where('email', $email)->first();
    }
}

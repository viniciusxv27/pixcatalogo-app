<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'user'; // Nome da tabela
    protected $primaryKey = 'id'; // Chave primária da tabela

    protected $allowedFields = ['codigo', 'password'];

    public function status($where)
    {
        return $this->where($where)->get();
    }
    
    public function definirCred($data)
    {
        return $this->update(1, $data);
    }

    public function getCode($code)
    {
        return $this->where('codigo', $code)->findAll();
    }
}

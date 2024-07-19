<?php

namespace App\Models;

use CodeIgniter\Model;

class AcessosModel extends Model
{
    protected $table = 'acessos';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';

    protected $allowedFields = ['ip', 'navegador', 'tipo', 'data'];

    public function inserir_acesso($data)
    {
        $this->db->table('acessos')->insert($data);
    }

    public function obter_total_acessos_mes($mes, $ano)
    {
        $this->db->where('MONTH(data)', $mes);
        $this->db->where('YEAR(data)', $ano);
        return $this->db->countAllResults();
    }

    public function obter_total_acessos_por_ano($ano)
    {
        $total_acessos = array();

        for ($mes = 1; $mes <= 12; $mes++) {
            $total_acessos[$mes] = $this->obter_total_acessos_mes($mes, $ano);
        }

        return $total_acessos;
    }
}

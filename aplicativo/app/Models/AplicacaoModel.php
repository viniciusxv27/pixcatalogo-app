<?php

namespace App\Models;

use CodeIgniter\Model;

class AplicacaoModel extends Model
{
    protected $table = 'aplicacao';
    protected $primaryKey = 'id';
    protected $allowedFields = ['montadora', 'veiculo', 'modelo', 'motor', 'conf_motor', 'inicio', 'fim', 'segmento_id'];

    public function inserirAplicacao($data)
    {
        return $this->insert($data);
    }

    public function totalAplicacoes()
    {
        return $this->countAllResults();
    }

    public function atualizarAplicacao($id, $data)
    {
        return $this->update($id, $data);
    }

    public function obterAplicacao($id)
    {
        return $this->find($id);
    }

    public function listarAplicacoes()
    {
        return $this->findAll();
    }

    public function excluirAplicacao($id)
    {
        return $this->delete($id);
    }

    // Rest

    public function sistema()
    {
        return $this->db->table('sistema')->get()->getResult();
    }

    public function segmentos()
    {
        return $this->db->table('segmento')->get()->getResult();
    }

    public function montadoras($id_segmento)
    {
        return $this->distinct()->select('montadora')->where('segmento_id', $id_segmento)->get()->getResult();
    }

    public function veiculo($segmento_id, $montadora)
    {
        return $this->distinct()->select('veiculo')->where('segmento_id', $segmento_id)->where('montadora', $montadora)->get()->getResult();
    }

    public function ano($montadora, $veiculo)
    {
        return $this->selectMin('inicio as valor_minimo_inicio')->selectMax('fim as valor_maximo_fim')->where('montadora', $montadora)->where('veiculo', $veiculo)->get()->getRow();
    }

    public function aplicacaoIds($segmento_id, $montadora, $veiculo, $modelo)
    {
        if($montadora && $veiculo && $modelo){
            return $this->select('id')->where('veiculo', $veiculo)->where('modelo', $modelo)->where('segmento_id', $segmento_id)->where('montadora', $montadora)->get()->getResult();            
        } elseif($montadora && $veiculo){
            return $this->select('id')->where('veiculo', $veiculo)->where('segmento_id', $segmento_id)->where('montadora', $montadora)->get()->getResult();
        } elseif($montadora){
            return $this->select('id')->where('segmento_id', $segmento_id)->where('montadora', $montadora)->get()->getResult();
        }

        return $this->select('id')->where('veiculo', $veiculo)->where('modelo', $modelo)->where('segmento_id', $segmento_id)->where('montadora', $montadora)->get()->getResult();
    }

    public function modelo($segmento_id, $montadora, $veiculo)
    {
        return $this->distinct()->select('modelo')->where('veiculo', $veiculo)->where('segmento_id', $segmento_id)->where('montadora', $montadora)->get()->getResult();
    }

    public function produtoAplicacao($aplicacaoIds)
    {
        return $this->whereIn('id', $aplicacaoIds)->get()->getResult();
    }

    public function aplicacaoProdutos($aplicacaoIds, $sistema)
    {
        $builder = $this->db->table('produtos');
        $builder->select('*')->where('sistema_id', $sistema);
    
        $orWhereClause = '';
        foreach ($aplicacaoIds as $id) {
            $orWhereClause .= ' OR JSON_CONTAINS(aplicacao_ids, \'["' . $id . '"]\')';
        }
        $orWhereClause = ltrim($orWhereClause, ' OR ');
    
        $builder->where($orWhereClause);
    
        return $builder->get()->getResultArray();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nome', 'marca', 'foto', 'aplicacao_ids', 'codigo_ean', 'codigo_ncm', 'garantia', 'garantia_km', 'altura', 'comprimento', 'largura', 'peso', 'quantidade', 'terminal', 'combustivel', 'injecao', 'similar_ids', 'sistema_id', 'codigo', 'linha_id', 'descricao','observacao'];

    public function inserirProduto($data)
    {
        $this->insert($data);
        return $this->getInsertID();
    }

    public function totalProdutos()
    {
        return $this->countAllResults();
    }

    public function atualizarProduto($id, $data)
    {
        return $this->update($id, $data);
    }

    public function obterProduto($id)
    {
        return $this->find($id);
    }

    public function listarProdutos()
    {
        return $this->findAll();
    }

    public function listarProdutosLinha($id)
    {
        return $this->where('linha_id', $id)->findAll();
    }

    public function excluirProduto($id)
    {
        return $this->delete($id);
    }

    public function pesquisarProdutos($palavraChave)
    {
        return $this->like('nome', $palavraChave)->orLike('codigo', $palavraChave)->findAll();
    }

    public function pesquisarProdutosGeral($palavraChave)
    {
        $builder = $this->db->table('aplicacao');
        $builder->select('id')
                ->like('montadora', $palavraChave)
                ->orLike('veiculo', $palavraChave)
                ->orLike('modelo', $palavraChave)
                ->orLike('motor', $palavraChave)
                ->orLike('conf_motor', $palavraChave)
                ->orLike('inicio', $palavraChave)
                ->orLike('fim', $palavraChave);
        
        $aplicacaoIds = $builder->get()->getResultArray();
        $ids = array_column($aplicacaoIds, 'id');
        
        $builder = $this->db->table('produtos');
        $builder->select('*')->like('nome', $palavraChave)
                ->orLike('codigo', $palavraChave)
                ->orLike('descricao', $palavraChave)
                ->orLike('observacao', $palavraChave);
        
        foreach ($ids as $id) {
            $builder->orLike('aplicacao_ids', '"'.$id.'"');
        }
                
        return $builder->get()->getResultArray();
    }

    public function pesquisarProdutosSistema($sistemaId)
    {
        return $this->like('sistema_id', $sistemaId)->findAll();
    }
    
    public function pesquisarFiltros()
    {
        $filtros[] = $this->select('marca')->distinct()->findAll();
        $builder = $this->db->table('linha');
        $filtros[] = $builder->select('nome')->distinct()->get()->getResultArray();
        $builder = $this->db->table('sistema');
        $filtros[] = $builder->select('nome')->distinct()->get()->getResultArray();
        return $filtros;
    }
    
    public function pesquisarFiltro($marcas, $sistemas, $linhas)
    {
        $builder = $this->db->table('produtos');
        $builder->select('produtos.*');
    
        if (!empty($sistemas)) {
            $builder->join('sistema', 'produtos.sistema_id = sistema.id');
            $builder->whereIn('sistema.nome', $sistemas);
        }
    
        if (!empty($linhas)) {
            $builder->join('linha', 'produtos.linha_id = linha.id');
            $builder->whereIn('linha.nome', $linhas);
        }
    
        if (!empty($marcas)) {
            $builder->whereIn('marca', $marcas);
        }
    
        return $builder->get()->getResultArray();
    }

    public function gerarPdf($codigos)
    {
        $builder = $this->db->table('produtos');
        $builder->select('*');
        $builder->whereIn('codigo', $codigos);
        $produtos = $builder->get()->getResultArray();

        foreach ($produtos as &$produto) {

            $ids = json_decode($produto['aplicacao_ids']); 
            $ids = array_filter($ids, function($value) {
                return !empty($value);
            });
            $ids = array_values($ids);

            $aplicacoes = $this->db->table('aplicacao')->select('*')->whereIn('id', $ids)->get()->getResultArray();
            $produto['aplicacoes'] = $aplicacoes;
        }

        return $produtos;
    }
}

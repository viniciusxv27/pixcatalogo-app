<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoModel extends Model
{
    protected $table = 'fotos';
    protected $primaryKey = 'idfotos';
    protected $allowedFields = ['produto_id', 'img_url'];

    public function inserirFoto($data)
    {
        $this->insert($data);
        return $this->getInsertID();
    }

    public function obterFotosPorProduto($produto_id)
    {
        return $this->where('produto_id', $produto_id)->findAll();
    }

    public function obterFotoPorId($foto_id)
    {
        return $this->find($foto_id);
    }

    public function excluirFoto($fotoId)
    {
        if (!is_numeric($fotoId) || $fotoId <= 0) {
            return false;
        }

        $foto = $this->find($fotoId);

        if (!$foto) {
            return false;
        }

        $upload_path = WRITEPATH . 'uploads/' . $foto['produto_id'] . '/';
        $foto_path = $upload_path . $foto['img_url'];

        if (file_exists($foto_path)) {
            unlink($foto_path);
        }

        $this->delete($fotoId);

        return true;
    }
}

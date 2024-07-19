<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo isset($pdf) ? 'Editar Pdf' : 'Criar Pdf'; ?></h6>
        </div>
        <div class="card-body"> 
            
        <div class=" row">
            <div class="col-lg-8 col-sm-12"> 
            <form method="post" enctype="multipart/form-data" >
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($pdf) ? $pdf['nome'] : ''; ?>">
                  </div>

                </div>

                <div class="col-lg-12 col-sm-12">

                  <?php if ( isset($pdf)) { ?>
                    <div class="form-group d-f-center">
                        <img  src="<?php echo base_url($pdf['capa']); ?>" style="max-width: 250px;">
                    </div>
                  <?php }  ?>

                  <div class="form-group d-f-center">
                    <label for="foto">Foto capa:</label>
                    <input type="file" class="form-control-file" id="foto" name="foto">
                  </div>

                  <?php if ( isset($pdf)) { ?>
                    <div class="form-group d-f-center">
                        <img  src="<?php echo base_url($pdf['capa_2']); ?>" style="max-width: 250px;">
                    </div>
                  <?php }  ?>
                  
                  <div class="form-group d-f-center">
                    <label for="foto2">Foto 2º capa:</label>
                    <input type="file" class="form-control-file" id="foto2" name="foto2">
                  </div>

                  <?php if ( isset($pdf)) { ?>
                    <div class="form-group d-f-center">
                        <img  src="<?php echo base_url($pdf['capa_3']); ?>" style="max-width: 250px;">
                    </div>
                  <?php }  ?>
                  
                  <div class="form-group d-f-center">
                    <label for="foto3">Foto 3º capa:</label>
                    <input type="file" class="form-control-file" id="foto3" name="foto3">
                  </div>

                </div>
                <div class="col-lg-12 col-sm-12">
                  <div class="form-group col-lg-12 col-sm-12">
                      <label for="produto">Produtos: <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarProduto">+</button></label>
                      <select class="form-control select2" id="aplicacao" name="produtos[]" multiple="multiple">
                          <?php foreach ($produtos as $produto) : ?>
                              <?php
                                if (isset($pdf)) :
                                  $produtos_ids_array = json_decode($pdf['produtos_ids']);
                                  $selected = in_array($produto['id'], $produtos_ids_array) ? 'selected' : '';
                              ?>
                                  <option value="<?= $produto['id']; ?>" <?= $selected; ?>>
                                      <?= $produto['codigo'] . ' - ' . $produto['nome'] . ' - ' . $produto['marca']; ?>
                                  </option>
                              <?php else : ?>
                                  <option value="<?= $produto['id']; ?>">
                                      <?= $produto['codigo'] . ' - ' . $produto['nome'] . ' - ' . $produto['marca']; ?>
                                  </option>
                              <?php endif; ?>
                          <?php endforeach; ?>
                      </select>
                  </div>
                </div>
                <div class="form-group col-lg-12 col-sm-12">
                    <button type="submit" class="btn btn-primary"><?php echo isset($pdf) ? 'Salvar' : 'Gerar PDF'; ?></button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>


<!-- Modal aplicação -->
<div class="modal fade" id="modalAdicionarProduto" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarProdutoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAdicionarProdutoLabel">Adicionar Produto </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" id="formAdicionarProduto">
          <div class="form-group">
                <label for="segmento">Segmento:</label>
                <select class="form-control select2" id="segmento" name="segmento">
                    <option value="">Selecione o Segmento</option>
                    <?php foreach ($segmentos as $segmento) { ?>
                        <option value="<?php echo $segmento['id']; ?>" <?php echo isset($produto) && $produto['segmento_id'] == $segmento['id'] ? 'selected' : ''; ?>><?php echo $segmento['nome']; ?></option>
                    <?php } ?>
                </select>
          </div>
          <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome">
          </div>
          <div class="form-group">
            <label for="marca">Marca:</label>
            <input type="text" class="form-control" id="marca" name="marca">
          </div>
          <div class="form-group">
            <label for="foto">Foto:</label>
            <input type="file" name="foto" id="foto">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="salvarProduto">Salvar</button>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
    .box-c{
        background-color: #f0f0f0;
    margin-bottom: 10px;
    padding: 10px 0px;
    border-radius: 7px;
    }
    h5.inf-box {
        font-size: 15px;
        font-weight: 600;
        color: #797979;
    }
    #qrcode img {
        cursor: pointer;
        border: solid 1px;
        margin-top: 20px;
        border-radius: 20px;
    }
    .lista-fotos {
        display: flex;
        background-color: #d5d5d5;
        overflow: auto;
        margin-bottom: 15px;
    }

    .lista-fotos img {
        max-width: 100px;
        padding: 10px;
    }
</style>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo isset($produto) ? 'Editar Produto' : 'Criar Produto'; ?></h6>
        </div>
        <div class="card-body"> 
            
        <div class=" row">
            <div class="col-lg-8 col-sm-12"> 
            <form method="post"  enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($produto) ? $produto['nome'] : ''; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="marca">Marca:</label>
                        <input type="text" class="form-control" id="marca" name="marca" value="<?php echo isset($produto) ? $produto['marca'] : ''; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="codigo">Código produto:</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo isset($produto) ? $produto['codigo'] : ''; ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao"><?php echo isset($produto) ? $produto['descricao'] : ''; ?></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="observacao">Observação</label>
                        <textarea class="form-control" id="observacao" name="observacao"><?php echo isset($produto) ? $produto['observacao'] : ''; ?></textarea>
                    </div>
                </div>
                <div class="form-row box-c">
                    <div class="col-12"> 
                     <h5 class="inf-box">Fiscal</h5> 
                     </div>
                    <div class="form-group col-lg-4 col-sm-12">
                        <label for="codigo_ean">Código EAN:</label>
                        <input type="number" class="form-control" id="codigo_ean" name="codigo_ean" value="<?php echo isset($produto) ? $produto['codigo_ean'] : ''; ?>">
                    </div>
                    <div class="form-group col-lg-4 col-sm-12">
                        <label for="codigo_ncm">Código NCM:</label>
                        <input type="number" class="form-control" id="codigo_ncm" name="codigo_ncm" value="<?php echo isset($produto) ? $produto['codigo_ncm'] : ''; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-sm-12">
                        <label for="garantia">Garantia (meses):</label>
                        <input type="number" class="form-control" id="garantia" name="garantia" value="<?php echo isset($produto) ? $produto['garantia'] : ''; ?>">
                    </div>
                    <div class="form-group col-lg-2 col-sm-12">
                        <label for="garantia_km">Garantia (km):</label>
                        <input type="number" class="form-control" id="garantia_km" name="garantia_km" value="<?php echo isset($produto) ? $produto['garantia_km'] : ''; ?>">
                    </div>
                </div>
                <div class="form-row box-c">
                    <div class="col-12"><h5 class="inf-box">Logístico</h5> </div>
                    <div class="form-group col-lg-3  col-sm-12">
                        <label for="altura">Altura (cm):</label>
                        <input type="number" class="form-control" id="altura" name="altura" value="<?php echo isset($produto) ? $produto['altura'] : ''; ?>">
                    </div>
                    <div class="form-group col-lg-3  col-sm-12">
                        <label for="comprimento">Comprimento (cm):</label>
                        <input type="number" class="form-control" id="comprimento" name="comprimento" value="<?php echo isset($produto) ? $produto['comprimento'] : ''; ?>">
                    </div>
                    <div class="form-group col-lg-2  col-sm-12">
                        <label for="largura">Largura (cm):</label>
                        <input type="number" class="form-control" id="largura" name="largura" value="<?php echo isset($produto) ? $produto['largura'] : ''; ?>">
                    </div>
                    <div class="form-group col-lg-2  col-sm-12">
                        <label for="peso">Peso (kg):</label>
                        <input type="number" class="form-control" id="peso" name="peso" value="<?php echo isset($produto) ? $produto['peso'] : ''; ?>">
                    </div>
                    <div class="form-group col-lg-2  col-sm-12">
                        <label for="quantidade">Quantidade:</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?php echo isset($produto) ? $produto['quantidade'] : ''; ?>">
                    </div>
                </div>
                <div class="form-row box-c">
                    <div class="col-12"><h5 class="inf-box">Dados técnicos</h5> </div>
                    <div class="form-group col-lg-2  col-sm-12">
                        <label for="terminal">Terminal:</label>
                        <input class="form-control" id="terminal" name="terminal" value="<?php echo isset($produto) ? $produto['terminal'] : ''; ?>">
                    </div>
                    <div class="form-group col-lg-2  col-sm-12">
                        <label for="combustivel">Combustível:</label>
                        <input class="form-control" id="combustivel" name="combustivel" value="<?php echo isset($produto) ? $produto['combustivel'] : ''; ?>">
                    </div>
                    <div class="form-group col-lg-2  col-sm-12">
                        <label for="injecao">Injeção:</label>
                        <input class="form-control" id="injecao" name="injecao" value="<?php echo isset($produto) ? $produto['injecao'] : ''; ?>">
                    </div>
                </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <?php if ( isset($produto)) { ?>
                        <div class="form-group d-f-center">
                            <img  src="<?php echo base_url('uploads/'.$produto['foto']); ?>" style="max-width: 250px;">
                        </div>
                    <?php }  ?>
                    <div class="form-group d-f-center">
                        <label for="foto">Foto capa:</label>
                        <input type="file" class="form-control-file" id="foto" name="foto">
                    </div>
                    <div id="lista-fotos" class="lista-fotos">
                    </div>
                    <?php if ( isset($produto)) { ?>
                        <center>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                              Adicionar fotos
                            </button>
                        </center>
                    <?php }  ?>
                    <?php if ( isset($produto)) { ?>
                    <div class="form-group d-f-center">
                         <div id="qrcode"><img src=""></div>
                    </div>
                    <?php }  ?>
                </div>

                
                
                <!-- selects -->
                <div class="col-lg-12 col-sm-12">
                    <div class="row">
                       
                        <div class="form-group col-lg-6 col-sm-12">
                            <label for="sistema">Sistema:</label>
                            <select class="form-control select2" id="sistema" name="sistema">
                                <option value="">Selecione o Sistema</option>
                                <?php 
                                foreach ($sistemas as $sistema) : ?>
                                    <option value="<?= $sistema['id']; ?>" <?= (isset($produto) && $produto['sistema_id'] == $sistema['id']) ? 'selected' : ''; ?>>
                                        <?= $sistema['nome']; ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-sm-12">
                            <label for="linha">Linha do produto/Categoria:</label>
                            <select class="form-control select2" id="linha" name="linha">
                                <option value="">Selecione</option>
                                <?php foreach ($linhas as $linha) : ?>
                                    <?php if (isset($produto)) : ?>
                                        <option value="<?= $linha['id']; ?>" <?= (isset($linha) && $produto['linha_id'] == $linha['id']) ? 'selected' : ''; ?>>
                                            <?= $linha['nome']; ?>
                                        </option>
                                    <?php else : ?>
                                        <option value="<?= $linha['id']; ?>"><?= $linha['nome']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                     </div>
                <div class="form-group col-lg-12 col-sm-12">
                    <label for="aplicacao">Aplicação: <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionarAplicacao">+</button></label>
                    <select class="form-control select2" id="aplicacao" name="aplicacao[]" multiple="multiple">
                    <?php foreach ($aplicacoes as $aplicacao) : ?>
                        <?php
                        if (isset($produto)) :
                            $aplicacao_ids_array = json_decode($produto['aplicacao_ids']);
                            $selected = in_array($aplicacao['id'], $aplicacao_ids_array) ? 'selected' : '';
                        ?>
                            <option value="<?= $aplicacao['id']; ?>" <?= $selected; ?>>
                                <?= $aplicacao['montadora'] . ' - ' . $aplicacao['veiculo'] . ' - ' . $aplicacao['modelo'] . ' - ' . $aplicacao['conf_motor'] . ' ' . $aplicacao['inicio'] . '~' . $aplicacao['fim']; ?>
                            </option>
                        <?php else : ?>
                            <option value="<?= $aplicacao['id']; ?>">
                                <?= $aplicacao['montadora'] . ' - ' . $aplicacao['veiculo'] . ' - ' . $aplicacao['modelo'] . ' - ' . $aplicacao['conf_motor'] . ' ' . $aplicacao['inicio'] . '~' . $aplicacao['fim']; ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-lg-12 col-sm-12">
                    <button type="submit" class="btn btn-primary"><?php echo isset($produto) ? 'Salvar' : 'Criar Produto'; ?></button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>



<!-- Modal aplicação -->
<div class="modal fade" id="modalAdicionarAplicacao" tabindex="-1" role="dialog" aria-labelledby="modalAdicionarAplicacaoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAdicionarAplicacaoLabel">Adicionar Aplicação </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAdicionarAplicacao">
          <div class="form-group">
                <label for="segmento">Segmento:</label>
                <select class="form-control select2" id="segmento" name="segmento">
                    <option value="">Selecione o Segmento</option>

                </select>
          </div>
          <div class="form-group">
            <label for="montadora">Montadora:</label>
            <input type="text" class="form-control" id="montadora" name="montadora">
          </div>
          <div class="form-group">
            <label for="veiculo">Veículo:</label>
            <input type="text" class="form-control" id="veiculo" name="veiculo">
          </div>
          <div class="form-group">
            <label for="modelo">Modelo:</label>
            <input type="text" class="form-control" id="modelo" name="modelo">
          </div>
          <div class="form-group">
            <label for="motor">Motor:</label>
            <input type="text" class="form-control" id="motor" name="motor">
          </div>
          <div class="form-group">
            <label for="config_motor">Configuração do Motor:</label>
            <input type="text" class="form-control" id="config_motor" name="config_motor">
          </div>
          <div class="form-group">
            <label for="inicio">Início:</label>
            <input type="number" class="form-control" id="inicio" name="inicio">
          </div>
          <div class="form-group">
            <label for="fim">Fim:</label>
            <input type="number" class="form-control" id="fim" name="fim">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" id="salvarAplicacao">Salvar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal add fotos-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group d-f-center">
                <label for="foto"></label>
                <form action="<?php echo base_url('produto/upload_foto/');?><?php echo isset($produto) ? $produto['id'] : ''; ?>" class="dropzone" id="my-dropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>
                </form>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript"> const produto_id = <?php echo isset($produto) ? $produto['id'] : ''; ?>;</script>

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
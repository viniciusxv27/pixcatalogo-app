<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo isset($aplicacao) ? 'Editar Aplicação' : 'Criar Aplicação'; ?></h6>
        </div>
        <div class="card-body"> 
        <div class=" ">
            <form method="post" class="row">
                <div class="form-group col-lg-6 col-sm-12">
                    <label for="segmento">Segmento:</label>
                    <select class="form-control select2" id="segmento" name="segmento">
                        <option value="">Selecione o Segmento</option>
                        <?php foreach ($segmentos as $segmento) { ?>
                            <option value="<?php echo $segmento['id']; ?>" <?php echo isset($aplicacao) && $aplicacao['segmento_id'] == $segmento['id'] ? 'selected' : ''; ?>><?php echo $segmento['nome']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-lg-6 col-sm-12">
                    <label for="montadora">Montadora:</label>
                    <input type="text" class="form-control" id="montadora" name="montadora" value="<?php echo isset($aplicacao) ? $aplicacao['montadora'] : ''; ?>">
                </div>
                <div class="form-group col-lg-6 col-sm-12">
                    <label for="veiculo">Veículo:</label>
                    <input type="text" class="form-control" id="veiculo" name="veiculo" value="<?php echo isset($aplicacao) ? $aplicacao['veiculo'] : ''; ?>">
                </div>
                <div class="form-group col-lg-6 col-sm-12">
                    <label for="modelo">Modelo:</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo isset($aplicacao) ? $aplicacao['modelo'] : ''; ?>">
                </div>
                <div class="form-group col-lg-6 col-sm-12">
                    <label for="motor">Motor:</label>
                    <input type="text" class="form-control" id="motor" name="motor" value="<?php echo isset($aplicacao) ? $aplicacao['motor'] : ''; ?>">
                </div>
                <div class="form-group col-lg-6 col-sm-12">
                    <label for="conf_motor">Configuração do Motor:</label>
                    <input type="text" class="form-control" id="conf_motor" name="conf_motor" value="<?php echo isset($aplicacao) ? $aplicacao['conf_motor'] : ''; ?>">
                </div>
                <div class="form-group col-lg-6 col-sm-12">
                    <label for="inicio">Início:</label>
                    <input type="number" max="9999" class="form-control" id="inicio" name="inicio" value="<?php echo isset($aplicacao) ? $aplicacao['inicio'] : ''; ?>">
                </div>
                <div class="form-group col-lg-6 col-sm-12">
                    <label for="fim">Fim:</label>
                    <input type="number" max="9999" class="form-control" id="fim" name="fim" value="<?php echo isset($aplicacao) ? $aplicacao['fim'] : ''; ?>">
                </div>
                <button type="submit" class="btn btn-primary"><?php echo isset($aplicacao) ? 'Salvar Alterações' : 'Criar Aplicação'; ?></button>
            </form>
        </div>
        </div>
    </div>
</div>
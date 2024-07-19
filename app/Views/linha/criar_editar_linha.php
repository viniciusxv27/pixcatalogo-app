<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo isset($linha) ? 'Editar Linha' : 'Criar Linha'; ?></h6>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($linha) ? $linha['nome'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="foto">Foto (Anexo):</label>
                    <input type="file" class="form-control-file" id="foto" name="foto">
                </div>
                <?php if (isset($linha) && !empty($linha['img_url'])) { ?>
                    <div class="form-group">
                        <label>Imagem Atual:</label>
                        <br>
                        <img src="<?php echo base_url($linha['img_url']); ?>" alt="Imagem Atual" class="img-thumbnail">
                    </div>
                <?php } ?>
                <button type="submit" class="btn btn-primary"><?php echo isset($linha) ? 'Salvar Alterações' : 'Criar Linha'; ?></button>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?php echo isset($sistema) ? 'Editar Sub-Linha' : 'Criar Sub-Linha'; ?></h6>
    </div>
    <div class="card-body"> 
        <form method="post">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($sistema) ? $sistema['nome'] : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary"><?php echo isset($sistema) ? 'Salvar Alterações' : 'Criar Sub-Linha'; ?></button>
        </form>
    </div>
    </div>
</div>
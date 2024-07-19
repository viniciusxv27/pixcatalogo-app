<div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?php echo isset($segmento) ? 'Editar Segmento' : 'Criar Segmento'; ?></h6>
    </div>
    <div class="card-body"> 
        <form method="post">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($segmento) ? $segmento['nome'] : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary"><?php echo isset($segmento) ? 'Salvar Alterações' : 'Criar Segmento'; ?></button>
        </form>
    </div>
    </div>
</div>
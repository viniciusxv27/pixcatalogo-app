
<div class="container-fluid">
<div class="card shadow mb-4">
<div class="">
    <div class="card-header py-3">
        <h6><?php echo isset($banner) ? 'Editar Banner' : 'Criar Banner'; ?></h6>
    </div>

    <div class="card-body"> 
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="texto">Link:</label>
            <input type="text" class="form-control" id="texto" name="texto" value="<?php echo isset($banner) ? $banner['texto'] : ''; ?>">
        </div>
        <div class="form-group">
            
            <?php if (isset($banner)): ?>
                <img style="max-width: 300px" src="<?php echo site_url('uploads/banner/');?><?php echo $banner['arquivo_banner']; ?>">
            <?php endif ?><br>
            <label for="arquivo_banner">Arquivo de Banner:</label>
            <input type="file" id="arquivo_banner" name="arquivo_banner">
            
        </div>
        <button type="submit" class="btn btn-primary"><?php echo isset($banner) ? 'Salvar Alterações' : 'Adicionar Banner'; ?></button>
    </form>
    </div>
</div>
</div>
</div>
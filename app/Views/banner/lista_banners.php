<div class="container-fluid">
<div class="card shadow mb-4">
<div class="">
    <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Lista de Banners</h6>
    </div>
    <div class="card-body"> 
        <a href="<?php echo site_url('banner/criar_editar/');?>" class="btn btn-primary mb-3">Novo Banner</a>
    <table id="produtoTable" class="display" >
        <thead>
        <tr>
            <th>ID</th>
            <th>Link</th>
            <th></th>
            <th>Ações</th>
        </tr>
        </thead>
        <?php foreach ($banners as $banner) { ?>
            <tr>
                <td><?php echo $banner['id']; ?></td>
                <td><?php echo $banner['texto']; ?></td>
                <td><img style="max-width: 80px" src="<?php echo site_url('uploads/banner/');?><?php echo $banner['arquivo_banner']; ?>"></td>
                <td>
                    <a class="btn btn-primary btn-sm" href="<?php echo site_url('banner/criar_editar/' . $banner['id']); ?>">Editar</a>
                    <a class="btn btn-danger btn-sm" href="<?php echo site_url('banner/excluir/' . $banner['id']); ?>">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>
</div>
</div>
</div>



<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Lista de Segmentos</h6>
        </div>
        <div class="card-body"> 
            <a href="<?php echo site_url('segmento/criar_editar'); ?>" class="btn btn-primary mb-3">Novo Segmento</a>
            <table id="segmentoTable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($segmentos as $segmento) { ?>
                        <tr>
                            <td><?php echo $segmento['id']; ?></td>
                            <td><?php echo $segmento['nome']; ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="<?php echo site_url('segmento/criar_editar/' . $segmento['id']); ?>">Editar</a>
                                <a class="btn btn-danger btn-sm" href="<?php echo site_url('segmento/excluir/' . $segmento['id']); ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
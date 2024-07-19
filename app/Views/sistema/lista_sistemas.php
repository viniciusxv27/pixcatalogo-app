<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Lista de Sub-Linhas</h6>
        </div>
        <div class="card-body"> 
            <a href="<?php echo site_url('sistema/criar_editar'); ?>" class="btn btn-primary mb-3">Nova Linha</a>
            <table id="linhaTable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sistemas as $sistema) { ?>
                        <tr>
                            <td><?php echo $sistema['id']; ?></td>
                            <td><?php echo $sistema['nome']; ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="<?php echo site_url('sistema/criar_editar/' . $sistema['id']); ?>">Editar</a>
                                <a class="btn btn-danger btn-sm"  href="<?php echo site_url('sistema/excluir/' . $sistema['id']); ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
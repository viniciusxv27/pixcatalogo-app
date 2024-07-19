<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Linhas</h6>
        </div>
        <div class="card-body">
            <a href="<?php echo site_url('linha/criar_editar'); ?>" class="btn btn-primary mb-3">Nova Linha</a>
            <table id="linhaTable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Foto</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($linhas as $linha) { ?>
                        <tr>
                            <td><?php echo $linha['id']; ?></td>
                            <td><?php echo $linha['nome']; ?></td>
                            <td>
                                <?php if (!empty($linha['img_url'])) { ?>
                                    <img src="<?php echo base_url($linha['img_url']); ?>" alt="Imagem" class="img-thumbnail" width="50">
                                <?php } ?>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="<?php echo site_url('linha/criar_editar/' . $linha['id']); ?>">Editar</a>
                                <a class="btn btn-danger btn-sm" href="<?php echo site_url('linha/excluir/' . $linha['id']); ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
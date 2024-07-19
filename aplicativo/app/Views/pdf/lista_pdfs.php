<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Lista de PDF</h6>
        </div>
        <div class="card-body"> 
            <a href="<?php echo site_url('pdf/criar_editar'); ?>" class="btn btn-primary mb-3">Novo PDF</a>
            <table id="linhaTable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pdfs as $pdf) { ?>
                        <tr>
                            <td><?php echo $pdf['id']; ?></td>
                            <td><?php echo $pdf['nome']; ?></td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="<?php echo $pdf['caminho']; ?>">Abrir</a>
                                <a class="btn btn-primary btn-sm" href="<?php echo site_url('pdf/criar_editar/' . $pdf['id']); ?>">Editar</a>
                                <a class="btn btn-danger btn-sm"  href="<?php echo site_url('pdf/excluir/' . $pdf['id']); ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
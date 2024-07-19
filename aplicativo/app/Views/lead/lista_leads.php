<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Lista de Logins</h6>
        </div>
        <div class="card-body"> 
            <a href="<?php echo site_url('lead/criar_editar'); ?>" class="btn btn-primary mb-3">Novo Login</a>
            <table id="linhaTable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Empresa</th>
                        <th>Cargo</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leads as $lead) { ?>
                        <tr>
                            <td><?php echo $lead['id']; ?></td>
                            <td><?php echo $lead['nome']; ?></td>
                            <td><?php echo $lead['email']; ?></td>
                            <td><?php echo $lead['empresa']; ?></td>
                            <td><?php echo $lead['cargo']; ?></td>
                            <td><?php echo $lead['telefone']; ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="<?php echo site_url('lead/criar_editar/' . $lead['id']); ?>">Editar</a>
                                <a class="btn btn-danger btn-sm" href="<?php echo site_url('lead/excluir/' . $lead['id']); ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
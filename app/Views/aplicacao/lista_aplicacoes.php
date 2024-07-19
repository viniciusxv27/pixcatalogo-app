<div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Aplicações</h6>
    </div>
    <div class="card-body"> 
        <div class="">
        <a href="<?php echo site_url('aplicacao/criar_editar'); ?>" class="btn btn-primary mb-3">Nova Aplicação</a>
        <table id="aplicacaoTable" class="display">
            <thead>
                <tr>
                    <th>Montadora</th>
                    <th>Veículo</th>
                    <th>Modelo</th>
                    <th>Motor</th>
                    <th>Configuração do Motor</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($aplicacoes as $aplicacao) { ?>
                    <tr>
                        <td><?php echo $aplicacao['montadora']; ?></td>
                        <td><?php echo $aplicacao['veiculo']; ?></td>
                        <td><?php echo $aplicacao['modelo']; ?></td>
                        <td><?php echo $aplicacao['motor']; ?></td>
                        <td><?php echo $aplicacao['conf_motor']; ?></td>
                        <td><?php echo $aplicacao['inicio']; ?></td>
                        <td><?php echo $aplicacao['fim']; ?></td>
                        <td class="df-end">
                            <a class="btn btn-primary btn-sm" href="<?php echo site_url('aplicacao/criar_editar/' . $aplicacao['id']); ?>">Editar</a>
                            <a class="btn btn-danger btn-sm" href="<?php echo site_url('aplicacao/excluir/' . $aplicacao['id']); ?>">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>
</div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Lista de Produtos</h6>
        </div>
        <div class="card-body">
            <div class="">
                <a href="<?php echo site_url('produto/criar_editar'); ?>" class="btn btn-primary mb-3">Novo Produto</a>
                <form id="formProdutos" action="<?php echo site_url('produto/gerar_pdf'); ?>" method="post">
                    <table id="produtoTable" class="display">
                        <thead>
                            <tr>
                                <th>Cód.</th>
                                <th>Nome</th>
                                <th>Marca</th>
                                <th>Segmento</th>
                                <th>Sistema</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $segmentos_dict = [];
                                
                                foreach ($segmentos as $segmento) {
                                    $segmentos_dict[$segmento['id']] = $segmento['nome'];
                                }
                                
                                $sistemas_dict = [];
                                
                                foreach ($sistemas as $sistema) {
                                    $sistemas_dict[$sistema['id']] = $sistema['nome'];
                                }
                            ?>
                                
                            <?php foreach ($produtos as $produto) { ?>
                                <tr>
                                    <td><?php echo $produto['codigo']; ?></td>
                                    <td><?php echo $produto['nome']; ?></td>
                                    <td><?php echo $produto['marca']; ?></td>
                                    <td><?php if($produto['segmento_id']){
                                        echo $segmentos_dict[$produto['segmento_id']];
                                    } ?></td>
                                    <td><?php if ($produto['sistema_id']) {
                                        echo isset($sistemas_dict[$produto['sistema_id']]) ? $sistemas_dict[$produto['sistema_id']] : '';
                                    } elseif (!$produto['sistema_id']) {
                                        echo '';
                                    } ?></td>
                                    <td class="df-end">
                                        <a class="btn btn-primary btn-sm" href="<?php echo site_url('produto/criar_editar/' . $produto['id']); ?>">Editar</a>
                                        <a class="btn btn-danger btn-sm" href="<?php echo site_url('produto/excluir/' . $produto['id']); ?>">Excluir</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div><!--card-body -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.checkboxProduto').change(function () {
            var isChecked = $('.checkboxProduto:checked').length > 0;
            $('#btnGerarPDF').toggle(isChecked);
        });
    });
</script>
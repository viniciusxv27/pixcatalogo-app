
<div class="container cad">
    <a href="<?php echo site_url('cliente/logar');?>" class="criar-conta" style="float: left;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path></svg>Voltar</a>
    <br>
    <h2>Cadastro</h2>
    
    <?php  $err = validation_errors();
    if($err){echo '<div class="error">'.validation_errors().'</div>';}  ?>

    <?php if (isset($error)) {
    echo '<div class="error">' . $error . '</div>';
    } ?>

    <form method="post" action="<?php echo site_url('cliente/cadastrar'); ?>" class="fom-cad">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome"><br>

        <label for="sobrenome">Sobrenome:</label>
        <input type="text" id="sobrenome" name="sobrenome"><br>

        <label for="email">E-mail:</label>
        <input type="text" id="email" name="email"><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="text" class="data" id="data_nascimento" name="data_nascimento"><br>

        <label for="telefone">Telefone de Contato/Whatsapp:</label>
        <input type="text" id="telefone" class="telefone" name="telefone"><br>

        <label for="nome_empresa">Nome da Empresa:</label>
        <input type="text" id="nome_empresa" class="nome_empresa" name="nome_empresa"><br>

        <label for="ramo_atividade">Ramo de Atividade:</label>
        <select id="ramo_atividade" name="ramo_atividade">
            <option value="consumidor_final">Consumidor Final</option>
            <option value="distribuidora">Distribuidora</option>
            <option value="industria">Indústria</option>
            <option value="oficina">Oficina</option>
            <option value="outros">Outros</option>
            <option value="servicos">Serviços</option>
            <option value="varejo">Varejo</option>
        </select><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha"><br>

        <label for="confirma_senha">Confirmação de Senha:</label>
        <input type="password" id="confirma_senha" name="confirma_senha" ><br>

        <input type="submit" value="Cadastrar" class="cta-cad">
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
        $(document).ready(function() {
            $('.telefone').mask('(00) 00000-0000', { clearIfNotMatch: true });
            $('.data').mask('00/00/0000', { clearIfNotMatch: true });
        });
    </script>
</body>
</html>

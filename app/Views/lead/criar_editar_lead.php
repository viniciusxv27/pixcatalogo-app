<div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?php echo isset($lead) ? 'Editar Login' : 'Criar Login'; ?></h6>
    </div>
    <div class="card-body"> 
        <form method="post">
            <div class="form-group">
                <label for="cadNomeInput">Nome:</label>
                <input required type="text" class="form-control" id="cadNomeInput" name="cadNomeInput" value="<?php echo isset($lead) ? $lead['nome'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="cadEmailInput">Email:</label>
                <input required type="email" class="form-control" id="cadEmailInput" name="cadEmailInput" value="<?php echo isset($lead) ? $lead['email'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="cadEmpresaInput">Empresa:</label>
                <input required type="text" class="form-control" id="cadEmpresaInput" name="cadEmpresaInput" value="<?php echo isset($lead) ? $lead['empresa'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="cadCargoInput">Cargo:</label>
                <input required type="text" class="form-control" id="cadCargoInput" name="cadCargoInput" value="<?php echo isset($lead) ? $lead['cargo'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="cadTelefoneInput">Telefone:</label>
                <input type="text" class="form-control" id="cadTelefoneInput" name="cadTelefoneInput" value="<?php echo isset($lead) ? $lead['telefone'] : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary"><?php echo isset($lead) ? 'Salvar Alterações' : 'Criar Login'; ?></button>
        </form>
    </div>
    </div>
</div>
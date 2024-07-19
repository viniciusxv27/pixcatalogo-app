<div class="container">
    <div class="align-items-center justify-content-center d-flex flex-column">
        <div class="col-sm-8 card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Opções do Catalogo</h6>
            </div>
            <div class="card-body"> 
                <div class="">
                <form method="post" action="configuracao/salvar_opcoes" enctype="multipart/form-data">
                    <div class="form-check form-switch mb-3">
                <?php
                        if($configuracao['forcar_login'] == '0'){ ?>
                            <input class="form-check-input" value="1" type="checkbox" role="switch" name="forcar_login" id="forcar_login">
                <?php   } elseif($configuracao['forcar_login'] == '1'){ ?>
                            <input class="form-check-input" value="1" type="checkbox" role="switch" name="forcar_login" id="forcar_login" checked>
                <?php   } ?>
                            <label class="form-check-label" for="forcar_login">Forçar Login</label>
                        </div>      
                    </div>
                    <button type="submit" name="salvar_opcoes" id="salvar_opcoes" class="btn btn-primary">Salvar Opções</button>
                </form>
            </div>
        </div>
        <div class="col-sm-8 card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Logo do Catalogo</h6>
            </div>
            <div class="card-body"> 
                <form method="post" action="configuracao/salvar_logo" enctype="multipart/form-data">
                <img src="<?php echo $configuracao['logo'] ?>" class="m-4" height="100px" alt="...">
                <div class="">
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="logo" id="logo" class="logo">
                    </div>
                </div>
                <button type="submit" name="salvar_logo" id="salvar_logo" class="btn btn-primary">Salvar Logo</button>
                </form>
            </div>
        </div>
        <div class="col-sm-8 card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Icone do Catalogo</h6>
            </div>
            <div class="card-body"> 
                <form method="post" action="configuracao/salvar_icone" enctype="multipart/form-data">
                <img src="<?php echo $configuracao['icone'] ?>" class="m-4" height="100px" alt="...">
                <div class="">
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="icone" id="icone" class="icone">
                    </div>
                </div>
                <button type="submit" name="salvar_icone" id="salvar_icone" class="btn btn-primary">Salvar Icone</button>
                </form>
            </div>
        </div>
    </div>

    <div class="align-items-center justify-content-center d-flex flex-column" >
        <div class="col-sm-8 card shadow mb-4 ">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Politicas de Privacidade (PDF)</h6>
            </div>
            <div class="card-body"> 
                <form method="post" action="configuracao/salvar_politicas" enctype="multipart/form-data">
                <div class="">
                    <div class="input-group mb-3">
                        <embed src="<?php echo $configuracao['rodape_politicas']?>" type="application/pdf" width="100%" height="500px">
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="politicas" name="politicas">
                    </div>
                </div>
                <button type="submit" name="salvar_politicas" id="salvar_politicas" class="btn btn-primary">Salvar Politicas de Privacidade</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card row shadow ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informações do Catalogo</h6>
        </div>
        <div class="card-body"> 
            <div class="">
                <form method="post" action="configuracao/salvar_rodape" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nome_marca" class="form-label">Nome da Marca:</label>
                    <input type="text" class="form-control" id="nome_marca" name="nome_marca" value="<?php echo $configuracao['marca'] ?>" placeholder="Nome da Marca">
                </div>
                <div class="mb-3">
                    <label for="rodape_email" class="form-label">Email de Contato:</label>
                    <input type="email" class="form-control" id="rodape_email" name="rodape_email" value="<?php echo $configuracao['rodape_email'] ?>" placeholder="contato@empresa.com">
                </div>
                <div class="mb-3">
                    <label for="rodape_local" class="form-label">Endereço da Empresa:</label>
                    <textarea class="form-control" id="rodape_local" name="rodape_local" rows="3"><?php echo $configuracao['rodape_local'] ?></textarea>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text"><i class='bx bx-pointer'></i></div>
                        <input type="text" class="form-control" id="rodape_site" name="rodape_site" value="<?php echo $configuracao['rodape_site'] ?>" placeholder="Site da Empresa">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text"><i class='bx bx-phone'></i></div>
                        <input type="text" class="form-control" id="rodape_telefone" name="rodape_telefone" value="<?php echo $configuracao['rodape_telefone'] ?>" placeholder="Telefone da Empresa">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text"><i class='bx bxl-facebook'></i></div>
                        <input type="text" class="form-control" id="rodape_facebook" name="rodape_facebook" value="<?php echo $configuracao['rodape_facebook'] ?>" placeholder="Facebook da Empresa">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text"><i class='bx bxl-instagram'></i></div>
                        <input type="text" class="form-control" id="rodape_instagram" name="rodape_instagram" value="<?php echo $configuracao['rodape_instagram'] ?>" placeholder="Instagram da Empresa">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text"><i class='bx bxl-youtube'></i></div>
                        <input type="text" class="form-control" id="rodape_youtube" name="rodape_youtube" value="<?php echo $configuracao['rodape_youtube'] ?>" placeholder="Youtube da Empresa">
                    </div>
                </div>
                <button type="submit" name="salvar_rodape" id="salvar_rodape" class="btn btn-primary">Salvar Informações</button>
                </form>
            </div>
        </div>
    </div>
</div>

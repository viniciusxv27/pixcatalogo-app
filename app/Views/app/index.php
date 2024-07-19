<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='<?php echo base_url('assets/css/app.css'); ?>' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <?php if ($configuracao['marca']) { ?>
        <title><?php echo $configuracao['marca'] ?> | Pix Catalogo</title>
    <?php } else { ?>
        <title>Pix Catalogo</title>
    <?php } ?>

    <?php if ($configuracao['icone']) { ?>
        <link rel="icon" href="<?php echo base_url($configuracao['icone']); ?>" type="image/x-icon">
    <?php } ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
</head>

<body>
    <!-- Menu -->
    <div class="nav-custom">
        <div class="nav-container-header">
            <img src="<?php echo base_url($configuracao['logo']); ?>" class="logo-plus">
            <div class="menu">
                <div class="dropdown">
                    <a class="btn " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i style="font-size: 35px" class="bx bx-menu"></i>
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i style="font-size: 25px; margin-right:5px" class='bx bx-home'></i> Inicio
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#box" id='svbvm'>
                                <i style="font-size: 25px; margin-right:5px" class="bx bx-car"></i> Busca pelo
                                Veiculo/Marca
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#box" id='svbcod'>
                                <i style="font-size: 25px; margin-right:5px" class="bx bx-barcode"></i> Busca por
                                Código/Peça</a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#box" id='svblv'>
                                <i style="font-size: 25px; margin-right:5px" class="bx bx-edit-alt"></i> Busca Livre
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#box" id='svbpl'>
                                <i style="font-size: 25px; margin-right:5px" class="bx bx-detail"></i> Busca por Placa
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#box" id='svbpia'>
                                <i style="font-size: 25px; margin-right:5px" class="bx bx-analyse"></i> Busca por IA
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('cliente/conta'); ?>">
                                <i style="font-size: 25px; margin-right:5px" class="bx bx-user"></i> Conta
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="mailto:<?php echo $configuracao['rodape_email']; ?>">
                                <i style="font-size: 25px; margin-right:5px" class="bx bx-chat"></i> Fale conosco
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim Menu -->

    <!-- Inicio Carousel -->
    <div id="carouselExampleDark" class="carousel carousel-dark slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="assets/plano-de-fundo.png" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- Fim Carousel -->


    <!-- Buscas -->
    <div class="box" id="box">

        <!-- Menu de Buscas -->
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="false">Busca por
                    Veículo/Marca</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Busca por
                    Código/Peça</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Busca Livre</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-plate-tab" data-bs-toggle="pill" data-bs-target="#pills-plate" type="button" role="tab" aria-controls="pills-plate" aria-selected="false">Busca por Placa</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-ia-tab" data-bs-toggle="pill" data-bs-target="#pills-ia" type="button" role="tab" aria-controls="pills-ia" aria-selected="false">Busca por IA</button>
            </li>
        </ul>
        <!-- Fim Menu de Buscas -->

        <div class="tab-content" id="pills-tabContent">

            <!-- Busca Por Veiculos-->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                <div class="op-flex">
                    <div class="col-op">
                        <h1 class="op-title">Linha de Produtos:</h1>
                        <select class="form-select" id="sistema">
                        </select>
                    </div>
                    <div class="col-op">
                        <h1 class="op-title">Segmento:</h1>
                        <select class="form-select" id="segmentoSelect" disabled>
                        </select>
                    </div>
                    <div class="col-op">
                        <h1 class="op-title">Montadora:</h1>
                        <select class="form-select" id="montadoraSelect" disabled>
                        </select>
                    </div>
                    <div class="col-op">
                        <h1 class="op-title">Veículo:</h1>
                        <select class="form-select" id="veiculoSelect" disabled>
                        </select>
                    </div>
                    <div class="col-op">
                        <h1 class="op-title">Ano:</h1>
                        <select class="form-select" id="anoSelect" disabled>
                        </select>
                    </div>
                    <div class="col-op">
                        <h1 class="op-title">Versão:</h1>
                        <select class="form-select" id="versaoSelect" disabled>
                        </select>
                    </div>
                    <div class="col-op cta">
                        <button type="button" class="d-flex align-items-center btn btn-primary btn-lg btn-circ-custom" id="cta-av">
                            <i style="margin-right: 5px;" class='bx bx-search-alt'></i> Buscar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Busca Por Placa-->
            <div class="tab-pane fade" id="pills-plate" role="tabpanel" aria-labelledby="pills-plate-tab" tabindex="0">
                <div class="box-code">
                    <input type="text" name="code" id="busca_placa" class="form-control" placeholder="Pesquise pela Placa">
                    <button type="button" class="d-flex align-items-center btn btn-primary btn-lg btn-circ-custom" id="cta-placa">
                        <i style="margin-right: 5px;" class='bx bx-search-alt'></i> Buscar
                    </button>
                </div>
            </div>
            <script>
                document.getElementById('busca_placa').addEventListener('keyup', function(event) {
                    if (event.key === 'Enter') {
                        document.getElementById('cta-placa').click();
                    }
                });
            </script>

            <!-- Busca Por Código-->
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                <div class="box-code">
                    <input type="text" name="code" id="code_busca" class="form-control" placeholder="Pesquise pelo Código ou Peça">
                    <button type="button" class="d-flex align-items-center btn btn-primary btn-lg btn-circ-custom" id="cta-code-s">
                        <i style="margin-right: 5px;" class='bx bx-search-alt'></i> Buscar
                    </button>
                </div>
            </div>
            <script>
                document.getElementById('code_busca').addEventListener('keyup', function(event) {
                    if (event.key === 'Enter') {
                        document.getElementById('cta-code-s').click();
                    }
                });
            </script>

            <!-- Busca Livre-->
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                <div class="box-code">
                    <input type="text" name="code" id="busca_geral" class="form-control" placeholder="Pesquisa Livre">
                    <button type="button" class="d-flex align-items-center btn btn-primary btn-lg btn-circ-custom" id="cta-geral">
                        <i style="margin-right: 5px;" class='bx bx-search-alt'></i> Buscar
                    </button>
                </div>
            </div>
            <script>
                document.getElementById('busca_geral').addEventListener('keyup', function(event) {
                    if (event.key === 'Enter') {
                        document.getElementById('cta-geral').click();
                    }
                });
            </script>

            <!-- Busca Por IA-->
            <div class="tab-pane fade" id="pills-ia" role="tabpanel" aria-labelledby="pills-ia-tab" tabindex="0">
                <div style="align-items: center" class="tab-pane">
                    <div style="display:flex; width=70%">
                        <img src="<?php echo base_url('assets/robo.gif') ?>" alt="IA gif" style="width:56px; height:56px; margin:10px">
                        <textarea class="form-control" name="code" id="busca_ia" rows="3" style="width:100%" placeholder="Pergunte a Laika"></textarea>
                    </div>

                    <br>

                    <button disabled type="button" class="d-flex align-items-center btn btn-primary btn-lg btn-circ-custom" id="cta-ia">
                        <i style="margin-right: 5px;" class='bx bx-search-alt'></i> Buscar
                    </button>
                </div>
                <br>
                <div class="alert alert-warning" role="alert">
                    <b>Em Desenvolvimento!</b>
                </div>
            </div>

        </div>
    </div>

    <!-- Loader -->
    <section style="min-height: 500px; width: 100%;">
        <div>
            <div id="loader">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div id="div-placa" class="div-placa">

            </div>
            <div id="alinhamento-filtro">
                <div id="filtros-box" class="filtros">
                    <h1>Filtros</h1>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed show" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Marcas
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed show" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Sistema do veículo
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed show" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    Linhas de produto
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filter-buttons">
                        <button onclick="filtrar()" class="apply">Aplicar Filtros</button>
                        <button onclick="gerar_pdf()" class="pdf">Gerar PDF</button>
                    </div>
                </div>
                <div id="produtos-box" class="produtos">

                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade  modal-xl " id="produtoM">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <iframe id="iframePro" width="100%" height="800" src="" frameborder="0"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="mp()">Fechar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="banners-cat">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <h4>Linhas de produtos</h4>
                </div>
                <div class="col-12">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($banners as $banner) : ?>
                                <div class="swiper-slide">
                                    <a href="<?php echo $banner['texto']; ?>" target="_blank">
                                        <img src="<?php echo base_url('uploads/banner/') . $banner['arquivo_banner']; ?>">
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-5 text-center text-body-secondary ">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 left-itens">
                    <h3>Contato</h3>

                    <?php if ($configuracao['rodape_local']) { ?>
                        <p class="color-c1"><?php echo $configuracao['rodape_local'] ?></p>
                    <?php } ?>

                    <?php if ($configuracao['rodape_email']) { ?>
                        <a class="d-flex" href="mailto:<?php echo $configuracao['rodape_email'] ?>">
                            <i style="font-size: 25px; margin-right: 5px" class="bx bx-envelope"></i>
                            <span style="font-weight: 600"><?php echo $configuracao['rodape_email'] ?></span>
                        </a>
                    <?php } ?>

                    <?php if ($configuracao['rodape_site']) { ?>
                        <a class="d-flex" href="<?php echo $configuracao['rodape_site'] ?>">
                            <i style="font-size: 25px; margin-right: 5px" class="bx bx-windows"></i>
                            <span style="font-weight: 600"><?php echo $configuracao['rodape_site'] ?></span>
                        </a>
                    <?php } ?>

                    <?php if ($configuracao['rodape_telefone']) { ?>
                        <a class="d-flex" href="tel:<?php echo $configuracao['rodape_telefone'] ?>">
                            <i style="font-size: 25px; margin-right: 5px" class="bx bx-phone"></i>
                            <span style="font-weight: 600"><?php echo $configuracao['rodape_telefone'] ?></span>
                        </a>
                    <?php } ?>

                    <a class="d-flex" href="<?php echo base_url('garantia'); ?>">
                        <i style="font-size: 25px; margin-right: 5px" class="bx bx-support"></i>
                        <span style="font-weight: 600">SAC</span>
                    </a>

                    <br>

                    <div class="d-flex box-social-icons">

                        <?php if ($configuracao['rodape_facebook']) { ?>
                            <a href="<?php echo $configuracao['rodape_facebook'] ?>">
                                <i style="font-size:25px" class="bx bxl-facebook"></i>
                            </a>
                        <?php } ?>

                        <?php if ($configuracao['rodape_instagram']) { ?>
                            <a href="<?php echo $configuracao['rodape_instagram'] ?>">
                                <i style="font-size:25px" class="bx bxl-instagram"></i>
                            </a>
                        <?php } ?>

                        <?php if ($configuracao['rodape_youtube']) { ?>
                            <a href="<?php echo $configuracao['rodape_youtube'] ?>">
                                <i style="font-size:25px" class="bx bxl-youtube"></i>
                            </a>
                        <?php } ?>

                    </div>
                </div>

                <div class="col-lg-4 left-itens">
                    <img src="<?php echo base_url($configuracao['logo']); ?>" class="logo-plus-footer">
                    <a>Todos os direitos reservados</a>
                    <a href="#" class="color-c1">Sobre</a>
                    <a target="__blank" href="<?php echo $configuracao['rodape_politicas'] ?>" class="color-c1">Politica
                        de privacidade</a>
                </div>
                <div class="col-12">
                    <p class="mb-0">
                        <a href="#"><i class='bx bx-chevron-up'></i> Voltar ao topo</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <?php if ($configuracao['forcar_login']) { ?>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="container f-column m-2 d-flex justify-content-center">
                        <img width="50%" src="<?php echo base_url($configuracao['logo']) ?>" alt="">
                    </div>
                    <div class="d-flex justify-content-center modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Entre aqui!</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="logEmailInput" class="form-label">Email:</label>
                            <input autocomplete="email" required type="email" class="form-control" name="logEmailInput" id="logEmailInput" placeholder="nome@email.com">
                            <p style="display:none" id="text-alert-login" class="mt-2 text-danger">Email não cadastrado!</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#staticCadastro">Não Cadastrei</button>
                        <button type="button" id="entrarButton" class="btn btn-primary">Entrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cadastro Modal -->
        <div class="modal fade" id="staticCadastro" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticCadastroLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="container f-column m-2 d-flex justify-content-center">
                        <img width="50%" src="<?php echo base_url($configuracao['logo']) ?>" alt="">
                    </div>
                    <div class="d-flex justify-content-center modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Cadastre-se aqui!</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="cadNomeInput" class="form-label">Nome:</label>
                            <input required type="text" class="form-control" id="cadNomeInput" name="cadNomeInput" placeholder="Nome">
                        </div>
                        <div class="mb-3">
                            <label for="cadEmailInput" class="form-label">Email:</label>
                            <input autocomplete="email" required type="text" class="form-control" id="cadEmailInput" name="cadEmailInput" placeholder="nome@email.com">
                        </div>
                        <div class="mb-3">
                            <label for="cadEmpresaInput" class="form-label">Empresa:</label>
                            <input required type="text" class="form-control" id="cadEmpresaInput" name="cadEmpresaInput" placeholder="Nome da Empresa">
                        </div>
                        <div class="mb-3">
                            <label for="cadCargoInput" class="form-label">Cargo:</label>
                            <input required type="text" class="form-control" id="cadCargoInput" name="cadCargoInput" placeholder="Seu Cargo">
                        </div>
                        <div class="mb-3">
                            <label for="cadTelefoneInput" class="form-label">Telefone (Opcional):</label>
                            <input type="text" class="form-control" id="cadTelefoneInput" name="cadTelefoneInput" placeholder="2799999-9999">
                        </div>
                        <p style="display:none" id="text-alert-cadastro" class="mt-2 text-danger">Não foi possivel realizar
                            o cadastro!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Já Cadastrei</button>
                        <button type="button" id="cadastrarButton" class="btn btn-primary">Cadastrar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script>
        const url_base = '<?php echo base_url(); ?>';
    </script>
    <script src="<?php echo base_url('assets/js/app.js'); ?>" defer></script>
    <?php if ($configuracao['forcar_login']) { ?>
        <script>
            var meuModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
            var cadModal = new bootstrap.Modal(document.getElementById('staticCadastro'));

            document.addEventListener('DOMContentLoaded', function() {
                if (localStorage.getItem('logado') != true) {
                    meuModal.show();
                }
            });

            var cadastrarButton = document.getElementById('cadastrarButton');
            var entrarButton = document.getElementById('entrarButton');

            cadastrarButton.addEventListener('click', function() {
                const entradaNomeCadastro = document.getElementById('cadNomeInput').value;
                const entradaEmailCadastro = document.getElementById('cadEmailInput').value;
                const entradaEmpresaCadastro = document.getElementById('cadEmpresaInput').value;
                const entradaCargoCadastro = document.getElementById('cadCargoInput').value;
                const entradaTelefoneCadastro = document.getElementById('cadTelefoneInput').value;

                const apiUrl = '<?php echo base_url('lead/cadastrar') ?>';
                const apiUrl2 = '<?php echo base_url('lead/logar') ?>';

                const dataCadastro = {
                    nome: entradaNomeCadastro,
                    email: entradaEmailCadastro,
                    empresa: entradaEmpresaCadastro,
                    cargo: entradaCargoCadastro,
                    telefone: entradaTelefoneCadastro,
                };

                const dataVerificar = {
                    email: entradaEmailCadastro,
                };

                const requestOptions = {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(dataCadastro),
                };

                const requestOptions2 = {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(dataVerificar),
                };

                fetch(apiUrl2, requestOptions2)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erro na requisição: ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data['lead'][0].email == entradaEmailCadastro) {
                            document.getElementById('text-alert-cadastro').style.display = "block";
                        }
                    })
                    .catch(error => {
                        fetch(apiUrl, requestOptions)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Erro na requisição: ' + response.status);
                                }
                                return response.json();
                            })
                            .then(data => {
                                cadModal.hide();
                                localStorage.setItem('logado', true);
                            })
                            .catch(error => {
                                document.getElementById('text-alert-cadastro').style.display = "block";
                            });
                    });

            })

            entrarButton.addEventListener('click', function() {
                const entradaEmailLogin = document.getElementById('logEmailInput').value;

                const apiUrl = '<?php echo base_url('lead/logar') ?>';

                const dataLogin = {
                    email: entradaEmailLogin,
                };

                const requestOptions = {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(dataLogin),
                };

                fetch(apiUrl, requestOptions)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erro na requisição: ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data['lead'][0].email == entradaEmailLogin) {
                            meuModal.hide();
                            localStorage.setItem('logado', true);
                        }
                    })
                    .catch(error => {
                        document.getElementById('text-alert-login').style.display = "block";
                    });

            })
        </script>
    <?php } ?>

</body>

</html>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='<?php echo base_url('/assets/css/app.css'); ?>' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    
    <?php if ($configuracao['marca']) { ?>
        <title><?php echo $configuracao['marca'] ?> | Pix catalogo</title>
    <?php } else { ?>
        <title>Pix Catalogo</title>
    <?php } ?>

    <?php if ($configuracao['icone']) { ?>
        <link rel="icon" href="<?php echo base_url($configuracao['icone']); ?>" type="image/x-icon">
    <?php } ?>

</head>

<body>

    <div class="nav-custom">
        <div class="nav-container-header">
            <img src="<?php echo base_url($configuracao['logo']);?>" class="logo-plus">
            <div class="menu">
                <div class="dropdown">
                    <a class="btn " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i style="font-size: 35px" class="bx bx-menu"></i>
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url(); ?>">
                                <i style="font-size: 25px; margin-right:5px" class='bx bx-home'></i> Inicio    
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url(); ?>#box" id='svbvm'>
                                <i style="font-size: 25px; margin-right:5px" class="bx bx-car"></i> Busca pelo Veiculo/Marca
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url(); ?>#box" id='svbcod'>
                                <i style="font-size: 25px; margin-right:5px" class="bx bx-barcode"></i> Busca por Código/Peça</a>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url(); ?>#box" id='svblv'>
                                <i style="font-size: 25px; margin-right:5px" class="bx bx-edit-alt"></i> Busca Livre
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url(); ?>#box" id='svbpl'>
                                <i style="font-size: 25px; margin-right:5px" class="bx bx-detail"></i> Busca por Placa
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url(); ?>#box" id='svbps'>
                                <i style="font-size: 25px; margin-right:5px" class="bx bx-wrench"></i> Busca por Sistema
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url(); ?>#box" id='svbpia'>
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

    <!-- Inicio Carousel -->
    <div id="carouselExampleDark" class="carousel carousel-dark slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="../assets/plano-de-fundo.png" class="d-block w-100" alt="...">
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


    <!-- Container Conta -->
    <div class="box">
        <h2>Conta</h2>

        <form method="post" action="<?php echo site_url('cliente/editar'); ?>" class="fom-edit">
            <input type="hidden" name="cliente_id" value="<?php echo $cliente['id']; ?>">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $cliente['nome']; ?>">
            </div>
            <div>
                <label for="sobrenome">Sobrenome:</label>
                <input type="text" id="sobrenome" name="sobrenome" value="<?php echo $cliente['sobrenome']; ?>">
            </div>
            <div>
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" value="<?php echo $cliente['email']; ?>">
            </div>
            <div>
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="text" class="data" id="data_nascimento" name="data_nascimento"
                    value="<?php echo $cliente['data_nascimento']; ?>">
            </div>
            <div>
                <label for="telefone">Telefone de Contato/Whatsapp:</label>
                <input type="text" class="telefone" id="telefone" name="telefone"
                    value="<?php echo $cliente['telefone']; ?>">
            </div>
            <div>
                <label for="nome_empresa">Nome da Empresa:</label>
                <input type="text" class="nome_empresa" id="nome_empresa" name="nome_empresa"
                    value="<?php echo $cliente['nome_empresa']; ?>">
            </div>
            <div>
                <label for="ramo_atividade">Ramo de Atividade:</label>
                <select id="ramo_atividade" name="ramo_atividade">
                    <option value="consumidor_final" <?php echo ($cliente['ramo_atividade'] === 'consumidor_final') ? 'selected' : ''; ?>>Consumidor Final</option>
                    <option value="distribuidora" <?php echo ($cliente['ramo_atividade'] === 'distribuidora') ? 'selected' : ''; ?>>Distribuidora</option>
                    <option value="industria" <?php echo ($cliente['ramo_atividade'] === 'industria') ? 'selected' : ''; ?>>Indústria</option>
                    <option value="oficina" <?php echo ($cliente['ramo_atividade'] === 'oficina') ? 'selected' : ''; ?>>
                        Oficina</option>
                    <option value="outros" <?php echo ($cliente['ramo_atividade'] === 'outros') ? 'selected' : ''; ?>>
                        Outros</option>
                    <option value="servicos" <?php echo ($cliente['ramo_atividade'] === 'servicos') ? 'selected' : ''; ?>>
                        Serviços</option>
                    <option value="varejo" <?php echo ($cliente['ramo_atividade'] === 'varejo') ? 'selected' : ''; ?>>
                        Varejo</option>
                </select>
            </div>
            <div>
                <label for="senha">Nova Senha (opcional):</label>
                <input type="password" id="senha" name="senha"><br>
            </div>
            <div>
                <label for="confirma_senha">Confirmação de Nova Senha (opcional):</label>
                <input type="password" id="confirma_senha" name="confirma_senha">

                <input type="submit" value="Salvar Alterações" class="cta-edit">
            </div>
        </form>
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
                            <span style="font-weight: 600"><?php echo $configuracao['rodape_email']?></span>
                        </a>
                    <?php } ?>

                    <?php if ($configuracao['rodape_site']) { ?>
                        <a class="d-flex" href="<?php echo $configuracao['rodape_site'] ?>">
                            <i style="font-size: 25px; margin-right: 5px" class="bx bx-windows"></i>
                            <span style="font-weight: 600"><?php echo $configuracao['rodape_site']?></span>
                        </a>
                    <?php } ?>

                    <?php if ($configuracao['rodape_telefone']) { ?>
                        <a class="d-flex" href="tel:<?php echo $configuracao['rodape_telefone'] ?>">
                            <i style="font-size: 25px; margin-right: 5px" class="bx bx-phone"></i>
                            <span style="font-weight: 600"><?php echo $configuracao['rodape_telefone']?></span>
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
    <style type="text/css">
        input.cta-edit {
            background-color: #6a66dc;
            box-shadow: none;
            color: white;
        }

        select#ramo_atividade {
            margin-bottom: 5px;
            border: none !important;
            padding: 10px 10px;
            width: 100%;
            background: #ecf0f3;
            border-radius: 25px;
            box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
        }

        form.fom-edit>div {
            width: 50%;
            display: flex;
            flex-direction: column;
            padding: 0px 10px;
        }

        form.fom-edit {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }

        form.fom-edit label {
            line-height: 30px;
        }

        input {
            background: #ecf0f3;
            padding: 10px;
            padding-left: 20px;
            height: 50px;
            font-size: 14px;
            border: none;
            margin-bottom: 15px;
            border-radius: 50px;
            box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
        }

        @media only screen and (max-width: 768px) {
            form.fom-edit>div {
                width: 100%;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>const url_base = '<?php echo base_url(); ?>';</script>
    <script>
        $(document).ready(function () {
            $('.telefone').mask('(00) 00000-0000', { clearIfNotMatch: true });
            $('.data').mask('00/00/0000', { clearIfNotMatch: true });
        });
    </script>

</body>

</html>
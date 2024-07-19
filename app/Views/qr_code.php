<div class="">
    <div class="">

        <div class="card-body">
            <div class=" row">
                <div class="col-lg-4 col-sm-12">
                    <?php if (isset($produto)) { ?>
                        <div>
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <?php
                                    $index = 0;
                                    foreach ($fotos as $foto) {
                                        if ($index === 0) {
                                            echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $index . '" class="active"></li>';
                                        } else {
                                            echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $index . '"></li>';
                                        }
                                        $index++;
                                    }
                                    ?>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item d-flex justify-content-center active">
                                        <img id="main-image" class="imagem fluid-image d-block w-50" src="<?php echo base_url('uploads/' . $produto['foto']); ?>" alt="First slide">
                                        <script>
                                            var imagem = document.getElementById('main-image');

                                            imagem.addEventListener('error', function() {
                                                this.src = '../../<?php echo $configuracao['logo'] ?>'
                                            });
                                        </script>
                                    </div>
                                    <?php
                                    foreach ($fotos as $foto) {
                                        echo '<div class="carousel-item">';
                                        echo '<img class="d-block w-100" src="' . base_url('uploads/' . $foto['produto_id'] . '/' . $foto['img_url']) . '" alt="Slide">';
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>

                    <?php } ?>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="row">
                        <div class="form-group col-lg-6 col-sm-12">
                            <label for="sistema">Sistema:</label>
                            <?php echo $sistemas['nome']; ?>
                        </div>
                        <div class="form-group col-lg-6 col-sm-12">
                            <label for="codigo">Código produto:</label>
                            <?php echo isset($produto) ? $produto['codigo'] : ''; ?>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="table-res">
                            <div class="row">
                                <div class="form-group col-lg-6 col-sm-12">
                                    <label for="sistema">Pesquisar:</label>
                                    <input type="text" id="searchInput" placeholder="Pesquisar...">
                                </div>
                            </div>
                            <table class="table table-striped-column">
                                <thead>
                                    <tr>
                                        <th>Montadora</th>
                                        <th>Veículo</th>
                                        <th>Modelo</th>
                                        <th>Motor</th>
                                        <th>Aplicação</th>
                                        <th>Início</th>
                                        <th>Fim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($aplicacoes as $aplicacao) : ?>
                                        <tr class="aplicacao-row">
                                            <td><?= $aplicacao->montadora; ?></td>
                                            <td><?= $aplicacao->veiculo; ?></td>
                                            <td><?= $aplicacao->modelo; ?></td>
                                            <td><?= $aplicacao->motor; ?></td>
                                            <td><?= $aplicacao->conf_motor; ?></td>
                                            <td><?= $aplicacao->inicio; ?></td>
                                            <td><?= $aplicacao->fim; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                        <div class="form-group d-f-center">
                            <div id="qrcode"><img src="<?php echo base_url('qrcode/qrcodes/qrcode_id' . $produto["id"] . '.png') ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-sm-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="nome">Nome:</label>
                            <?php echo isset($produto) ? $produto['nome'] . ' - ' . $produto['codigo'] : ''; ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="marca">Marca:</label>
                            <?php echo isset($produto) ? $produto['marca'] : ''; ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="codigo">Código produto:</label>
                            <?php echo isset($produto) ? $produto['codigo'] : ''; ?>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="codigo">Descrição adicional:</label>
                                <?php echo isset($produto) ? $produto['descricao'] : ''; ?>
                            </div>
                        </div>
                        <div style="flex-direction: column !important;" class="d-flex form-group col-md-12">
                            <label for="codigo">Observação:</label>
                            <textarea disabled id="observacao"><?php echo isset($produto) ? $produto['observacao'] : ''; ?></textarea>
                            <style>
                                #observacao {
                                    width: 300px;
                                    height: 130px;
                                    resize: none;
                                    border: 0px;
                                    background-color: transparent;
                                }
                            </style>
                        </div>

                    </div>
                    <div class="form-row box-c">
                        <div class="col-12">
                            <h5 class="inf-box">Equivalencia</h5>
                        </div>
                        <div class="form-group col-lg-12 col-sm-12">
                        <textarea disabled id="observacao"><?php echo isset($produto) ? $produto['observacao'] : ''; ?></textarea>
                        </div>
                    </div>
                    <div class="form-row box-c">
                        <div class="col-12">
                            <h5 class="inf-box">Fiscal</h5>
                        </div>
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="codigo_ean">Código EAN:</label>
                            <?php echo isset($produto) ? $produto['codigo_ean'] : ''; ?>
                        </div>
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="codigo_ncm">Código NCM:</label>
                            <?php echo isset($produto) ? $produto['codigo_ncm'] : ''; ?>
                        </div>
                        <div class="form-group col-lg-2 col-sm-12">
                            <label for="garantia">Garantia (meses):</label>
                            <?php echo isset($produto) ? $produto['garantia'] : ''; ?>
                        </div>
                        <div class="form-group col-lg-2 col-sm-12">
                            <label for="garantia_km">Garantia (km):</label>
                            <?php echo isset($produto) ? $produto['garantia_km'] : ''; ?>
                        </div>
                    </div>
                    <div class="form-row box-c">
                        <div class="col-12">
                            <h5 class="inf-box">Logístico</h5>
                        </div>
                        <div class="form-group col-lg-3  col-sm-12">
                            <label for="altura">Altura (cm):</label>
                            <?php echo isset($produto) ? $produto['altura'] : ''; ?>
                        </div>
                        <div class="form-group col-lg-3  col-sm-12">
                            <label for="comprimento">Comprimento (cm):</label>
                            <?php echo isset($produto) ? $produto['comprimento'] : ''; ?>
                        </div>
                        <div class="form-group col-lg-2  col-sm-12">
                            <label for="largura">Largura (cm):</label>
                            <?php echo isset($produto) ? $produto['largura'] : ''; ?>
                        </div>
                        <div class="form-group col-lg-2  col-sm-12">
                            <label for="peso">Peso (kg):</label>
                            <?php echo isset($produto) ? $produto['peso'] : ''; ?>
                        </div>
                        <div class="form-group col-lg-2  col-sm-12">
                            <label for="quantidade">Quantidade:</label>
                            <?php echo isset($produto) ? $produto['quantidade'] : ''; ?>
                        </div>
                    </div>
                    <div class="form-row box-c">
                        <div class="col-12">
                            <h5 class="inf-box">Dados técnicos</h5>
                        </div>
                        <div class="form-group col-lg-2  col-sm-12">
                            <label for="terminal">Terminal:</label>
                            <?php echo isset($produto) ? $produto['terminal'] : ''; ?>
                        </div>
                        <div class="form-group col-lg-2  col-sm-12">
                            <label for="combustivel">Combustível:</label>
                            <?php echo isset($produto) ? $produto['combustivel'] : ''; ?>
                        </div>
                        <div class="form-group col-lg-2  col-sm-12">
                            <label for="injecao">Injeção:</label>
                            <?php echo isset($produto) ? $produto['injecao'] : ''; ?>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    input#searchInput {
        border-radius: 25px;
        padding: 8px 15px;
        border: none;
        background-color: #f0f0f0;
        border: solid 1px #3a3b45;
    }

    a.carousel-control-prev,
    span.carousel-control-next-icon {
        filter: invert(1);
    }

    .box-c {
        background-color: #f0f0f0;
        margin-bottom: 10px;
        padding: 10px 0px;
        border-radius: 7px;
    }

    h5.inf-box {
        font-size: 15px;
        font-weight: 600;
        color: #797979;
    }

    .table-res {
        max-width: 100%;
        overflow: auto;
    }

    label {
        font-weight: 600;
    }

    @media only screen and (max-width: 768px) {
        .table {
            width: 1000px;
        }

        .col-lg-12.col-sm-12 {
            padding: 0;
        }
    }
</style>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
<script type="text/javascript">
    document.getElementById("searchInput").addEventListener("input", function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll(".aplicacao-row");

        rows.forEach(function(row) {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
    $('.carousel').carousel();
</script>
</body>

</html>
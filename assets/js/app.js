var filtros = document.getElementById('filtros-box');
var loader = $('#loader');
var linhasDT = '';

var swiper = new Swiper(".mySwiper", {
    spaceBetween: 30,
    breakpoints: {
        768: {
            slidesPerView: 1,
            spaceBetween: 20
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 50
        }
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true
    }
});

var swiper = new Swiper(".linhas", {
    spaceBetween: 30,
    breakpoints: {
        768: {
            slidesPerView: 2,
            spaceBetween: 20
        },
        1024: {
            slidesPerView: 5,
            spaceBetween: 50
        }
    },
    navigation: {
        nextEl: ".linhas-swiper-button-next",
        prevEl: ".linhas-swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true
    }
});


document.getElementById('code_busca').addEventListener('input', function () {
    this.value = this.value.toUpperCase()
})
document.getElementById('busca_geral').addEventListener('input', function () {
    this.value = this.value.toUpperCase()
})
document.getElementById('busca_placa').addEventListener('input', function () {
    this.value = this.value.toUpperCase()
})

function mostrarLoader() {
    loader.show();
}

function pararLoader() {
    loader.hide();
}

function semProdutos() {
    const divProdutos = $('#produtos-box');
    const divProduto = $('#div-placa');
    divProduto.html('');
    divProdutos.html('');
    divProduto.append('<div style="display:flex; justify-content: center;"><h3>Sem produtos</h3></div>');
}

function limparProdutos() {
    const divProduto = $('#div-placa');
    divProduto.html('');
}

$("#segmentoSelect").change(function () {
    const segmentoSelect = $(this).val();
    var segmento_id = $("#segmentoSelect");
    const veiculoSelect = $("#veiculoSelect");
    const anoSelect = $("#anoSelect");
    const versaoSelect = $("#versaoSelect");

    versaoSelect.prop("disabled", true);
    veiculoSelect.prop("disabled", true);
    anoSelect.prop("disabled", true);

    $("#veiculoSelect")[0].innerHTML = '';
    $("#anoSelect")[0].innerHTML = '';
    $("#versaoSelect")[0].innerHTML = '';

    load_montadora(segmento_id.val());
});

$("#sistema").change(function () {
    $("#segmentoSelect").prop("disabled", false);
    load_segmentos();

    $("#montadoraSelect")[0].innerHTML = '';
    $("#veiculoSelect")[0].innerHTML = '';
    $("#anoSelect")[0].innerHTML = '';
    $("#versaoSelect")[0].innerHTML = '';

    const montadoraSelect = $("#montadoraSelect");
    const veiculoSelect = $("#veiculoSelect");
    const anoSelect = $("#anoSelect");
    const versaoSelect = $("#versaoSelect");

    montadoraSelect.prop("disabled", true);
    veiculoSelect.prop("disabled", true);
    anoSelect.prop("disabled", true);
    versaoSelect.prop("disabled", true);

});

$("#montadoraSelect").change(function () {
    $("#veiculoSelect").prop("disabled", false);
    load_veiculos();

    $("#veiculoSelect")[0].innerHTML = '';
    $("#anoSelect")[0].innerHTML = '';
    $("#versaoSelect")[0].innerHTML = '';

    const anoSelect = $("#anoSelect");
    const versaoSelect = $("#versaoSelect");

    $("#cta-av").prop("disabled", false);
    anoSelect.prop("disabled", true);
    versaoSelect.prop("disabled", true);
});

$("#veiculoSelect").change(function () {
    $("#anoSelect").prop("disabled", false);
    load_ano();

    const versaoSelect = $("#versaoSelect");

    versaoSelect.prop("disabled", true);

    $("#versaoSelect")[0].innerHTML = '';
    $("#sistema").prop("disabled", false);

});

$("#anoSelect").change(function () {
    $("#versaoSelect").prop("disabled", false);
    modelo();
});

function filtrar() {

    mostrarLoader();
    limparProdutos();

    const filtro1 = document.getElementsByClassName('accordion-body')[0];
    const filtro2 = document.getElementsByClassName('accordion-body')[1];
    const filtro3 = document.getElementsByClassName('accordion-body')[2];

    let checkboxes = filtro1.querySelectorAll('.form-check-input');
    let checkedMarcas = [];
    let checkedSistemas = [];
    let checkedLinhas = [];

    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            checkedMarcas.push(checkbox.value);
        }
    });

    checkboxes = filtro2.querySelectorAll('.form-check-input');

    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            checkedSistemas.push(checkbox.value);
        }
    });

    checkboxes = filtro3.querySelectorAll('.form-check-input');

    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            checkedLinhas.push(checkbox.value);
        }
    });

    var requestData = { marcas: checkedMarcas, sistemas: checkedSistemas, linhas: checkedLinhas };

    $.ajax({
        url: url_base + 'rest/filtrar',
        type: 'POST',
        data: requestData,
        dataType: 'json',
        success: function (data) {
            pararLoader()
            const divProduto = $('#produtos-box');
            divProduto.html('');
            if (data && data.length > 0) {

                $.each(data, function (index, produto) {
                    filtros.style.display = 'flex';
                    var desc = '';
                    linha_name = load_linha_nome(produto.linha_id);
                    divProduto.append('<div class="produto" onclick="load_m_pro(' + produto.id + ')"><div class="img-produto"><img src="' + url_base + 'uploads/' + produto.foto + '"></div><div class="desc-produto"><h3>' + produto.nome + '</h3><span><b>Marca: </b>' + produto.marca + '</span><span><b>Código: </b>' + produto.codigo + '</span> ' + desc + '</div><div class="div_span_produto"><span class="span_produto">Ver Detalhes</span></div></div>');
                });

                verificarImagens();

            } else {
                semProdutos();

            }
        },
        error: function () {
            pararLoader()
        }
    });
}
const { jsPDF } = window.jspdf;
function gerar_pdf() {
    const divProduto = $('#produtos-box');
    const produtos = divProduto.find('.produto');
    const codigos = [];

    produtos.each(function (index, produto) {
        const codigo = $(produto).find('.desc-produto span:nth-child(3)').text().replace('Código: ', '');
        codigos.push(codigo);
    });

    $.ajax({
        url: url_base + 'rest/gerar_pdf',
        type: 'POST',
        data: { codigos: codigos },
        dataType: 'json',
        success: function (data) {

            const doc = new jsPDF();

            const margemEsquerda = 10;
            const margemTopo = 10;
            const linhaAltura = 10;
            let linhaAtual = margemTopo;

            function novaPagina() {
                doc.addPage();
                linhaAtual = margemTopo;
            }

            const coverImage = new Image();
            coverImage.src = url_base + 'assets/capa_pdf.png';
            doc.addImage(coverImage, 'JPEG', 0, 0, doc.internal.pageSize.getWidth(), doc.internal.pageSize.getHeight());

            doc.addPage();

            const backCoverImage = new Image();
            backCoverImage.src = url_base + 'assets/ccapa_pdf.png';
            doc.addImage(backCoverImage, 'JPEG', 0, 0, doc.internal.pageSize.getWidth(), doc.internal.pageSize.getHeight());
            doc.addPage();

            const sumario = [];
            let paginaAtual = 3;

            data.forEach(produto => {
                sumario.push({
                    nome: produto.nome,
                    pagina: paginaAtual + 1
                });
                paginaAtual += Math.ceil((produto.aplicacoes.length * (linhaAltura + 2) + linhaAltura * 9) / doc.internal.pageSize.getHeight());
            });

            doc.setFontSize(18);
            doc.text("Sumario", margemEsquerda, linhaAtual);
            linhaAtual += linhaAltura * 2;

            doc.setFontSize(12);
            sumario.forEach(item => {
                doc.text(`${item.nome} .................................. ${item.pagina}`, margemEsquerda, linhaAtual);
                linhaAtual += linhaAltura;

                if (linhaAtual > 280) {
                    novaPagina();
                }
            });

            novaPagina();

            data.forEach(produto => {
                doc.setFontSize(18);
                doc.setFont("helvetica", "bold");
                doc.text(produto.nome, margemEsquerda, linhaAtual);
                linhaAtual += linhaAltura;

                doc.setFontSize(12);
                doc.setFont("helvetica", "normal");

                const img = new Image();
                img.src = url_base + `uploads/${produto.foto}`;
                doc.addImage(img, 'JPEG', margemEsquerda, linhaAtual, 50, 50);
                linhaAtual += 60;

                const detalhes = [
                    `ID: ${produto.id}`,
                    `Marca: ${produto.marca}`,
                    `Código: ${produto.codigo}`,
                    `EAN: ${produto.codigo_ean}`,
                    `NCM: ${produto.codigo_ncm}`,
                    `Garantia: ${produto.garantia}`,
                    `Altura: ${produto.altura}`,
                    `Comprimento: ${produto.comprimento}`,
                    `Largura: ${produto.largura}`,
                    `Peso: ${produto.peso}`,
                    `Quantidade: ${produto.quantidade}`,
                    `Terminal: ${produto.terminal}`,
                    `Combustível: ${produto.combustivel}`,
                    `Injeção: ${produto.injecao}`,
                    `Descrição: ${produto.descricao}`,
                    `Observação: ${produto.observacao}`
                ];

                const colWidth = 80;
                const rowHeight = 10;
                const cellPadding = 2;

                detalhes.forEach((detalhe, index) => {
                    const xPos = margemEsquerda + (index % 2) * colWidth;
                    const yPos = linhaAtual + Math.floor(index / 2) * rowHeight;

                    doc.text(detalhe, xPos + cellPadding, yPos + cellPadding, { maxWidth: colWidth - 2 * cellPadding, align: 'left' });
                });

                linhaAtual += Math.ceil(detalhes.length / 2) * rowHeight + 25;

                doc.setFontSize(14);
                doc.setFont("helvetica", "bold");
                doc.text("Aplicações:", margemEsquerda, linhaAtual);
                linhaAtual += linhaAltura;

                doc.setFontSize(12);
                doc.setFont("helvetica", "normal");

                produto.aplicacoes.forEach(aplicacao => {
                    doc.text(`${aplicacao.montadora} ${aplicacao.veiculo} ${aplicacao.modelo} ${aplicacao.motor} (${aplicacao.inicio}-${aplicacao.fim})`, margemEsquerda, linhaAtual);
                    linhaAtual += linhaAltura;

                    doc.setLineWidth(0.1);
                    doc.line(margemEsquerda, linhaAtual, 200, linhaAtual);
                    linhaAtual += linhaAltura;

                    if (linhaAtual > 280) {
                        novaPagina();
                    }
                });

                novaPagina();
            });
            doc.deletePage(doc.getNumberOfPages());

            doc.save("catalogo.pdf");
        },
        error: function () {
            console.log('Error');
        }
    });
}

function load_segmentos() {

    $.ajax({
        url: url_base + 'rest/segmento',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            const segmentoSelect = $('#segmentoSelect');
            segmentoSelect.empty();

            if (data.segmento && data.segmento.length > 0) {
                segmentoSelect.append('<option value="" disabled selected>Selecione o Segmento</option>');
                $.each(data.segmento, function (index, segmento) {
                    segmentoSelect.append('<option value="' + segmento.id + '">' + segmento.nome + '</option>');
                });

            } else {
                segmentoSelect.append('<option value="">Nenhuma segmento Disponível</option>');
            }
        },
        error: function () {
            const segmentoSelect = $('#segmentoSelect');
            segmentoSelect.empty().append('<option value="">Erro ao carregar segmento</option>');
        }
    });
}

function load_montadora() {

    var requestData = { segmento_id: $("#segmentoSelect").val() };

    $.ajax({
        url: url_base + 'rest/montadora',
        type: 'POST',
        data: requestData,
        dataType: 'json',
        success: function (data) {
            const montadoraSelect = $('#montadoraSelect');
            montadoraSelect.empty();
            if (data.montadoras && data.montadoras.length > 0) {
                montadoraSelect.append('<option value="" disabled selected>Selecione a Montadora</option>');
                $.each(data.montadoras, function (index, montadora) {
                    montadoraSelect.append('<option value="' + montadora.montadora + '">' + montadora.montadora + '</option>');
                });

                montadoraSelect.prop("disabled", false);
            } else {
                montadoraSelect.append('<option value="">Nenhuma Montadora Disponível</option>');
            }
        },
        error: function () {
            const montadoraSelect = $('#montadoraSelect');
            montadoraSelect.empty().append('<option value="">Erro ao Carregar Montadoras</option>');
        }
    });

}

function load_veiculos() {

    var requestData = { segmento_id: $("#segmentoSelect").val(), montadora: $("#montadoraSelect").val() };

    $.ajax({
        url: url_base + 'rest/veiculo',
        type: 'POST',
        data: requestData,
        dataType: 'json',
        success: function (data) {
            const veiculoSelect = $('#veiculoSelect');
            veiculoSelect.empty();
            if (data.veiculos && data.veiculos.length > 0) {
                veiculoSelect.append('<option value="" disabled selected>Selecione o Veiculo</option>');
                $.each(data.veiculos, function (index, veic) {
                    veiculoSelect.append('<option value="' + veic.veiculo + '">' + veic.veiculo + '</option>');
                });

                veiculoSelect.prop("disabled", false);
            } else {
                veiculoSelect.append('<option value="">Nenhuma Montadora Disponível</option>');
            }
        },
        error: function () {
            const veiculoSelect = $('#veiculoSelect');
            veiculoSelect.empty().append('<option value="">Erro ao Carregar Montadoras</option>');
        }
    });
}
function load_filtro() {
    $.ajax({
        url: url_base + 'rest/filtros',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            const divFiltro1 = document.getElementsByClassName('accordion-body')[0];
            const divFiltro2 = document.getElementsByClassName('accordion-body')[1];
            const divFiltro3 = document.getElementsByClassName('accordion-body')[2];
            divFiltro1.innerHTML = '';
            divFiltro2.innerHTML = '';
            divFiltro3.innerHTML = '';
            var filtros1 = data[0]
            var filtros2 = data[1]
            var filtros3 = data[2]
            var indexCrescente = 0;
            filtros1.forEach((filtro, index) => {
                divFiltro1.innerHTML += `<div class="form-check"><input class="form-check-input" type="checkbox" value="${filtro.marca}" id="flexCheckDefault${index}"><label class="form-check-label" for="flexCheckDefault${index}">${filtro.marca}</label></div>`;
                indexCrescente = index;
            });

            indexCrescente++

            filtros2.forEach((filtro, index) => {
                index = index + indexCrescente;
                divFiltro2.innerHTML += `<div class="form-check"><input class="form-check-input" type="checkbox" value="${filtro.nome}" id="flexCheckDefault${index}"><label class="form-check-label" for="flexCheckDefault${index}">${filtro.nome}</label></div>`;
                indexCrescente = index;
            });

            indexCrescente++

            filtros3.forEach((filtro, index) => {
                index = index + indexCrescente;
                divFiltro3.innerHTML += `<div class="form-check"><input class="form-check-input" type="checkbox" value="${filtro.nome}" id="flexCheckDefault${index}"><label class="form-check-label" for="flexCheckDefault${index}">${filtro.nome}</label></div>`;
            });
        }
    });
}

function load_ano() {
    var requestData = { segmento_id: $("#segmentoSelect").val(), montadora: $("#montadoraSelect").val(), veiculo: $("#veiculoSelect").val() };
    $.ajax({
        url: url_base + 'rest/ano',
        type: 'POST',
        data: requestData,
        dataType: 'json',
        success: function (data) {
            const anoSelect = $('#anoSelect');
            anoSelect.empty();
            if (data.anos && data.anos.length > 0) {
                anoSelect.append('<option value="" disabled selected>Selecione o ano</option>');
                $.each(data.anos, function (index, ano) {
                    anoSelect.append('<option value="' + ano + '">' + ano + '</option>');
                });

                anoSelect.prop("disabled", false);
            } else {
                anoSelect.append('<option value="">Nenhuma ano disponível</option>');
            }
        },
        error: function () {
            const anoSelect = $('#anoSelect');
            anoSelect.empty().append('<option value="">Erro no ano do veiculo</option>');
        }
    });
}


$("#cta-av").click(function () {
    mostrarLoader();
    limparProdutos();
    var requestData = { segmento_id: $("#segmentoSelect").val(), montadora: $("#montadoraSelect").val(), veiculo: $("#veiculoSelect").val(), sistema: $('#sistema').val(), modelo: $('#versaoSelect').val() };
    $.ajax({
        url: url_base + 'rest/busca_avancada',
        type: 'POST',
        data: requestData,
        dataType: 'json',
        success: function (data) {
            pararLoader()
            const divProduto = $('#produtos-box');
            divProduto.html('');
            if (data && data.length > 0) {

                $.each(data, function (index, produto) {
                    filtros.style.display = 'flex';
                    var desc = '';
                    linha_name = load_linha_nome(produto.linha_id);
                    divProduto.append('<div class="produto" onclick="load_m_pro(' + produto.id + ')"><div class="img-produto"><img src="' + url_base + 'uploads/' + produto.foto + '"></div><div class="desc-produto"><h3>' + produto.nome + '</h3><span><b>Marca: </b>' + produto.marca + '</span><span><b>Código: </b>' + produto.codigo + '</span> ' + desc + '</div><div class="div_span_produto"><span class="span_produto">Ver Detalhes</span></div></div>');
                });

                verificarImagens();

            } else {
                semProdutos();
            }
        },
        error: function () {
            pararLoader()
        }
    });
});

$("#cta-code-s").click(function () {
    mostrarLoader();
    limparProdutos();
    var requestData = { palavra_chave: $("#code_busca").val() };
    $.ajax({
        url: url_base + 'rest/buscar_codigo',
        type: 'POST',
        data: requestData,
        dataType: 'json',
        success: function (data) {
            pararLoader()
            const divProduto = $('#produtos-box');
            divProduto.html('');
            if (data && data.length > 0) {

                $.each(data, function (index, produto) {
                    filtros.style.display = 'flex';
                    var desc = '';
                    linha_name = load_linha_nome(produto.linha_id);
                    divProduto.append('<div class="produto" onclick="load_m_pro(' + produto.id + ')"><div class="img-produto"><img src="' + url_base + 'uploads/' + produto.foto + '"></div><div class="desc-produto"><h3>' + produto.nome + '</h3><span><b>Marca: </b>' + produto.marca + '</span><span><b>Código: </b>' + produto.codigo + '</span> ' + desc + '</div><div class="div_span_produto"><span class="span_produto">Ver Detalhes</span></div></div>');
                });

                verificarImagens();

            } else {
                semProdutos();

            }
        },
        error: function () {
            pararLoader()
        }
    });
});

$("#cta-geral").click(function () {
    mostrarLoader();
    limparProdutos();
    var requestData = { palavra_chave: $("#busca_geral").val() };

    $.ajax({
        url: url_base + 'rest/buscar_geral',
        type: 'POST',
        data: requestData,
        dataType: 'json',
        success: function (data) {
            pararLoader()
            const divProduto = $('#produtos-box');
            divProduto.html('');
            if (data && data.length > 0) {

                $.each(data, function (index, produto) {
                    filtros.style.display = 'flex';
                    var desc = '';
                    linha_name = load_linha_nome(produto.linha_id);
                    divProduto.append('<div class="produto" onclick="load_m_pro(' + produto.id + ')"><div class="img-produto"><img src="' + url_base + 'uploads/' + produto.foto + '"></div><div class="desc-produto"><h3>' + produto.nome + '</h3><span><b>Marca: </b>' + produto.marca + '</span><span><b>Código: </b>' + produto.codigo + '</span> ' + desc + '</div><div class="div_span_produto"><span class="span_produto">Ver Detalhes</span></div></div>');
                });

                verificarImagens();

            } else {
                semProdutos();

            }
        },
        error: function () {
            pararLoader()
        }
    });
});

$("#cta-placa").click(async function () {
    var placaInput = document.getElementById('busca_placa');
    var placa = placaInput.value;
    var requestData = { 'placa': placa, 'nome_banco': 'app' };

    async function fazerSolicitacao() {
        mostrarLoader();
        limparProdutos();

        $.ajax({
            url: 'https://businesspromo.com.br/placas/',
            type: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': '*'
            },
            data: JSON.stringify(requestData),
            dataType: 'json',
            success: function (data) {
                mostrarDadosNoDOM(data);
                verificarImagens();
            },
            error: function () {
                semProdutos();
            }
        });
    }

    function mostrarDadosNoDOM(data) {
        pararLoader()
        const divPlacas = document.getElementById('div-placa');
        const divProduto = document.getElementById('produtos-box');
        divProduto.innerHTML = '';

        const divInfo = document.createElement("div");
        divInfo.style.width = "100%";
        divInfo.style.textAlign = "center";
        divInfo.style.margin = "15px";

        const divPlaca = document.createElement("div");
        divPlaca.style.width = "100%";
        divPlaca.style.display = "flex";
        divPlaca.style.textAlign = "center";
        divPlaca.style.justifyContent = "center";

        const textPlaca = document.createElement("h4");
        textPlaca.textContent = placa.slice(0, 3) + "-" + placa.slice(3);
        textPlaca.style.backgroundImage = "url(./assets/placa.png)";
        textPlaca.style.backgroundRepeat = "no-repeat";
        textPlaca.style.backgroundSize = "100%";
        textPlaca.style.padding = "20px";
        textPlaca.style.height = "100%";
        textPlaca.style.margin = "10px";
        textPlaca.style.color = "#000";
        textPlaca.style.filter = "drop-shadow(1px 2px 3px black)";

        const textInfo = document.createElement("h4");
        textInfo.textContent = data.dados.montadora + " " + data.dados.veiculo + " " + data.dados.versao + " " + data.dados.ano;

        divInfo.appendChild(textInfo);
        divPlaca.appendChild(textPlaca);
        divPlacas.appendChild(divPlaca);
        divPlacas.appendChild(divInfo);

        if (data.produtos == null) {
            textInfo.innerHTML += "<br/><br/> <h2>Nenhum produto encontrado</h2>";
        } else {
            data.produtos.forEach(function (produto) {
                filtros.style.display = 'flex';
                var desc = '';
                var linha_name = load_linha_nome(produto.linha_id);
                divProduto.innerHTML += '<div class="produto" onclick="load_m_pro(' + produto.id + ')"><div class="img-produto"><img src="' + url_base + 'uploads/' + produto.foto + '"></div><div class="desc-produto"><h3>' + produto.nome + '</h3><span><b>Marca: </b>' + produto.marca + '</span><span><b>Código: </b>' + produto.codigo + '</span> ' + desc + '</div><div class="div_span_produto"><span class="span_produto">Ver Detalhes</span></div></div>';

            });
        }
    }

    fazerSolicitacao();

});

$("#cta-ia").click(async function () {
    var iaInput = document.getElementById('busca_ia');
});

function modelo() {
    var requestData = { segmento_id: $("#segmentoSelect").val(), montadora: $("#montadoraSelect").val(), veiculo: $("#veiculoSelect").val(), ano: $("#anoSelect").val() };
    $.ajax({
        url: url_base + 'rest/modelo',
        type: 'POST',
        data: requestData,
        dataType: 'json',
        success: function (data) {
            const versaoSelect = $('#versaoSelect');
            versaoSelect.empty();

            if (data.modelo && data.modelo.length > 0) {
                versaoSelect.append('<option value="" disabled selected>Selecione a versão</option>');
                $.each(data.modelo, function (index, m) {
                    versaoSelect.append('<option value="' + m.modelo + '">' + m.modelo + '</option>');
                });

            } else {
                versaoSelect.append('<option value="">Nenhuma modelo disponível</option>');
            }
        },
        error: function () {
            const versaoSelect = $('#versaoSelect');
            versaoSelect.empty().append('<option value="">Erro no modelo do veiculo</option>');
        }
    });
}

function load_aplicacao() {

    $.ajax({
        url: url_base + 'rest/sistema',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            const sistema = $('#sistema');


            if (data.sistemas && data.sistemas.length > 0) {
                sistema.append('<option value="" disabled selected>Selecione a linha</option>');
                $.each(data.sistemas, function (index, si) {
                    sistema.append('<option value="' + si.id + '">' + si.nome + '</option>');
                });

            } else {
                sistema.append('<option value="">Nenhuma linha Disponível</option>');
            }
        },
        error: function () {
            const sistema = $('#sistema');
            sistema.empty().append('<option value="">Erro ao carregar linha</option>');
        }
    });
}

function load_linha() {
    $.ajax({
        url: url_base + 'rest/linha',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            const linha = $('.linhas-cat');

            linhasDT = data;
            if (data.linhas && data.linhas.length > 0) {

                $.each(data.linhas, function (index, si) {

                    linha.append('<div class="swiper-slide"><a onclick="showLinha(' + si.id + ')" href="#produtos-box"><img src="' + si.img_url + '">' + si.nome + '</a></div>');
                });
            } else {
            }
        },
        error: function () {
            const linha = $('.linhas-cat');
            linha.empty().append('erro x97 banners');
        }
    });
}

function load_linha_nome(id) {
    data = linhasDT;
    var value = '';
    if (data.linhas && data.linhas.length > 0) {
        $.each(data.linhas, function (index, idx) {
            if (id == idx.id) {
                value = idx.nome;
            }
        });
    }
    return value ? value : '';
}

function showLinha(arg) {
    mostrarLoader();
    $.ajax({
        url: url_base + 'rest/produtos_linha/' + arg,
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            const divProduto = $('#produtos-box');
            divProduto.html('');
            if (data && data.length > 0) {

                $.each(data, function (index, produto) {
                    filtros.style.display = 'flex';
                    var desc = '';
                    linha_name = load_linha_nome(produto.linha_id);
                    divProduto.append('<div class="produto" onclick="load_m_pro(' + produto.id + ')"><div class="img-produto"><img src="' + url_base + 'uploads/' + produto.foto + '"></div><div class="desc-produto"><h3>' + produto.nome + '</h3><span><b>Marca: </b>' + produto.marca + '</span><span><b>Código: </b>' + produto.codigo + '</span> ' + desc + '</div><div class="div_span_produto"><span class="span_produto">Ver Detalhes</span></div></div>');
                });

            } else {
                divProduto.append('<div class="produto">Sem produtos</div>');

            }
        },
        error: function () {
        }
    });
}

function load_m_pro(id) {
    url = url_base + 'qrcode_produto/get/' + id;

    document.getElementById('iframePro').src = url;

    $('#produtoM').modal('show');
}

function mp() {
    $('#produtoM').modal('hide');
}

$("#svbvm").click(() => $("#pills-home-tab").click());
$("#svbcod").click(() => $("#pills-profile-tab").click());
$("#svblv").click(() => $("#pills-contact-tab").click());
$("#svbpl").click(() => $("#pills-plate-tab").click());
$("#svbpia").click(() => $("#pills-ia-tab").click());

document.getElementById('busca_placa').addEventListener('input', function (event) {
    this.value = this.value.toUpperCase();
});

function verificarImagens() {
    var containers = document.getElementsByClassName('img-produto');

    for (var i = 0; i < containers.length; i++) {
        var div = containers[i];
        var imagem = div.querySelector('img');

        imagem.addEventListener('error', function () {
            this.src = 'assets/logo.png'
        });

    }
}

$(document).ready(function () {
    jQuery.support.cors = true;
    pararLoader();
    load_linha();
    load_aplicacao();
    load_filtro();
    $("#cta-av").prop("disabled", true);
});
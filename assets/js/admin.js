// $(function() {
    var temp_aplicacao;

    function load_galeria_fotos() {

          $.ajax({
            url: base_url+'produto/obter_fotos/'+produto_id, 
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#lista-fotos').empty();
                $.each(data, function(index, foto) {
                    var img = '<div class="box-img"><img src="' + base_url+'uploads/'+produto_id+'/'+foto.img_url + '"  class="g-fotos" alt="Foto do Produto"><span class="delete-img" onclick="del_img('+foto.idfotos+')">X</span></div>';
                    $('#lista-fotos').append(img);
                });
            },
            error: function() {
                console.log('Erro ao buscar fotos do produto.');
            }
        });
    }

    load_galeria_fotos();

    $("#qrcode img").on("click", function() {
        var imgUrl = $(this).attr("src");
        var a = $("<a>")
            .attr("href", imgUrl)
            .attr("download", "imagem.png")
            .appendTo("body");
        a[0].click();
        a.remove();
    });

    $('#exampleModal').on('hidden.bs.modal', function (e) {
    load_galeria_fotos();
    })


   $('#salvarAplicacao').click(function() {
        // Coletar dados do formulário
        var dados = {
          segmento: $('#segmento').val(),
          montadora: $('#montadora').val(),
          veiculo: $('#veiculo').val(),
          modelo: $('#modelo').val(),
          motor: $('#motor').val(),
          config_motor: $('#config_motor').val(),
          inicio: $('#inicio').val(),
          fim: $('#fim').val()
        };

        $.ajax({
          url: base_url+'aplicacao/adicionar_aplicacao', 
          data: dados,
          type: 'POST',
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              $('#formAdicionarAplicacao')[0].reset();
              temp_aplicacao =  $('#aplicacao').val();
              atualizarListaAplicacoes(response.aplicacoes);
              
              $('#modalAdicionarAplicacao').modal('hide');
              $('#aplicacao').val(temp_aplicacao).trigger('change');
            } else {
              alert('Erro ao salvar a aplicação');
            }
          },
          error: function() {
            alert('Erro na requisição AJAX');
          }
        });
    })

   $('#salvarProduto').click(function() {
        // Coletar dados do formulário
        var dados = {
          segmento: $('#segmento').val(),
          nome: $('#nome').val(),
          marca: $('#marca').val(),
          foto: $('#foto').val(),
        };

        $.ajax({
          url: base_url+'produto/criar_editar', 
          data: dados,
          type: 'POST',
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              $('#formAdicionarProduto')[0].reset();
              temp_produto =  $('#produto').val();
              atualizarListaProdutos(response.produtos);
              
              $('#modalAdicionarProduto').modal('hide');
              $('#produto').val(temp_produto).trigger('change');
            } else {
              alert('Erro ao salvar o Produto');
            }
          },
          error: function() {
            alert('Erro na requisição AJAX');
          }
        });
    });


    function atualizarListaAplicacoes(aplicacoes) {
      $('#aplicacao').empty();
      
      $.each(aplicacoes, function(index, aplicacao) {
        $('#aplicacao').append($('<option>', {
          value: aplicacao.id,
          text: aplicacao.montadora + ' - ' + aplicacao.veiculo + ' - ' + aplicacao.modelo + ' - ' + aplicacao.conf_motor + ' ' + aplicacao.inicio + '~' + aplicacao.fim
        }));
      });
    }
    
    function atualizarListaProdutos(produtos) {
      $('#produto').empty();
      
      $.each(produtos, function(index, produto) {
        $('#produto').append($('<option>', {
          value: produto.id,
          text: produto.nome + ' - ' + produto.marca + ' - ' + produto.aplicacao_ids
        }));
      });
    }
    
 


// });
function del_img(fotoId) {
    var confirmar = confirm('Tem certeza de que deseja excluir esta foto?');
    if (confirmar) {
        $.ajax({
            type: 'POST',
            url: base_url+'produto/excluirfoto/'+fotoId, 
            success: function (data) {
                if (data === 'deletada') {
                    load_galeria_fotos();
                    $.mSnackbar.add({
                      text:'Foto deletada com sucesso.',
                      lifespan: 8000,
                    });
                    $(this).parent().remove();
                } else {
                    alert('Falha ao excluir a foto.');
                }
            },
            error: function () {
                alert('Ocorreu um erro ao excluir a foto.');
            }
        });
    }
}


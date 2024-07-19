

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Está pronto?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Tem certeza que deseja sair?.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="<?php echo base_url('login/logout'); ?>">Sair</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('assets/js/jquery.easing.min.js'); ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('assets/js/sb-admin-2.min.js'); ?>"></script>
  
  <!-- Page level plugins -->
  <!-- <script src="<?php echo base_url('assets/js/Chart.min.js'); ?>"></script> -->
  
  <!-- chart -->
  <!-- <script src="<?php echo base_url('assets/js/demo/chart-bar-demo.js'); ?>"></script> -->
  <!-- <script src="<?php echo base_url('assets/js/demo/chart-pie-demo.js'); ?>"></script> -->
  <!-- datatables -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
  <script src="<?php echo base_url('assets/js/mSnackbar.js'); ?>"></script>

    <script>
        $(document).ready(function() {

            $('#produtoTable').DataTable();
            $('#aplicacaoTable').DataTable();
            $('#sistemaTable').DataTable();
            $('#segmentoTable').DataTable();
            $('#linhaTable').DataTable();

            $('.cta-del').click(function(e) {
                e.preventDefault(); // Evita que o link seja seguido imediatamente

                var url = $(this).attr('href');

                if (window.confirm("Tem certeza que deseja excluir?")) {
                    window.location.href = url;
                }
            });

            $('#aplicacao').select2();
        });//document
    </script>
    <?php  if(isset($produto['id'])){ ?>
    <script type="text/javascript">
      const base_url = "<?php echo base_url();?>";
      $(document).ready(function() {
          
           var apiUrl = base_url+"qrcode/qrcode.php?id=<?php echo $produto['id'] ?>";
                  function fetchAndUpdateImage() {
                    $.getJSON(apiUrl, function(data) {

                        const imageUrl = data.url;
                        const $imgElement = $("#qrcode img");
                        
                        if ($imgElement.length) {
                          $imgElement.attr("src", base_url+'qrcode/'+imageUrl);
                        } else {
                           console.log('erro');
                          $("#qrcode").append('<img src="<?php echo base_url('qrcode');?>/'+imageUrl + '" id="download-img" style="cursor: pointer"/> ');
                        }

                    }).fail(function(jqXHR, textStatus, errorThrown) {
                      console.error("Ocorreu um erro ao buscar o JSON: " + textStatus, errorThrown);
                    });
                  }

                  fetchAndUpdateImage();
                  <?php if (session()->has('notificacaoPop')) { ?>
                      $.mSnackbar.add({
                          text: '<?php echo session('notificacaoPop'); ?>',
                          lifespan: 8000,
                      });
                  <?php } ?>
      });//document
    </script>
    <?php }?>
    <script src="<?php echo base_url('assets/js/admin.js'); ?>"></script>
</body>
</html>

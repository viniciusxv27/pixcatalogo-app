<div class="container login">
  <a href="<?php echo site_url(); ?>" class="criar-conta mb-4" style="float: left;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path></svg>Inicio</a>
  <div class="brand-logo"><img src="<?php echo site_url($configuracao['logo']); ?>"></div>
  <div class="inputs">
    <form method="post" action="<?php echo site_url('cliente/logar'); ?>">
        <?php  $err = validation_errors();
         if($err){echo '<div class="error">'.validation_errors().'</div>';}  ?>

        <?php if (isset($error)) {
            echo '<div class="error">' . $error . '</div>';
        } ?>
        <label for="email">E-mail:</label>
        <input type="text" id="email" name="email">

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha"><br>

        <input type="submit" value="Entrar" class="cta-login" >
        <a href="<?php echo site_url('cliente/cadastrar'); ?>" class="criar-conta left-text">Criar conta.</a>
    </form>
  </div>
  
</div>
</body>
</html>

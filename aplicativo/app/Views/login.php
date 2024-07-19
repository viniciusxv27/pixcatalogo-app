<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">

	<?php if ($configuracao['marca']) { ?>
		<title><?php echo $configuracao['marca'] ?> | Login</title>
	<?php } else { ?>
		<title>Login</title>
	<?php } ?>

	<?php if ($configuracao['icone']) { ?>
		<link rel="shortcut icon" href="<?php echo base_url($configuracao['icone']); ?>" type="image/x-icon">
	<?php } ?>

	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<!-- Custom styles for Login -->
	<link href="<?php echo base_url('assets/css/login.css'); ?>" rel="stylesheet">
	<style type="text/css">
		form.form-signin {

			border-radius: 30px;
		}

		.form-label-group {
			margin-bottom: 25px;
		}

		button.btn.btn-lg.btn-primary.btn-block {
			background-color: #f68a1e;
			border: none;
			border-radius: 60px;
		}
	</style>
</head>

<body>
	<form class="form-signin" method="post" action="<?php echo site_url('login/masuk'); ?>">
		<div class="text-center mb-4">
			<img src="<?php echo base_url($configuracao['logo']); ?>" style="max-width: 220px;padding: 20px 0px;">
		</div>

		<div class="form-label-group">
			<input type="text" id="username" name="username" class="form-control" placeholder="Usuário" required
				autofocus>
			<label for="username">Usuário</label>
		</div>

		<div class="form-label-group">
			<input type="password" id="password" name="password" class="form-control" placeholder="Senha" required>
			<label for="password">Senha</label>
		</div>

		
		<button class="mb-3 btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
		<p class="mt-5 mb-3 text-center"><a href="<?php echo base_url('login/recover')?>" class="mt-5 mb-3 text-center"  >Esqueci a Senha</a></p>
		<p class="mt-5 mb-3 text-muted text-center">&copy; Pix Catalogo <?php echo date("Y"); ?></p>
	</form>
</body>

</html>
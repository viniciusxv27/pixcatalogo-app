<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="<?php echo base_url('assets/css/cliente-login.css'); ?>" rel="stylesheet">
  <?php if($configuracao['marca']) {?>
      <title>Cliente | <?php echo $configuracao['marca'] ?> </title>
  <?php } else {?>
      <title>Cliente</title>
  <?php } ?>

  <?php if($configuracao['icone']) {?>
      <link rel="icon" href="<?php echo base_url($configuracao['icone']);?>" type="image/x-icon">
  <?php } ?>  
</head>
<body>
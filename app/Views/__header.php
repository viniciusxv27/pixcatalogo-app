<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use App\Models\ConfiguracaoModel;

$config = new ConfiguracaoModel();

$configuracao = $config->obterConfiguracao();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/custom-style.css'); ?>" rel="stylesheet">
  <style>body {font-family: "Arial";}</style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
  <?php if($configuracao['marca']) {?>
        <title><?php echo $configuracao['marca']?> | Pix Catalogo</title>
  <?php } else {?>
        <title>Pix Catalogo</title>
  <?php } ?>

  <?php if($configuracao['icone']) {?>
      <link rel="icon" href="<?php echo $configuracao['icone'];?>" type="image/x-icon">
  <?php } ?>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="container wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url();?>">
       <img src="<?php echo base_url($configuracao["logo"]);?>" style="max-width: 150px;">
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('dashboard');?>">
          <i class='bx bxs-dashboard'></i>
          <span>Painel</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('lead');?>">
          <i class='bx bxs-user-account'></i>
          <span>Logins</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('banner');?>">
          <i class='bx bxs-layout'></i>
          <span>Banners</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('pdf');?>">
          <i class='bx bxs-file-blank'></i>
          <span>PDFS</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('sac');?>">
          <i class='bx bx-support'></i>
          <span>SAC</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('configuracao');?>">
          <i class='bx bx-wrench'></i>
          <span>Configuração</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="submenuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class='bx bx-menu'></i>
          <span>Catalogo</span>
        </a>
        <div style="background: #000" class="dropdown-menu" aria-labelledby="submenuDropdown">
          <a class="nav-link" href="<?php echo base_url('produto');?>">
          <i class='bx bx-cog'></i>
          <span>Produtos</span></a>
          <a class="nav-link" href="<?php echo base_url('aplicacao');?>">
          <i class='bx bxs-car-mechanic'></i>
          <span>Aplicações</span></a>
          <a class="nav-link" href="<?php echo base_url('segmento');?>">
          <i class='bx bx-category-alt'></i>
          <span>Segmento</span></a>
          <a class="nav-link" href="<?php echo base_url('linha');?>">
          <i class='bx bx-align-left'></i>
          <span>Categoria</span></a>
          <a class="nav-link" href="<?php echo base_url('sistema');?>">
          <i class='bx bx-cog' ></i>
          <span>Linha</span></a>
          <a class="nav-link" href="<?php echo base_url('sub-linha');?>">
          <i class='bx bx-right-indent'></i>
          <span>Sub-Linha</span></a>
        </div>
      </li>

        <?php if (session()->get('role') === 'administrator') { ?>
            
        <?php } else { ?>
            <!-- Caso contrário, você pode colocar outro conteúdo aqui ou deixar em branco -->
        <?php } ?>

    </ul>

    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= session('username') ?></span>
                <img class="img-profile rounded-circle" src="<?php echo base_url('assets/user.png'); ?>">
              </a>
              
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Sair
                </a>
              </div>
            </li>

          </ul>

        </nav>
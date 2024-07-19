<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/custom-style.css'); ?>" rel="stylesheet">
    <style>
        body {
            font-family: "Arial";
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <?php if ($configuracao['marca']) { ?>
        <title><?php echo $configuracao['marca'] ?> | Pix Catalogo</title>
    <?php } else { ?>
        <title>Pix Catalogo</title>
    <?php } ?>

    <?php if ($configuracao['icone']) { ?>
        <link rel="icon" href="<?php echo $configuracao['icone']; ?>" type="image/x-icon">
    <?php } ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #000;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            border-color: #007bff;
        }

        .btn-primary:hover {
            border-color: #0062cc;
        }

        .btn-primary:focus,
        .btn-primary.focus {
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
        }

        .btn-primary:disabled,
        .btn-primary.disabled {
            background-color: #007bff;
            border-color: #007bff;
            opacity: 0.65;
        }

        .btn-primary:not(:disabled):not(.disabled):active,
        .btn-primary:not(:disabled):not(.disabled).active,
        .show>.btn-primary.dropdown-toggle {
            background-color: #0062cc;
            border-color: #005cbf;
        }
    </style>
</head>

<body>
    <div>
        <div class="container">
            <h2 class="mb-4">Recuperação de Senha <?php echo $configuracao['marca']?></h2>
            <p>Você está recebendo este email porque alguém solicitou a recuperação de senha da sua conta em nosso
                sistema.</p>
            <p>Para definir uma nova senha, clique no link abaixo:</p>
            <a href="<?php echo $url ?>" class="mb-4">Definir Nova Senha</a>
            <br>
            <p>Se você não solicitou esta recuperação ou não reconhece esta atividade, por favor, pode ignorar esta
                mensagem.</p>
            <p>Atenciosamente,<br>Equipe de Suporte Pix Catalogo</p>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </div>
</body>

</html>
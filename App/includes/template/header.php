<!doctype html>
<html lang="es">
<head>
    <title> <?= $tituloPagina; ?> </title>

    <!-- metatags -->
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- ------------- stylesheet -->
    <!-- Vendor -->
    <?= '<link rel="stylesheet" href="'. VENDOR_REF . '/bootstrap/css/bootstrap.min.css">'."\n"; ?>
    <?= '<link rel="stylesheet" href="'. VENDOR_REF . '/font-awesome/css/font-awesome.min.css">'."\n" ?>
    <?php //echo '<link rel="stylesheet" href="'. STYLE_REF  . '/vendor/normalize.css">'."\n"; ?>
    <!-- Custom -->
    <?= '<link rel="stylesheet" href="'. STYLE_REF  . '/estilos.css">'."\n"; ?>

    <style>
        .inputMateria{
            margin-bottom: 10px;
        }
    </style>

</head>
<body>
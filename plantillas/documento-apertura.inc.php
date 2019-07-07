<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php
        if(!isset($titulo) || empty($titulo)){
            $titulo = 'Blog Perron';
        }
        echo "<title>$titulo</title>";
        ?>
        
        <link href="<?php echo RUTA_CSS; ?>bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link href="<?php echo RUTA_CSS; ?>estilos.css" rel="stylesheet">
    </head>
    <body>

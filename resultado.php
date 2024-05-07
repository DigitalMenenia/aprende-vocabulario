<?php

function carga($clase){

    require "./class/$clase.php";
}

spl_autoload_register("carga");

session_start();

$resultado= $_SESSION['examen'];

$html_informe_examen = Plantilla::html_informe_examen($resultado);

?>





<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> Resultado del examen </h1>

        <?=$html_informe_examen?>
    
</body>
</html>
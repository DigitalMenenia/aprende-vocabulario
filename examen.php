<?php

function carga($clase){

    require "./class/$clase.php";
}

spl_autoload_register("carga");

session_start();

$idioma = $_SESSION['idioma'];
$imagenes = $_SESSION['imagenes'];

$imagenes = unserialize($imagenes);
$numero_pregunta = $_SESSION['numero_pregunta'] ?? 1;
$_SESSION['numero_pregunta'] = $numero_pregunta; 

//queremos evaluar respuesta
if($_POST['submit']== 'Evaluar'){
    $pregunta = $_POST['pregunta'];
    $respuesta = $_POST['respuesta'];  //OJO es un array
    $respuesta = implode ("", $respuesta);

    //$letras_acertadas = $_POST['letras_acertadas'];
    $resultado = new Evaluacion($pregunta, $respuesta, 0, "FALLADO" );

    $resultado->evaluar();
    $_SESSION ['examen'] [] = serialize($resultado);

    if($numero_pregunta>5){
        
        header("Location: resultado.php");
        
        exit();
    }
    
    $resultado->sumaResultado();
}

//sacamos la imagen q queremos mostrar
$imagen = $imagenes[$numero_pregunta-1];


$html_pregunta = Plantilla::html_pregunta_imagen($idioma, $imagen);
$_SESSION ['numero_pregunta'] = ++$numero_pregunta;

// Pretendemos mostrar 5 imagenes ubicadas en ./idiomas/$idioma
//de cada imagen mostraremos la imagen y tantas cajas de texto como lketras tenga(sin extension)
//evaluaremos cada letra escrita por el usuario con cada letra de la imagen
//Anotaremos resultados (letra acertadas y si ha acertado o no la palabra)
//Cuando haya realizado las 5 preguntas, mostraremos un resumen de todo



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Realizar examen de vocabulario</title>
    <link rel="stylesheet" href="./estilo/estilo.css">
</head>
<body>
    <fieldset>

        <form action="index.php" method="post">
            <input type="submit" value="Volver al index">
        </form>

        <form action = "examen.php" method = "post">
            <?=$html_pregunta ?>
            <input type="submit" value="Evaluar" name="submit">
        </form>

        <?=$resultado??""?>

    </fieldset>
</body>
</html>


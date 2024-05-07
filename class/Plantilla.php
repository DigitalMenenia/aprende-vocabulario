<?php

class Plantilla {

    public static function html_pregunta_imagen($idioma, $imagen){
        
        $html = "";

        $separador = DIRECTORY_SEPARATOR;

        $numero_pregunta = $_SESSION['numero_pregunta'];

        //sacamos la palabra que corresponde a la imagen
        $palabra = substr($imagen, 0, strpos($imagen, "."));

        $html .= "<fieldset> ";

        $html .= "<legend> Pregunta numero $numero_pregunta </legend>";

        $html .= "<img src = './{$separador}idiomas{$separador}$idioma$separador$imagen' alt='$palabra' width='200' height ='200'>";

        $array_palabra = str_split($palabra);

        foreach($array_palabra as $letra)

        $html .= "<input type = 'text' name = 'respuesta[]' maxlength='1' size = '1'>";

        $html .= "<input type = 'hidden' name = 'pregunta' value = '$palabra' >";

        $html .= "</fieldset> ";

        return $html;

    }

    public static function html_informe_examen (array $resultados){

        $idioma = $_SESSION ['idioma'];

        $separador = DIRECTORY_SEPARATOR;
        $html = "";

        $html .= "<fieldset>";
        $html .= "<legend> Resultados del examen </legend>";

        foreach ($resultados as $numero_pregunta => $resultado){

            $resultado = unserialize($resultado);
            $imagen = $resultado->getPregunta();

            $html .= "<h4> Pregunta numero $numero_pregunta: </h4>";

            $html .= "<img src= '.{$separador}idiomas$separador$idioma$separador$imagen.png' alt ='$imagen'>";

            $html .= "$resultado";
         
            $html .= "<hr />";

        }

       
        //$html .= "</fieldset>";

        return $html;
    
    }
}


?>
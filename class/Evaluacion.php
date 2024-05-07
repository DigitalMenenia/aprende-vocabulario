<?php

class Evaluacion {

    private $pregunta;
    private $respuesta;
    private $letras_acertadas;
    private $resultado;

    public function __construct( $pregunta,  $respuesta, $letras_acertadas, $resultado){

        $this->pregunta = $pregunta;
        $this->respuesta = $respuesta;
        $this->letras_acertadas = $letras_acertadas;
        $this->resultado = $resultado;

    }

   
    public function evaluar() {
        for ($n = 0; $n < strlen($this->respuesta); $n++) {
            if ($this->respuesta[$n] == $this->pregunta[$n]) {
                $this->letras_acertadas++;
                if ($this->letras_acertadas == strlen($this->pregunta)) {
                    $this->resultado = 'ACERTADO';

                }
            }
        }
    }

    public function __toString() : string {
        $plural= $this->letras_acertadas == 1 ?"":"s";

        $html= " <h4>Pregunta: <span style='color: green'>$this->pregunta</span></h4>";
        $html.= "<h4>Respuesta: <span style='color: green'>$this->respuesta </span></h4>";
        $html.= "<h4>Letra{$plural} acertada{$plural}: <span style='color: green'>$this->letras_acertadas</span></h4>";
        $html.= "<h3><span style='color: blue'>$this->resultado</span></h3>";
        return $html;
    }



    public function getPregunta(){

        return $this->pregunta;
    }

    public function sumaResultado() {
        for ($i=0;$i< strlen($this->resultado);$i++){

            if ($this->resultado == 'ACERTADO'){
                $suma_acertados=0;
                $suma_acertados++;
                $html = "<h3>Has acertado: $suma_acertados </h3>";
            }else{
                $suma_fallados=0;
                $suma_fallados++;
                $html="<h3>Has fallado: $suma_fallados </h3>";
            }
			
			return $html;
        }

    }

}
<?php


class Directorio
{
    private $contenido_dir = [];
    private $ruta;


    /**
     * Elimina el dir . y .. de la lista de directorios que tenemos
     * En el atributo $contenido_dir
     */
    private function quita_puntos()
    {

        $pos_punto = array_search(".", $this->contenido_dir);
        unset ($this->contenido_dir[$pos_punto]);
        $pos_punto_punto = array_search("..", $this->contenido_dir);
        unset ($this->contenido_dir[$pos_punto_punto]);

    }

    /**
     * Directorio constructor.
     * @param string $dir directorio del que vamos a obtener su contenido
     */
    public function __construct($dir = "idiomas")
    {
        $this->ruta = $dir;
        $this->contenido_dir = scandir($dir);
        $this->quita_puntos();
}


    //El contendio del directorio actual
    public function getContenidoDir(){
        return $this->contenido_dir;
    }

    /**
     * @return bool si el directorio actual está o no vacío
     */
    public function vacio(){
        if (count($this->contenido_dir)==0)
            return true;
        else
            return false;
    }


    /**
     * actualiza el atributo contenido_dir
     * Importante hacerlo después de cualquier modificación (crear o borrar elementos)
     */
    private function actualiza_contenido(){
        $this->contenido_dir = scandir($this->ruta);
        $this->quita_puntos();

    }

    /**
     * @param $directorio a crear
     * @return bool si lo ha creado o no
     * Apache tiene que tener permisos de escritura y ejecutción
     * en el direcorio dónde se quiere crear $this->ruta
     */
    public function add_dir ($directorio){
        $created = false;
        $separador = DIRECTORY_SEPARATOR;
        if (@mkdir("$this->ruta$separador$directorio", 0777)) {
            $this->actualiza_contenido();
            $created = true;
        }
        return $created;
    }

    /**
     * @param $directorio direcotorio a borrar Debe existir, estar vacío y con permisos para apache
     * @return bool si lo ha borrado o no
     */
    public function del_dir($directorio){
        var_dump($directorio);
        $deleted = false;
        //Cuidado, el dir tiene que estar vacío
        $separador = DIRECTORY_SEPARATOR;
        if (rmdir("$this->ruta$separador$directorio")) {
            $this->actualiza_contenido();
            $deleted = true;
        }
        return $deleted;
    }
}
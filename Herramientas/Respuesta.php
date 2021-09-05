<?php 
class Respuesta{
    public $datos,$error,$mensaje;

    public function __construct($datos,$error,$mensaje)
    {
        $this->datos= $datos;
        $this->error=$error;
        $this->mensaje=$mensaje;
    }
}

?>
<?php 
class Cliente {
    public $nombre,$id,$cedula,$apellido,$apellido2,$direccion,$telefono, $nacionalidad, $correo;

     public function __construct(){

    }
    public function setCedula($cedula){
        $this->cedula=$cedula;
    }

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function setid($id){
        $this->id=$id;
    }

    public function setApellido($apellido){
        $this->apellido=$apellido;
    }

    public function setApellido2($apellido2){
        $this->apellido2=$apellido2;
    }

    
    public function setDireccion($direccion){
        $this->direccion=$direccion;
    }

    
    public function setTelefono($telefono){
        $this->telefono=$telefono;
    }

    public function setNacionalidad($nacionalidad){
        $this->nacionalidad=$nacionalidad;
    }
    public function setCorreo($correo){
        $this->correo=$correo;
    }








    
    
}

?>
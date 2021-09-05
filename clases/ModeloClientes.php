<?php
 class Clientes{
     public $usuarios;


    function insertar_cliente($cliente){
        $conn=new Conexion();

        if($this->buscar_cliente($cliente->cedula,0)==false){
            $id=$conn->realizarComandoInsercion("INSERT INTO `cliente` ( `cedula`, `nombre`, `apellido`, `apellido2`, `direccion`, `telefono`, `nacionalidad`, `correo`) VALUES ( '$cliente->cedula', '$cliente->nombre', '$cliente->apellido', '$cliente->apellido2', '$cliente->direccion', '$cliente->telefono', '$cliente->nacionalidad', '$cliente->correo');");
        }else{
            $this->actualizar_cliente($cliente->cedula,$cliente);
            $id=$cliente->cedula;
        }
        $usuario= $this->buscar_cliente($id);
        return $usuario;
    }

    function buscar_cliente($cedula,$activo=1){
        $conn= new Conexion();
        $resultado =  $conn->realizarComandoselect("SELECT * FROM `cliente` WHERE `cedula` = $cedula AND `activo`= $activo ");
        if($resultado->num_rows>0){
            return $resultado->fetch_assoc();
        }else{
            return false;   
        }
        

        
    }
    
    function buscar_clientes(){
        $conn= new Conexion();
        $resultado =  $conn->realizarComandoselect("SELECT * FROM `cliente` WHERE activo = 1");
        return $resultado->fetch_all(MYSQLI_ASSOC);

        
    }

    function eliminar_cliente($cedula){
        $conn= new Conexion();
        $resultado = $conn->realizarComandoUpdate( "UPDATE `cliente` SET activo = 0 WHERE cedula = '$cedula'");
        return $resultado;
      
    }

    function actualizar_cliente($cedula,$cliente){
        $conn= new Conexion();
        $resultado = $conn->realizarComandoUpdate("UPDATE `cliente` SET `cedula`='$cliente->cedula',`nombre`='$cliente->nombre',`apellido`='$cliente->apellido',`apellido2`='$cliente->apellido',`direccion`='$cliente->direccion',`telefono`='$cliente->direccion',`nacionalidad`='$cliente->nacionalidad',`correo`='$cliente->correo',activo=1 WHERE cedula= $cedula");
        return $resultado;
      
    }

 



 }
?>
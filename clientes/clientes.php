<?php
$accion = $_SERVER['REQUEST_METHOD'];
include("../clases/Cliente.php");
include("../clases/Conexion.php");
include("../clases/ModeloClientes.php");
include("../Herramientas/Respuesta.php");
include("../Herramientas/headers.php");

switch($accion){
     case  "GET":

      $cedula= $_REQUEST["cedula"]??null;
      
        if($cedula==null){
            buscar_clientes();
        }else{
            
            buscar_cliente($cedula);
        }
        
        break;

     case "POST":
        $json= $_POST["informacion"]??null;
        $objeto = json_decode($json);
       
            if($objeto->cedula_modificar==""){
                crear_cliente($json);
            }else{
                actualizar_cliente($json);
            }
        

        break;
        

      

      case "DELETE":
         $cedula= $_REQUEST["cedula"]??null;
         
        eliminar_cliente($cedula);
        break;



}


function buscar_cliente($cedula){
   try{
    $clientes= new Clientes();
    $datos  = $clientes->buscar_cliente($cedula);
    if($datos !=""){
        $respuesta= new Respuesta($datos,false,"cliente encontrado");
    }else{
        $respuesta= new Respuesta($datos,false,"no se encontro el clinete");
    }
   
   }catch(Exception $e){
        $respuesta = new Respuesta("error",$e,"");
    }
   echo json_encode($respuesta);
  

    


}

function buscar_clientes(){
    try{
        $clientes= new Clientes();
        $datos  = $clientes->buscar_clientes();
        $respuesta= new Respuesta($datos,false,"clientes cargado de manera exitosa");
    }catch(Exception $e){
        $respuesta = new Respuesta("error",$e,"");
    }
    echo json_encode($respuesta);
}


function actualizar_cliente($json){
    try{
        $cliente = new Cliente();
        $clientes= new Clientes();
        if($json==null){
            
            throw new Exception("no hay informacion del usuario a actualizar");
        }else{
            $json=json_decode($json);
        }
       

        if($json->nombre=="" || $json->apellido=="" || $json->apellido2==""){
            
            throw new Exception("el nombre y apellido son obligatorios");

        }

        $cliente->setNombre( $json->nombre);
        $cliente->setApellido( $json->apellido);
        $cliente->setApellido2($json->apellido2);
        $cliente->setCedula($json->cedula);
        $cliente->setDireccion($json->direccion);
        $cliente->setTelefono($json->telefono);
        $cliente->setNacionalidad($json->nacionalidad);
        $cliente->setCorreo( $json->correo);

        //$datos= $clientes->insertar_cliente($cliente);
        
        if($json->cedula_modificar!=""){
            
            if($clientes->buscar_cliente($json->cedula_modificar)!=false ){
                
                $clientes->actualizar_cliente($json->cedula_modificar,$cliente);
            }else{
                
                throw new Exception("El usuario con la cedula $json->cedula_modificar no existe");    
            }
        }else{
            throw new Exception("la cedula a modificar es obligatoria");
        }
        $respuesta= new Respuesta($cliente,false,"Actualizacion  exitosa");
        

        
        }catch(Exception $e){
            $respuesta = new Respuesta("error",$e->getMessage(),"");
            http_response_code(500);
        }
        echo json_encode($respuesta);
}


function crear_cliente($json){
    try{
        $cliente = new Cliente();
        $clientes= new Clientes();
        if($json==null||$json==""){
            
            throw new Exception("no hay informacion del usuario a creear");
        }else{
            $json=json_decode($json);
        }

        if($json->nombre=="" || $json->apellido=="" || $json->apellido2==""){
            
            throw new Exception("el nombre y apellido son obligatorios");

        }
        if($clientes->buscar_cliente($json->cedula)){
            throw new Exception("Ya existe un cliente activo con esa cedula");

        }

        $cliente->setNombre( $json->nombre);
        $cliente->setApellido( $json->apellido);
        $cliente->setApellido2($json->apellido2);
        $cliente->setCedula($json->cedula);
        $cliente->setDireccion($json->direccion);
        $cliente->setTelefono($json->telefono);
        $cliente->setNacionalidad($json->nacionalidad);
        $cliente->setCorreo( $json->correo);

        $datos= $clientes->insertar_cliente($cliente);
        $respuesta= new Respuesta($datos,false,"Registro exitoso");
        

        
        }catch(Exception $e){
            $respuesta = new Respuesta("error",$e->getMessage(),"");
            http_response_code(500);
        }
        echo json_encode($respuesta);

}

function eliminar_cliente($cedula){
    
    try{
        if($cedula==null|| $cedula==""){
            throw new Exception("no hay cedula del usuario a eliminar del usuario a eliminar");
        }
            
        

        $clientes= new Clientes();
        if($clientes->buscar_cliente($cedula)==false){
            throw new Exception("La cedula a elimina no existe");     
        }
        if($clientes->eliminar_cliente($cedula)){
            $respuesta = new Respuesta($cedula,"","se elimino correctamente el cliente ");
        }else{
            $respuesta = new Respuesta($cedula,"","No existe un cliente con la cedula $cedula");
        }
    
    }catch(Exception $e){
        $respuesta = new Respuesta("error",$e->getMessage(),"");
        http_response_code(500);
        
    }
   echo json_encode($respuesta);
}


?>

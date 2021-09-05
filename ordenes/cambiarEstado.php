<?php
$accion = $_SERVER['REQUEST_METHOD'];
include("../clases/Cliente.php");
include("../clases/Conexion.php");
include("../clases/ModeloClientes.php");
include("../Herramientas/Respuesta.php");
include("../Herramientas/headers.php");
include("../clases/Orden.php");
include("../clases/ModeloOrdenes.php");


$accion = $_SERVER['REQUEST_METHOD'];
switch($accion){
   
      case "POST":
        $json=$_POST["informacion"];
           insertarOrden($json);
       
        break;
}

 






function insertarOrden($json){
    $json= json_decode($json);
   try{
    $ordenes= new Ordenes();
    
    
    
    if($json->id_orden==null || ""){
        throw new Exception("El id de la orden es obligatorio");
    }
    if($json->estado==null || ""){
        throw new Exception("El estado  de la orden es obligatorio");
    }
        $ordenes->cambiar_estado($json->id_orden,$json->estado);
    
    $respuesta= new Respuesta("",false,"Se cambio el estado  correctamente");
    }catch(Exception $e){
        $respuesta = new Respuesta("error",$e->getMessage(),"");
        http_response_code(500);
    }
    echo json_encode($respuesta);
  
}

function actualizarOrden($json){
    try{

    }catch(Exception $e){
        $respuesta = new Respuesta("error",$e->getMessage(),"");
        http_response_code(500);
    }
    echo json_encode($respuesta);
}


?>
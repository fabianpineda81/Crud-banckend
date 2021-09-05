<?php

include("../clases/Cliente.php");
include("../clases/Conexion.php");
include("../clases/ModeloClientes.php");
include("../Herramientas/Respuesta.php");
include("../Herramientas/headers.php");
include("../clases/Orden.php");
include("../clases/ModeloOrdenes.php");


$accion = $_SERVER['REQUEST_METHOD'];
switch($accion){
     case  "GET":
        $id= $_GET["id"]??null;
        if($id==null){
            buscar_ordenes();
        }else{
            buscar_orden($id);
        }
        break;

     case "POST":
        $json=$_POST["informacion"];
           insertarOrden($json);
       
        break;
}

 function buscar_orden($id){
    try{
        
        $ordenes= new Ordenes();
        $datos  = $ordenes->buscar_orden($id);
        if($datos == false ){
            $respuesta = new Respuesta("","no existe una orden con ese id","");
            echo json_encode($respuesta);
            return;
        }

        if($datos !=""){
            $respuesta= new Respuesta($datos,false,"Se encontro correctamento la orden");
        }
       
       }catch(Exception $e){
        $respuesta = new Respuesta("error",$e->getMessage(),"");
        http_response_code(500);
        }
       echo json_encode($respuesta);
}

function buscar_ordenes(){
        try{
            $ordenes= new Ordenes();
            $res_ordenes= $ordenes->buscar_ordenes();
            $respuesta= new Respuesta($res_ordenes,false,"ordenes buscadas correctamente");

        }catch(Exception $e){
            $respuesta = new Respuesta("error",$e->getMessage(),"");
            http_response_code(500);
        }
        echo json_encode($respuesta);
}




function insertarOrden($json){
    $json= json_decode($json);
   try{
    $ordenes= new Ordenes();
    $orden = new Orden();
    //$orden->setid($json->id);
    //$orden->setNumero_orden($json->numero_orden);
    if($json->id_cliente==null || ""){
        throw new Exception("la cedula del cliente debe ser obligatoria ");
    }
    $orden->setId_cliente($json->id_cliente);
   

    //$orden->setEstado($json->estado);
   

    $orden = $ordenes->insertar_orden($orden);

    $items=$json->items;
    foreach($items as $item){
        $orden->insertar_item($item);
    }
    $respuesta= new Respuesta($orden,false,"Se inserto correctamente la orden");
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
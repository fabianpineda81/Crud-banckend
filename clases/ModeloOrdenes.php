<?php
class Ordenes{
    
    function insertar_orden($orden){
        $conn=new Conexion();
        
        $id=$conn->realizarComandoInsercion("INSERT INTO `orden` ( `id_cliente`) VALUES ('$orden->id_cliente');");
        $orden= $this->buscar_orden($id);
        return $orden;
    }
    
    function buscar_orden($id_orden){
        
        $conn= new Conexion();
        $resultado =  $conn->realizarComandoselect("SELECT o.*,c.cedula,c.nombre,c.apellido  FROM orden o, cliente C WHERE c.id=o.id_cliente AND  o.id = $id_orden ");
        if(!$resultado->num_rows>0){
            return false;
        }
        
        $orden = new Orden();
        $res = $resultado->fetch_object();
        $orden->setid($res->id);
        $orden->setNumero_orden($res->numero_orden);
        $orden->setId_cliente($res->id_cliente);
        $orden->setEstado($res->estado);
        $orden->setFecha($res->fecha);
        $orden->setCedula_cliente($res->cedula);
        $orden->setNombre_cliente($res->nombre);
        $orden->setapellido_cliente($res->apellido);
        
        $orden->buscar_items();

        return $orden;
    
        
    }
    
    function buscar_ordenes(){
        $contador=0;
        $res_ordenes=[];
        $conn= new Conexion();
        $resultado =  $conn->realizarComandoselect("SELECT o.*,c.cedula,c.nombre,c.apellido FROM orden o, cliente C WHERE c.id=o.id_cliente");
        while($res=$resultado->fetch_object()){
            
            $orden = new Orden();
            $orden->setid($res->id);
            $orden->setNumero_orden($res->numero_orden);
            $orden->setId_cliente($res->id_cliente);
            $orden->setEstado($res->estado);
            $orden->setFecha($res->fecha);
            $orden->setCedula_cliente($res->cedula);
            $orden->setNombre_cliente($res->nombre);
            $orden->setapellido_cliente($res->apellido);
            $orden->buscar_items();
            $res_ordenes[$contador]=$orden;
            $contador++;


        }
        
        return $res_ordenes;
    
        
    }

    function cambiar_estado($id_orden,$estado){
        $conn= new Conexion();
        $resultado = $conn->realizarComandoUpdate( "UPDATE `orden` SET `estado`=$estado WHERE id=$id_orden");
        return $resultado;
    
    }
    
    function eliminar_orden($id_orden){
        $conn= new Conexion();
        $resultado = $conn->realizarComandoUpdate( "UPDATE `orden` SET `activo`=0 WHERE id=$id_orden");
        return $resultado;
    
    }


   



    
}




?>
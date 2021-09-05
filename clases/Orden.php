<?php
    class Orden {
         public $id,$numero_orden,$id_cliente,$estado,$fecha,$items,$cedula_cliente,$cantidad_items,$total,$nombre_cliente,$apellido_cliente;

        public function __construct()
        {
            
        }

         public function setid($id){
            $this->id=$id;
        }

        public function setNumero_orden($numero_orden){
            $this->numero_orden=$numero_orden;
        }

        public function setId_cliente($id_cliente){
            $this->id_cliente=$id_cliente;
        }

        public function setEstado($estado){
            $this->estado=$estado;
        }

        public function setFecha($fecha){
            $this->fecha=$fecha;
        }
        public function setCedula_cliente($cedula_cliente){
            $this->cedula_cliente=$cedula_cliente;
        }
        public function setNombre_cliente($nombre_cliente){
            $this->nombre_cliente=$nombre_cliente;
        }
        public function setApellido_cliente($apellido_cliente){
            $this->apellido_cliente=$apellido_cliente;
        }

        function insertar_item($item){
            $conn=new Conexion();
            
            $id=$conn->realizarComandoInsercion("INSERT INTO `item` ( `id_orden`, `ancho`, `largo`, `precio`, `cantidad`) VALUES ('$this->id','$item->ancho', '$item->largo', '$item->precio', '$item->cantidad');");
            return $id; 
            
        }


    
        public function     buscar_items(){
            $conn=new Conexion();
            $resultado =  $conn->realizarComandoselect("SELECT * FROM `item` WHERE id_orden='$this->id'");
            $this->items= $resultado->fetch_all(MYSQLI_ASSOC);
            $contador=0;
            $total=0;
            foreach($this->items as $item){
                $contador++;
                $total+=$item["precio"]*$item["cantidad"];

            }
            $this->total=$total;
            $this->cantidad_items=$contador;

        }





     
    
    
    }




?>
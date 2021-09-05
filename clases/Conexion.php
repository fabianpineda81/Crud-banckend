<?php 
    class Conexion{
        private $host="localhost";
        private $username="root";
        private $password="";
        private $dataBase="tecnoglass";
        private $conn=null;
        public function __construct() {
            $this->connectar();
        }

        function connectar(){
            $this->conn= new mysqli($this->host,$this->username,$this->password,$this->dataBase);
            
            
            if($this->conn->connect_error){
                die("fallo en la conexion: ".$this->conn->connect_error);

            }
        }


        function realizarComandoInsercion ($comando){
            if($this->conn->query($comando)){
                $lastId=$this->conn->insert_id;
                return $lastId;
            }else{
                die( "Error: " .$comando . "<br>" . $this->conn->error); 
            }
        }

        function realizarComandoselect($comando){
             if($resultado =   $this->conn->query($comando)){
                
                 return $resultado;


             }else{
                die( "Error: " .$comando . "<br>" . $this->conn->error);

             }

        }


        function realizarComandoDelte($comando){
            if($this->conn->query($comando)){
                return true ;
            }else{
               die( "Error deleting record: " . $this->conn->error);
            }
        }

        function realizarComandoUpdate($comando){
            if($this->conn->query($comando)){
                return true ;
            }else{
               die( "Error updating  record: " . $this->conn->error);
            }
        }




    }
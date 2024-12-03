<?php
require_once 'conexion.php'; // Incluir la conexión a la base de datos

class Mserv {
    // Atributos
    private $idservi;
    private $nit;
    private $detservi;
    private $precio;
    private $tipservi;
    private $idempre;

    // Métodos get
    public function getIdservi(){
        return $this->idservi;
    }
    public function getNit(){
        return $this->nit;
    }
    public function getDetservi(){
        return $this->detservi;
    }
    public function getPrecio(){
        return $this->precio;
    }
    public function getTipservi(){
        return $this->tipservi;
    }
    public function getIdempre(){
        return $this->idempre;
    }

    // Métodos set
    public function setIdservi($idservi){
        $this->idservi = $idservi;
    }
    public function setNit($nit){
        $this->nit = $nit;
    }
    public function setDetservi($detservi){
        $this->detservi = $detservi;
    }
    public function setPrecio($precio){
        $this->precio = $precio;
    }
    public function setTipservi($tipservi){
        $this->tipservi = $tipservi;
    }
    public function setIdempre($idempre){
        $this->idempre = $idempre;
    }

    // Métodos públicos
    public function getAll(){
        $res = NULL;
        $sql = "SELECT * FROM servicios";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getOne(){
        $res = NULL;
        $sql = "SELECT * FROM servicios WHERE idservi = :idservi";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idservi = $this->getIdservi();
        $result->bindParam(":idservi", $idservi);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function save(){
        try {
            $sql = "INSERT INTO servicios(detservi, precio, tipservi) 
                    VALUES (:detservi, :precio, :tipservi)";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            
            $detservi = $this->getDetservi();
            $result->bindParam(":detservi", $detservi);
            $precio = $this->getPrecio();
            $result->bindParam(":precio", $precio);
            $tipservi = $this->getTipservi();
            $result->bindParam(":tipservi", $tipservi);
            
            $result->execute();
            echo "Datos guardados exitosamente.";
        } catch (PDOException $e) {
            echo "Error al guardar: " . $e->getMessage();
        }
    }

    public function edit(){
        $sql = "UPDATE servicios 
                SET detservi = :detservi, precio = :precio, tipservi = :tipservi
                WHERE idservi = :idservi";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        
        $idservi = $this->getIdservi();
        $result->bindParam(":idservi", $idservi);
        $detservi = $this->getDetservi();
        $result->bindParam(":detservi", $detservi);
        $precio = $this->getPrecio();
        $result->bindParam(":precio", $precio);
        $tipservi = $this->getTipservi();
        $result->bindParam(":tipservi", $tipservi);
        
        $result->execute();
    }

    public function del(){
        $sql = "DELETE FROM servicios WHERE idservi = :idservi";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idservi = $this->getIdservi(); 
        $result->bindParam(":idservi", $idservi);
        $result->execute();
    }
}
?>

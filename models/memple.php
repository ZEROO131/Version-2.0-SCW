<?php
require_once 'conexion.php'; // Incluir la conexión a la base de datos

class Memple {
    // Atributos
    private $idemple;
    private $nomemple;
    private $tipdocu;
    private $ndocemple;
    private $emaiemple;
    private $codbal; 
    private $idempre;

    // Métodos get
    public function getIdemple(){
        return $this->idemple;
    }
    public function getNomemple(){
        return $this->nomemple;
    }
    public function getTipdocu(){
        return $this->tipdocu;
    }
    public function getNdocemple(){
        return $this->ndocemple;
    }
    public function getEmaiemple(){
        return $this->emaiemple;
    }
    public function getCodbal(){
        return $this->codbal;
    }
    public function getIdempre(){
        return $this->idempre;
    }

    // Métodos set
    public function setIdemple($idemple){
        $this->idemple = $idemple;
    }
    public function setNomemple($nomemple){
        $this->nomemple = $nomemple;
    }
    public function setTipdocu($tipdocu){
        $this->tipdocu = $tipdocu;
    }
    public function setNdocemple($ndocemple){
        $this->ndocemple = $ndocemple;
    }
    public function setEmaiemple($emaiemple){
        $this->emaiemple = $emaiemple;
    }
    public function setCodbal($codbal){
        $this->codbal = $codbal;
    }
    public function setIdempre($idempre){
        $this->idempre = $idempre;
    }

    // Métodos públicos
    public function getAll(){
        $res = NULL;
        $sql = "SELECT * FROM empleado";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getEmpall() {
        $res = NULL;
        // Consulta que obtiene el ID del empleado y su nombre sin duplicados
        $sql = "SELECT DISTINCT idemple, nomemple FROM empleado";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }


    public function getOne(){
        $res = NULL;
        $sql = "SELECT * FROM empleado WHERE idemple = :idemple";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idemple = $this->getIdemple();
        $result->bindParam(":idemple", $idemple);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function save(){

        $sql = "INSERT INTO empleado(nomemple, tipdocu, ndocemple, emaiemple) 
                VALUES (:nomemple, :tipdocu, :ndocemple, :emaiemple)";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
                
        $nomemple = $this->getNomemple();
        $result->bindParam(":nomemple", $nomemple);
        $tipdocu = $this->getTipdocu();
        $result->bindParam(":tipdocu", $tipdocu);
        $ndocemple = $this->getNdocemple();
        $result->bindParam(":ndocemple", $ndocemple);
        $emaiemple = $this->getEmaiemple();
        $result->bindParam(":emaiemple", $emaiemple);
                
        $result->execute();
    }


    public function edit(){
        $sql = "UPDATE empleado 
                SET nomemple = :nomemple, tipdocu = :tipdocu, ndocemple = :ndocemple, emaiemple = :emaiemple
                WHERE idemple = :idemple";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        
        // Vinculación de todos los parámetros
        $idemple = $this->getIdemple();
        $result->bindParam(":idemple", $idemple);
        $nomemple = $this->getNomemple();
        $result->bindParam(":nomemple", $nomemple);
        $tipdocu = $this->getTipdocu();
        $result->bindParam(":tipdocu", $tipdocu);
        $ndocemple = $this->getNdocemple();
        $result->bindParam(":ndocemple", $ndocemple);
        $emaiemple = $this->getEmaiemple();
        $result->bindParam(":emaiemple", $emaiemple);
        // Ejecuta solo una vez
        $result->execute();
    }

    public function del(){
        $sql = "DELETE FROM empleado WHERE idemple = :idemple";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idemple = $this->getIdemple(); 
        $result->bindParam(":idemple", $idemple);
        $result->execute();
    }
}

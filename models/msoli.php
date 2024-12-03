<?php
require_once 'conexion.php'; // Incluir la conexión a la base de datos

class Msoli {
    // Atributos
    private $idsoli;
    private $fecha;
    private $estasoli;
    private $idvehi;
    private $idusu;
    private $idempre;

    // Métodos get
    public function getIdsoli(){
        return $this->idsoli;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getEstasoli(){
        return $this->estasoli;
    }
    public function getIdvehi(){
        return $this->idvehi;
    }
    public function getIdusu(){
        return $this->idusu;
    }
    public function getIdempre(){
        return $this->idempre;
    }

    // Métodos set
    public function setIdsoli($idsoli){
        $this->idsoli = $idsoli;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    public function setEstasoli($estasoli){
        $this->estasoli = $estasoli;
    }
    public function setIdvehi($idvehi){
        $this->idvehi = $idvehi;
    }
    public function setIdusu($idusu){
        $this->idusu = $idusu;
    }
    public function setIdempre($idempre){
        $this->idempre = $idempre;
    }

    // Métodos públicos
    public function getAll(){
        $res = NULL;
        $sql = "SELECT 
                    s.idsoli, 
                    s.fecha, 
                    v.placa AS placa_vehiculo, 
                    CONCAT(u.nomusu, ' ', u.apeusu) AS nombre_completo 
                FROM solicitud s
                JOIN vehiculo v ON s.idvehi = v.idvehi
                JOIN usuario u ON s.idusu = u.idusu";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getOne(){
        $res = NULL;
        $sql = "SELECT * FROM solicitud WHERE idsoli = :idsoli";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idsoli = $this->getIdsoli();
        $result->bindParam(":idsoli", $idsoli);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function save(){
        try {
            $sql = "INSERT INTO solicitud(fecha, estasoli, idvehi, idusu, idempre) 
                    VALUES (:fecha, :estasoli, :idvehi, :idusu, :idempre)";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            
            $fecha = $this->getFecha();
            $result->bindParam(":fecha", $fecha);
            $estasoli = $this->getEstasoli();
            $result->bindParam(":estasoli", $estasoli);
            $idvehi = $this->getIdvehi();
            $result->bindParam(":idvehi", $idvehi);
            $idusu = $this->getIdusu();
            $result->bindParam(":idusu", $idusu);
            $idempre = $this->getIdempre();
            $result->bindParam(":idempre", $idempre);
            
            $result->execute();
            echo "Datos guardados exitosamente.";
        } catch (PDOException $e) {
            echo "Error al guardar: " . $e->getMessage();
        }
    }

    public function edit(){
        $sql = "UPDATE solicitud 
                SET fecha = :fecha, estasoli = :estasoli, idvehi = :idvehi, idusu = :idusu, idempre = :idempre
                WHERE idsoli = :idsoli";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        
        $idsoli = $this->getIdsoli();
        $result->bindParam(":idsoli", $idsoli);
        $fecha = $this->getFecha();
        $result->bindParam(":fecha", $fecha);
        $estasoli = $this->getEstasoli();
        $result->bindParam(":estasoli", $estasoli);
        $idvehi = $this->getIdvehi();
        $result->bindParam(":idvehi", $idvehi);
        $idusu = $this->getIdusu();
        $result->bindParam(":idusu", $idusu);
        $idempre = $this->getIdempre();
        $result->bindParam(":idempre", $idempre);
        
        $result->execute();
    }

    public function del(){
        $sql = "DELETE FROM solicitud WHERE idsoli = :idsoli";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idsoli = $this->getIdsoli(); 
        $result->bindParam(":idsoli", $idsoli);
        $result->execute();
    }
}
?>

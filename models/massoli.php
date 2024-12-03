<?php
require_once 'conexion.php'; // Incluir la conexión a la base de datos

class Massoli {
    // Atributos
    private $idasig;
    private $idemple;
    private $idsoli;

    // Métodos get
    public function getIdasig() {
        return $this->idasig;
    }
    public function getIdemple() {
        return $this->idemple;
    }
    public function getIdsoli() {
        return $this->idsoli;
    }

    // Métodos set
    public function setIdasig($idasig) {
        $this->idasig = $idasig;
    }
    public function setIdemple($idemple) {
        $this->idemple = $idemple;
    }
    public function setIdsoli($idsoli) {
        $this->idsoli = $idsoli;
    }

    // Métodos públicos
    public function getAll() {
        $sql = "SELECT solicitud.idvehi, vehiculo.placa, detsoli.idservi, servicios.detservi AS nombre_servicio, asignacion.idemple, empleado.nomemple AS nombre_empleado 
                FROM solicitud 
                JOIN vehiculo ON solicitud.idvehi = vehiculo.idvehi 
                JOIN detsoli ON solicitud.idsoli = detsoli.idsoli 
                JOIN servicios ON detsoli.idservi = servicios.idservi 
                JOIN asignacion ON solicitud.idsoli = asignacion.idsoli 
                JOIN empleado ON asignacion.idemple = empleado.idemple";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne() {
        $sql = "SELECT * FROM asignacion WHERE idasig = :idasig";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idasig = $this->getIdasig();
        $result->bindParam(":idasig", $idasig);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function save() {
        try {
            $sql = "INSERT INTO asignacion (idemple, idsoli) 
                    VALUES (:idemple, :idsoli)";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            
            $idemple = $this->getIdemple();
            $idsoli = $this->getIdsoli();

            $result->bindParam(":idemple", $idemple);
            $result->bindParam(":idsoli", $idsoli);
            
            if ($result->execute()) { 
                echo "Registro guardado correctamente.<br>"; 
                return true;
            } else { 
                print_r($result->errorInfo()); // Mostrar detalles del error
                return false;
            }
        } catch (PDOException $e) { 
            echo "Error: " . $e->getMessage(); // Mostrar mensaje de error
            return false;
        }
    }

    public function edit() {
        try {
            $sql = "UPDATE asignacion 
                    SET idemple = :idemple, idsoli = :idsoli
                    WHERE idasig = :idasig";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);

            $idasig = $this->getIdasig();
            $idemple = $this->getIdemple();
            $idsoli = $this->getIdsoli();

            $result->bindParam(":idasig", $idasig);
            $result->bindParam(":idemple", $idemple);
            $result->bindParam(":idsoli", $idsoli);
            
            return $result->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function del() {
        try {
            $sql = "DELETE FROM asignacion WHERE idasig = :idasig";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idasig = $this->getIdasig();
            $result->bindParam(":idasig", $idasig);
            return $result->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>


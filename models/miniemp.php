<?php
require_once 'conexion.php'; // Incluir la conexión a la base de datos

class Miniemp {
    // Atributos
    private $idvehi;
    private $idusu;
    private $placa;
    private $color;
    private $marca;
    private $modelvehi;
    private $tipvehi;
    private $conexion;

    // Constructor que inicializa la conexión
    public function __construct() {
        $modelo = new Conexion();
        $this->conexion = $modelo->get_conexion();
    }

    // Métodos get
    public function getIdvehi() { return $this->idvehi; }
    public function getIdusu() { return $this->idusu; }
    public function getPlaca() { return $this->placa; }
    public function getColor() { return $this->color; }
    public function getMarca() { return $this->marca; }
    public function getModelvehi() { return $this->modelvehi; }
    public function getTipvehi() { return $this->tipvehi; }

    // Métodos set
    public function setIdvehi($idvehi) { $this->idvehi = htmlspecialchars(strip_tags($idvehi)); }
    public function setIdusu($idusu) { $this->idusu = htmlspecialchars(strip_tags($idusu)); }
    public function setPlaca($placa) { $this->placa = htmlspecialchars(strip_tags($placa)); }
    public function setColor($color) { $this->color = htmlspecialchars(strip_tags($color)); }
    public function setMarca($marca) { $this->marca = htmlspecialchars(strip_tags($marca)); }
    public function setModelvehi($modelvehi) { $this->modelvehi = htmlspecialchars(strip_tags($modelvehi)); }
    public function setTipvehi($tipvehi) { $this->tipvehi = htmlspecialchars(strip_tags($tipvehi)); }

    // Validación de existencia
    public function exists($idvehi) {
        try {
            $sql = "SELECT COUNT(*) FROM vehiculo WHERE idvehi = :idvehi";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":idvehi", $idvehi);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    // Obtener todos los vehículos
    public function getAll() {
        try {
            $sql = "SELECT * FROM vehiculo";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error al obtener vehículos: " . $e->getMessage();
        }
    }

    // Obtener todos los servicios
    public function getAllsrv() {
        try {
            $sql = "SELECT idservi, detservi, precio FROM servicios";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error al obtener servicios: " . $e->getMessage();
        }
    }

    // Obtener un vehículo
    public function getOne() {
        try {
            $sql = "SELECT * FROM vehiculo WHERE idvehi = :idvehi";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":idvehi", $this->idvehi);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error al obtener vehículo: " . $e->getMessage();
        }
    }

    // Guardar vehículo y solicitudes
    public function save() {
        $this->conexion->beginTransaction();
        try {
            // Insertar vehículo sin el idusu
            $sqlVehiculo = "INSERT INTO vehiculo (idvehi, placa, color, marca, modelvehi, tipvehi) 
                            VALUES (:idvehi, :placa, :color, :marca, :modelvehi, :tipvehi)";
            $stmtVehiculo = $this->conexion->prepare($sqlVehiculo);
            $stmtVehiculo->bindParam(":idvehi", $this->idvehi);
            $stmtVehiculo->bindParam(":placa", $this->placa);
            $stmtVehiculo->bindParam(":color", $this->color);
            $stmtVehiculo->bindParam(":marca", $this->marca);
            $stmtVehiculo->bindParam(":modelvehi", $this->modelvehi);
            $stmtVehiculo->bindParam(":tipvehi", $this->tipvehi);
            $stmtVehiculo->execute();
    
            // Insertar solicitud
            $sqlSolicitud = "INSERT INTO solicitud (idvehi) VALUES (:idvehi)";
            $stmtSolicitud = $this->conexion->prepare($sqlSolicitud);
            $stmtSolicitud->bindParam(":idvehi", $this->idvehi);
            $stmtSolicitud->execute();
    
            // Obtener ID de la solicitud generada
            $idsoli = $this->conexion->lastInsertId();
    
            // Insertar detalle de solicitud
            $sqlDetSoli = "INSERT INTO detsoli (idsoli, idservi) VALUES (:idsoli, :idservi)";
            $stmtDetSoli = $this->conexion->prepare($sqlDetSoli);
            $stmtDetSoli->bindParam(":idsoli", $idsoli);
    
            // Aquí se debería pasar un idservi válido, por ejemplo de la entrada del formulario
            $idservi = 1; // Cambiar por el valor real de idservi
            $stmtDetSoli->bindParam(":idservi", $idservi);
            $stmtDetSoli->execute();
    
            // Confirmar transacción
            $this->conexion->commit();
            return "Registro completado exitosamente.";
        } catch (Exception $e) {
            $this->conexion->rollBack();
            return "Error al registrar los datos: " . $e->getMessage();
        }
    }
    // Actualizar vehículo
    public function edit() {
        try {
            $this->conexion->beginTransaction();
            // No actualizamos el idusu
            $sql = "UPDATE vehiculo 
                    SET placa = :placa, color = :color, marca = :marca, modelvehi = :modelvehi, tipvehi = :tipvehi 
                    WHERE idvehi = :idvehi";
            $stmt = $this->conexion->prepare($sql);
    
            $stmt->bindParam(":idvehi", $this->idvehi);
            $stmt->bindParam(":placa", $this->placa);
            $stmt->bindParam(":color", $this->color);
            $stmt->bindParam(":marca", $this->marca);
            $stmt->bindParam(":modelvehi", $this->modelvehi);
            $stmt->bindParam(":tipvehi", $this->tipvehi);
            $stmt->execute();
            
            $this->conexion->commit();
            return "Vehículo actualizado correctamente.";
        } catch (Exception $e) {
            $this->conexion->rollBack();
            return "Error al actualizar vehículo: " . $e->getMessage();
        }
    }

    // Eliminar vehículo
    public function del() {
        if (!$this->exists($this->idvehi)) {
            return "El vehículo no existe.";
        }

        try {
            $this->conexion->beginTransaction();
            $sql = "DELETE FROM vehiculo WHERE idvehi = :idvehi";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":idvehi", $this->idvehi);
            $stmt->execute();

            $this->conexion->commit();
            return "Vehículo eliminado correctamente.";
        } catch (Exception $e) {
            $this->conexion->rollBack();
            return "Error al eliminar vehículo: " . $e->getMessage();
        }
    }
}
?>
<?php
require_once('conexion.php');

class ModeloServicios {
    private $conexion;

    public function __construct() {
        $modelo = new Conexion();
        $this->conexion = $modelo->get_conexion();
    }

    public function obtenerServiciosPorUsuario($idUsuario) {
        $sql = "SELECT 
                    s.detservi,
                    s.tipservi,
                    s.precio
                FROM 
                    solicitud AS sol
                INNER JOIN detsoli AS ds ON sol.idsoli = ds.idsoli
                INNER JOIN servicios AS s ON ds.idservi = s.idservi
                WHERE 
                    sol.idusu = :idusu";

        $result = $this->conexion->prepare($sql);
        $result->bindParam(":idusu", $idUsuario);

        try {
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejo de errores
            error_log("Error al obtener servicios: " . $e->getMessage());
            return [];
        }
    }
}

?>
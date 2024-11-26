<?php
require_once('conexion.php');

class SolicitudModel {
    private $conexion;

    public function __construct() {
        $modelo = new Conexion();
        $this->conexion = $modelo->get_conexion();
    }

    // Obtener el estado de la solicitud del usuario activo
    public function getSolicitudEstadoByUsuario($idusu) {
        $sql = "SELECT s.etasol, s.idsoli 
                FROM solicitud AS s 
                WHERE s.idusu = :idusu 
                ORDER BY s.idsoli DESC 
                LIMIT 1";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":idusu", $idusu); // Aquí usamos el nombre correcto del campo en la tabla
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
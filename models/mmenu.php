<?php 
class Mmenu {
    private $idpag;

    function getIdpag() {
        return $this->idpag;
    }

    function setIdpag($idpag) {
        $this->idpag = $idpag;
    }

    public function getMenu() {
        $resultado = NULL;
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        
        // Cambiamos `pagper` a `perxpag`, ya que esa es la tabla en tu base de datos
        $sql = "SELECT p.idpag, p.nompag, p.rutpag, p.mospag, p.ordpag, p.icopag 
                FROM pagina AS p 
                INNER JOIN perxpag AS f ON p.idpag = f.idpag 
                WHERE f.idper = :idper";

        $result = $conexion->prepare($sql);
        
        // Obtenemos el idper de la sesión para realizar la consulta
        $idper = isset($_SESSION['idper']) ? $_SESSION['idper'] : 0;
        $result->bindParam(":idper", $idper);
        
        $result->execute();
        $resultado = $result->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function getVal() {
        $resultado = NULL;
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        
        $sql = "SELECT p.idpag, p.nompag, p.rutpag, p.mospag, p.ordpag, p.icopag 
                FROM página AS p 
                INNER JOIN perxpag AS f ON p.idpag = f.idpag 
                WHERE f.idper = :idper AND p.idpag = :idpag";

        $result = $conexion->prepare($sql);
        
        // Obtenemos el idper de la sesión y el idpag de la instancia
        $idper = isset($_SESSION['idper']) ? $_SESSION['idper'] : 0;
        $result->bindParam(":idper", $idper);
        
        $idpag = $this->getIdpag();
        $result->bindParam(":idpag", $idpag);
        
        $result->execute();
        $resultado = $result->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
}
?>
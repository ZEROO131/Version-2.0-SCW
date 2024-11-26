<?php
class Musuinf{
    private $idusu;
    private $nomusu;
    private $apeusu;
    private $emailusu;
    private $paswusu;
    private $tipdocusu;
    private $ndocusu;
    private $telusu;
    private $codubi;
    private $idper;
    private $imgusu;

    //metodos get

    public function getIdusu(){
        return $this->idusu;
    }
    public function getNomusu(){
        return $this->nomusu ;
    } 
    public function getApeusu(){
        return $this->apeusu ;
    } 
    public function getEmailusu(){
        return $this->emailusu;
    }
    public function getPaswusu(){
        return $this->paswusu;
    }
    public function getTipdocusu(){
        return $this->tipdocusu;
    }
    public function getNdocusu(){
        return $this->ndocusu;
    }
    public function getTelusu(){
        return $this->telusu;
    }
    public function getCodubi(){
        return $this->codubi;
    }
    public function getIdper(){
        return $this->idper;
    }
    public function getimgusu(){
        return $this->imgusu;
    }
    
    //Metodos set

    public function setIdusu($idusu){
        $this->idusu = $idusu;
    }    
    public function setNomusu($nomusu ){
        $this->nomusu  = $nomusu ;
    } 
    public function setApeusu($apeusu ){
        $this->apeusu  = $apeusu ;
    } 
    public function setEmailusu($emailusu){
        $this->emailusu = $emailusu;
    }
    public function setPaswusu($paswusu){
        $this->paswusu = $paswusu;
    }
    public function setTipdocusu($tipdocusu){
        $this->tipdocusu = $tipdocusu;
    }
    public function setNdocusu($ndocusu){
        $this->ndocusu = $ndocusu;
    }
    public function setTelusu($telusu){
        $this->telusu = $telusu;
    }
    public function setCodubi($codubi){
        $this->codubi = $codubi;
    }
    public function setIdper($idper){
        $this->idper = $idper;
    }
    public function setImgusu($imgusu){
        $this->imgusu = $imgusu;
    }

    //metodos publicos
	public function getAll(){
		$res = NULL;
		$sql = "SELECT * FROM usuario";
		$modelo = new Conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res= $result->fetchall(PDO::FETCH_ASSOC);
		return $res;
	}
    
    public function getOne() {
        $sql = "SELECT * FROM usuario WHERE idusu = :idusu";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idusu", $this->idusu);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);  // Devuelve los datos en un array asociativo
    }

    function guardarUsuario($nomusu, $apeusu, $emailusu, $telusu) {
        if ($_SESSION['idusu']) {  // Verificar que haya una sesión activa
            $sql = "INSERT INTO usuario (nomusu, apeusu, emailusu, telusu) VALUES (:nomusu, :apeusu, :emailusu, :telusu)";
    
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $stmt = $conexion->prepare($sql);
    
            // Asignar los valores para la consulta
            $stmt->bindParam(":nomusu", $nomusu);
            $stmt->bindParam(":apeusu", $apeusu);
            $stmt->bindParam(":emailusu", $emailusu);
            $stmt->bindParam(":telusu", $telusu);
    
            // Ejecutar la consulta
            $stmt->execute();
    
            return true; // Si se ejecuta correctamente
        } else {
            return false; // Si no hay sesión activa
        }
    }

    function editarUsuario($idusu, $nomusu, $apeusu, $emailusu, $telusu) {
        // Verificar que el ID de usuario de la sesión coincida con el ID a modificar
        if ($_SESSION['idusu'] == $idusu) {
            $sql = "UPDATE usuario SET nomusu = :nomusu, apeusu = :apeusu, emailusu = :emailusu, telusu = :telusu WHERE idusu = :idusu";
    
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $stmt = $conexion->prepare($sql);
    
            // Asignar los valores para la consulta
            $stmt->bindParam(":nomusu", $nomusu);
            $stmt->bindParam(":apeusu", $apeusu);
            $stmt->bindParam(":emailusu", $emailusu);
            $stmt->bindParam(":telusu", $telusu);
            $stmt->bindParam(":idusu", $idusu);
    
            // Ejecutar la consulta
            $stmt->execute();
    
            return true; // Si se ejecuta correctamente
        } else {
            return false; // Si no es el usuario correcto
        }
    }

    function eliminarUsuario($idusu) {
        // Verificar que el ID de usuario de la sesión coincida con el ID a eliminar
        if ($_SESSION['idusu'] == $idusu) {
            $sql = "DELETE FROM usuario WHERE idusu = :idusu";
    
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":idusu", $idusu);
    
            // Ejecutar la consulta
            $stmt->execute();
    
            // Puedes agregar la lógica para cerrar sesión aquí si quieres que cierre la sesión después de eliminar al usuario.
            // cerrarSesion();
    
            return true; // Usuario eliminado
        } else {
            return false; // Si no es el usuario correcto
        }
    }
}
?>
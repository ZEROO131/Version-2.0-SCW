<?php
require_once('conexion.php');
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
        $res = NULL;
    
        // Verificamos que la sesión esté iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Validamos que exista un id de usuario en la sesión
        if (isset($_SESSION['idusu'])) {
            $idusu = $_SESSION['idusu'];
            $sql = "SELECT idusu, nomusu, apeusu, emailusu, paswusu, tipdocusu, ndocusu, telusu, codubi, idper, imgusu 
                    FROM usuario 
                    WHERE idusu = :idusu";
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":idusu", $idusu);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return $res;
    }
    public function save() {
        $sql = "INSERT INTO usuario (nomusu, apeusu, emailusu, paswusu, tipdocusu, ndocusu, telusu, codubi, idper, imgusu) VALUES (:nomusu, :apeusu, :emailusu, :paswusu, :tipdocusu, :ndocusu, :telusu, :codubi, :idper, :imgusu)";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idusu", $this->idusu);    
        $result->bindParam(":nomusu", $this->nomusu);
        $result->bindParam(":apeusu", $this->apeusu);
        $result->bindParam(":emailusu", $this->emailusu);
        $result->bindParam(":paswusu", $this->paswusu);
        $result->bindParam(":tipdocusu", $this->tipdocusu);
        $result->bindParam(":ndocusu", $this->ndocusu);
        $result->bindParam(":telusu", $this->telusu);
        $result->bindParam(":codubi", $this->codubi);
        $result->bindParam(":idper", $this->idper);
        $result->bindParam(":imgusu", $this->imgusu);
        $result->execute();
    }

    public function edit() {
        $sql = "UPDATE usuario SET nomusu=:nomusu, apeusu=:apeusu, emailusu=:emailusu, ndocusu=:ndocusu, telusu=:telusu, codubi=:codubi, imgusu=:imgusu WHERE idusu=:idusu";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idusu", $this->idusu);
        $result->bindParam(":nomusu", $this->nomusu);
        $result->bindParam(":apeusu", $this->apeusu);
        $result->bindParam(":emailusu", $this->emailusu);
        $result->bindParam(":ndocusu", $this->ndocusu);
        $result->bindParam(":telusu", $this->telusu);
        $result->bindParam(":codubi", $this->codubi);
        $result->bindParam(":imgusu", $this->imgusu);
        $result->execute();
    }
    

    public function del() {
        $sql = "DELETE FROM usuario WHERE idusu=:idusu";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idusu", $this->idusu);
        $result->execute();
    }
}
?>
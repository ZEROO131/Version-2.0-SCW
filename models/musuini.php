<?php 

class Musuini{
private $idvehi; 
private $idusu; 
private $placa; 
private $color; 
private $marca; 
private $modelvehi;
private $tipvehi;




// GET
public function getIdvehi(){ 
    return $this->idvehi;}
public function getIdusu(){ 
    return $this->idusu;}
public function getPlaca(){ 
    return $this->placa;}
public function getColor(){ 
    return $this->color;}
public function getMarca(){ 
    return $this->marca;}
public function getModelvehi(){ 
    return $this->modelvehi;}
public function getTipvehi(){ 
    return $this->tipvehi;}


// SET 
public function setIdvehi($idvehi){
    $this->idvehi = $idvehi;
}

public function setIdusu($idusu){
    $this->idusu = $idusu;
}

public function setPlaca($placa){
    $this->placa = $placa;
}

public function setColor($color){
    $this->color = $color;
}

public function setMarca($marca){
    $this->marca = $marca;
}

public function setModelvehi($modelvehi){
    $this->modelvehi = $modelvehi;
}

public function setTipvehi($tipvehi){
    $this->tipvehi = $tipvehi;
}

// metodos publicos
public function getAll(){
    $res = NULL;
    $sql = "SELECT * FROM vehiculo";
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->execute();
    $res= $result->fetchall(PDO::FETCH_ASSOC);
    return $res;
}

public function getOne(){
    $res = NULL;
    $sql = "SELECT * FROM vehiculo WHERE idvehi=:idvehi";
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $idvehi = $this->getIdvehi();
    $result->bindParam(":idvehi", $idvehi);
    $result->execute();
    $res= $result->fetchall(PDO::FETCH_ASSOC);
    return $res;
}
public function getVehiculoByUsuario(){
    $res = NULL;
    if (isset($_SESSION['idusu'])) {
        $idusu = $_SESSION['idusu'];
        $sql = "SELECT v.idvehi, v.placa, v.color, v.marca, v.modelvehi, v.tipvehi 
                FROM vehiculo AS v 
                JOIN usuario AS u ON v.idusu = u.idusu 
                WHERE u.idusu = :idusu";
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idusu", $idusu);
        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
    }
    return $res;
}
}
?>

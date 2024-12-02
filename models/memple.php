<?php
class Memple{

	private $idservi;
	private $idemple;
	private $precio;
	private $tiposervi;
	

	public function getIdservi(){
		return $this->idservi;
	}

	public function getPrecio(){
		return $this->precio;
	}
	public function getTiposervi(){
		return $this->tiposervi;
	}

	public function setIdservi($idservi){
		return $this->idservi = $idservi;
	}
	public function setIdemple($idemple){
		return $this->idemple = $idemple;
	}
	public function setPrecio($precio){
		return $this->precio = $precio;
	}
	public function setTiposervi($tiposervi){
		return $this->tiposervi = $tiposervi;
	 }

 }

?>
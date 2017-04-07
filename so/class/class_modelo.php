<?php


class Proceso 
{
	private $idProceso;
	private $estadoProceso;
	private $prioridad;
	private $cantidadInstrucciones;
	private $instruccionBloqueo;
	private $evento;
	function __construct($idProceso, $estadoProceso, $prioridad, $cantidadInstrucciones, $instruccionBloqueo, $evento)
	{
		$this->idProceso = $idProceso;
		$this->estadoProceso = $estadoProceso;
		$this->prioridad = $prioridad;
		$this->cantidadInstrucciones = $cantidadInstrucciones;
		$this->instruccionBloqueo= $instruccionBloqueo;
		$this->evento= $evento;
	}

	public function Holis(){
		echo "Que ondas";
	}
	public function getIdProceso(){
		return $this->idProceso;
	} 
	public function setIdProceso($idProceso){
		$this->idProceso=$idProceso;
	}
	public function getEstadoProceso(){
		return $this->estadoProceso;
	}
	public function setEstadoProceso($estadoProceso){
		$this->estadoProceso=$estadoProceso;
	}
	public function getPrioridad(){
		return $this->prioridad;
	}
	public function setPrioridad($prioridad){
		$this->prioridad=$prioridad;
	}
	public function getCantidadInstrucciones(){
		return $this->cantidadInstrucciones;
	}
	public function setCantidadInstrucciones($cantidadInstrucciones){
		$this->cantidadInstrucciones=$cantidadInstrucciones;
	}
	public function getInstruccionBloqueo(){
		return $this->instruccionBloqueo;
	}
	public function setInstruccionBloqueo($instruccionBloqueo){
		$this->instruccionBloqueo=$instruccionBloqueo;
	}
	public function getEvento(){
		return $this->evento;
	}
	public function setEvento($evento){
		$this->evento=$evento;
	}

	public function toString(){
		return "Id Proceso= ".$this->getIdProceso()."<br> Estado Proceso= ".$this->getEstadoProceso().
				"<br> prioridad= ".$this->getPrioridad()."<br> Cantidad Instrucciones= ".$this->getCantidadInstrucciones().
				"<br> Instruccion de bloqueo= ".$this->getInstruccionBloqueo()."<br> Evento= ".$this->getEvento();
	}

}


?>
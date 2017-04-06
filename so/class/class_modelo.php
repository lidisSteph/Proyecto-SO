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

}


?>
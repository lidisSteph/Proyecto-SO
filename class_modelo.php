<?php


class Proceso 
{
	private $idProceso;
	private $estadoProceso;
	private $prioridad;
	private $cantidadInstrucciones;
	private $instruccionBloqueo;
	private $evento;
	private $parametros;
	function __construct($parametros)
	{
		// for($j=0;$j<sizeof($parametros);$j++){
  //               echo $subpartes[$j]."<br>";
         $this->idProceso = $subpartes[0];
		$this->estadoProceso = $subpartes[1];
		$this->prioridad = $subpartes[2];
		$this->cantidadInstrucciones = $subpartes[3];
		$this->instruccionBloqueo= $subpartes[4]
		$this->evento= $subpartes[5];
        //  }
		
	}
/*
1. Que sean enteros todo lo que enviemos
2. una vez separadas las con ; el tamaño debe de ser igual lo estípulado
3. Que no se repita el ID
4. Que retorne un error a todo aquello que no esta en los parametros que ella pide
*/
	public function Holis(){
		echo "Que ondas";
	} 

	public function getIdProceso(){
		return $this->idProceso;
	}

	public function getIdProceso($idProceso){
		$this->idProceso=$idProceso;
	}

	public function getestadoProceso(){
		return $this->estadoProceso;
	}

	public function getestadoProceso($estadoProceso){
		$this->estadoProceso=$estadoProceso;
	}
	public function getprioridad(){
		return $this->prioridad;
	}

	public function setprioridad($prioridad){
		$this->prioridad=$prioridad;
	}

	public function getcantidadInstrucciones(){
		return $this->cantidadInstrucciones;
	}

	public function setcantidadInstrucciones($cantidadInstrucciones){
		$this->cantidadInstrucciones=$cantidadInstrucciones;
	}

	public function getinstruccionBloqueo(){
		return $this->instruccionBloqueo;
	}

	public function setinstruccionBloqueo($instruccionBloqueo){
		$this->instruccionBloqueo=$instruccionBloqueo;
	}

	public function getevento(){
		return $this->evento;
	}

	public function setevento($evento){
		$this->evento=$evento;
	}
}


?>
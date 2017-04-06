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

	public function Holis(){
		echo "Que ondas";
	} 

}


?>
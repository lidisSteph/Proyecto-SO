  <?php

     //Ejemplo aprenderaprogramar.com
$fp = fopen(fichero, modoDeApertura);

    $idProceso=1;
    $estadoProceso=1;
    $prioridad=1;
    $cantidadInstrucciones=1;
    $instruccionBloqueo=1;
    $evento=1;

   $a = new Modelo($idProceso, $estadoProceso, $prioridad, $cantidadInstrucciones, $instruccionBloqueo, $evento);


   echo $a->Holis(); ?>
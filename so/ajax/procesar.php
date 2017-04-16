  <?php
include_once('../class/class_modelo.php.');

 $path = $_POST["txt-archivo"];
            if (!file_exists($path))
                exit("File not found");


            $file = fopen($path, "r");
            if ($file) {

              $idProceso="";
              $estadoProceso="";
              $prioridad="";
              $cantidadInstrucciones="";
              $instruccionBloqueo="";
              $evento="";
              $procesos = array();
              $excepciones=array('\n','\r');
              $lineaLimpia ='';
              $k=0;
                while (($line = fgets($file)) !== false) {
                    $lineaLimpia .= str_replace('\n', "\\n", $line);
                 
                }

                $partes =explode(";", $lineaLimpia);
                for ($i=0;$i<sizeof($partes);$i++) {
                    // echo "<br> Al limpiar el ; :".$partes[$i];

                    $subpartes =explode("/", $partes[$i]);
                     
                           for($j=0;$j<sizeof($subpartes);$j++){
                                 // if(is_numeric($subpartes[$j])){
                                      switch ($j) {
                                           case 0:
                                                $idProceso=$subpartes[$j];
                                             break;
                                            case 1:
                                                $estadoProceso=$subpartes[$j];
                                             break;
                                             case 2:
                                                $prioridad=$subpartes[$j];
                                             break;
                                             case 3:
                                                $cantidadInstrucciones=$subpartes[$j];
                                             break; 
                                             case 4:
                                                $instruccionBloqueo=$subpartes[$j];
                                             break;
                                             case 5:
                                                $evento=$subpartes[$j];
                                             break;   
                                           default:
                                             # code...
                                             break;
                                         }   
                                 // }else{
                                 //   switch ($j) {
                                 //           case 0:
                                 //                $idProceso="vacio";
                                 //             break;
                                 //            case 1:
                                 //                $estadoProceso="vacio";
                                 //             break;
                                 //             case 2:
                                 //                $prioridad="vacio";
                                 //             break;
                                 //             case 3:
                                 //                $cantidadInstrucciones="vacio";
                                 //             break; 
                                 //             case 4:
                                 //                $instruccionBloqueo="vacio";
                                 //             break;
                                 //             case 5:
                                 //                $evento="vacio";
                                 //             break;   
                                 //           default:
                                 //             # code...
                                 //             break;
                                 //         }   
                                 // }
                         
                          }

                          
                           $procesos[$i] = new Proceso($idProceso,$estadoProceso,$prioridad,$cantidadInstrucciones,$instruccionBloqueo,$evento);

                }
                $procesosRechazados=array();

                for($i=0; $i<sizeof($procesos);$i++){


                   if(is_numeric($procesos[$i]->getIdProceso())==false||is_numeric($procesos[$i]->getEstadoProceso())==false
                    ||is_numeric($procesos[$i]->getPrioridad())==false||is_numeric($procesos[$i]->getCantidadInstrucciones())==false
                    ||is_numeric($procesos[$i]->getInstruccionBloqueo())==false||is_numeric($procesos[$i]->getEvento())==false){

                      // if($procesos[$i]->getIdProceso()=="vacio"||$procesos[$i]->getEstadoProceso()=="vacio"||$procesos[$i]->getPrioridad()=="vacio"
                      //   ||$procesos[$i]->getCantidadInstrucciones()=="vacio"||$procesos[$i]->getInstruccionBloqueo()=="vacio"
                      //   ||$procesos[$i]->getEvento()=="vacio"){
                        
                        $procesosRechazados[$i]= new Proceso($procesos[$i]->getIdProceso(),$procesos[$i]->getEstadoProceso()
                                                        ,$procesos[$i]->getPrioridad(),$procesos[$i]->getCantidadInstrucciones(),
                                                        $procesos[$i]->getInstruccionBloqueo(),$procesos[$i]->getEvento());
                        //unset($procesos[$i]);  
                      }
                }
                // echo "procesos que han sido validados: <br>";
            // Procesos que han sido dados de alta por el verificador de datos
                for($i=0; $i<sizeof($procesos);$i++){
                    // echo $procesos[$i]->toString();
                }

            // echo "procesos que han sido rechazados: <br>";
            // Procesos Rechados
                for($i=0; $i<sizeof($procesos);$i++){
                  if(isset($procesosRechazados[$i])){
                     // echo $procesosRechazados[$i]->toString();

                  }
                    
                }
               // var_export($procesosRechazados);

                if (!feof($file))
                    echo "Error: EOF not found\n";
               
                fclose($file);

            }

switch ($_GET["accion"]) {
  case 1:
$j=0;


?>
    <table class="table table-striped table-hover" style="padding: 20px 20px 20px 20px">
                <tr style="color:#F77D03" class="text-center">
                    <td>Evaluador</td>
                    <td># de proceso</td>
                    <td>Identificador</td>
                    <td>Estado</td>
                    <td>Prioridad</td>
                    <td>Cantidad de Instrucciones</td>
                    <td>Instrucción de bloqueo</td>
                    <td>Evento</td>
                </tr> 
               <?php

                    for ($i=0; $i <sizeof($procesos) ; $i++) {
                      $j=$i+1;
                echo "<tr class='text-center'>";


                if(isset($procesosRechazados[$i])){
                      echo     "<td><i class='fa fa-close' style='color:#CC0000' aria-hidden='true'></i></td>";

                  }else{
                echo     "<td><i class='fa fa-check' style='color:#009900' aria-hidden='true'></i></td>";

                }

                echo     "<td>".$j."</td>";
                echo     "<td>".$procesos[$i]->getIdProceso()."</td>";
                echo     "<td>".$procesos[$i]->getEstadoProceso()."</td>"; 
                echo     "<td>".$procesos[$i]->getPrioridad()."</td>";
                echo     "<td>".$procesos[$i]->getCantidadInstrucciones()."</td>";
                echo     "<td>".$procesos[$i]->getInstruccionBloqueo()."</td>";
                echo     "<td>".$procesos[$i]->getEvento()."</td>";
                echo "</tr>";

                  
                        # cod..
                    }



               ?>

    </table>




<?php
   

    break;
  case 2:
 ?>
    <table class="table table-striped table-hover" style="padding: 20px 20px 20px 20px">
                <tr style="color:#F77D03" class="text-center">
                    <td>Evaluador</td>
                    <td>Identificador</td>
                    <td>Estado</td>
                    <td>Prioridad</td>
                    <td>Cantidad de Instrucciones</td>
                    <td>Instrucción de bloqueo</td>
                    <td>Evento</td>
                </tr> 
               <?php

                    for ($i=0; $i <sizeof($procesos) ; $i++) {
                echo "<tr class='text-center'>";


                if(isset($procesosRechazados[$i])){
                      echo     "<td><i class='fa fa-close' style='color:#CC0000' aria-hidden='true'></i></td>";

                  }else{
                echo     "<td><i class='fa fa-check' style='color:#009900' aria-hidden='true'></i></td>";

                }


                echo     "<td>".$procesos[$i]->getIdProceso()."</td>";
                echo     "<td>".$procesos[$i]->getEstadoProceso()."</td>"; 
                echo     "<td>".$procesos[$i]->getPrioridad()."</td>";
                echo     "<td>".$procesos[$i]->getCantidadInstrucciones()."</td>";
                echo     "<td>".$procesos[$i]->getInstruccionBloqueo()."</td>";
                echo     "<td>".$procesos[$i]->getEvento()."</td>";
                echo "</tr>";

                  
                        # cod..
                    }



               ?>

    </table>




<?php

                
    break;
  
  default:
    # code...
    break;
}

 ?>
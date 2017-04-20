  <?php
include_once('../class/class_modelo.php.');
include_once('../class/class_conexion.php');

$conexion = new Conexion();


// Guardamos en una variable la url del archivo
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
                             
                          }

                          
                           $procesos[$i] = new Proceso($idProceso,$estadoProceso,$prioridad,$cantidadInstrucciones,$instruccionBloqueo,$evento);

                             $resultado = $conexion->ejecutarInstruccion(
                            "
                            INSERT INTO procesos
                           (id_proceso, estado_proceso, prioridad, cantidad_instrucciones, instruccion_bloqueo, evento)
                            VALUES 
                            (".$procesos[$i]->getIdProceso().",".$procesos[$i]->getEstadoProceso().",".$procesos[$i]->getPrioridad().",".$procesos[$i]->getCantidadInstrucciones().",".$procesos[$i]->getInstruccionBloqueo().",".$procesos[$i]->getEvento().");");
                           
                       


                }


                $procesosRechazados=array();

                for($i=0; $i<sizeof($procesos);$i++){

     


                    if(is_numeric($procesos[$i]->getIdProceso())==false
                    ||ctype_digit($procesos[$i]->getEstadoProceso())==false
                    ||ctype_digit($procesos[$i]->getPrioridad())==false
                    ||ctype_digit($procesos[$i]->getCantidadInstrucciones())==false
                    ||ctype_digit($procesos[$i]->getInstruccionBloqueo())==false
                    ||ctype_digit($procesos[$i]->getEvento())==false){

                      
                        
                        $procesosRechazados[$i]= new Proceso($procesos[$i]->getIdProceso(),$procesos[$i]->getEstadoProceso()
                                                        ,$procesos[$i]->getPrioridad(),$procesos[$i]->getCantidadInstrucciones(),
                                                        $procesos[$i]->getInstruccionBloqueo(),$procesos[$i]->getEvento());
                       
                      }else{
                        $procesosAceptados[$i] = new Proceso($procesos[$i]->getIdProceso(),$procesos[$i]->  getEstadoProceso()
                                                        ,$procesos[$i]->getPrioridad(),$procesos[$i]->getCantidadInstrucciones(),
                                                        $procesos[$i]->getInstruccionBloqueo(),$procesos[$i]->getEvento());





                         // $resultado = $conexion->ejecutarInstruccion(
                         //    "
                         //    INSERT INTO procesos_correctos
                         //   (codigo_proceso)
                         //    VALUES 
                         //    (".$procesos[$i]->getIdProceso().",".$procesos[$i]->getEstadoProceso().",".$procesos[$i]->getPrioridad().",".$procesos[$i]->getCantidadInstrucciones().",".$procesos[$i]->getInstruccionBloqueo().",".$procesos[$i]->getEvento().");");
                           
                         //   if($resultado){
                         //    echo "wee";
                         //   }else{
                         //    echo "basuqui";
                         //   }
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
                $comparador=0;
                // CODIGO PARA VALIDAR QUE NO SE REPITA UN ID DE PROCESO
                for ($i=0; $i <sizeof($procesos); $i++) { 
                if(isset($procesosAceptados[$i])){
            
                    if($comparador==0){
                        $comparador=$procesosAceptados[$i]->getIdProceso();
                        echo $comparador;

                    }
                  
                    if($comparador==$procesosAceptados[$i]->getIdProceso()){
                         $procesosRechazados[$i]= new Proceso($procesosAceptados[$i]->getIdProceso(),$procesosAceptados[$i]->getEstadoProceso()
                                                        ,$procesosAceptados[$i]->getPrioridad(),$procesosAceptados[$i]->getCantidadInstrucciones(),
                                                        $procesosAceptados[$i]->getInstruccionBloqueo(),$procesosAceptados[$i]->getEvento());
                         $procesosAceptados[$i]=null;
                     }
                 
                 
                }
              }

              ///////////////////////////////////////////////////////////////////////////////
               // var_export($procesosRechazados);

              

                if (!feof($file))
                    echo "Error: EOF not found\n";
               
                fclose($file);

            }



switch ($_GET["accion"]) {
  case 1:
$j=0;


              ?>
              <!-- HTML -->
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
                <!-- HTML -->
               <?php

               for ($i=0; $i <sizeof($procesos) ; $i++) {
                     echo "<tr class='text-center'>";


                if(isset($procesosRechazados[$i])){
                      echo     "<td><i class='fa fa-close' style='color:#CC0000' aria-hidden='true'></i></td>";
                      echo     "<td>0</td>";

                  }else{
                    $j++;

                echo     "<td><i class='fa fa-check' style='color:#009900' aria-hidden='true'></i></td>";
                echo     "<td>".$j."</td>";

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
  case 2:
  $j=0;
 ?>
    <table class="table table-striped table-hover" style="padding: 20px 20px 20px 20px">
                <tr style="color:#F77D03" class="text-center">
                    <!-- <td>Evaluador</td> -->
                    <td>Identificador</td>
                    <td>Estado</td>
                    <td>Prioridad</td>
                    <!-- <td>Cantidad de Instrucciones</td> -->
                    <!-- <td>Instrucción de bloqueo</td> -->
                    <!-- <td>Evento</td> -->
                </tr> 
               <?php

                    for ($i=0; $i <sizeof($procesos) ; $i++) {
                      
                        echo "<tr class='text-center'>";


                        if(isset($procesosAceptados[$i])){
                             $j++;
                              echo     "<td>".$j."</td>";
                              echo     "<td>".$procesos[$i]->getEstadoProceso()."</td>"; 
                              echo     "<td>".$procesos[$i]->getPrioridad()."</td>";
                              // echo     "<td>".$procesos[$i]->getCantidadInstrucciones()."</td>";
                              // echo     "<td>".$procesos[$i]->getInstruccionBloqueo()."</td>";
                              // echo     "<td>".$procesos[$i]->getEvento()."</td>";
                              echo "</tr>";


                          }else{
                            
                        }


                        

                  
                        # cod..
                    }



               ?>

    </table>




<?php

                
    break;
    case 3:
      $conexion->ejecutarInstruccion("
        DELETE
      procesos;");
      break;
  
  case 4:
    # code...
    break;
  default:
    # code...
    break;
}

 ?>
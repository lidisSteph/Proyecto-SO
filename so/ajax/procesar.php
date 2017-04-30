  <?php
include_once('../class/class_modelo.php.');
include_once('../class/class_conexion.php');

$conexion = new Conexion();



switch ($_GET["accion"]) {
  case 0:
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
                                        sprintf(
                                           "
                                          INSERT INTO procesos
                                         (codigo_proceso, id_proceso, estado_proceso, prioridad, cantidad_instrucciones, instruccion_bloqueo, evento)
                                          VALUES 
                                          ('%s','%s','%s','%s','%s','%s','%s')",
                                          stripslashes($i+1),
                                          stripslashes($procesos[$i]->getIdProceso()),
                                          stripslashes($procesos[$i]->getEstadoProceso()),
                                          stripslashes($procesos[$i]->getPrioridad()),
                                          stripslashes($procesos[$i]->getCantidadInstrucciones()),
                                          stripslashes($procesos[$i]->getInstruccionBloqueo()),
                                          stripslashes($procesos[$i]->getEvento())
                                          

                                          ));
                           
                       


                }
                // var_dump($procesos);

                $procesosRechazados=array();

                if(sizeof($procesos)>10){
                  // echo "Sólo fueron tomados los 10 primeros procesos del archivo";
                    for($i=9; $i<sizeof($procesos);$i++){
                      $procesosRechazados[$i]= new Proceso($procesos[$i]->getIdProceso(),$procesos[$i]->getEstadoProceso()
                                                        ,$procesos[$i]->getPrioridad(),$procesos[$i]->getCantidadInstrucciones(),
                                                        $procesos[$i]->getInstruccionBloqueo(),$procesos[$i]->getEvento());



                         $resul1 = $conexion->ejecutarInstruccion(
                                        sprintf(
                                           "
                                          INSERT INTO procesos_rechazados
                                         (idprocesos_rechazados, codigo_proceso)
                                          VALUES 
                                          ('%s','%s')",
                                          stripslashes($i+1),
                                          stripslashes($i+1)
                                     ));

                    }

                }


                

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
                        $resul1 = $conexion->ejecutarInstruccion(
                                        sprintf(
                                           "
                                          INSERT INTO procesos_rechazados
                                         (idprocesos_rechazados, codigo_proceso)
                                          VALUES 
                                          ('%s','%s')",
                                          stripslashes($i+1),
                                          stripslashes($i+1)
                                     ));
                       
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
                // for($i=0; $i<sizeof($procesos);$i++){
                //     // echo $procesos[$i]->toString();
                // }

            // echo "procesos que han sido rechazados: <br>";
            // Procesos Rechados
                // for($i=0; $i<sizeof($procesos);$i++){
                //   if(isset($procesosRechazados[$i])){
                //      // echo $procesosRechazados[$i]->toString();

                //   }
                    
                // }
                $comparador=0;

                // CODIGO PARA VALIDAR QUE NO SE REPITA UN ID DE PROCESO y CODIGO PARA VALIDAR LA INSTRUCCION DE BLOQUEO
                for ($i=0; $i <sizeof($procesos); $i++) { 
                  if(isset($procesosAceptados[$i])){
            
                        if($comparador==0){
                            $comparador=$procesosAceptados[$i]->getIdProceso();

                        }

                        if( $procesosAceptados[$i]->getIdProceso() < 1000 
                          || $procesosAceptados[$i]->getIdProceso()  >  9999
                          || $procesosAceptados[$i]->getEstadoProceso() != 0
                          || $procesosAceptados[$i]->getPrioridad() < 1
                          || $procesosAceptados[$i]->getPrioridad() > 3
                          || $procesosAceptados[$i]->getCantidadInstrucciones() <= 0 
                          || $procesosAceptados[$i]->getCantidadInstrucciones()  >  999
                          || $procesosAceptados[$i]->getInstruccionBloqueo() <= 0 
                          || $procesosAceptados[$i]->getInstruccionBloqueo()  >  999
                          || ($procesosAceptados[$i]->getEvento() !=3
                          && $procesosAceptados[$i]->getEvento() !=5)
                          || $comparador==$procesosAceptados[$i]->getIdProceso() 
                          || $procesosAceptados[$i]->getInstruccionBloqueo() >= $procesosAceptados[$i]->getCantidadInstrucciones()){

                             $procesosRechazados[$i]= new Proceso($procesosAceptados[$i]->getIdProceso(),$procesosAceptados[$i]->getEstadoProceso()
                                                            ,$procesosAceptados[$i]->getPrioridad(),$procesosAceptados[$i]->getCantidadInstrucciones(),
                                                            $procesosAceptados[$i]->getInstruccionBloqueo(),$procesosAceptados[$i]->getEvento());
                              $resul1 = $conexion->ejecutarInstruccion(
                                        sprintf(
                                           "
                                          INSERT INTO procesos_rechazados
                                         (idprocesos_rechazados, codigo_proceso)
                                          VALUES 
                                          ('%s','%s')",
                                          stripslashes($i+1),
                                          stripslashes($i+1)
                                     ));
                             $procesosAceptados[$i]=null;
                         }

                       
            }
          }



          for ($i=0; $i <10 ; $i++) { 

           if (isset($procesosAceptados[$i])) {
            $resul1 = $conexion->ejecutarInstruccion(
                                        sprintf(
                                           "
                                          INSERT INTO procesos_correctos
                                         (idprocesos_correctos, codigo_proceso)
                                          VALUES 
                                          ('%s','%s')",
                                          stripslashes($i+1),
                                          stripslashes($i+1)
                                     ));
           }

          }



              

                if (!feof($file))
                    echo "Error: EOF not found\n";
               
                fclose($file);

            }

  break;

  case 1:
$j=0;
      
      $total = $conexion->ejecutarInstruccion(
              'SELECT * FROM procesos'
        );
      $totalRegistros = $conexion->cantidadRegistros($total);
        // if ($totalRegistros) {
        //   echo $totalRegistros;
        // }else{
        //   echo "ño";
        // }

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


               <?php

               for ($i=1; $i < $totalRegistros+1 ; $i++) {

                if($i >= 11){
                  // echo "buenas";
                  // mayores que 10
                      echo "<tr class='text-center' style='color:#CC0000; font-weight: bold'>";
                      $consulta = $conexion->ejecutarInstruccion(
                                         sprintf(
                                          'SELECT codigo_proceso, id_proceso, estado_proceso, prioridad, cantidad_instrucciones, instruccion_bloqueo, evento 
                                          FROM procesos 
                                          WHERE codigo_proceso = "%s"',
                                         stripslashes($i)
                                         ));
                        $fila = $conexion->obtenerFila($consulta);
                



                            echo     "<td><i class='fa fa-close' style='color:#CC0000' aria-hidden='true'></i></td>";
                            echo     "<td>0</td>";
                            echo     "<td>".$fila['id_proceso']."</td>";
                            echo     "<td>".$fila['estado_proceso']."</td>"; 
                            echo     "<td>".$fila['prioridad']."</td>";
                            echo     "<td>".$fila['cantidad_instrucciones']."</td>";
                            echo     "<td>".$fila['instruccion_bloqueo']."</td>";
                            echo     "<td>".$fila['evento']."</td>";
                            echo "</tr>";

                      // }

                }else{
                   
                           $consulta3 = $conexion->ejecutarInstruccion(
                                         sprintf(
                                          'SELECT codigo_proceso 
                                          FROM procesos_correctos 
                                          WHERE codigo_proceso = "%s"',
                                         stripslashes($i)
                                         ));

                        $fila8=$conexion->obtenerFila($consulta3);
                          // echo $fila8['codigo_proceso'];
                     
                        
                        if($fila8['codigo_proceso']==$i){
                          echo "<tr class='text-center'>";

                          // Se actualiza el estado ya que pasa a listos
                             $actualizaciónEstado = $conexion->ejecutarInstruccion(sprintf(


                                                    'UPDATE procesos 
                                                      SET estado_proceso="%s"
                                                      WHERE codigo_proceso="%s"',
                                                      stripslashes(1),
                                                      stripslashes($i)

                                                    ));
                             // se llama al proceso con el Id que se encuentra en corrextos
                           $con1 = $conexion->ejecutarInstruccion(
                                         sprintf(
                                          'SELECT codigo_proceso, id_proceso, estado_proceso, prioridad, cantidad_instrucciones, instruccion_bloqueo, evento 
                                          FROM procesos 
                                          WHERE codigo_proceso = "%s"',
                                         stripslashes($i)
                                         ));



                           $fila2 = $conexion->obtenerFila($con1);

                                $j++;

                          // echo "<tr class='text-center'>";
                          echo     "<td><i class='fa fa-check' style='color:#009900' aria-hidden='true'></i></td>";
                          echo     "<td>".$j."</td>";
                          // $procesos[$i]->setEstadoProceso(1);
                          echo     "<td>".$fila2['id_proceso']."</td>";
                          echo     "<td>".$fila2['estado_proceso']."</td>"; 
                          echo     "<td>".$fila2['prioridad']."</td>";
                          echo     "<td>".$fila2['cantidad_instrucciones']."</td>";
                          echo     "<td>".$fila2['instruccion_bloqueo']."</td>";
                          echo     "<td>".$fila2['evento']."</td>";
                          echo "</tr>";

                       


                        }else{
                            echo "<tr class='text-center'>";
                            $con = $conexion->ejecutarInstruccion(
                                         sprintf(
                                          'SELECT codigo_proceso, id_proceso, estado_proceso, prioridad, cantidad_instrucciones, instruccion_bloqueo, evento 
                                          FROM procesos 
                                          WHERE codigo_proceso = "%s"',
                                         stripslashes($i)
                                         ));
                            $fila1 = $conexion->obtenerFila($con);

                                  echo     "<td><i class='fa fa-exclamation-triangle' style='color:#F5CB03' aria-hidden='true'></i></td>";
                                  echo     "<td>0</td>";
                                  echo     "<td>".$fila1['id_proceso']."</td>";
                                  echo     "<td>".$fila1['estado_proceso']."</td>"; 
                                  echo     "<td>".$fila1['prioridad']."</td>";
                                  echo     "<td>".$fila1['cantidad_instrucciones']."</td>";
                                  echo     "<td>".$fila1['instruccion_bloqueo']."</td>";
                                  echo     "<td>".$fila1['evento']."</td>";
                                  echo "</tr>";

                        }




        /*                if(isset($procesosRechazados[$i])){
                            echo     "<td><i class='fa fa-exclamation-triangle' style='color:#F5CB03' aria-hidden='true'></i></td>";
                            echo     "<td>0</td>";
                                  echo     "<td>".$fila['id_proceso']."</td>";
                                  echo     "<td>".$fila['estado_proceso']."</td>"; 
                                  echo     "<td>".$fila['prioridad']."</td>";
                                  echo     "<td>".$fila['cantidad_instrucciones']."</td>";
                                  echo     "<td>".$fila['instruccion_bloqueo']."</td>";
                                  echo     "<td>".$fila['evento']."</td>";
                                  echo "</tr>";

                        }else{
                          $j++;

                          echo "<tr class='text-center'>";
                          echo     "<td><i class='fa fa-check' style='color:#009900' aria-hidden='true'></i></td>";
                          echo     "<td>".$j."</td>";
                          $procesos[$i]->setEstadoProceso(1);
                          echo     "<td>".$procesos[$i]->getIdProceso()."</td>";
                          echo     "<td>".$procesos[$i]->getEstadoProceso()."</td>"; 
                          echo     "<td>".$procesos[$i]->getPrioridad()."</td>";
                          echo     "<td>".$procesos[$i]->getCantidadInstrucciones()."</td>";
                          echo     "<td>".$procesos[$i]->getInstruccionBloqueo()."</td>";
                          echo     "<td>".$procesos[$i]->getEvento()."</td>";
                          echo "</tr>";

                      }*/
                }
                     

              

                

                  
                        # cod..
                    }



               ?>

    </table>




<?php
   

    break;
  case 2:
  $j=0;
 
        $total = $conexion->ejecutarInstruccion(
              'SELECT * FROM procesos_correctos'
        );
        $totalRegistros = $conexion->cantidadRegistros($total);

 ?>
    <table class="table table-striped table-hover" style="padding: 20px 20px 20px 20px">
                <tr style="color:#F77D03" class="text-center">
                    <!-- <td>Evaluador</td> -->
                    <td># proceso</td>
                    <td>Identificador</td>
                    <td>Estado</td>
                    <td>Prioridad</td>
                    <td>Cantidad de Instrucciones</td>
                    <td>Instrucción de bloqueo</td>
                    <td>Evento</td>
                </tr> 
               <?php


               $consulta = $conexion-> ejecutarInstruccion(
                                    'SELECT a.codigo_proceso, a.id_proceso, a.estado_proceso, a.prioridad, a.cantidad_instrucciones, a.instruccion_bloqueo, a.evento 
                                      FROM procesos a
                                      INNER JOIN procesos_correctos b
                                      ON(a.codigo_proceso = b.codigo_proceso)'

                                      );

               while ($fila1 = $conexion->obtenerFila($consulta)){

                        echo "<tr class='text-center'>";

                        // listos($fila1['id_proceso']);
                        // if(isset($procesosAceptados[$i])){
                             $j++;
                                  echo     "<td>".$j."</td>";
                                  echo     "<td>".$fila1['id_proceso']."</td>";
                                  echo     "<td>".$fila1['estado_proceso']."</td>"; 
                                  echo     "<td>".$fila1['prioridad']."</td>";
                                  echo     "<td>".$fila1['cantidad_instrucciones']."</td>";
                                  echo     "<td>".$fila1['instruccion_bloqueo']."</td>";
                                  echo     "<td>".$fila1['evento']."</td>";
                              echo "</tr>";

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
$listos = array();
$bloqueados = array();
$ejecutando=0;

$i=1;
  echo "holis";
  $total = $conexion->ejecutarInstruccion(
              'SELECT a.codigo_proceso, b.id_proceso, b.estado_proceso, b.prioridad, b.cantidad_instrucciones, b.instruccion_bloqueo, b.evento 
               FROM procesos_correctos a
               INNER JOIN procesos b
               ON (a.codigo_proceso = b.codigo_proceso)
               ORDER BY b.prioridad'
        );
  while ($file = $conexion->obtenerFila($total)) {
     // var_dump($file);

    $listos[$i] = $file['codigo_proceso'];
    echo $listos[$i];
    $i++;

  }



  // for ($i=0; $i <sizeof($listos) ; $i++) { 
    
  //   switch ($) {
  //     case 'value':
  //       # code...
  //       break;
      
  //     default:
  //       # code...
  //       break;
  //   }

  // }



 
        // for ($i=1; $i <sizeof($listos)+1 ; $i++) { 


        //   // if(isset($listos[$i])){


        //   $resta=0;
        //   $total1 = $conexion->ejecutarInstruccion(
        //       'SELECT a.codigo_proceso, b.id_proceso, b.estado_proceso, b.prioridad, b.cantidad_instrucciones, b.instruccion_bloqueo, b.evento 
        //        FROM procesos_correctos a
        //        INNER JOIN procesos b
        //        ON (a.codigo_proceso = b.codigo_proceso)
        //        ORDER BY b.prioridad'
        // );
        //  while ($file1 = $conexion->obtenerFila($total1)){

        //     for ($i=1; $i < $file1['cantidad_instrucciones']+1; $i++) { 

        //           if($file1['cantidad_instrucciones'] == $file1['instruccion_bloqueo']){
        //               $resta = $file1['cantidad_instrucciones']-$i;
  
        //           }
                  
        //     }



        //   }
        //   // }


        //   # code...
        // }
        

              



    break;
  default:
    # code...
    break;
}

 ?>
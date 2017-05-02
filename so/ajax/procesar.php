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





                      }
                }



          
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
                    <td>Nuevos</td>
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

                           $consulta4 = $conexion->ejecutarInstruccion(
                                         sprintf(
                                          'SELECT estado_proceso 
                                          FROM procesos 
                                          WHERE codigo_proceso = "%s"',
                                         stripslashes($i)
                                         ));

                        $fila8=$conexion->obtenerFila($consulta3);
                        $fila9=$conexion->obtenerFila($consulta4);
                          // echo $fila8['codigo_proceso'];
                          // echo $fila8['codigo_proceso'];
                     
                        
                        if($fila8['codigo_proceso']==$i){
                          echo "<tr class='text-center'>";

                          // Se actualiza el estado ya que pasa a listos
                            if ($fila9['estado_proceso']==0) {
                               $actualizacionEstado = $conexion->ejecutarInstruccion(sprintf(


                                                    'UPDATE procesos 
                                                      SET estado_proceso="%s"
                                                      WHERE codigo_proceso="%s"',
                                                      stripslashes(1),
                                                      stripslashes($i)

                                                    ));
                        
                            }
                            


                           
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


                }
                     

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
                    <td># proceso</td>
                    <td>Identificador</td>
                    <td>Estado</td>
                    <td>Prioridad</td>
                    <td>Cantidad de Instrucciones</td>
                    <td>Instrucción de bloqueo</td>
                    <td>Evento</td>
                </tr> 
               <?php

              






               $con = $conexion-> ejecutarInstruccion(
                                    'SELECT a.codigo_proceso, a.estado_proceso, a.prioridad 
                                      FROM procesos a
                                      INNER JOIN procesos_correctos b
                                      ON(a.codigo_proceso = b.codigo_proceso)
                                      ORDER BY a.prioridad'

                                      );
               while ( $li = $conexion->obtenerFila($con)) {
                    if ($li['estado_proceso']==1) {
                       $actualizacionEstado = $conexion->ejecutarInstruccion(sprintf(


                                                    'UPDATE procesos 
                                                      SET estado_proceso="%s"
                                                      WHERE codigo_proceso="%s"',
                                                      stripslashes(2),
                                                      stripslashes($li['codigo_proceso'])

                                                    ));
                    }
               }


               $consulta = $conexion-> ejecutarInstruccion(
                                    'SELECT a.codigo_proceso, a.id_proceso, a.estado_proceso, a.prioridad, a.cantidad_instrucciones, a.instruccion_bloqueo, a.evento 
                                      FROM procesos a
                                      INNER JOIN procesos_correctos b
                                      ON(a.codigo_proceso = b.codigo_proceso)
                                      WHERE a.estado_proceso = 2
                                      ORDER BY a.prioridad'
                                      );


               while ($fila1 = $conexion->obtenerFila($consulta)){
                        echo "<tr class='text-center'>";

                 
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
        DELETE FROM
      procesos_correctos");
       $conexion->ejecutarInstruccion("
        DELETE FROM
      procesos_rechazados");

      $conexion->ejecutarInstruccion("
        DELETE FROM
      procesos");

      echo "hola";
      break;
  
  case 4:

$evento = array();
$listos = array();
$bloqueados = array();
$codigos=array();
$contador = array();
$pasos = array();





$c=(int)$_POST['txt-ciclos'];


 function Listos($conexion){
  $i=0;

   $total = $conexion->ejecutarInstruccion(
                    'SELECT a.codigo_proceso, b.id_proceso, b.estado_proceso, b.prioridad, b.cantidad_instrucciones, b.instruccion_bloqueo, b.evento 
                     FROM procesos_correctos a
                     INNER JOIN procesos b
                     ON (a.codigo_proceso = b.codigo_proceso)
                     ORDER BY b.prioridad'
              );
        while ($file = $conexion->obtenerFila($total)) {
           // var_dump($file);

          $listos[$i] = new Proceso ($file['id_proceso'], $file['estado_proceso'], $file['prioridad'], $file['cantidad_instrucciones'], 
                                        $file['instruccion_bloqueo'], $file['evento']);
          $listos[$i]->setCodigo($file['codigo_proceso']);


          $i++;

        }
      $conexion->liberarResultado($total);

      return  $listos;

}


$listos = Listos($conexion);

for ($i=0; $i <sizeof($listos) ; $i++) { 

  $listos[$i]->setEstadoProceso(2);
                                       $conexion->ejecutarInstruccion(sprintf(
                                                                         'UPDATE procesos 
                                                                              SET estado_proceso="%s"
                                                                              WHERE codigo_proceso="%s"',
                                                                                stripslashes($listos[$i]->getEstadoProceso()),
                                                                                stripslashes($listos[$i]->getCodigo())
                                                      )); 
 
}
$listos = Listos($conexion);

       
          















while ($c > 0) {
              if (isset($listos[0])) {
                $ejecutando = new Proceso($listos[0]->getIdProceso(),3
                                                        ,$listos[0]->getPrioridad(),$listos[0]->getCantidadInstrucciones(),
                                                        $listos[0]->getInstruccionBloqueo(),$listos[0]->getEvento());
                $ejecutando->setCodigo($listos[0]->getCodigo());
                $ejecutando->setPaso($listos[0]->getPaso());
                  $hola = $conexion->ejecutarInstruccion(sprintf(
                                                                                  'UPDATE procesos 
                                                                                    SET estado_proceso="%s"
                                                                                    WHERE codigo_proceso="%s"',
                                                                                    stripslashes($ejecutando->getEstadoProceso()),
                                                                                    stripslashes($ejecutando->getCodigo())
                                                                                  )); 

               

               
                  unset($listos[0]);
                  $listos = array_values($listos);        
                  // var_dump($listos);
               

               ?>

    </table>




<?php



                        
         for ($j=1; $j <= 5; $j++) { 
                              
              if (isset($ejecutando)) {
                
                                if($ejecutando->getCantidadInstrucciones()>0){

                                          if ($ejecutando->getCantidadInstrucciones() == $ejecutando->getInstruccionBloqueo()) {
                                                    // $bloqueados[$i] = $ejecutando;
                                                    $bloqueados[] = new Proceso($ejecutando->getIdProceso(),4
                                                            ,$ejecutando->getPrioridad(),$ejecutando->getCantidadInstrucciones(),
                                                            $ejecutando->getInstruccionBloqueo(),$ejecutando->getEvento());
                                                    $codigos[] = $ejecutando->getCodigo();
                                                    $pasos[] = $ejecutando->getPaso();

                                                       $conexion->ejecutarInstruccion(sprintf(
                                                                                  'UPDATE procesos 
                                                                                    SET estado_proceso="%s"
                                                                                    WHERE codigo_proceso="%s"',
                                                                                    stripslashes(4),
                                                                                    stripslashes($ejecutando->getCodigo())
                                                                                  )); 

                                                // Selección del tipo de evento 
                                                    switch ($ejecutando->getEvento()) {
                                                      case 3:
                                                          $evento[]=13;
                                                        break;
                                                      case 5:
                                                          $evento[]=27;
                                                        break;
                                                      
                                                      default:
                                                        # code...
                                                        break;
                                                    }
                                                    unset($ejecutando);

                                                 break;
                                                 
                                            }else{

                                              $ejecutando->setCantidadInstrucciones( $ejecutando->getCantidadInstrucciones()-1);
                                              $c = $c -1;


                                                if($c ==0 && $ejecutando->getEstadoProceso()==3){

                                                    // if (isset($ejecutando)) {
                                                            
                                                   ?> <table class="table table-striped table-hover" style="padding: 20px 20px 20px 20px">
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
                                           
                                               
                                               // while ($fila1 = $conexion->obtenerFila($ejec)){
                                                        echo "<tr class='text-center'>";
                                                         echo     "<td>1</td>";
                                                                  echo     "<td>".$ejecutando->getIdProceso()."</td>";
                                                                  echo     "<td>".$ejecutando->getEstadoProceso()."</td>"; 
                                                                  echo     "<td>".$ejecutando->getPrioridad()."</td>";
                                                                  echo     "<td>".$ejecutando->getCantidadInstrucciones()."</td>";
                                                                  echo     "<td>".$ejecutando->getInstruccionBloqueo()."</td>";
                                                                  echo     "<td>".$ejecutando->getEvento()."</td>";
                                                          echo "</tr>";

                                                   echo "</table>";                                        
                                                    // }
                                                }
                                                              

                                 

               // }

                                              

                                              

                                                        /*Actualizar a la base de datos lo ejecutado y llamar la consulta otra vez*/ 

                                                  // Disminución de los bloqueados

                                                for ($k=0; $k < sizeof($bloqueados) ; $k++) { 

                                                
                                                            if (isset($bloqueados[$k])) {
                                                                    if ($evento[$k] > 0) {
                                                                    // echo "dentro de eventos";
                                                                    
                                                                     $evento[$k] = $evento[$k]-1;

                                                                  }else{
                                                                      
                                                                      echo $bloqueados[$k]->toString();
                                                                        $nuevo1 = new Proceso($bloqueados[$k]->getIdProceso(),2
                                                                              ,$bloqueados[$k]->getPrioridad(),$bloqueados[$k]->getCantidadInstrucciones(),
                                                                               $bloqueados[$k]->getInstruccionBloqueo(),$bloqueados[$k]->getEvento()); 

                                                                      array_unshift($listos, $nuevo1);
                                                                        
                                                                        $listos[0]->setCodigo($codigos[$k]);
                                                                        $listos[0]->setPaso($pasos[$k]);



                                                                        $listos[0]->setCantidadInstrucciones($listos[0]->getCantidadInstrucciones()-1);

                                                                        unset($bloqueados[$k]);
                                                                        unset($evento[$k]);
                                                                        unset($codigos[$k]);
                                                                        unset($pasos[$k]);
                                                                        $conexion->ejecutarInstruccion(sprintf(
                                                                                  'UPDATE procesos 
                                                                                    SET cantidad_instrucciones="%s"
                                                                                    WHERE codigo_proceso="%s"',
                                                                                    stripslashes($listos[0]->getCantidadInstrucciones()),
                                                                                    stripslashes($listos[0]->getCodigo())
                                                                                  )); 
                                                                        $conexion->ejecutarInstruccion(sprintf(
                                                                                  'UPDATE procesos 
                                                                                    SET estado_proceso="%s"
                                                                                    WHERE codigo_proceso="%s"',
                                                                                    stripslashes($listos[0]->getEstadoProceso()),
                                                                                    stripslashes($listos[0]->getCodigo())
                                                                                  )); 

                                                                  }
                                                            }
                                                    // }
                                                            // break;

                                                }//for disminucion de bloqueados

                                            } // else del bloqueo
                                  }else{

                                    $conexion->ejecutarInstruccion(sprintf(
                                                                                  'UPDATE procesos 
                                                                                    SET estado_proceso="%s"
                                                                                    WHERE codigo_proceso="%s"',
                                                                                    stripslashes(5),
                                                                                    stripslashes($ejecutando->getCodigo())
                                                                                  )); 
                                  
                                    unset($ejecutando);
                                    
                                  } // if cantidad instrucciones
                                    
                                  // } if Bloqueados


                                    if(isset($ejecutando)){
                                       $conexion->ejecutarInstruccion(sprintf(
                                                    'UPDATE procesos 
                                                      SET cantidad_instrucciones="%s"
                                                      WHERE codigo_proceso="%s"',
                                                      stripslashes($ejecutando->getCantidadInstrucciones()),
                                                      stripslashes($ejecutando->getCodigo())
                                                    ));
                                    }
              }
                                       

                                           


     // } for listos
        
           
    } // for temporizador

      
     if (isset($ejecutando)) {

      $nuevo = new Proceso($ejecutando->getIdProceso(),2
                                                        ,$ejecutando->getPrioridad(),$ejecutando->getCantidadInstrucciones(),
                                                        $ejecutando->getInstruccionBloqueo(),$ejecutando->getEvento()); 
      array_unshift($listos, $nuevo);

      $listos[0]->setPaso($ejecutando->getPaso()+1);
      $listos[0]->setCodigo($ejecutando->getCodigo());




      if ($listos[0]->getPaso()==3) {


      switch ($listos[0]->getPrioridad()) {
        case 1:
         $conexion->ejecutarInstruccion(sprintf(
                                                    'UPDATE procesos 
                                                      SET prioridad="%s"
                                                      WHERE codigo_proceso="%s"',
                                                      stripslashes(2),
                                                      stripslashes($ejecutando->getCodigo())
                                                    ));
          break;

        case 2:
         $conexion->ejecutarInstruccion(sprintf(
                                                    'UPDATE procesos 
                                                      SET prioridad="%s"
                                                      WHERE codigo_proceso="%s"',
                                                      stripslashes(3),
                                                      stripslashes($ejecutando->getCodigo())
                                                    ));
          break;
        default:
          # code...
          break;

      }

       $listos[0]->setPaso(0);
       $listos = Listos($conexion);


       
     }
                                    


              }


}else{


  break;
}



     } //ejecutando




  


              



    break;


    case 5:

    $j=0;
    ?>
    <table class="table table-striped table-hover" style="padding: 20px 20px 20px 20px">
                <tr style="color:#F77D03" class="text-center">
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
                                      ON(a.codigo_proceso = b.codigo_proceso)
                                      WHERE a.estado_proceso = 4
                                      ORDER BY a.prioridad'

                                      );


               while ($fila1 = $conexion->obtenerFila($consulta)){
                        echo "<tr class='text-center'>";

                 
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


    case 6:

    $j=0;
    ?>
    <table class="table table-striped table-hover" style="padding: 20px 20px 20px 20px">
                <tr style="color:#F77D03" class="text-center">
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
                                      ON(a.codigo_proceso = b.codigo_proceso)
                                      WHERE a.estado_proceso = 5
                                      ORDER BY a.prioridad'

                                      );


               while ($fila1 = $conexion->obtenerFila($consulta)){
                        echo "<tr class='text-center'>";

                 
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
  default:
    # code...
    break;
}

 ?>
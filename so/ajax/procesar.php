  <?php
include_once('../class/class_modelo.php.');
echo "llegué aqui";
$path = $_POST["txt-archivo"];
if (!file_exists($path))
    exit("File not found");


$file = fopen($path, "r");
if ($file) {
//   $array= file($path);
// array_shift($array);
// foreach ($array as $array) {
//     $fields = explode(";",$array);
//     echo $fields;
//   }
  $idProceso="";
  $estadoProceso="";
  $prioridad="";
  $cantidadInstrucciones="";
  $instruccionBloqueo="";
  $evento="";
  $procesos = array();
  $excepciones=array('\n','\r');
  $lineaLimpia ='';
    while (($line = fgets($file)) !== false) {
        $lineaLimpia .= str_replace('\n', "\\n", $line);
        //$lineaLimpia=trim($line,"\n");
              // echo "<br>Esto es lo que imprime la linea Limpia: ". $lineaLimpia;
        /*$partes =explode(";", $lineaLimpia);
         for ($i=0;$i<sizeof($partes);$i++) {
                  echo "<br> Al limpiar el ; :".$partes[$i];
            //Primero es el arreglo y luego la variable donde seva a guardar
                  $subpartes =explode("/", $partes[$i]);

               for($j=0;$j<sizeof($subpartes);$j++){
                     // echo $subpartes[$j]."<br><br>";
                      // echo "Este es el valor de j=".$j."<br><br>";
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
           //$procesos[$i] = new Proceso($subpartes);

         //  $procesos[$i]->Holis();
        
          }*/
    }

    $partes =explode(";", $lineaLimpia);
    for ($i=0;$i<sizeof($partes);$i++) {
        echo "<br> Al limpiar el ; :".$partes[$i];

        $subpartes =explode("/", $partes[$i]);

               for($j=0;$j<sizeof($subpartes);$j++){
                     if(is_numeric($subpartes[$j])){
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
             
              }
               $procesos[$i] = new Proceso($idProceso,$estadoProceso,$prioridad,$cantidadInstrucciones,$instruccionBloqueo,$evento);

    }

    for($i=0; $i<sizeof($procesos);$i++){
        echo $procesos[$i]->toString();
    }

    if (!feof($file))
        echo "Error: EOF not found\n";
   
    fclose($file);

}

   // $a = new Modelo($idProceso, $estadoProceso, $prioridad, $cantidadInstrucciones, $instruccionBloqueo, $evento);


   // echo $a->Holis(); ?>
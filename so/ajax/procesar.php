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
    while (($line = fgets($file)) !== false) {
         $partes =explode(";", $line);
         for ($i=0;$i<sizeof($partes);$i++) {
            //Primero es el arreglo y luego la variable donde seva a guardar
            $subpartes =explode("/", $partes[$i]);
            for($j=0;$j<sizeof($subpartes);$j++){
                echo $subpartes[$j]."<br>";
            }
          
            //echo $line;
          }
    }
    if (!feof($file)) {
        echo "Error: EOF not found\n";
    }
    fclose($file);
}

   // $a = new Modelo($idProceso, $estadoProceso, $prioridad, $cantidadInstrucciones, $instruccionBloqueo, $evento);


   // echo $a->Holis(); ?>
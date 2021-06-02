<?php
//Programa que lee el fichero posiciones y crea un fichero txt por cada fecha.

//Leemos el fichero original de las posiciones
//Lo almacenamos en un array
$posiciones=file("posiciones.csv");
//Creamos un array solo con las fechas
foreach ($posiciones as $key => $value) {
	if ($datos=strstr($value, '"202')){
		$fecha[]=substr($datos,1,10);
		//echo "<br>$fecha";
	}
}
//Seleccionamos las fechas distintas (sin repetir)
//Obtendremos un array con las distintas fechas
$fechas=array_unique($fecha);
//Creamos un fichero por cada fecha
echo "<b>Fechas creadas para posiciones: <br></b>";
foreach ($fechas as $key => $value) {
	$f=fopen("posiciones/".$value.".txt", "w");
	//Llamamos a una función que guarda los datos en el fichero
	//Le pasamos la fecha y el puntero al fichero.
	guardarDatos(trim($value),$f);
	fclose($f);
	echo "$value<br>";
}


//Función que guarda los datos en un fichero de una fecha.
function guardardatos($fecha,$f){
  //Buscamos la fecha en el fichero posiciones
   $gps=file("posiciones.csv");
   foreach ($gps as $key => $value) {
	 	if ($datos=strstr($value, '"202')){
			$fecha1=trim(substr($datos,1,10));
			//Si hemos encontrado la fecha guardamos la línea en el fichero de esa fecha.
			if ($fecha==$fecha1){
				fwrite($f,$value);
			} 
	 	}
	}
}
header("Location: 02medidasSinBlancos.php");
?>
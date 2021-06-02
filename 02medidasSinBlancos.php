<?php
//Programa que elimina los registros con valores pm10 o pm25 en blanco.

//leemos el fichero
$medidas=file("medidas.csv");
//Creamos un array con las líneas que no tienen valores en blanco.
foreach ($medidas as $key => $value) {
	if (!($datos=strstr($value, ',,'))){
		$medidasSinBlancos[]=$value;
		
	}
}

//Almacenamos el array en un fichero.
$f=fopen("medidaSinBlancos.csv", "w");
foreach ($medidasSinBlancos as $key => $value) {
	fwrite($f, $value);
}
fclose($f);
echo "Eliminados valores sin medidas de PN25 o PM10";
header("Location: 03medidasFechas.php");
?>

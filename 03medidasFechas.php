<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
<?php
//Programa que lee el fichero medidas y crea un fichero txt por cada fecha.

//Es similar al programa 01posicionesFrchas
//Partimos del fichero 
$medidas=file("medidaSinBlancos.csv");
//Creamos un array con las fechas
foreach ($medidas as $key => $value) {
	if ($datos=strstr($value, '"202')){
		$fecha[]=substr($datos,1,10);
	}
}

//Seleccionamos las fechas distintas
$fechas=array_unique($fecha);
//Creamos un fichero por fecha
foreach ($fechas as $key => $value) {
	$f=fopen("medidas/".$value.".txt", "w");
	guardarDatos(trim($value),$f);
	fclose($f);
}


//Función que guarda los datos en un fichero de una fecha.
function guardardatos($fecha,$f){
   $sensores=file("medidaSinBlancos.csv");
   foreach ($sensores as $key => $value) {
	 	if ($datos=strstr($value, '"202')){
			$fecha1=trim(substr($datos,1,10));
			if ($fecha==$fecha1){
				fwrite($f,$value);
			} 
	 	}
	}
}
?>
<div class="navbar">
	<h3>Paso 1 para la modificación del CSV<br>
</div>
<table>
	<tr>
	<th colspan="2" style="text-align: center;">
		En este paso se habrán creado los archivos <big>medidas.csv<br>
		medidasSinBlancos.csv y posiciones.csv<br></big>
		Ahora deberá elegir si unir todas las fechas o seleccionar<br>
		un rango concreto de fechas.<br>
	</th>
</tr>
<tr>
	<th colspan="2" style="text-align: center;">
		<br><button class="button"><a href='04Porunafecha_1' >Seleccionar Fechas</a></button>
	</th>
</tr>
<tr>
	<th colspan="2" style="text-align: center;">
		<br><button class="button"><a href='04TodasLasFechas.php' >Unir todas las fechas</a></button>
	</th>
</tr>
<tr>
    <td colspan="2">
      <br>
      <img src="./imagenes/pie.png" alt="" width="80%">
    </td>
 </tr>
</table>
</body>
</html>
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
<div class="navbar">
	<h3>Fechas seleccionadas<br>
</div>
<table>
<tr>
	<th colspan="2" style="text-align: center;">
<?php
	foreach($_POST['fecha'] as $selected){
		$fecha=$selected;
		if (!file_exists("medidas/$fecha")){
			echo "<br>No existen datos de contaminantes para la fecha: ", $fecha;

		}else{
			echo "<br>$fecha";
			//Cargamos en los arrys $gps y $sensor
			$gps=file("posiciones/$fecha");
			$sensor=file("medidas/$fecha");
			//Inicializamos los arrays.
			$timeP=array();
			$timeM=array();
			$index=array();
			//Guardamos el tiempo de las posicionesen $timeP		
			foreach ($gps as $key => $value) {
				$gpsvalor=explode(",", $value);
				$timeP[]=$gpsvalor[0];
			//Guardamos el tiempo de las medidas $timeM	
			}
			foreach ($sensor as $key => $value) {
				$sensorvalor=explode(",", $value);
				$timeM[]=$sensorvalor[0];
			}

			//Calculamos el valor más cercano.
			foreach ($timeP as $key => $value) {
				$nr=sizeof($timeM);
				for ($i=0; $i <$nr ; $i++) { 
					//echo "<br>$valor - $timeM[$i] ";
					if ($value > $timeM[$i]){
							if ($i==0){
								$cercano=$timeM[$i];
								$k=$i;
							}else{
								$cercano=$timeM[$i-1];
								$k=$i-1;
							}
												
					}elseif ($value < $timeM[$i] and $i==0) {
							$cercano=$timeM[$i];
							$k=$i;
					}		
				}
				//unset($timeM[$k]);
				$index[]=$k;
				//echo "<b>$k-$value-$cercano<br>";
			}

			$indices=array_unique($index);
			$nr=sizeof($indices);
			foreach ($indices as $key => $value) {
				//echo "<br>$key - $value";
				$datosgps=explode(",",$gps[$key]);
				$latlon=$datosgps[2].",".$datosgps[3];
				//$datos[]=trim($gps[$key]).",".trim($sensor[$value]).PHP_EOL;
				$datos[]=trim($sensor[$value]).",".$latlon;
				//echo "<br>$value - $sensor[$value] - $gps[$key]";
			}

			$f=fopen("fusion/$fecha", "w");
			foreach ($datos as $key => $value) {
				//echo "<br>$value";
				fwrite($f, $value);
			}
			fclose($f);
		  }	
		
	}	
	?>
	<br><br><button class="button"><a href='05Mezcla.php?fichero=fechas.csv' >Unir y Terminar</a></button>
</th>
</tr>
<tr>
    <td colspan="2">
      <br>
      <img src="./imagenes/pie.png" alt="" width="80%">
    </td>
 </tr>
</body>
</html>
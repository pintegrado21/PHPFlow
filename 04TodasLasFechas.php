<?php
//Accdemos a la carpeta posiciones
chdir(".\posiciones");
//Leemos la carpeta con sus archivos y directorios.
$ps=scandir(".");
chdir("..");
//Precesamod cada entrada de la carpeta que hemos guardado en el array $ps
foreach ($ps as $key => $value) {
	
	if (!is_dir($value)){
		$fecha=$value;
		procesarFecha($fecha);
	}		
}
header("Location: 05Mezcla.php?fichero=compacto.csv");

function procesarFecha($fecha){
	if (!file("medidas/$fecha")){
		echo "No existen datos de esa fecha";

	}else{
		$gps=file("posiciones/$fecha");
		$sensor=file("medidas/$fecha");

		foreach ($gps as $key => $value) {
			$gpsvalor=explode(",", $value);
			$timeP[]=$gpsvalor[0];
			
		}
		foreach ($sensor as $key => $value) {
			$sensorvalor=explode(",", $value);
			$timeM[]=$sensorvalor[0];
		}


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
		echo "<br>$fecha: Hecha";
	}
}		
?>
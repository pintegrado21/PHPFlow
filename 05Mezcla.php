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
	<h3>¡Ha llegado al final del programa!<br>
</div>
<table>
<tr>
	<th colspan="2" style="text-align: center;">
			<?php
		chdir("fusion");
		$ps=scandir(".");
		$datos=array();
		$fichero=$_GET["fichero"];
		//Leemos los nombres de los ficheros de directorio
		foreach ($ps as $key => $value) {
			//echo "<br>$value";
			//Si es un fichero los añadimos al array
			if (is_file($value)){
				$fecha=file("$value");
				$datos=array_merge($datos,$fecha);
			}
		}

		$f=fopen($fichero, "w");
		//Cabecera del archivo
		fwrite($f, '"timestamp","date","NO2","VOC","pm10","pm25","NO2AQI","VOCAQI","pm10AQI","pm25AQI","pm1","pm1AQI","latitude","longitude"'.PHP_EOL);

		//Pasamos al achivo el array obtenido con merge.
		foreach ($datos as $key => $value) {
			if (strlen($value>10)){
				fwrite($f, $value);
			}

		}
		fclose($f);
		if ($fichero=="compacto.csv"){
			echo "<h3>Puede usar los datos enlazados en el archivo <b>$fichero</b> que se encuentra en la carpeta <b>fusion</b> <br> y sustituir los datos de su base de datos.";
		}
		if ($fichero=="fechas.csv"){
			echo "<h3>Puede usar los datos del archivo <b>'fechas.csv'</b> que se encuentra en la carpeta <b>fusion</b><br> y añadirlos a su base de datos.";	
		}
		?>
</th>
</tr>
<tr>
    <td colspan="2">
      <br>
      Si desea volver a utilizar el programa, debe eliminar los archivos <big>medidas.csv<br>
		medidasSinBlancos.csv y posiciones.csv<br></big> y vaciar el contenido de las carpetas<br>
		<big> fusion, medidas y posiciones</big> no toque los archivos originales<br>
		a no ser que los cambie por otros archivos con el mismo nombre y otros datos.
    </td>
 </tr>
<tr>
    <td colspan="2">
      <br>
      <img src="./imagenes/pie.png" alt="" width="80%">
    </td>
 </tr>
</body>
</html>	
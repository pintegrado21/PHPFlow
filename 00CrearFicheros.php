<?php
//en la carpeta originales deben estar solos los archivos
//user_measures*.csv y user_positions*.csv 
$ficheros =scandir("originales");
chdir("originales");
foreach ($ficheros as $key => $value) {
	if (strstr($value, "measures")){
		echo "Medidas: $value";
		copy("$value" , "../medidas.csv");
	}elseif (strstr($value, "positions")){
		echo "<br>Medidas: $value";
		copy("$value" , "../posiciones.csv");
	}
						
}
header("Location:01posicionesFechas.php");


?>
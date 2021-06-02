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
	<h3>Paso 2 para la modificación del CSV Por una fecha<br>
</div>
<table>
	<tr>
	<th colspan="2" style="text-align: center;">
		Las fechas que aparecen son de las que se tiene referencias GPS (latitud y Longitud).<br>
		Deberá seleccionar las fechas, entre
		los siguientes ".txt" para unirlas en el CSV final.<br>
		Una vez seleccionadas pulse el botón <big>Enviar</big> y se unirán las fechas seleccionadas.
	</th>
</tr>
<tr>
	<th colspan="2" style="text-align: center;">
		<?php
		echo "<br>";
		//Accdemos a la carpeta posiciones
		chdir(".\posiciones");
		//Leemos la carpeta con sus archivos y directorios.
		$ps=scandir(".");
		//Precesamod cada entrada de la carpeta que hemos guardado en el array $ps
		$valor=-2;
		?>
		<?php foreach ($ps as $key => $value): ?>
			<?php 
				$fecha=$value;
				$valor++; 
			//Comprobamos que es un archivo.
			?>
			<?php if (is_file($value)): ?>

				<form action="04Porunafecha_2.php" method="post">
					<input type="checkbox" name="fecha[]" value="<?php echo $fecha; ?>"><label><?php echo "&nbsp", substr($fecha,0,10), "&nbsp&nbsp&nbsp";?></label>
					<?php if ($valor %4 ==0) echo "<br>"; ?>
			<?php endif; ?>
		<?php endforeach; ?>				
		
					<br><br><button class="button">Enviar</a></button>
				</form>		
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

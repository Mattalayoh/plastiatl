<?php 
	include_once 'conexion.php';
	
	if(isset($_POST['guardar'])){
		$turno=$_POST['turno'];
		$maquina=$_POST['maquina'];
		$producto=$_POST['producto'];
		$operario=$_POST['operario'];
		$documento=$_POST['documento'];

		if(!empty($turno) && !empty($maquina) && !empty($producto) && !empty($operario) && !empty($documento) ){
			if(!filter_var($documento,FILTER_VALIDATE_INT)){
				echo "<script> alert('Documento no valido');</script>";
			}else{
				$consulta_insert=$con->prepare('INSERT INTO registro(turno,maquina,producto,operario,documento) VALUES(:turno,:maquina,:producto,:operario,:documento)');
				$consulta_insert->execute(array(
					':turno' =>$turno,
					':maquina' =>$maquina,
					':producto' =>$producto,
					':operario' =>$operario,
					':documento' =>$documento
				));
				header('Location: index.php');
			}
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}

	}


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Cliente</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>Registrar</h2>
		<form action="" method="post">
			<div class="form-group">
				<select type="text" name="turno" placeholder="Turno" class="input__text">
					<option selected >Turno</option>
					<option value="dia">Mañana</option>
					<option value="tarde">Tarde</option>
				</select>
				<select type="text" name="maquina" placeholder="Maquina" class="input__text">
					<option selected >Maquina</option>
					<option value="maq01">Maquina 01</option>
					<option value="maq02">Maquina 02</option>
					<option value="maq03">Maquina 03</option>
				</select>
			</div>
			<div class="form-group">
				<input type="text" name="producto" placeholder="Producto" class="input__text">
				<input type="text" name="operario" placeholder="Operario" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="documento" placeholder="Documento" class="input__text">
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>

<?php
	include_once 'conexion.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM registro WHERE id=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: index.php');
	}


	if(isset($_POST['guardar'])){
		$turno=$_POST['turno'];
		$maquina=$_POST['maquina'];
		$producto=$_POST['producto'];
		$operario=$_POST['operario'];
		$documento=$_POST['documento'];
		$id=(int) $_GET['id'];

		if(!empty($turno) && !empty($maquina) && !empty($producto) && !empty($operario) && !empty($documento) ){
			if(!filter_var($documento,FILTER_VALIDATE_INT)){
				echo "<script> alert('Documento no valido');</script>";
			}else{
				$consulta_update=$con->prepare(' UPDATE registro SET  
					turno=:turno,
					maquina=:maquina,
					producto=:producto,
					operario=:operario,
					documento=:documento
					WHERE id=:id;'
				);
				$consulta_update->execute(array(
					':turno' =>$turno,
					':maquina' =>$maquina,
					':producto' =>$producto,
					':operario' =>$operario,
					':documento' =>$documento,
					':id' =>$id
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
	<title>Editar Cliente</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>Editar</h2>
		<form action="" method="post">
			<div class="form-group">
				<select type="text" name="turno" value="<?php if($resultado) echo $resultado['turno']; ?>" class="input__text">
					<option selected >Turno</option>
					<option value="dia">Mañana</option>
					<option value="tarde">Tarde</option>
				</select>
				<select type="text" name="maquina" value="<?php if($resultado) echo $resultado['maquina']; ?>" class="input__text">
					<option selected >Maquina</option>
					<option value="maq01">Maquina 01</option>
					<option value="maq02">Maquina 02</option>
					<option value="maq03">Maquina 03</option>
				</select>
			</div>
			<div class="form-group">
				<input type="text" name="producto" value="<?php if($resultado) echo $resultado['producto']; ?>" class="input__text">
				<input type="text" name="operario" value="<?php if($resultado) echo $resultado['operario']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="documento" value="<?php if($resultado) echo $resultado['documento']; ?>" class="input__text">
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>

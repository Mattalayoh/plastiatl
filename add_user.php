<?php

include "conexion.php";

if($_POST)
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	
	$sql="INSERT INTO `usuarios`(`name`, `email`, `password`) VALUES ('".$name."','".$email."','".$password."')";

	$query = mysqli_query($conn,$sql);
	if($query)
	{
		session_start();
		$_SESSION['name'] = $name;
		header('Location: excel/index.php');
	}
	else
	{
		echo "Algo salió mal";
	}
	
	}
?>
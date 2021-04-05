<?php
define('SERVIDOR','localhost');
define('USUARIO','root');
define('PASSWORD','');
define('BD','plastiatlantico');

$servidor="mysql:dbname=".BD.";host=".SERVIDOR;
try{
    $pdo = new PDO($servidor,USUARIO,PASSWORD,
        array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")
    );
    //echo "<script>alert('Conexión con exito a la base de datos');</script>";
}catch (PDOException $e){
    echo "<script>alert('error al conectar con la base de datos');</script>";
}



$d1 = $_POST['d1'];
$d2 = $_POST['d2'];
$d3 = $_POST['d3'];
$d4 = $_POST['d4'];
$d5 = $_POST['d5'];
$d6 = $_POST['d6'];


$fecha = "2020-03-11 00:00:00";
$horario= "dd/mm/yyyy";
$estado = "1";

//echo $d1." - ".$d2." - ".$d3." - ".$d4." - ".$d5." - ".$d6." - ".$d7;

$sentencia = $pdo->prepare("INSERT INTO antiguos
      ( horario, turno, maquina, producto, operario, documento, estado) 
VALUES(:horario,:turno,:maquina,:producto,:operario,:documento,:estado)");

$sentencia->bindParam(':horario',$d1);
$sentencia->bindParam(':turno',$d2);
$sentencia->bindParam(':maquina',$d3);
$sentencia->bindParam(':producto',$d4);
$sentencia->bindParam(':operario',$d5);
$sentencia->bindParam(':documento',$d6);

$sentencia->bindParam(':estado',$estado);
$sentencia->execute();
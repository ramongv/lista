<?php

session_start();
$connect = mysqli_connect("localhost","root","","lista");
$id= mysqli_real_escape_string($connect, $_POST["idmodhoras"]);
$h_ini = mysqli_real_escape_string($connect, $_POST["h_ini"]);
$h_fin = mysqli_real_escape_string($connect, $_POST["h_fin"]);
$sql="UPDATE asistencia SET h_ini='$h_ini',h_fin='$h_fin' WHERE id=$id";
$result = mysqli_query($connect, $sql);
echo "1";



?>

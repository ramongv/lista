<?php

session_start();

$idcert = mysqli_real_escape_string($connect, $_POST["idcert"]);
$nombcert = mysqli_real_escape_string($connect, $_POST["nombcert"]);
$dir_subida = '../archivos/';

$nombre_file="pruebas.pdf";
$fichero_subido = $dir_subida .$nombre_file;
echo $fichero_subido;

if (move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido)) {
    echo "El fichero es válido y se subió con éxito.\n";



} else {

}


?>

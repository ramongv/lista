<?php

session_start();
$connect = mysqli_connect("localhost","root","","lista");
$idcert = mysqli_real_escape_string($connect, $_POST["idcert"]);
$nombcert = mysqli_real_escape_string($connect, $_POST["nombcert"]);
$dir_subida = '../archivos/';
$nombre_file=uniqid().".pdf";
$fichero_subido = $dir_subida .$nombre_file;

  print_r($_FILES["cert_file"]);
if (move_uploaded_file($_FILES['cert_file']['tmp_name'], $fichero_subido)) {
    echo "El fichero es válido y se subió con éxito.\n";
    $nom=$nombre_file;
    $sqls="UPDATE partido SET $nombcert='$nom' WHERE id=$idcert";
    echo $sqls;
    $result = mysqli_query($connect, $sqls);
    header('Location: ../registro.php');
} else {
    echo "¡error!\n";
}


?>

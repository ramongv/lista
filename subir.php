<?php

session_start();
$connect = mysqli_connect("localhost","root","","lista");
$ida = mysqli_real_escape_string($connect, $_POST["ida"]);
$ca = mysqli_real_escape_string($connect, $_POST["ca"]);
$dir_subida = 'archivos/';
$nombre_file=uniqid().".pdf";
echo "el nombre es";
echo $nombre_file;
$fichero_subido = $dir_subida .$nombre_file;


if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
    echo "El fichero es válido y se subió con éxito.\n";
    $nom=$nombre_file;
    $sqls="UPDATE archivos SET $ca='$nom' WHERE id_asis=$ida";
    echo $sqls;
    $result = mysqli_query($connect, $sqls);
    if ($_SESSION["user"]!="admin") {
      header('Location: index.php');
    }else{header('Location: ad.php');}

} else {
    echo "¡error!\n";
}


?>

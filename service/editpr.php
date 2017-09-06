<?php

session_start();
$connect = mysqli_connect("localhost","root","","lista");
$nombarchivo = mysqli_real_escape_string($connect, $_POST["nombarchivo"]);
//$tablaarchi = mysqli_real_escape_string($connect, $_POST["tablaarchi"]);
if ($_FILES["archi_file"]["name"]!="") {
  print_r($_FILES["archi_file"]);
  $dir_subidaa = '../archivos/';
  $nombre_filea=$nombarchivo;

  $anexo_subidoa = $dir_subidaa .$nombre_filea;


  if (move_uploaded_file($_FILES['archi_file']['tmp_name'], $anexo_subidoa)) {
      echo "El fichero es válido y se subió con éxito.\n";
      //$sql="UPDATE $tablaarchi SET nombre='$nombre_filea' WHERE nombre='$nombarchivo'";
      //$sqlsa="INSERT INTO informes(id_asis, nombre) VALUES ('$ida3','$nombre_filea')";
      //echo $sql;
      //$resulta = mysqli_query($connect, $sql);

  } else {
      echo "¡error!\n";
  }

}
header ("Location: ../registro.php");
?>

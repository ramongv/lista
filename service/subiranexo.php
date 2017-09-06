<?php

session_start();
$connect = mysqli_connect("localhost","root","","lista");
$ida2 = mysqli_real_escape_string($connect, $_POST["ida2"]);
if ($_FILES["a_usuario"]["name"]!="") {
  print_r($_FILES["a_usuario"]);
  $dir_subidaa = '../archivos/';
  $nombre_filea=uniqid().".pdf";

  $anexo_subidoa = $dir_subidaa .$nombre_filea;


  if (move_uploaded_file($_FILES['a_usuario']['tmp_name'], $anexo_subidoa)) {
      echo "El fichero es válido y se subió con éxito.\n";

      $sqlsa="INSERT INTO acuerdos(id_asis, nombre) VALUES ('$ida2','$nombre_filea')";
      echo $sqlsa;
      $resulta = mysqli_query($connect, $sqlsa);

  } else {
      echo "¡error!\n";
  }

}
if($_FILES["anexo_usuario"]["name"]!=""){
  $dir_subida = '../archivos/';
  $nombre_file=uniqid().".pdf";

  $anexo_subido = $dir_subida .$nombre_file;


  if (move_uploaded_file($_FILES['anexo_usuario']['tmp_name'], $anexo_subido)) {
      echo "El fichero es válido y se subió con éxito.\n";
      $nom=$nombre_file;
      $sqls="INSERT INTO anexo(id_asis, nombre) VALUES ('$ida2','$nombre_file')";
      echo $sqls;
      $result = mysqli_query($connect, $sqls);

  } else {
      echo "¡error!\n";
  }
  print_r($_FILES["anexo_usuario"]);}
header ("Location: ../login.php");


?>

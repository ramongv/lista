<?php

session_start();
$connect = mysqli_connect("localhost","root","","lista");
$ida3 = mysqli_real_escape_string($connect, $_POST["ida3"]);
if ($_FILES["a_info"]["name"]!="") {
  print_r($_FILES["a_info"]);
  $dir_subidaa = '../archivos/';
  $nombre_filea=uniqid().".pdf";

  $anexo_subidoa = $dir_subidaa .$nombre_filea;


  if (move_uploaded_file($_FILES['a_info']['tmp_name'], $anexo_subidoa)) {
      echo "El fichero es válido y se subió con éxito.\n";

      $sqlsa="INSERT INTO informes(id_asis, nombre) VALUES ('$ida3','$nombre_filea')";
      echo $sqlsa;
      $resulta = mysqli_query($connect, $sqlsa);

  } else {
      echo "¡error!\n";
  }

}
header ("Location: ../login.php");
?>

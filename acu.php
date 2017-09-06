<?php

session_start();
$connect = mysqli_connect("localhost","root","","lista");

if(isset($_POST["val"])){
  $tab= mysqli_real_escape_string($connect, $_POST["tab"]);
  $val = mysqli_real_escape_string($connect, $_POST["val"]);
    $sql = "SELECT * FROM $tab WHERE id_asis= '$val'";

  $result = mysqli_query($connect, $sql);
  $num_row = mysqli_num_rows($result);
$datos=array();

  if (true) {

    while ($data = mysqli_fetch_array($result)) {
      $datos[]=$data['nombre'];
    }
    header('Content-type: application/json');

   echo json_encode($datos);

  } else {
    echo "error";
  }
} else {
  echo "error";
}

?>

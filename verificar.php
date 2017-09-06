<?php

session_start();
$connect = mysqli_connect("localhost","root","","lista");

if(isset($_POST["passw"])){

  $passw = mysqli_real_escape_string($connect, $_POST["passw"]);
    $sql = "SELECT * FROM validar WHERE password='$passw'";

  $result = mysqli_query($connect, $sql);
  $num_row = mysqli_num_rows($result);

  if ($num_row == "1") {
    $data = mysqli_fetch_array($result);

    echo "1";
  } else {
    echo "error";
  }
} else {
  echo "error";
}

?>

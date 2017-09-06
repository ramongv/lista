<?php

session_start();
$connect = mysqli_connect("localhost","root","","lista");

if(isset($_POST["user"]) && isset($_POST["pass"])){
  $user = mysqli_real_escape_string($connect, $_POST["user"]);
  $pass = mysqli_real_escape_string($connect, $_POST["pass"]);
    $sql = "SELECT * FROM usuarios WHERE usuario= '$user'  AND password='$pass'";

  $result = mysqli_query($connect, $sql);
  $num_row = mysqli_num_rows($result);


  if ($num_row == "1") {
    $data = mysqli_fetch_array($result);
    if ($data["usuario"]=="secretario"||$data["usuario"]=="consejeros") {
      $_SESSION["user"] = "admin";
      $_SESSION["municipio"]=$data["id_municipio"];
      $_SESSION["id"]=$data["id"];
    }else{
    $_SESSION["user"] = $data["usuario"];
    $_SESSION["municipio"]=$data["id_municipio"];
    $_SESSION["id"]=$data["id"];}
    if($_SESSION["user"]=="admin"){
      echo "admin";
    }
    echo "1";
  } else {
    echo "error";
  }
} else {
  echo "error";
}

?>

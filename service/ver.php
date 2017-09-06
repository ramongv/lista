<?php
session_start();
if(!isset($_SESSION["user"])){
  header("location:login.php");
}
$connect = mysqli_connect("localhost","root","","lista");

if(isset($_POST["id"])){
$id=mysqli_real_escape_string($connect,$_POST["id"]);
$sqli="UPDATE asistencia SET verif=false WHERE id=$id";
$res=mysqli_query($connect,$sqli);

    echo "1";
}

?>

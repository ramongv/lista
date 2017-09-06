<?php
session_start();
if(!isset($_SESSION["user"])){
  header("location:login.php");
}
$connect = mysqli_connect("localhost","root","","lista");

if(isset($_POST["nnew"])){
$usuario=$_SESSION["user"];
$dni=$_POST["dni"];
$id_municipio=$_SESSION["municipio"];
$nnew=mysqli_real_escape_string($connect,$_POST["nnew"]);
$nxml=$_POST["nxml"];
if ($usuario=="admin") {
  # code...
}else{
$sqli="INSERT INTO bitacora(nombrep,nombren,fehca, modifico,usuario) VALUES ('$dni','$nnew',now(),'$nxml','$usuario')";
$res=mysqli_query($connect,$sqli);}
$sql="UPDATE consejeros SET $nxml='$nnew'  WHERE id_municipio='$id_municipio'";
  $result = mysqli_query($connect, $sql);
    echo "1";
}

?>

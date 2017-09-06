<?php
session_start();
if(!isset($_SESSION["user"])){
  header("location:login.php");
}
$connect = mysqli_connect("localhost","root","","lista");

if(isset($_POST["nnewpartido"])){
  $usuario=$_SESSION["user"];
  $cam=mysqli_real_escape_string($connect,$_POST["cam"]);
  $cam= substr($cam, 1, -1);
$idpar=mysqli_real_escape_string($connect,$_POST["idpar"]);
$campopartido=mysqli_real_escape_string($connect,$_POST["campopartido"]);
$nnewpartido=mysqli_real_escape_string($connect,$_POST["nnewpartido"]);
$valorpartido=$_POST["valorpartido"];
if ($usuario=="admin") {

}else{
$sqli="INSERT INTO bitacora(nombrep,nombren,fehca, modifico,usuario) VALUES ('$valorpartido','$nnewpartido',now(),'$campopartido','$usuario')";
$res=mysqli_query($connect,$sqli);}
$sql="UPDATE partido SET $campopartido='$nnewpartido'  WHERE id='$idpar'";

  $result = mysqli_query($connect, $sql);
    echo "1";
}

?>

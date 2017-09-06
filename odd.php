<?php

session_start();
$a=4;
if(!isset($_SESSION["user"])){
  header("location:login.php");
}else{
  if ($_SESSION["user"]=="admin") {
    header("location:ad.php");
  }
  $xarr=['consejero1','consejero2','consesejero3','consejero4'];
  $i=$_SESSION["municipio"];
  $connect = mysqli_connect("localhost","root","","lista");
  //$sql="SELECT * FROM asistencia WHERE id_municipio= $i";
  $sqld="SELECT id_distrito FROM municipios where id='$i'";
  $re=mysqli_query($connect,$sqld);
  $rex=mysqli_fetch_row($re);

  $sql="SELECT asistencia.id,verif,distritos.nombre,municipios.nombre,fecha, h_ini, h_fin,tipo, presidente, presidentesup, secretario, secretariosup, vocalcapacitacion, vocalcapacitacionsup, vocalorganizacion, vocalorganizacionsup, consejero1, consejero1sup, consejero2, consejero2sup, consejero3, consejero3sup, consejero4, consejero4sup,pantitular,pansuplente,pestitular,pessuplente,morenatitular,morenasuplente,movimientotitular,movimientosuplente,pnaltitular,pnalsuplente,prdtitular,prdsuplente,prititular,prisuplente,pttitular,ptsuplente,verdetitular,verdesuplente,independiente1titular,independiente1suplente,independiente2titular,independiente2suplente,independiente3titular,independiente3suplente FROM asistencia, municipios, distritos WHERE asistencia.id_municipio='$i' and municipios.id='$i' and distritos.id='$rex[0]'";


  $result=mysqli_query($connect,$sql);


  }


?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="shortcut icon" type="image/png" href="logos/favicon.png"/>
    <meta charset="utf-8">
    <title>Bitacora</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <script src="js/jquery-3.2.0.min.js" charset="utf-8"></script>
    <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </head>

  <body>
    <div class="container">
    <img src="logos/Logo_principal_192_137.png" WIDTH="192" HEIGHT="137">


    <nav class="navbar navbar-default">

          <a href="logout.php" class="navbar-brand navbar-right" >Cerrar Sesion</a>

      <a class="navbar-brand" href="registro.php">Asistencia</a>
      <a class="navbar-brand" href="index.php">Bitacora</a>
      <a class="navbar-brand" href="#">Orden del dia</a>
    </nav>
  </div>

        <div class="container">
        </div>
  </body>


</html>

<?php

session_start();
$a=4;
if(!isset($_SESSION["user"])){
  header("location:login.php");
}else{
  $n=$_GET['n'];
  $i=$_SESSION["municipio"];

  $connect = mysqli_connect("localhost","root","","lista");
  $sqla="SELECT * FROM asistencia where id='$n'";
  $ress=mysqli_query($connect,$sqla);
  $sql="SELECT * FROM consejeros WHERE id_municipio= $i";
  $result=mysqli_query($connect,$sql);
  mysql_query("SET NAMES 'utf8'");
  $data=mysqli_fetch_array($result);
  $dataa=mysqli_fetch_array($ress);
  $xarr=['consejero1','consejero2','consesejero3','consejero4'];
  $axrs=['consejero1sup','consejero2sup','consejero3sup','consejero4sup'];
  foreach ($data as $key => $value) {
    if (is_numeric($key)or $key=="id" or $key=="id_municipio") {
      unset($data[$key]);
    }
  }
  $sql2="SELECT * FROM partido where id_municipio=$i";
  $resultado=mysqli_query($connect,$sql2);
}
$v="";

 header("Content-type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=reporte.xls");
  header("Pragma: no-cache");
  header("Expires: 0");

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registro</title>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

  <div class="container">





  <h2 style="text-align: center">Registro</h2>



   <table class="table table-bordered">
     <thead>
       <tr>
           <td>Fecha</td>
           <td><?php $date = date_create($dataa["fecha"]);
           $x=date_format($date, 'd/m/y'); echo $x ; ?></td>
       </tr>
       <tr>
           <td>Hora de Inicio</td>
           <td><?php echo $dataa["h_ini"]; ?></td>
       </tr>
       <tr>
           <td>Hora de Termino</td>
           <td><?php echo $dataa["h_fin"]; ?></td>
       </tr>

     </thead>
     <tbody>
       <tr>

           <th>Cargo</th>
           <th>Nombre </th>
          <th>Asistencia</th>
       </tr>

    <?php foreach ($data as $key => $value) {
      if ($value!=null ){
        $aux=$key;
        if (in_array($key,$xarr) ) {
          $aux='Consejero(A)';
        }elseif (in_array($key,$axrs)) {
          $aux='Consejero(A) suplente';
        }elseif ($key=="presidentesup") {
          $aux="Presidente Suplente";
        }elseif ($key=="vocalcapacitacionsup") {
          $aux="Vocal Capacitacion Suplente";
        }elseif ($key=="secretariosup") {
          $aux ="secretario suplente";
        }elseif ($key=="vocalorganizacionsup") {
          $aux="vocal capacitacion suplente";
        }

        if ($dataa[$key]==1) {
          $v="&#10003;";
        }else{$v="-";}
      echo'<div class="form-group row">
      <tr>
        <td>'.strtoupper($aux).":".'</td>
        <td for="'.$key.'" class="col-sm-4 col-form-label "id="'.$key."n".'" >'.$value.'</td>
        <td  >'.$v.'</td>
        </tr>
      	';}
    }
    while ($fila=mysqli_fetch_row($resultado)) {
      $indice=$fila[1].'titular';
      $indice2=$fila[1].'suplente';
      if ($dataa[$indice]==1) {
        $vt="&#10003;";
      }else{$vt="-";}
      if ($dataa[$indice2]==1) {
        $vs="&#10003;";
      }else{$vs="-";}
      echo '
        <tr>
        <td>'.$fila[1].'titular</td>
        <td>'.$fila[5].'</td>
        <td>'.$vt.'</td>
        </tr>
        <tr>
        <td>'.$fila[1].'suplente</td>
        <td>'.$fila[6].'</td>
        <td>'.$vs.'</td>
        </tr>
       ';}
     ?>
     </tbody>
	</table>

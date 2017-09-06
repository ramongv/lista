<?php
session_start();

if(!isset($_SESSION["user"]) or $_SESSION["user"]!="admin"){
  header("location:login.php");
}else{
  $connect = mysqli_connect("localhost","root","","lista");
  $sql="SELECT *FROM bitacora where 1";
  $result=mysqli_query($connect,$sql);

//$logitud = 8;
//$psswd = substr( md5(microtime()), 1, $logitud);
//echo $psswd;

}




?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="shortcut icon" type="image/png" href="logos/favicon.png"/>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <script src="js/jquery-3.2.0.min.js" charset="utf-8"></script>
    <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="container">
    <img src="logos/Logo_principal_192_137.png" WIDTH="192" HEIGHT="137">


    <nav class="navbar navbar-default">

          <a href="logout.php" class="navbar-brand navbar-right" >Cerrar Sesion</a>
          <a class="navbar-brand" href="ad.php">Asistencia </a>
          <a class="navbar-brand" href="#">Bitacora</a>
          <a class="navbar-brand" href="modnomb.php">Modificar</a>
          <a class="navbar-brand" href="service/tmu.php">Reporte Estatal<span class="glyphicon glyphicon-download" aria-hidden="true"></span></a>


    </nav>
  </div>

  <div class="container">
    <h2 style="text-align: center">Bitacora de Cambios</h2>

    <div class="table-responsive">

  <table class="table table-striped">
      <thead>
          <tr>
              <th>Municipio</th>
              <th>Campo que se modifico</th>
              <th>Valor previo</th>
              <th>Valor nuevo</th>
              <th>Fecha</th>





          </tr>
      </thead>
      <tbody>
          <?php

          while ($fila=mysqli_fetch_row($result)) {
            echo "<tr>
                  <th>".$fila[4]."</th>
                  <th>".$fila[1]."</th>
                  <th>".$fila[2]."</th>
                  <th>".$fila[3]."</th>
                  <th>".$fila[5]."</th>  ";


            }




           ?>

      </tbody>



  </table>

</div>

  </div>
  </body>
</html>
<script>
$(document).ready(function(){
  $('#hhh').click(function(){
  var hh=$('#municip').val();
  $.ajax({
    url:"service/mun.php",
    method:"POST",
    data:{hh:hh},
    cache:"false",
    beforeSend:function(){
      $('#hhh').val("buscando");
    },
    success:function(data){
      console.log(data);
    }

  });
  });
});
</script>

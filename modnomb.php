<?php

session_start();
$a=4;
if($_SESSION["user"]!="admin"){
    header("location:index.php");
}else{
  if (!isset($_SESSION["user"])) {

    header("location:login.php");
  }
  $connect = mysqli_connect("localhost","root","","lista");
  $sql3="SELECT * FROM municipios where 1 order by nombre";

  $resultadomun=mysqli_query($connect,$sql3);
  if (isset($_POST["hh"])) {

    $_SESSION["municipio"]=$_POST["hh"];
  $i=$_SESSION["municipio"];

  $connect = mysqli_connect("localhost","root","","lista");
  $sql="SELECT * FROM consejeros WHERE id_municipio= $i";
  $result=mysqli_query($connect,$sql);
  mysql_query("SET NAMES 'utf8'");
  $data=mysqli_fetch_array($result);
  $xarr=['consejero1','consejero2','consejero3','consejero4'];
  $axrs=['consejero1sup','consejero2sup','consejero3sup','consejero4sup'];
  foreach ($data as $key => $value) {
    if (is_numeric($key)or $key=="id" or $key=="id_municipio") {
      unset($data[$key]);
    }
  }
  $sql2="SELECT * FROM partido where id_municipio=$i";

  $resultado=mysqli_query($connect,$sql2);
  //$datos=mysqli_fetch_array($resultado);
}}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" type="image/png" href="logos/favicon.png"/>
  <meta charset="utf-8">
  <title>Registro</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="css/bootstrap-timepicker.min.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="css/bootstrap-datepicker.min.css" media="screen" title="no title" charset="utf-8">
  <script src="js/jquery-3.2.0.min.js" charset="utf-8"></script>
  <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  <script src="js/bootstrap-timepicker.min.js" charset="utf-8"></script>
  <script src="js/bootstrap-datepicker.min.js" charset="utf-8"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <div class="container">
  <img src="logos/Logo_principal_192_137.png" WIDTH="192" HEIGHT="137">


  <nav class="navbar navbar-default">

        <a href="logout.php" class="navbar-brand navbar-right" >Cerrar Sesion</a>
        <a class="navbar-brand" href="ad.php">Asistencia</a>
        <a class="navbar-brand" href="bitacora.php">Bitacora</a>
        <a class="navbar-brand" href="modnomb.php">Modificar</a>
        <a class="navbar-brand" href="service/tmu.php">Reporte Estatal<span class="glyphicon glyphicon-download" aria-hidden="true"></span></a>


  </nav>
</div>

  <div class="container">

    <form class="" id="iq"action="modnomb.php" method="post">
      <div class="form-group row">
        <label for="municip" class="col-sm-2 col-form-label ">Municipio</label>
        <div class="col-sm-5">


      <select id="municip" name="hh" class=" form-control">
          <?php
            while ($fila=mysqli_fetch_row($resultadomun)) {
                echo'<option value="'.$fila[0].'" >'.$fila[1].'</option>';
            }
           ?>

      </select>
      </div>
      <input type="submit" value="Seleccionar" form="iq"class="btn btn-success">
      </div>

    </form>



  <h2 style="text-align: center">Modificar</h2>



  <form id="xx" >






    <?php if (isset($_POST["hh"])) {
      # code...
    foreach ($data as $key => $value) {
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


      echo'<div class="form-group row">
        <label for="'.$key.'" class="col-sm-4 col-form-label ">'.strtoupper($aux).":".'</label>
        <label for="'.$key.'" class="col-sm-4 col-form-label "id="'.$key."n".'" >'.$value.'</label>
        <button type="button" class="btn btn-primary" onclick="mostrar('."'".$key."','".$value."'".');" >
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
        </button>

      </div>';}
    }}

     ?>

  <?php if (isset($_POST["hh"])) {

  while ($fila=mysqli_fetch_row($resultado)) {//<div class="col-sm-1 col-form-label" > <a href="archivos/hojas.pdf" download class="btn btn-default" ><span class="fa fa-file-pdf-o"style="font-size:24px" aria-hidden="true"></span></a></div>
    echo '<div class="form-group row">';
    if ($fila[2]==null) {
      echo'<div class="col-sm-1 col-form-label">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       <span class="fa fa-file-pdf-o"style="font-size:24px" aria-hidden="true"></span>

       </button>
      <ul class="dropdown-menu">
       <li><a onclick="subir('."'".'archivo1'."'".','.$fila[0].')"; >
        Subir
        </a></li>
       </ul>
       </div>';
    }else{
    echo'<div class="col-sm-1 col-form-label">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     <span class="fa fa-file-pdf-o"style="font-size:24px" aria-hidden="true"></span>

     </button>
    <ul class="dropdown-menu">
     <li><a onclick="modarchi('."'".$fila[2]."'".')"; >
      Editar
      </a></li>
       <li><a href="archivos/'.$fila[2].'" download  >Descargar</a></li>
     </ul>
     </div>';}
     if ($fila[3]==null) {
       echo'<div class="col-sm-1 col-form-label">
       <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa fa-file-pdf-o"style="font-size:24px" aria-hidden="true"></span>

        </button>
       <ul class="dropdown-menu">
        <li><a onclick="subir('."'".'archivo2'."'".','.$fila[0].')"; >
         Subir
         </a></li>
        </ul>
        </div>';
     }else{
     echo'<div class="col-sm-1 col-form-label">
     <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="fa fa-file-pdf-o"style="font-size:24px" aria-hidden="true"></span>

      </button>
     <ul class="dropdown-menu">
      <li><a onclick="modarchi('."'".$fila[3]."'".')";  >
       Editar
       </a></li>
        <li><a href="archivos/'.$fila[3].'" download  >Descargar</a></li>
      </ul>
      </div>';}
      if ($fila[4]==null) {
        echo'<div class="col-sm-1 col-form-label">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span class="fa fa-file-pdf-o"style="font-size:24px" aria-hidden="true"></span>

         </button>
        <ul class="dropdown-menu">
        <li><a onclick="subir('."'".'archivo3'."'".','.$fila[0].')"; >
          Subir
          </a></li>
         </ul>
         </div>';
      }else{
      echo'<div class="col-sm-1 col-form-label">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       <span class="fa fa-file-pdf-o"style="font-size:24px" aria-hidden="true"></span>

       </button>
      <ul class="dropdown-menu">
       <li><a onclick="modarchi('."'".$fila[4]."'".')"; >
        Editar
        </a></li>
         <li><a href="archivos/'.$fila[4].'" download  >Descargar</a></li>
       </ul>
       </div>';}


     echo'<div class="col-sm-1 col-form-label">  <img  src="logos/'.$fila[1].'.png" WIDTH="40" HEIGHT="40"></div>
       <div class="form-group">
          <label  class="col-sm-4 col-form-label "id="'.$fila[1].'titularn" >'.$fila[5].'</label>
          <button  type="button" class="btn btn-primary" onclick="mostrardos('."'".$fila[0]."','".$fila[1]."titular'".','."'".'titular'."'".');" >
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
          </button>




       </div>
       <div class="form-line">
         <br>
         <div class="col-sm-4"></div>
          <label  class="col-sm-4 col-form-label "id="'.$fila[1].'suplenten" >'.$fila[6].'</label>
          <button  type="button" class="btn btn-primary" onclick="mostrardos('."'".$fila[0]."','".$fila[1]."suplente'".','."'".'suplente'."'".');" >
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
          </button>



       </div>
  </div>';}} ////////?> </form>
       <!--<div class="form-group row">
         <div class="col-sm-1 col-form-label" > <a href="manual.pdf" download class="btn btn-default" ><span class="fa fa-file-pdf-o"style="font-size:24px" aria-hidden="true"></span></a></div>
         <div class="col-sm-1 col-form-label" > <a href="manual.pdf" download class="btn btn-default" ><span class="fa fa-file-pdf-o"style="font-size:24px" aria-hidden="true"></span></a></div>
         <div class="col-sm-1 col-form-label" > <a href="manual.pdf" download class="btn btn-default" ><span class="fa fa-file-pdf-o"style="font-size:24px" aria-hidden="true"></span></a></div>
          <div id="pdf"class="col-sm-1 col-form-label">  <img  src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/PAN_%28Mexico%29.svg/337px-PAN_%28Mexico%29.svg.png" WIDTH="40" HEIGHT="40"></div>
            <div class="form-group">
               <label for="pa2n" class="col-sm-4 col-form-label "id="xx" >"Nombres"</label>
               <button for="pa2n" type="button" class="btn btn-primary" onclick="mostrar();" >
                 <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
               </button>

               <div class="col-sm-1">
                 <input type="checkbox" class="form-check-input" name="pan" id="pa2n" >
               </div>

            </div>
            <div class="form-line">
              <br>
              <div class="col-sm-4"></div>
               <label for="pa2n" class="col-sm-4 col-form-label "id="xx" >"Nombres"</label>
               <button for="pa2n" type="button" class="btn btn-primary" onclick="mostrar();" >
                 <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
               </button>

               <div class="col-sm-1">
                 <input type="checkbox" class="form-check-input" name="pan" id="pa2n" >
               </div>

            </div>
       </div>-->






</div>

  </body>
  <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modificar</h4>
      </div>
      <div class="modal-body">
        <form class="" action="modificar.php" method="post" >
            <input type="text" name="nxml" value="" id="nxml"style="visibility:hidden">
          <div class="form-group row">
            <label for="lgFormGroupInput" class="col-sm-3 col-form-label col-form-label-lg">Nombre Actual:</label>
            <div class="col-sm-5">
              <input type="text" class="form-control form-control-lg" id="DNI" name="DNI" placeholder="">
            </div>
          </div>
          <div class="form-group row">
            <label for="lgFormGroupInput" class="col-sm-3 col-form-label col-form-label-lg">Nombre Nuevo:</label>
            <div class="col-sm-5">
              <input type="text" class="form-control form-control-lg" id="nnew" name="nnew" placeholder="">
            </div>
          </div>

        </form>

      </div>
      <div class="modal-footer">

        <input type="button" name="modific" id="modific" value="Modificar" class="btn btn-success">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="modal" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Autorizacion</h4>
      </div>
      <div class="modal-body">
        <form class="" >
          <input type="password" name="passw" id="passw">

        </form>
        <p>password</p>
          <span id="errorv"></span>

      </div>
      <div class="modal-footer">
        <input type="button"class="btn btn-primary"name="autori" id="autori" value="autorizar"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="modalpartido" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Autorizacion</h4>
      </div>
      <div class="modal-body">
        <form class="" >
          <input type="password" name="passpartido" id="passpartido">

        </form>
        <p>password</p>
          <span id="errorpartido"></span>

      </div>
      <div class="modal-footer">
        <input type="button"class="btn btn-primary"name="autoripartido" id="autoripartido" value="autorizar"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="partido" class="modal fade" role="dialog">
<div class="modal-dialog">


  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Modificar</h4>
    </div>
    <div class="modal-body">
      <form class="" action="service/modificarpartido.php" method="post" >
          <input type="text" name="idpar" value="" id="idpar"style="visibility:hidden" >
          <input type="text" name="campopartido" value="" id="campopartido"style="visibility:hidden" >
          <input type="text" name="campopartido" value="" id="capar"style="visibility:hidden" >
        <div class="form-group row">
          <label for="lgFormGroupInput" class="col-sm-3 col-form-label col-form-label-lg">Nombre Actual:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control form-control-lg" id="valorpartido" name="valorpartido" placeholder="">
          </div>
        </div>
        <div class="form-group row">
          <label for="lgFormGroupInput" class="col-sm-3 col-form-label col-form-label-lg">Nombre Nuevo:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control form-control-lg" id="nnewpartido" name="nnewpartido" placeholder="">
          </div>
        </div>

      </form>

    </div>
    <div class="modal-footer">

      <input type="button" name="modificpartido" id="modificpartido" value="Modificar" class="btn btn-success">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

</div>
</div>
<!-- Modal modificar archivos-->
<div id="modarchivos" class="modal fade" role="dialog">
<div class="modal-dialog">


  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Editar</h4>
    </div>
    <div class="modal-body">
      <form enctype="multipart/form-data" id="modarchivo" method="post" action="service/editpr.php">
              <input type="text" name="nombarchivo" id="nombarchivo" value=""style="visibility:hidden">

              <div style="text-align: center;"><label  for="archi_file">Subir Archivo</label></div>

              <input  type="file"  id="archi_file" name="archi_file"/><br>

          </form>
    </div>
    <div class="modal-footer">

       <input type="submit" value="Guardar" form="modarchivo"class="btn btn-success">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

</div>
</div>
<!-- Modal subircertificacion-->
<div id="subicertificacion" class="modal fade" role="dialog">
<div class="modal-dialog">


  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Subir certificaion</h4>
    </div>
    <div class="modal-body">
      <form enctype="multipart/form-data" id="certarchivo" method="post" action="service/subcert.php">
              <input type="text" name="idcert" id="idcert" value=""style="visibility:hidden">
              <input type="text" name="nombcert" id="nombcert" value=""style="visibility:hidden">
              <div style="text-align: center;"><label  for="cert_file">Subir Archivo</label></div>

              <input  type="file"  id="cert_file" name="cert_file"/><br>

          </form>
    </div>
    <div class="modal-footer">

       <input type="submit" value="Guardar" form="certarchivo"class="btn btn-success">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

</div>
</div>
</html>
<script>
$(document).ready(function() {
  $('#h_ini').timepicker({
    showMeridian:false,
    minuteStep:1,
    defaultTime:false
  });
  $('#h_fin').timepicker({
    showMeridian:false,
    minuteStep:1,
    defaultTime:false
  });
  $('#fecha').datepicker({
               format: 'yyyy/mm/dd'
               });
  $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
    $('#registrar').click(function(){
      var elArray={};
      elArray['fecha']="'".concat($('#fecha').val()).concat("'");
      elArray['h_ini']="'".concat($('#h_ini').val()).concat("'");
      elArray['h_fin']="'".concat($('#h_fin').val()).concat("'");
      elArray['tipo']="'".concat($('#tip').val()).concat("'");

  var x=$('#xx').find("input:checkbox");
$.each(x,function(valie){
  var it=x[valie].id;

var ix="#".concat(x[valie].id);
var ixt=$(ix).is(':checked') ? 1 : 0;
elArray[it]=ixt;


});
if($.trim($('#fecha').val()).length > 0 && $.trim(elArray['h_fin']).length > 0){
  $.ajax({
    url:"reg.php",
    method:"POST",
    data:elArray,
    cache:"false",
    beforeSend:function() {
      $('#registrar').val("Conectando...");
    },
    success:function(data) {
      $('#registrar').val("registrar");
      if (data=="1") {
        $(location).attr('href','index.php');
      } else {

        $("#result").html("<div class='alert alert-dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>¡Error!</strong> las credenciales son incorrectas.</div>");
      }
    }
  });
}else {
  console.log("aun no");
};




        	//$.post("reg.php", elArray, function(htmlexterno){
//   $("#cargaexterna").html(htmlexterno);
    		//});





     });



  });
  function mostrar(valor,valor2){
    $('#modal').modal("show");
    var r=valor.concat("n");
    var r="#".concat(r);
    var rq=$(r).text();
    $(".modal-body #DNI").val(rq);

    $(".modal-body #nxml").val(valor);
  };
  function mostrardos(pid,val,campo){
    $('#modalpartido').modal("show");
    var r=val.concat("n");
    var r="#".concat(r);
    var rq=$(r).text();
    console.log(r);
    $(".modal-body #capar").val(r);
    $(".modal-body #idpar").val(pid);
    $(".modal-body #campopartido").val(campo);
    $(".modal-body #valorpartido").val(rq);
  };

  $('#autori').click(function(){

    var passw=$('#passw').val();
    if($.trim(passw).length >0){
      $.ajax({
        url:"verificar.php",
        method:"POST",
        data:{passw:passw},
        cahe:"false",
        beforeSend:function(){
          $('#autori').val("verificando");
        },
        success:function(data){
          if (data=="1") {
            $('#passw').val("");
            $('#autori').val("autorizar");
            $('#modal').modal("hide");
            $("#myModal").modal("show");
          } else {
            $("#errorv").html("<div class='alert alert-dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>¡Error!</strong> las credenciales son incorrectas.</div>");
          }


        }
      });
    }

  });
  $('#autoripartido').click(function(){

    var passw=$('#passpartido').val();
    if($.trim(passw).length >0){
      $.ajax({
        url:"verificar.php",
        method:"POST",
        data:{passw:passw},
        cahe:"false",
        beforeSend:function(){
          $('#autoripartido').val("verificando");
        },
        success:function(data){
          if (data=="1") {
            $('#passpartido').val("");
            $('#autoripartido').val("autorizar");
            $('#modalpartido').modal("hide");
            $("#partido").modal("show");
          } else {
            $("#errorpartido").html("<div class='alert alert-dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>¡Error!</strong> las credenciales son incorrectas.</div>");
          }


        }
      });
    }

  });
  $('#modific').click(function(){
    var dni=$('#DNI').val();
    var nxml=$('#nxml').val();
    var nnew=$('#nnew').val().toUpperCase();
    if($.trim(nnew).length >0){
      $.ajax({
        url:"modificar.php",
        method:"POST",
        data:{nxml:nxml,nnew:nnew,dni:dni},
        cahe:"false",
        beforeSend:function(){
          $('#modific').val("modificando");
        },
        success:function(data){
          $('#modific').val("modificar");
          $('#myModal').modal('hide');
          var cambio=$('#nxml').val().concat("n");
          var cambio='#'.concat(cambio);
          var val=$('#nnew').val();

          $(cambio).text(val);
          $("#nnew").val("");
          $(".modal-body #DNI").val(val);
        }
      });
    }

  });
  $('#modificpartido').click(function(){
    var idpar=$('#idpar').val();
    var campopartido=$('#campopartido').val();
    var nnewpartido=$('#nnewpartido').val().toUpperCase();
    var valorpartido=$('#valorpartido').val();
    var cam=$(".modal-body #capar").val();

    if($.trim(nnewpartido).length >0){
      $.ajax({
        url:"service/modificarpartido.php",
        method:"POST",
        data:{idpar:idpar,campopartido:campopartido,nnewpartido:nnewpartido,valorpartido:valorpartido,cam:cam},
        cahe:"false",
        beforeSend:function(){
          $('#modificpartido').val("modificando");
        },
        success:function(data){
          $('#modificpartido').val("modificar");
          $('#partido').modal('hide');
        //  var cambio=$('#campopartido').val().concat("n");
          var cambio=  $(".modal-body #capar").val();
          console.log(cambio);
          var val=$('#nnewpartido').val();

          $(cambio).text(val);
          $("#nnewpartido").val("");
          $(".modal-body #valorpartido").val(val);
        }
      });
    }

  });
  function modarchi(archi){



    $(".modal-body #nombarchivo").val(archi);



    $('#modarchivos').modal("show");

  };
  function subir(nombre,id){
    $('#idcert').val(id);
    $('#nombcert').val(nombre);
    $('#subicertificacion').modal("show");
    console.log(id);
    console.log(nombre);

  };

</script>

<?php
session_start();

if(!isset($_SESSION["user"]) or $_SESSION["user"]!="admin"){
  header("location:login.php");
}else{
  $connect = mysqli_connect("localhost","root","","lista");


  $sql2="SELECT * FROM municipios where 1 order by nombre";

  $resultado=mysqli_query($connect,$sql2);

  if(isset($_POST["hh"]) or $_SESSION["municipio"]!=0 ){
    if (isset($_POST["hh"])) {
$_SESSION["municipio"] = mysqli_real_escape_string($connect, $_POST["hh"]);

    }

    $im=$_SESSION["municipio"];
    $sqld="SELECT id_distrito FROM municipios where id='$im'";
    $re=mysqli_query($connect,$sqld);
    $rex=mysqli_fetch_row($re);
$arr=['42','43','44','45','46','47'];
    $sql="SELECT asistencia.id,verif,distritos.nombre,municipios.nombre,fecha, h_ini, h_fin,tipo, presidente, presidentesup, secretario, secretariosup, vocalcapacitacion, vocalcapacitacionsup, vocalorganizacion, vocalorganizacionsup, consejero1, consejero1sup, consejero2, consejero2sup, consejero3, consejero3sup, consejero4, consejero4sup,pantitular,pansuplente,pestitular,pessuplente,morenatitular,morenasuplente,movimientotitular,movimientosuplente,pnaltitular,pnalsuplente,prdtitular,prdsuplente,prititular,prisuplente,pttitular,ptsuplente,verdetitular,verdesuplente,independiente1titular,independiente1suplente,independiente2titular,independiente2suplente,independiente3titular,independiente3suplente FROM asistencia, municipios, distritos WHERE asistencia.id_municipio='$im' and municipios.id='$im' and distritos.id='$rex[0]'";
    $sqlp="SELECT * FROM asistencia where id_municipio=$im";
    $result=mysqli_query($connect,$sql);
    $res=mysqli_query($connect,$sqlp);
    $pintar=mysqli_fetch_row($res);


  }}
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="shortcut icon" type="image/png" href="logos/favicon.png"/>
    <meta charset="utf-8">
    <title></title>
    <script src="js/jquery-3.2.0.min.js" charset="utf-8"></script>
    <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap-timepicker.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap-datepicker.min.css" media="screen" title="no title" charset="utf-8">


    <script src="js/bootstrap-timepicker.min.js" charset="utf-8"></script>
    <script src="js/bootstrap-datepicker.min.js" charset="utf-8"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="container">
    <img src="logos/Logo_principal_192_137.png" WIDTH="192" HEIGHT="137">


    <nav class="navbar navbar-default">

          <a href="logout.php" class="navbar-brand navbar-right" >Cerrar Sesion</a>
          <a class="navbar-brand" href="#">Asistencia</a>
          <a class="navbar-brand" href="bitacora.php">Bitacora</a>
          <a class="navbar-brand" href="modnomb.php">Modificar</a>
          <a class="navbar-brand" href="service/tmu.php">Reporte Estatal<span class="glyphicon glyphicon-download" aria-hidden="true"></span></a>


    </nav>
  </div>
  <div class="container">
    <form class="" id="iq"action="ad.php" method="post">
      <div class="form-group row">
        <label for="municip" class="col-sm-2 col-form-label ">Municipio</label>
        <div class="col-sm-5">


      <select id="municip" name="hh" class=" form-control">
          <?php
            while ($fila=mysqli_fetch_row($resultado)) {
                echo'<option value="'.$fila[0].'" >'.$fila[1].'</option>';
            }
           ?>

      </select>
      </div>
      <input type="submit" value="Seleccionar" form="iq"class="btn btn-success">
      </div>

    </form>
  </div>
  <div class="container">
    <h2 style="text-align: center">Tabla de Registros</h2>

    <div class="table-responsive">

  <table class="table table-bordered">
      <thead>
          <tr>
              <th>Distrito</th>
              <th>Municipio</th>
              <th>fecha</th>
              <th>Hora de Inicio</th>
              <th>Hora de Termino</th>
              <th>Tipo</th>
              <th colspan="2">Consejero(A) Presidente</th>
              <th colspan="2">Secretario(A)</th>
              <th colspan="2">Vocal de Capacitacion</th>
                <th colspan="2">Vocal de Organizacion</th>
              <th colspan="2">Consejero(A)</th>
              <th colspan="2">Consejero(A)</th>
              <th colspan="2" style="">Consejero(A)</th>
              <th colspan="2"style="">Consejero(A)</th>
              <th colspan="2"style=""><img  src="logos/pan.png" WIDTH="40" HEIGHT="40"></th>
              <th colspan="2"style=""><img  src="logos/pes.png" WIDTH="40" HEIGHT="40"></th>
              <th colspan="2"style=""><img  src="logos/morena.png" WIDTH="40" HEIGHT="40"></th>
              <th colspan="2"style=""><img  src="logos/movimiento.png" WIDTH="40" HEIGHT="40"></th>

              <th colspan="2"style=""><img  src="logos/pnal.png" WIDTH="40" HEIGHT="40"></th>
              <th colspan="2"style=""><img  src="logos/prd.png" WIDTH="40" HEIGHT="40"></th>
              <th colspan="2"style=""><img  src="logos/pri.png" WIDTH="40" HEIGHT="40"></th>
              <th colspan="2"style=""><img  src="logos/pt.png" WIDTH="40" HEIGHT="40"></th>
              <th colspan="2"style=""><img  src="logos/verde.png" WIDTH="40" HEIGHT="40"></th>
              <?php if (isset($pintar)) {
                if ($pintar[42]!=null) {
                  echo'<th colspan="2"style=""><img  src="logos/independiente1.png" WIDTH="40" HEIGHT="40"></th>';
                }
              } ?>


              <?php if (isset($pintar)) {
                if ($pintar[44]!=null) {
                  echo'<th colspan="2"style=""><img  src="logos/independiente2.png" WIDTH="40" HEIGHT="40"></th>';
                }
              } ?>
              <?php if (isset($pintar)) {
                if ($pintar[46]!=null) {
                  echo'<th colspan="2"style=""><img  src="logos/independiente3.png" WIDTH="40" HEIGHT="40"></th>';
                }
              } ?>
              <th>Orden dia</th>
              <th>Proyecto Acta sesion </th>
              <th>Reporte de inasistencia</th>
              <th>Acta aprobada</th>
              <th>Informe</th>
              <th>Acuerdos</th>
              <th>Reporte</th>
              <th>Verificar</th>




          </tr>
      </thead>
      <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Prop</td>
            <td>Supl</td>
            <td>Prop</td>
            <td>Supl</td>
            <td>Prop</td>
            <td>Supl</td>

              <td >Prop</td>
              <td >Supl</td>
              <td >Prop</td>
              <td>Supl</td>


            <td>Prop</td>
            <td>Supl</td>
            <td>Prop</td>
            <td>Supl</td>
            <td>Prop</td>
            <td>Supl</td>
            <td>Prop</td>
            <td>Supl</td>
            <td>Prop</td>
            <td>Supl</td>
            <td>Prop</td>
            <td>Supl</td>
            <td>Prop</td>
            <td>Supl</td>
            <td>Prop</td>
            <td>Supl</td>
            <td>Prop</td>
            <td>Supl</td>
            <td>Prop</td>
            <td>Supl</td>
            <td>Prop</td>
            <td>Supl</td>
            <td>Prop</td>
            <td>Supl</td>
            <?php if (isset($pintar)) {
              if ($pintar[42]!=null) {
                echo'<td>Prop</td>
                <td>Supl</td>';
              }
            } ?>


            <?php if (isset($pintar)) {
              if ($pintar[44]!=null) {
                echo'<td>Prop</td>
                <td>Supl</td>';
              }
            } ?>
            <?php if (isset($pintar)) {
              if ($pintar[46]!=null) {
                echo'<td>Prop</td>
                <td>Supl</td>';
              }
            } ?>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
              <th></th>
              <th></th>
        </tr>
          <?php
          if(isset($_POST["hh"])or $_SESSION["municipio"]!=0){
          while ($fila=mysqli_fetch_row($result)) {
            echo"<tr>";
            foreach ($fila as $key => $value) {
              if (in_array($key,$arr)) {
                if ($value=='1') {
                  echo'<td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';
                }
                if ($value=='0') {
                echo"<td></td>";
                }
              }else{
                if($key=="0"){ $ii=$value;}else {
                  if ($key=="1") {
                    $verif=$value;

                  }else {
                  if ($key=="4") {
                    $date = date_create($value);
                      $value=date_format($date, 'd/m/y');

                      echo'<td><a onclick="modhoras('."'".$fila[5]."'".','."'".$fila[6]."'".','.$fila[0].')"style="text-decoration:none;color:black">'.$value.'</a></td>';

                  }else{


                if ($value=='1') {
                  echo'<td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';
                }else{
                  if ($value=='0') {
                  echo"<td></td>";
                  }else{
                  echo"<td>".utf8_encode($value)."</td>";}}
}}}}

            }
            $sq="SELECT  ordendia,actasesionproyecto, oficioreporte, actaaprobada FROM archivos WHERE id_asis='$ii'";
            $rarch=mysqli_query($connect,$sq);
            $ar=mysqli_fetch_array($rarch);
            foreach ($ar as $keis => $va) {
              if (is_numeric($keis)) {
                unset($ar[$keis]);
              }
            }


                foreach ($ar as $keya => $valuea) {

                  if ($valuea==null) {
                  echo ' <th><button type="button" class="btn btn-default btn-sm" onclick="mostrar('.$ii.','."'".$keya."'".');">
                   <span class="glyphicon glyphicon-open-file"></span>
                   </button></th>';
                 }else{
                //echo '<th><div class="col-sm-1 col-form-label" > <a href="archivos/'.$valuea.'" download class="btn btn-default" ><span class="glyphicon glyphicon-download"></span></a></div></th>';
                 //  echo ' <th><button type="button" class="btn btn-default btn-sm" onclick="mostrar('.$ii.','."'".$keya."'".');">
                 // <span class="glyphicon glyphicon-open-file"></span>
                 //</button></th>';
                 if ($verif==true) {
                   echo'<th><div class="btn-group" role="group">
                   <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Archivo
                    <span class="caret"></span>
                    </button>
                   <ul class="dropdown-menu">
                    <li><a  onclick="modarchi('.$ii.','."'".$keya."'".');">
                     Editar
                     </a></li>
                      <li><a href="archivos/'.$valuea.'" download  >Descargar</a></li>
                    </ul>
                    </div></th>';
                 }else{ echo'<th><div class="btn-group" role="group">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   Archivo
                   <span class="caret"></span>
                   </button>
                  <ul class="dropdown-menu">

                     <li><a href="archivos/'.$valuea.'" download  >Descargar</a></li>
                   </ul>
                   </div></th>';}
                 }



                }
                echo ' <th><button type="button" class="btn btn-default btn-sm" onclick="minfo('.$ii.','.$verif.');">
                 <span class="glyphicon glyphicon-list"></span>
                 </button></th>';
                 echo ' <th><button type="button" class="btn btn-default btn-sm" onclick="anexos('.$ii.','.$verif.');">
                <span class="glyphicon glyphicon-list"></span>
                  </button></th>';
                echo'<th><a href="service/repordoc2.php?n='.$ii.'&i='.$im.'" class="btn btn-danger" >Reporte</a></th>';
                if ($verif==true) {
                  echo ' <th><button type="button" id ="'.$ii.'"class="btn btn-primary" onclick="verificar('.$ii.','.$im.');">Verificar</button></th>';
                }else{  echo ' <th><button type="button" id ="'.$ii.'"class="btn btn-success" >Verificado</button></th>';}


        echo"</tr>";  }}

           ?>

      </tbody>



  </table>
<a href="service/probando2.php" class="btn btn-danger" >Reporte</a>
</div>

  </div>
  </body>
  <!-- Modal subir archivo -->
<div id="archivos" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Subir Archivo</h4>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" id="up" method="post" action="subir.php">
                <input type="text" name="ida" id="ida" value=""style="visibility:hidden">
                <input type="text" name="ca" id="ca"value=""style="visibility:hidden">

                <input  type="file"  id="fichero_usuario" name="fichero_usuario"/>
                <div class="modal-footer">
                   <input type="submit" value="Guardar" form="up"class="btn btn-success">


                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>

      </div>

    </div>

  </div>
</div>
<!-- Modal ANEXOS-->
<div id="anexos" class="modal fade" role="dialog">
<div class="modal-dialog">


  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Subir Acuerdo</h4>
    </div>
    <div class="modal-body">
      <div class="ag_anexos" ></div><br>

      <div class="an">

      </div>
<div id="anexoverif">


      <form enctype="multipart/form-data" id="upanexo" method="post" action="service/subiranexo.php">
              <input type="text" name="ida2" id="ida2" value=""style="visibility:hidden">
              <div style="text-align: center;"><label  for="a_usuario">Subir Acuerdo</label></div>

              <input  type="file"  id="a_usuario" name="a_usuario"/><br>
            <div style="text-align: center;"><label  for="anexo_usuario">Subir Anexo</label></div>

              <input  type="file"  id="anexo_usuario" name="anexo_usuario"/>
              <div class="modal-footer">

                 <input type="submit" value="Guardar" form="upanexo"class="btn btn-success">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </form>
          </div>
    </div>

  </div>

</div>
</div>
<!-- Modal informes-->
<div id="informes" class="modal fade" role="dialog">
<div class="modal-dialog">


  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Subir Informe</h4>
    </div>
    <div class="modal-body">
      <div class="info" ></div>


<div id="inforverif" >


      <form enctype="multipart/form-data" id="upinfome" method="post" action="service/subirinfo.php">
              <input type="text" name="ida3" id="ida3" value=""style="visibility:hidden">
              <div style="text-align: center;"><label  for="a_info">Subir Archivo</label></div>

              <input  type="file"  id="a_info" name="a_info"/><br>
              <div class="modal-footer">

                 <input type="submit" value="Guardar" form="upinfome"class="btn btn-success">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>

          </form>
          </div>
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
      <form enctype="multipart/form-data" id="modarchivo" method="post" action="service/editarch.php">
              <input type="text" name="nombarchivo" id="nombarchivo" value=""style="visibility:hidden">
              <input type="text" name="tablaarchi" id="tablaarchi" value=""style="visibility:hidden">
              <div style="text-align: center;"><label  for="archi_file">Subir Archivo</label></div>

              <input  type="file"  id="archi_file" name="archi_file"/><br>
              <div class="modal-footer">

                 <input type="submit" value="Guardar" form="modarchivo"class="btn btn-success">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>

          </form>
    </div>

  </div>

</div>
</div>
<!-- Modal modificar horas-->
<div id="modhoras" class="modal fade" role="dialog">
<div class="modal-dialog">


  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Editar</h4>
    </div>
    <div class="modal-body">

      <form  action="service/modhora.php" method="post">
          <input type="text" name="idmodhoras" id="idmodhoras" value=""style="visibility:hidden">
        <label for="h_ini" class="col-sm-2 col-form-label ">Hora de Inicio</label>
        <div >
          <input type="text" class="form-control "name="h_ini" id="h_ini" placeholder="Hora de Inicio">
        </div>
        <label for="h_fin" class="col-sm-2 col-form-label ">Hora de Termino</label>
        <div >
          <input type="text" class="form-control "name="h_fin" id="h_fin" placeholder="Hora de Inicio">
        </div>





          </form>
    </div>
    <div class="modal-footer">


        <a onclick="ajmodhoras()"class="btn btn-default">Modificar</a>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>

</div>
</div>
</html>
<script>
$(document).ready(function(){
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


function verificar(id,idmun){
console.log(id);
var arr={};
arr['hh']=6;
var i="#".concat(id);
$.ajax({
  url:"service/ver.php",
  method:"POST",
  data:{id:id},
  cache:"false",
  beforeSend:function(){},
  success:function(data){
    if (data=="1") {
      //$(location).attr('href','ad.php');
      $("#municip").val(idmun);
      $("#iq").submit();
        //window.location.reload();
    }

  }
});

};
function ajmodhoras(){
var idmodhoras=$("#idmodhoras").val();
var h_ini=$("#h_ini").val();
var h_fin=$("#h_fin").val();
$.ajax({
  url:"service/modhora.php",
  method:"POST",
  data:{idmodhoras:idmodhoras,h_ini:h_ini,h_fin:h_fin},
  cache:"false",
  beforeSend:function(){},
  success:function(data){
    if (data=="1") {
      //$(location).attr('href','ad.php');
        $(location).attr('href','ad.php');

        //window.location.reload();
    }

  }
});

};
function modhoras(hini,hfin,id){
    $(".modal-body #idmodhoras").val(id);
    $(".modal-body #h_ini").val(hini);
    $(".modal-body #h_fin").val(hfin);
    console.log(hini);
    console.log(hfin);
    $("#modhoras").modal("show");
  };
function mostrar(val,val1){
  $(".modal-body #ida").val(val);

  $(".modal-body #ca").val(val1);
  $('#archivos').modal("show");

};
function modarchi(archi,ta){
//  $(".modal-body #ida").val(val);

  $(".modal-body #nombarchivo").val(archi);
  $(".modal-body #tablaarchi").val(ta);
  $('#informes').modal("hide");
  $('#anexos').modal("hide");
  $('#modarchivos').modal("show");

};
function minfo(val,verif){
  var verif=verif;
var va=val;
var t="informes";
$(".modal-body #ida3").val(val);
$( ".info" ).empty( );
if (verif==true) {
  $("#inforverif").show();
}else{  $("#inforverif").hide();}

if ($.trim(val).length >0) {
  $.ajax({
    url:"acu.php",
    method:"POST",
    data:{val:val,tab:t},
    cahe:"false",
    beforeSend:function(){
    },
    success:function(data){
      console.log(data);

      $.each( data, function( key, value ) {
        ////////////
            if (verif==true) {
              var ht='<th><div class="btn-group" role="group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Informe<span class="caret"></span></button><ul class="dropdown-menu"><li><a  onclick="modarchi('.concat("'",value,"'",',',"'",'informes',"'",' );"> Editar</a></li><li><a  href="archivos/',value,'" download >Descargar</a></li></ul></div></th>');
            }        else{                                                                                                                                                                                                      //  var ht='<th><a  onclick="modarchi('.concat("'",value,"'",');"> Editar</a></th>');
        var ht='<th><div class="btn-group" role="group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Informe<span class="caret"></span></button><ul class="dropdown-menu"><li><a  href="archivos/'.concat(value,'" download >Descargar</a></li></ul></div></th>');
      } //var h='';
        ////////////
        //var ht='<a  href="archivos/'.concat(value,'" download class="btn btn-default" ><span class="glyphicon glyphicon-download"></span> Infome</a>');
          $( ".info" ).append( ht );
          });
        $('#informes').modal("show");



    }
  });

}
};
function anexos(val,verif){
  var val=val;
  var verif=verif;
  if (verif==true) {
    $("#anexoverif").show();
  }else{  $("#anexoverif").hide();}
  $(".modal-body #ida2").val(val);

  $( ".an" ).empty( );
  $( ".ag_anexos" ).empty( );
  var tab="anexo";
  var tab1="acuerdos";
  if($.trim(val).length >0){
    $.ajax({
      url:"acu.php",
      method:"POST",
      data:{val:val,tab:tab},
      cahe:"false",
      beforeSend:function(){
      },
      success:function(data){
        console.log(data);

        $.each( data, function( key, value ) {
          if (verif==true) {
            var ht='<th><div class="btn-group" role="group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Anexo<span class="caret"></span></button><ul class="dropdown-menu"><li><a  onclick="modarchi('.concat("'",value,"'",',',"'",'anexo',"'",' );"> Editar</a></li><li><a  href="archivos/',value,'" download >Descargar</a></li></ul></div></th>');
          }else{
          var ht='<th><div class="btn-group" role="group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Anexo<span class="caret"></span></button><ul class="dropdown-menu"><li><a  href="archivos/'.concat(value,'" download >Descargar</a></li></ul></div></th>');
        }//var ht='<a  href="archivos/'.concat(value,'" download class="btn btn-default" ><span class="glyphicon glyphicon-download"></span> Anexo</a>');
            $( ".an" ).append( ht );
            });

          $.ajax({
            url:"acu.php",
            method:"POST",
            data:{val:val,tab:tab1},
            cahe:"false",
            beforeSend:function(){
            },
            success:function(data){
              console.log(data);

              $.each( data, function( key, value ) {
                if (verif==true) {
var ht='<th><div class="btn-group" role="group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acuerdo<span class="caret"></span></button><ul class="dropdown-menu"><li><a  onclick="modarchi('.concat("'",value,"'",',',"'",'acuerdo',"'",' );"> Editar</a></li><li><a  href="archivos/',value,'" download >Descargar</a></li></ul></div></th>');
                }else{
                var ht='<th><div class="btn-group" role="group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acuerdo<span class="caret"></span></button><ul class="dropdown-menu"><li><a  href="archivos/'.concat(value,'" download >Descargar</a></li></ul></div></th>');
              }//var ht='<a  href="archivos/'.concat(value,'" download class="btn btn-default" ><span class="glyphicon glyphicon-download"></span> Acuerdo</a>');
                  $( ".ag_anexos" ).append( ht );
                  });
                $('#anexos').modal("show");



            }
          });


      }
    });
  }

};
</script>

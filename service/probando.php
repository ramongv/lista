
<?php

session_start();
$a=4;
if(!isset($_SESSION["user"])){
  header("location: ../login.php");
}else{
  $xarr=['consejero1','consejero2','consesejero3','consejero4'];
  $i=$_SESSION["municipio"];

  $connect = mysqli_connect("localhost","root","","lista");
  //$sql="SELECT * FROM asistencia WHERE id_municipio= $i";
  $sqld="SELECT id_distrito FROM municipios where id='$i'";
  $re=mysqli_query($connect,$sqld);
  $rex=mysqli_fetch_row($re);

  $sql="SELECT asistencia.id,distritos.nombre,municipios.nombre,fecha, h_ini, h_fin,tipo, presidente, presidentesup, secretario, secretariosup, vocalcapacitacion, vocalcapacitacionsup, vocalorganizacion, vocalorganizacionsup, consejero1, consejero1sup, consejero2, consejero2sup, consejero3, consejero3sup, consejero4, consejero4sup,morenatitular,morenasuplente,movimientotitular,movimientosuplente,pantitular,pansuplente,pestitular,pessuplente,pnaltitular,pnalsuplente,prdtitular,prdsuplente,prititular,prisuplente,pttitular,ptsuplente,verdetitular,verdesuplente,independiente1titular,independiente1suplente,independiente2titular,independiente2suplente,independiente3titular,independiente3suplente FROM asistencia, municipios, distritos WHERE asistencia.id_municipio='$i' and municipios.id='$i' and distritos.id='$rex[0]'";
  $result=mysqli_query($connect,$sql);
  }

  header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  				header('Pragma: ');
  				header('Cache-Control: ');
  				header('Content-disposition: attachment; filename="reporte.xls"');

?>




    <h2 style="text-align: center">Tabla de Registros</h2>



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
            <th colspan="2"style="">morena</th>
            <th colspan="2"style="">movimiento ciudadano</th>
            <th colspan="2"style="">PAN</th>
            <th colspan="2"style="">Encuento Social</th>
            <th colspan="2"style="">Nueva Alianza</th>
            <th colspan="2"style="">PRD</th>
            <th colspan="2"style="">PRI</th>
            <th colspan="2"style="">PT</th>
            <th colspan="2"style="">Verde</th>
            <th colspan="2"style="">Independiente1</th>
            <th colspan="2"style="">Independiente2</th>
            <th colspan="2"style="">Independiente3</th>





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
            <td>Prop</td>
            <td>Supl</td>
            <td>Prop</td>
            <td>Supl</td>
            <td>Prop</td>
            <td>Supl</td>

        </tr>

	        </tr>
          <?php
          while ($fila=mysqli_fetch_row($result)) {
            echo"<tr>";
            foreach ($fila as $key => $value) {

                if($key=="0"){ $ii=$value;}else {
                  if ($key=="3") {
                    $date = date_create($value);
                    $value=date_format($date, 'd/m/y');


                  }


                if ($value=='1') {
                  echo'<td>&#10003;</td>';
                }else{
                  if ($value=='0') {
                  echo"<td></td>";
                  }else{
                  echo"<td>".$value."</td>";}}
}

            }


        echo"</tr>";  }

           ?>

	    </tbody>



	</table>

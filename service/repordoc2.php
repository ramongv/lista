<?php
require('../lib/fpdf.php');
$i=$_GET["i"];
$n=$_GET["n"];
$connect = mysqli_connect("localhost","root","","lista");
$sqla="SELECT * FROM asistencia where id=$n";
$ress=mysqli_query($connect,$sqla);
$sql="SELECT * FROM consejeros WHERE id_municipio=$i";
$result=mysqli_query($connect,$sql);
$data=mysqli_fetch_array($result);
$dataa=mysqli_fetch_array($ress);
$sql2="SELECT * FROM partido where id_municipio=$i";
$resultado=mysqli_query($connect,$sql2);
$xarr=['consejero1','consejero2','consesejero3','consejero4'];
$axrs=['consejero1sup','consejero2sup','consejero3sup','consejero4sup'];
foreach ($data as $key => $value) {
  if (is_numeric($key)or $key=="id" or $key=="id_municipio" or $value==null) {
    unset($data[$key]);
  }
}
$date = date_create($dataa["fecha"]);
$x=date_format($date, 'd/m/y');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetTitle('Reporte de Asistencia');
$pdf->SetFont('Arial','B',20);
$pdf->Cell(200,10,utf8_decode('Reporte de Asistencia'),0,2,'C');
$pdf->ln(25);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(60,10,strtoupper("fecha"),0,'L');
$pdf->Cell(60,10,$x,0,1,'L');
$pdf->Cell(60,10,strtoupper("hora de inicio"),0,'L');
$pdf->Cell(60,10,$dataa["h_ini"],0,1,'L');
$pdf->Cell(60,10,strtoupper("Hora de termino"),0,'L');
$pdf->Cell(60,10,$dataa["h_fin"],0,1,'L');
foreach ($data as $key => $value) {
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
  }elseif ($key=="vocalcapacitacion") {
    $aux="vocal capacitacion";
  }elseif ($key=="vocalorganizacion") {
    $aux="vocal organizacion";
  }
  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(60,10,strtoupper($aux),0,'L');
  $pdf->Cell(60,10,utf8_decode($value),0,'L');
  if ($dataa[$key]==1) {
    $pdf->SetFont('ZapfDingbats','',7);
    $pdf->Cell(60,10,chr(51),0,'L');
    $pdf->ln(7);

  }else {
    $pdf->SetFont('Symbol','',7);
    $pdf->Cell(60,10,chr(45),0,'L');
    $pdf->ln(7);
  }

}
while ($fila=mysqli_fetch_row($resultado)) {
  $indice=$fila[1].'titular';
  $indice2=$fila[1].'suplente';

$pdf->SetFont('Arial','B',7);
  $pdf->Cell(60,10,strtoupper($fila[1]." titular"),0,'L');
  $pdf->Cell(60,10,utf8_decode($fila[5]),0,'L');
  if ($dataa[$indice]==1) {
    $pdf->SetFont('ZapfDingbats','',7);
    $pdf->Cell(60,10,chr(51),0,'L');
    $pdf->ln(7);
  }else{$pdf->SetFont('Symbol','',7);
  $pdf->Cell(60,10,chr(45),0,'L');
  $pdf->ln(7);}
  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(60,10,strtoupper($fila[1]." suplente"),0,'L');
  $pdf->Cell(60,10,utf8_decode($fila[6]),0,'L');
  if ($dataa[$indice2]==1) {
    $pdf->SetFont('ZapfDingbats','',7);
    $pdf->Cell(60,10,chr(51),0,'L');
    $pdf->ln(7);
  }else{$pdf->SetFont('Symbol','',7);
  $pdf->Cell(60,10,chr(45),0,'L');
  $pdf->ln(7);}


   }

$pdf->Output('Reporteasistencia.pdf', 'D');

?>

<?php
session_start();
$i=$_SESSION["municipio"];
$k="";
$v="";
$s=1;
foreach($_POST as $campo => $valor){
if ($s==1) {
  $k=$k.$campo;
  $v=$v.$valor;
  $s=0;
}else{
$k=$k.",".$campo;
$v=$v.",".$valor;
};
};
$connect = mysqli_connect("localhost","root","","lista");
$sqls="SELECT id_distrito FROM municipios WHERE id=$i";
$results = mysqli_query($connect, $sqls);
$num_row = mysqli_num_rows($results);
if ($num_row == "1") {
  $datas = mysqli_fetch_array($results);
$datax=$datas["id_distrito"];
}
$sql="INSERT INTO asistencia(id_distrito,id_municipio,".$k.") VALUES ('$datax','$i',".$v.")";

$result = mysqli_query($connect, $sql);
$id=mysqli_insert_id($connect);
if($result){
  $sql2="INSERT INTO archivos(id_asis) VALUES ('$id')";
  $resulta = mysqli_query($connect, $sql2);
  $data=$result;
    echo "1";
}else {
  echo$result;
}
?>

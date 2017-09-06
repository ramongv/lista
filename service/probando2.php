<?php
session_start();
$connect = mysqli_connect("localhost","root","","lista");
$xarr=['consejero1','consejero2','consesejero3','consejero4'];
$i=$_SESSION["municipio"];
//$sql="SELECT * FROM asistencia WHERE id_municipio= $i";
$sqld="SELECT id_distrito FROM municipios where id='$i'";
$re=mysqli_query($connect,$sqld);
$rex=mysqli_fetch_row($re);

$sql="SELECT asistencia.id,distritos.nombre,municipios.nombre,fecha, h_ini, h_fin,tipo, presidente, presidentesup, secretario, secretariosup, vocalcapacitacion, vocalcapacitacionsup, vocalorganizacion, vocalorganizacionsup, consejero1, consejero1sup, consejero2, consejero2sup, consejero3, consejero3sup, consejero4, consejero4sup,morenatitular,morenasuplente,movimientotitular,movimientosuplente,pantitular,pansuplente,pestitular,pessuplente,pnaltitular,pnalsuplente,prdtitular,prdsuplente,prititular,prisuplente,pttitular,ptsuplente,verdetitular,verdesuplente,independiente1titular,independiente1suplente,independiente2titular,independiente2suplente,independiente3titular,independiente3suplente FROM asistencia, municipios, distritos WHERE asistencia.id_municipio='$i' and municipios.id='$i' and distritos.id='$rex[0]'";
$result=mysqli_query($connect,$sql);
	if($result->num_rows > 0 ){

		date_default_timezone_set('America/Mexico_City');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once '../lib/PHPExcel/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Codedrinks") //Autor
							 ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel con PHP y MySQL")
							 ->setSubject("Reporte Excel con PHP y MySQL")
							 ->setDescription("Reporte")
							 ->setKeywords("reporte ")
							 ->setCategory("Reporte excel");

		$tituloReporte = "Reporte";
    $titulosColumnas = array('Distrito',	'Municipio',	'fecha'	,'Hora de Inicio'	,'Hora de Termino',	'Tipo',	'Consejero(A) Presidente',		'Secretario(A)'		,'Vocal de Capacitacion'	,	'Vocal de Organizacion'	,	'Consejero(A)'	,	'Consejero(A)'	,	'Consejero(A)',		'Consejero(A)',		'morena'	,	'movimiento ciudadano'	,	'PAN'		,'Encuento Social',		'Nueva Alianza'	,	'PRD'		,'PRI'	,	'PT'	,	'Verde','independiente1','independiente2','independiente3');
    $filas=array('A','B','C','D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X','Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT');
		$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('K1',$tituloReporte)
        		    ->mergeCells('K1:L1');

		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A3',  $titulosColumnas[0])
		            ->setCellValue('B3',  $titulosColumnas[1])
        		    ->setCellValue('C3',  $titulosColumnas[2])
                ->setCellValue('D3',  $titulosColumnas[3])
		            ->setCellValue('E3',  $titulosColumnas[4])
        		    ->setCellValue('F3',  $titulosColumnas[5])
                ->setCellValue('G3',  $titulosColumnas[6])
		            ->setCellValue('I3',  $titulosColumnas[7])
        		    ->setCellValue('K3',  $titulosColumnas[8])
                ->setCellValue('M3',  $titulosColumnas[9])
		            ->setCellValue('O3',  $titulosColumnas[10])
        		    ->setCellValue('Q3',  $titulosColumnas[11])
                ->setCellValue('S3',  $titulosColumnas[12])
                ->setCellValue('U3',  $titulosColumnas[13])
                ->setCellValue('W3',  $titulosColumnas[14])
               ->setCellValue('Y3',  $titulosColumnas[15])
               ->setCellValue('AA3',  $titulosColumnas[16])
                ->setCellValue('AC3',  $titulosColumnas[17])
                ->setCellValue('AE3',  $titulosColumnas[18])
                ->setCellValue('AG3',  $titulosColumnas[19])
               ->setCellValue('AI3',  $titulosColumnas[20])
               ->setCellValue('AK3',  $titulosColumnas[21])
               ->setCellValue('AM3',  $titulosColumnas[22])
               ->setCellValue('AO3',  $titulosColumnas[23])
              ->setCellValue('AQ3',  $titulosColumnas[24])
              ->setCellValue('AS3',  $titulosColumnas[25]);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('G3:H3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I3:J3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('K3:L3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('M3:N3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O3:P3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('Q3:R3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('S3:T3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('U3:V3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('W3:X3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('Y3:Z3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('AA3:AB3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('AC3:AD3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('AE3:AF3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('AG3:AH3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('AI3:AJ3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('AK3:AL3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('AM3:AN3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('AO3:AP3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('AQ3:AR3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('AS3:AT3');



		//Se agregan los datos de los alumnos

		for ($i=6; $i <=44 ; $i=$i+2) {
			$objPHPExcel->setActiveSheetIndex(0)
									->setCellValue($filas[$i].'4',  'Prop')
									->setCellValue($filas[$i+1].'4',  'Supl');
		}

/*foreach ($filas as $key => $value) {
	////////
	$objPHPExcel->getActiveSheet()->getStyle("A4")->getFont()->setBold(true)
	                                ->setName('Wingdings 2');
$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A4',  'P');
						//////////////


}*/
$i=5;
while ($fila=mysqli_fetch_row($result)) {

	foreach ($fila as $key => $value) {

			if($key=="0"){ }else {
				if ($key=="3") {
					$date = date_create($value);
					$value=date_format($date, 'd/m/y');
					$objPHPExcel->setActiveSheetIndex(0)
											->setCellValue($filas[$key-1].$i,  $value);

				}


			if ($value=='1') {
				$objPHPExcel->getActiveSheet()->getStyle($filas[$key-1].$i)->getFont()->setBold(true)
				                                ->setName('Wingdings 2');
			$objPHPExcel->setActiveSheetIndex(0)
									->setCellValue($filas[$key-1].$i,  'P');
			}else{
				if ($value=='0') {

				}else{$objPHPExcel->setActiveSheetIndex(0)
										->setCellValue($filas[$key-1].$i, $value);
					}}
}

	}

$i++;
  }
		/*$estiloTituloReporte = array(
        	'font' => array(
	        	'name'      => 'Verdana',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>16,
	            	'color'     => array(
    	            	'rgb' => 'FFFFFF'
        	       	)
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => 'FF220835')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE
               	)
            ),
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
			);*/

		/*$estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,
                'color'     => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
				'rotation'   => 90,
        		'startcolor' => array(
            		'rgb' => 'c47cf2'
        		),
        		'endcolor'   => array(
            		'argb' => 'FF431a5d'
        		)
			),
            'borders' => array(
            	'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                )
            ),
			'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'wrap'          => TRUE
    		));*/






		for($i = 'A'; $i <= 'F'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)
				->getColumnDimension($i)->setAutoSize(TRUE);
		}


		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Reporte');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Reporte.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;

	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>

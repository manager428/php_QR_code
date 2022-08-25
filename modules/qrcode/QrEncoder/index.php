<?php    
	function output_json_headers() {

		header('Content-type: application/json');
		header('Cache-Control: no-cache, must-revalidate');
	}
	
	//set it to writable location, a place for temp generated PNG files
	//$PNG_TEMP_DIR = $_SERVER['DOCUMENT_ROOT'].'/images/qr_images'.DIRECTORY_SEPARATOR;
	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'../../../uploads/qr_images'.DIRECTORY_SEPARATOR;
	//html PNG location prefix
	$PNG_WEB_DIR = './uploads/qr_images/';

	include "qrlib.php";    
	
	//ofcourse we need rights to create temp dir
	if (!file_exists($PNG_TEMP_DIR)){
		mkdir($PNG_TEMP_DIR);
	}

	$filename = 'assets/img/empty.png';

	//processing form input
	//remember to sanitize user input in real-life solution !!!
	$errorCorrectionLevel = 'L';
	if (isset($_POST['level']) && in_array($_POST['level'], array('L','M','Q','H')))
		$errorCorrectionLevel = $_POST['level'];    
	$matrixPointSize = 4;
	if (isset($_POST['size']))
		$matrixPointSize = min(max((int)$_POST['size'], 1), 10);

	output_json_headers();
	
	if (isset($_POST['full_name']) || isset($_POST['number_pax']) || isset($_POST['car_plate']) || isset($_POST['car_model']) || isset($_POST['check_in']) || isset($_POST['check_out']) || isset($_POST['visit_reason']) || isset($_POST['address']) || isset($_POST['hostname'])) { 
	
		//it's very important!
		if (empty($_POST['full_name']) && empty($_POST['number_pax']) && empty($_POST['car_plate']) && empty($_POST['car_model']) && empty($_POST['check_in']) && empty($_POST['check_out']) && empty($_POST['visit_reason']) && empty($_POST['address']) && empty($_POST['hostname'])){
			$response = array(
				'error' => '1',
				'message' => '¡Los datos QR no pueden estar vacíos!',
				'img_link' => 'assets/img/empty.png'
			);
			echo json_encode($response);
			exit;
		}
			
		$qr_data = "Visitas: " . $_POST['full_name'] . "\n" . "Número de personas: " . $_POST['number_pax'] . "\n" . "Placas: " . $_POST['car_plate'] . "\n" . "Modelo del auto: " . $_POST['car_model'] . "\n" . "Entrada: " . $_POST['check_in'] . "\n" . "Salida: " . $_POST['check_out'] . "\n" . "Visita tipo o motivo: " . $_POST['visit_reason'] . "\n" . "Dirección a donde se dirige: " . $_POST['address'] . "\n" . "Nombre del anfitrión: " . $_POST['hostname'];
		// user data
		$filename = $PNG_TEMP_DIR.'QR'.md5($qr_data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';

		QRcode::png($qr_data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
		
		$response = array(
			'success' => '1',
			'message' => 'Su código QR está listo, ¡Gracias por utilizar nuestro sistema!',
			'img_link' => $PNG_WEB_DIR.basename($filename)
		);
		echo json_encode($response); 
		
	} else {    
	
		//it's very important!
		$response = array(
			'error' => '1',
			'message' => '¡Los datos QR no pueden estar vacíos!',
			'img_link' => 'assets/img/empty.png'
		);
		echo json_encode($response);
		exit;
		
	}    
		
	// benchmark
	//QRtools::timeBenchmark();
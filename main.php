<?php 
	require_once('TCPDF/tcpdf.php');

	$template_path; 
	$csv_path; 

	for ($i = 0; $i < count($argv); $i++) 
	{ 
		if($argv[$i] == "-t")
			$template_path = $argv[$i+1];
		elseif($argv[$i] == "-c")
			$csv_path = $argv[$i+1];
	}

	if(isset($template_path) && isset($csv_path))
		echo "setou\n";	
	else
		echo "nao setou\n";
		// throw new Exception('Insert the needed files.');

		
	// try {
	// 	echo $template_path."\n";
	// 	echo $csv_path."\n";
	// } catch (Exception $e) {
	//     echo 'Exceção capturada: ',  $e->getMessage(), "\n";
	// }


	// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

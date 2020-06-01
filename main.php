<?php 
	
	require_once('TCPDF/tcpdf.php');
	
	$columns = [];

	for ($i = 0; $i < count($argv); $i++) 
	{ 
		if($argv[$i] == "-t") 
			$template_path = $argv[$i+1];
		elseif($argv[$i] == "-f") 
			$csv_path = $argv[$i+1];
		elseif($argv[$i] == "-corder") 
			$columns = $argv[$i+1];
		elseif($argv[$i] == "-p") 
			echo "position";
		elseif($argv[$i] == "-m") 
			$GLOBALS['message'] = $argv[$i+1];
		elseif($argv[$i] == "-d") 
			echo "destino output";
		elseif($argv[$i] == "-w") 
			$GLOBALS['w'] = $argv[$i+1];
		elseif($argv[$i] == "-h") 
			$GLOBALS['h'] = $argv[$i+1];
		elseif($argv[$i] == "-x") 
			$GLOBALS['x'] = $argv[$i+1];
		elseif($argv[$i] == "-y") 
			$GLOBALS['y'] = $argv[$i+1];
	}


	$columns = array_map('intval', str_split($columns));


	function message($values)
	{
		$i = 0;
		$message = explode("$", $GLOBALS['message']);
		while($i < count($values)){
			$message[$i] = $message[$i].$values[$i];  
			$i++;
		}
		return implode("", $message);
	}
	
	function makePdf($message=''){
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(0, 0, 0, true);
		$pdf->SetAutoPageBreak(false, 0);
		$pdf->AddPage('LANDSCAPE', 'P', 'A4');
		$pdf->Image('template.jpg', 0, 0, 400, 300, 'JPG', '', '', true, 200, '', false, false, 0, false, false, true);
		$pdf->writeHTMLCell($GLOBALS['w'], $GLOBALS['h'], $GLOBALS['x'], $GLOBALS['y'], $message);
		$pdf->Output(dirname(__FILE__).'/example.pdf', 'F');
	}

	function readCsv($filename="", $columns)
	{
		//https://stackoverflow.com/questions/9139202/how-to-parse-a-csv-file-using-php
		$row = 1;
		$values = array();
		if (($handle = fopen($filename, "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		    $row++;
		    for ($c=0; $c < count($columns); $c++){
		    	array_push($values, $data[$columns[$c]]);
		  	}
		  	makePdf(message($values));
			$values = array();
		  }
		  fclose($handle);
		}
	}

	readCsv($csv_path, $columns);




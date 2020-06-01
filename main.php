<?php 
	
	require_once('TCPDF/tcpdf.php');
	
	global $message;
	//global = 	$columns;
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
			$message = $argv[$i+1];
		elseif($argv[$i] == "-d") 
			echo "destino output";
	}

	$columns = array_map('intval', str_split($columns));


	function message($message, $values)
	{
		$i = 0;
		$message = explode("$", $message);
		while($i < count($values)){
			$message[$i] = $message[$i]." ".$values[$i];  
			$i++;
		}

		return implode(" ", $message);
	}
	
	function makePdf($message=''){
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(0, 0, 0, true);
		$pdf->SetAutoPageBreak(false, 0);
		$pdf->AddPage('LANDSCAPE', 'P', 'A4');
		$pdf->Image('template.jpg', 0, 0, 400, 300, 'JPG', '', '', true, 200, '', false, false, 0, false, false, true);
		$html = '<span style="background-color:yellow;color:blue;padding: 800px;">&nbsp;'.$message.'2&nbsp;</span>';
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output(dirname(__FILE__).'/example.pdf', 'F');
	}

	function readCsv($filename="", $columns, $message)
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
		  	makePdf(message($message, $values));
			$values = array();
		  }
		  fclose($handle);
		}
	}



	readCsv($csv_path, $columns, $message);




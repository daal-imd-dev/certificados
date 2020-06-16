<?php 
	
	require_once('TCPDF/tcpdf.php');
	include('mail.php');
	

	function readParams(){
		for ($i = 0; $i < count($argv); $i++) 
		{ 
			if($argv[$i] == "-t") 
				$GLOBALS['template'] = $argv[$i+1];
			elseif($argv[$i] == "-f") 
				$GLOBALS['csv_path'] = $argv[$i+1];
			elseif($argv[$i] == "-corder") 
				$GLOBALS['columns'] = $argv[$i+1];
			elseif($argv[$i] == "-m") 
				$GLOBALS['message'] = $argv[$i+1];
			elseif($argv[$i] == "-d") 
				$GLOBALS['destine_path'] = $argv[$i+1];
			elseif($argv[$i] == "-w") 
				$GLOBALS['w'] = $argv[$i+1];
			elseif($argv[$i] == "-h") 
				$GLOBALS['h'] = $argv[$i+1];
			elseif($argv[$i] == "-x") 
				$GLOBALS['x'] = $argv[$i+1];
			elseif($argv[$i] == "-y") 
				$GLOBALS['y'] = $argv[$i+1];
			elseif($argv[$i] == "-o") 
				$GLOBALS['o'] = intval($argv[$i+1]);
		}

		$GLOBALS['columns'] = array_map('intval', str_split($GLOBALS['columns']));
	}


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
	
	function makePdf($message='', $new_file_name=''){
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(0, 0, 0, true);
		$pdf->SetAutoPageBreak(false, 0);
		$pdf->AddPage('LANDSCAPE', 'P', 'A4');
		$pdf->Image($GLOBALS['template'], 0, 0, 400, 300, 'JPG', '', '', true, 200, '', false, false, 0, false, false, true);
		$pdf->writeHTMLCell($GLOBALS['w'], $GLOBALS['h'], $GLOBALS['x'], $GLOBALS['y'], $message);
		$pdf->Output($GLOBALS['destine_path'].'/'.$new_file_name.'.pdf', 'F');
	}

	function readCsv()
	{
		$row = 1;
		$values = array();
		if (($handle = fopen($GLOBALS['csv_path'], "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		    $row++;
		    for ($c=0; $c < count($GLOBALS['columns']); $c++){
		    	array_push($values, $data[$GLOBALS['columns'][$c]]);
		  	}
		  	makePdf(message($values), $data[$GLOBALS['o']]);
		  	$email = $data[$GLOBALS['email_index']];
		  	$name = $data[$GLOBALS['name_index']];
		  	send_email($email, $name);
			$values = array();
		  }
		  fclose($handle);
		}
	}

	




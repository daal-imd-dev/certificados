<?php 
	
	require_once('TCPDF/tcpdf.php');
	

	function readParams($argv){
		for ($i = 0; $i < count($argv); $i++) 
		{ 
			if($argv[$i] == "-t") 
				$GLOBALS['template'] = explode(",", $argv[$i+1]);
			elseif($argv[$i] == "-f") 
				$GLOBALS['csv_path'] = explode(",", $argv[$i+1]);
			elseif($argv[$i] == "-corder") 
				$GLOBALS['columns'] = $argv[$i+1];
			elseif($argv[$i] == "-m") 
				$GLOBALS['message'] = file_get_contents($argv[$i+1]);
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
			elseif($argv[$i] == "-e") 
				$GLOBALS['email_index'] = intval($argv[$i+1]);
			elseif($argv[$i] == "-n") 
				$GLOBALS['name_index'] = intval($argv[$i+1]);
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
	
	function makePdf($message='', $new_file_name='', $template=''){
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(0, 0, 0, true);
		$pdf->SetAutoPageBreak(false, 0);
		$pdf->AddPage('LANDSCAPE', 'P', 'A4');
		$pdf->Image($template, 0, 0, 400, 300, 'JPG', '', '', true, 200, '', false, false, 0, false, false, true);
		$pdf->writeHTMLCell($GLOBALS['w'], $GLOBALS['h'], $GLOBALS['x'], $GLOBALS['y'], $message);
		$pdf->Output($GLOBALS['destine_path'].'/'.$new_file_name.'.pdf', 'F');
	}

	function readCsv()
	{

		$values = array();
		foreach ($GLOBALS['csv_path'] as $key => $csv) {
			if (($handle = fopen(trim($csv), "r")) !== FALSE) {
			  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			 
			    for ($c=0; $c < count($GLOBALS['columns']); $c++)
			    	array_push($values, $data[$GLOBALS['columns'][$c]]);

			  	$email = $data[$GLOBALS['email_index']];
			  	$name = $data[$GLOBALS['name_index']];
			  	$template = trim($GLOBALS['template'][$key]);
			  	$filename = $email."#".$name;

			  	makePdf(message($values), $filename, $template);
				$values = array();
			  }
			  fclose($handle);
			}
		}	

	}

	




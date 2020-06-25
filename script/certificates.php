<?php 
	
	require_once('TCPDF/tcpdf.php');
	
	function readParams($argv){
		for ($i = 0; $i < count($argv); $i++){ 
			if($argv[$i] == "-t") 
				define('TEMPLATES', $argv[$i+1]);
			elseif($argv[$i] == "-f") 
				define('CSVS', $argv[$i+1]);
			elseif($argv[$i] == "-corder") 
				define('COLUMNS', $argv[$i+1]);
			elseif($argv[$i] == "-m") 
				define('MESSAGE', file_get_contents($argv[$i+1]));
			elseif($argv[$i] == "-d") 
				define('DESTINE', $argv[$i+1]."/");
			elseif($argv[$i] == "-w") 
				define('W', $argv[$i+1]);
			elseif($argv[$i] == "-h") 
				define('H', $argv[$i+1]);
			elseif($argv[$i] == "-x") 
				define('X', $argv[$i+1]);
			elseif($argv[$i] == "-y") 
				define('Y', $argv[$i+1]);
			elseif($argv[$i] == "-e") 
				define('EMAIL_COL', intval($argv[$i+1]));
			elseif($argv[$i] == "-n") 
				define('NAME_COL', intval($argv[$i+1]));
			elseif($argv[$i] == "-em") 
				define('EMAIL_TITLE', $argv[$i+1]);
			elseif($argv[$i] == "-et") 
				define('EMAIL_TEMPLATE', $argv[$i+1]);
		}
	}

	function message($values){
		$i = 0;
		$message = explode("$", MESSAGE);
		
		while($i < count($values)){
			$message[$i] = $message[$i].$values[$i];  
			$i++;
		}

		return implode("", $message);
	}
	
	function makePdf($message='', $file_name='', $template=''){
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetMargins(0, 0, 0, true);
		$pdf->SetAutoPageBreak(false, 0);
		$pdf->AddPage('LANDSCAPE', 'P', 'A4');
		$pdf->Image($template, 0, 0, 400, 300, 'JPG', '', '', true, 200, '', false, false, 0, false, false, true);
		$pdf->writeHTMLCell(W, H, X, Y, $message);
		$pdf->Output(DESTINE.utf8_encode($file_name).".pdf", 'F');
	}

	function readCsv(){
		$content = array();
		$columns = array_map('intval', str_split(COLUMNS));
		$csvs = explode(",", CSVS);
		$templates = explode(",", TEMPLATES);

		foreach ($csvs as $key => $csv){
			if (($handle = fopen(trim($csv), "r")) !== FALSE){
			  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
			 
			    for ($c=0; $c < count($columns); $c++)
			    	array_push($content, $data[$columns[$c]]);
			  
			    $file_name = $data[EMAIL_COL]."#".$data[NAME_COL];
			  	makePdf(message($content), $file_name, trim($templates[$key]));
				$content = array();
			  }
			  fclose($handle);
			}
		}	
	}

	




<?php 

	require_once('TCPDF/tcpdf.php');

	for ($i = 0; $i < count($argv); $i++) 
	{ 
		if($argv[$i] == "-t") 
			$template_path = $argv[$i+1];
		elseif($argv[$i] == "-f") 
			$csv_path = $argv[$i+1];
		elseif($argv[$i] == "-cname") 
			$name_column = $argv[$i+1];
		elseif($argv[$i] == "-p") 
			echo "position";
		elseif($argv[$i] == "-d") 
			echo "destine output";
	}


	function readCsv($filename="")
	{
		//https://stackoverflow.com/questions/9139202/how-to-parse-a-csv-file-using-php
		$row = 1;
		if (($handle = fopen($filename, "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		    $num = count($data);
		    $row++;
		    for ($c=0; $c < $num; $c++) {
		        echo $data[$c] . "\n";
		    }
		  }
		  fclose($handle);
		}
	}

	readCsv($csv_path);
	// throw new Exception('Insert the needed files.');
	// try {
	// 	echo $template_path."\n";
	// 	echo $csv_path."\n";
	// } catch (Exception $e) {
	//     echo 'Exceção capturada: ',  $e->getMessage(), "\n";
	// }

	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


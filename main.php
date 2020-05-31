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
		echo var_dump(strpos($message, "$"));
		echo $message."\n";
		$message = substr_replace($message, $values[$i], strpos($message, "$"), strlen($values[$i]));
		// while(strpos($message, "$")){
			// $i++;
		// }
		echo $message."\n";

		return $message;
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
		    	// echo $data[$columns[$c]]."\n";
		    	array_push($values, $data[$columns[$c]]);
		  	}
		  	message($message, $values);
			$values = array();
		  }
		  fclose($handle);
		}
	}

	readCsv($csv_path, $columns, $message);

	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


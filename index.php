<?php
	
	require __DIR__.'/vendor/autoload.php';	
	include('config.php');
	include('script/mail.php');
	include('script/certificates.php');

	readParams($argv);
	readCsv();
		
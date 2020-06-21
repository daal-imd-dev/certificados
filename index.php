<?php
	
	include('config.php');
	

	readParams($argv);
	readCsv();
	send_emails();
		
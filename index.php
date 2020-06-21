<h1>aaaaaa</h1>
<?php
	
	include('config.php');
	include('script/mail.php');
	include('script/certificates.php');

	readParams($argv);
	readCsv();
	send_emails();
	

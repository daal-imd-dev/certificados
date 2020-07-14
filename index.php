<?php
	
	include('config.php');
	include('script/mail.php');
	include('script/certificates.php');

	readParams($argv);
	readCsv();
	// send_emails_debug(SENDER_EMAIL, EMAIL_TITLE, EMAIL_TEMPLATE);
	send_emails(SENDER_EMAIL, EMAIL_TITLE, EMAIL_TEMPLATE);
	

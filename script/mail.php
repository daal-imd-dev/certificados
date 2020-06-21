<?php 
	
	use PHPMailer\PHPMailer\PHPMailer;

	$mail = new PHPMailer();

	// // Settings
	// $mail->IsSMTP();
	// $mail->CharSet = 'UTF-8';

	// $mail->Host       = "mail.example.com"; // SMTP server example
	// $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
	// $mail->SMTPAuth   = true;                  // enable SMTP authentication
	// $mail->Port       = 25;                    // set the SMTP port for the GMAIL server
	// $mail->Username   = SENDER_EMAIL; // SMTP account username example
	// $mail->Password   = SENDER_PASS;        // SMTP account password example

	function send_email(){
		echo "aaaaaaaaaaaaaaaa";
		// // $mail->isHTML(true);                                  // Set email format to HTML
		// // $mail->Subject = 'Here is the subject';
		// // $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
		// // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		// foreach ($emails as $email) {
		// 	$mail->addAddress($email, $name);		
		// 	$mail->send();
		// }
	}
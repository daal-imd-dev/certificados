<?php 
	
	function get_files(){
		$files = scandir(DESTINE);
		array_splice($files, 0, 2);
		return $files;
	}

	function send_emails($from="", $title="", $body_file=""){

		global $mail;

		$files = get_files();
		$file_name = explode("#",$files[0]);
		$email = $file_name[0];
		$next = current($files);
		
		$mail->Subject = $title." - ".$email[0];
		$mail->Body    = file_get_contents($body_file);
		$mail->SetFrom($from);
		$mail->Username = SENDER_EMAIL;


		foreach ($files as $file) {

			$file_name = $file;
			$file = explode("#", $file);
			$email = $file[0];

			$new_file_name = utf8_decode($file[1]);
			$mail->addAttachment(DESTINE.$file_name, $new_file_name);
			$next = next($files);

			if (strpos($next, $email) === false OR $next === false){
				$mail->addAddress(TEST_EMAIL);		
				$mail->send();		
				$mail->ClearAllRecipients(); 
				$mail->clearAttachments();
			}
		}
	}


	function send_emails_debug($from="", $title="", $body_file=""){
		$files = get_files();
		$file_name = $files[0];
		$email = explode("#",$files[0]);
		$new_file_name = $email[1];
		$email = $email[0];
		
		global $mail;
		
		$mail->Subject = $title;
		$mail->Body    = file_get_contents($body_file);
		$mail->SetFrom($from);
		$mail->Username = SENDER_EMAIL;
		$mail->addAddress(TEST_EMAIL);
		$mail->addAttachment(DESTINE.$file_name, $new_file_name);
		echo var_dump($mail);
		$mail->send() ? "enviado" : $mail->ErrorInfo;
	}


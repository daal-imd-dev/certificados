<?php 
	
	function get_files(){
		$files = scandir(DESTINE);
		array_splice($files, 0, 2);
		return $files;
	}

	function send_emails($from="", $title="", $body_file=""){
		$files = get_files();
		$email = explode("#",$files[0]);
		$email = $email[0];
		
		global $mail;
		
		$mail->Subject = $title;
		$mail->Body    = file_get_contents($body_file);
		$mail->SetFrom($from);
		$mail->Username = SENDER_EMAIL;

		foreach ($files as $file) {
			$file_name = $file;
			$file = explode("#", $file);
			$current_email = $file[0];

			$new_file_name = $file[1]; 
			if ($email == $current_email){
				echo ">>>>>>>>>>>>> nao mandou";	
				$mail->addAttachment($file_name, $new_file_name);
				continue; 
			}else{
				$mail->send();		
				$email = $current_email;
				$mail->ClearAllRecipients(); 
				$mail->clearAttachments();
				// $mail->addAddress($email, 'Joe User');	
				echo ">>>>>>>>>>>>> mandou";	
				echo var_dump($mail);
				$mail->addAddress(TEST_EMAIL);		
				$mail->addAttachment(DESTINE.$file_name, $new_file_name);    
			}	
		}
	}


	function send_emails_debug($from="", $title="", $body_file=""){
		$files = get_files();
		$email = explode("#",$files[0]);
		$email = $email[0];
		
		global $mail;
		
		$mail->Subject = $title;
		$mail->Body    = file_get_contents($body_file);
		$mail->SetFrom($from);
		$mail->Username = SENDER_EMAIL;
		$mail->addAddress(TEST_EMAIL);
		// $mail->addAttachment(DESTINE.$file_name, $new_file_name);
		echo var_dump($mail);
		$mail->send() ? "enviado" : $mail->ErrorInfo;
	}


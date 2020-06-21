<?php 
	
	function get_files(){
		$files = scandir(DESTINE);
		array_splice($files, 0, 2);
		return $files;
	}

	function send_emails(){
		$files = get_files();
		$email = explode("#", $files[0]);
		$email = $email[0];
		
		global $mail;
		
		$mail->Subject = 'Here is the subject';
		$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail';

		foreach ($files as $file) {
			$file_name = $file;
			$file = explode("#", $file);
			$current_email = $file[0];
			$new_file_name = $file[1]; 
			// echo $email." - ".$file_name."\n";
			
			if ($email == $current_email){
				$mail->addAttachment($file_name, $new_file_name);
				// echo "não mandou\n";   
				continue; 
			}else{
				// echo "mandou\n";
				$mail->send();		
				$email = $current_email;
				$mail->ClearAllRecipients(); 
				$mail->clearAttachments();
				$mail->addAddress($email, 'Joe User');		
				$mail->addAttachment($file_name, $new_file_name);    
			}	
		}
	}


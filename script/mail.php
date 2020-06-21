<?php 

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;	
	
	$mail = new PHPMailer();
	
	function get_files(){
		$files = scandir(DESTINE);
		array_splice($files, 0, 2);
		return $files;
	}

	function send_emails(){
		$files = get_files();
		var_dump($files);	
		$email = explode("#", $files[0]);
		$email = $email[0];

		foreach ($files as $file) {
			$file = explode("#", $file);
			$current_email = $file[0];
			$file_name = $file[1]; 
			
			echo $email." - ".$file_name."\n";
			
			if ($email == $current_email){
				// $mail->addAttachment($file, $file_name);
				echo "não mandou\n";   
				continue; 
			}else{
				echo "mandou\n";
				// $mail->send();		
				$email = $current_email;
				// $mail->ClearAllRecipients(); 
				// $mail->clearAttachments();
				// $mail->addAddress($email, 'Joe User');		
				// $mail->addAttachment($file, $file_name);    
			}	
		}
	}


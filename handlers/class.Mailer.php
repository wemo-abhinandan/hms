<?php

	if(count(get_included_files()) == 1) {
		header("Location: ../");
		exit();
	}

	class Mailer
	{	
		function sendMail($to, $message, $subject)
		{						
			require 'mailer/class.phpmailer.php';
			$mail = new PHPMailer();
			$mail->IsSMTP(); 
			$mail->SMTPDebug  = 0;                     
			$mail->SMTPAuth   = true;                  
			$mail->SMTPSecure = "ssl";                 
			$mail->Host       = "";      
			$mail->Port       = 465;
			$mail->AddAddress($to);
			$mail->Username = '';  
			$mail->Password = '';        
			$mail->SetFrom('','Haridas Madhadas Sugandhi');
			$mail->AddReplyTo('','Haridas Madhadas Sugandhi');
			$mail->Subject = $subject;
			$mail->MsgHTML($message);
			if($mail->Send()) {
				return true;
			}
			else{
				return false;
			}
		}	
	}

<?php

$to_arr = $cc_arr = $bcc_arr = [];
$isCC = $isBCC = false; 

$subject = $_REQUEST['mail_subject'];
$body_html = $_REQUEST['email_body_html'];

$files_arr = uploadFile($_FILES);
print_r($files_arr);
die;
if (strpos($_REQUEST['email_to'], ',') !== false) {
    $to_arr =  explode( ',', $_REQUEST['email_to']);
} else {
	array_push($to_arr, $_REQUEST['email_to']);
}

if($_REQUEST['email_cc'] != '') {
	$isCC = true;
	if (strpos($_REQUEST['email_cc'], ',') !== false) {
		$cc_arr =  explode( ',', $_REQUEST['email_cc']);
	} else {
		array_push($cc_arr, $_REQUEST['email_cc']);
	}
}

if($_REQUEST['email_bcc'] != '') {
	$isBCC = true;
	if (strpos($_REQUEST['email_bcc'], ',') !== false) {
		$bcc_arr =  explode( ',', $_REQUEST['email_bcc']);
	} else {
		array_push($bcc_arr, $_REQUEST['email_bcc']);
	}
}


if(!empty($body_html)){
	if(count($to_arr)>0){
		$emailObj = new Email();  
		$defaults = $emailObj->getSystemDefaultEmail(); 
		$mail = new SugarPHPMailer();  
		$mail->setMailerForSystem();  
		$mail->From = $defaults['email'];  
		$mail->FromName = $defaults['name'];  
		$mail->Subject  =   $subject;
		$mail->Body     =  $body_html ; 
		$mail->prepForOutbound();  
		for($i = 0 ; $i < count($to_arr); $i++) {
			$mail->AddAddress(trim($to_arr[$i]));
		}
		if($isCC) {
			for($i = 0 ; $i < count($cc_arr); $i++) {
				$mail->AddCC(trim($cc_arr[$i]));
			}
		} 
		if($isBCC) {
			for($i = 0 ; $i < count($bcc_arr); $i++) {
				$mail->addBcc(trim($bcc_arr[$i]));
			}
		}
		$mail->addAttachment($upload_location, $_FILES['files']['name']);
			
		$mail->IsHTML(true);
		if(!$mail->send()) {
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $mail->ErrorInfo;
		   exit;
		} else {
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
		
	}
}



function uploadFile($_FILES) {
	echo "hello sam";
	// Count total files
	$countfiles = count($_FILES['files']['name']);

	// Upload directory
	$upload_location = "uploads/";

	// To store uploaded files path
	$files_arr = array();

	// Loop all files
	for($index = 0;$index < $countfiles;$index++){

		if(isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != ''){

			// File name
			$filename = $_FILES['files']['name'][$index];

			// Get extension
			$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

			// Valid image extension
			$valid_ext = array("png","jpeg","jpg");

			// Check extension
			if(in_array($ext, $valid_ext)){

				// File path
				$path = $upload_location.$filename;

				// Upload file
				if(move_uploaded_file($_FILES['files']['tmp_name'][$index],$path)){
					$files_arr[] = $path;
				}
			}
		}
					
	}
	return json_encode($files_arr);
}
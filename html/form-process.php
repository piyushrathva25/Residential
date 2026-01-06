<?php

	$errorMSG = "";

	// FullNAME
	if (empty($_POST["fullname"])) {
		$errorMSG = "Full Name is required. ";
	} else {
		$fullname = $_POST["fullname"];
	}

	// EMAIL
	if (empty($_POST["email"])) {
		$errorMSG .= "Email is required. ";
	} else {
		$email = $_POST["email"];
	}

	// PHONE
	if (empty($_POST["phone"])) {
		$errorMSG .= "Phone is required. ";
	} else {
		$phone = $_POST["phone"];
	}
	
	// SUBJECT
	if (empty($_POST["subject"])) {
		$errorMSG .= "subject is required. ";
	} else {
		$subject = $_POST["subject"];
	}

	// MESSAGE
	if (empty($_POST["message"])) {
		$errorMSG .= "Message is required. ";
	} else {
		$message = $_POST["message"];
	}

	$subject = 'Contact Inquiry from Seore Website';

	//$EmailTo = "info@yourdomain.com"; // Replace with your email.
    $EmailTo = "awaikentechnology@gmail.com";
    
	// prepare email body text
	$Body = "";
	$Body .= "fullname: ";
	$Body .= $fullname;
	$Body .= "\n";
	$Body .= "Email: ";
	$Body .= $email;
	$Body .= "\n";
	$Body .= "Phone: ";
	$Body .= $phone;
	$Body .= "\n";
	$Body .= "subject: ";
	$Body .= $subject;
	$Body .= "\n";
	$Body .= "Message: ";
	$Body .= $message;
	$Body .= "\n";

	// send email
	$success = @mail($EmailTo, $subject, $Body, "From:".$email);

	// redirect to success page
	if ($success && $errorMSG == ""){
	   echo "success";
	}else{
		if($errorMSG == ""){
			echo "Something went wrong :(";
		} else {
			echo $errorMSG;
		}
	}

?>
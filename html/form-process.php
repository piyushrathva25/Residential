<?php
error_reporting(0);
header('Content-Type: text/plain');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	echo "POST only";
	exit;
}

$errorMSG = "";

// ========================
// GET FORM DATA
// ========================
$fullname = isset($_POST["fullname"]) ? trim($_POST["fullname"]) : "";
$email    = isset($_POST["email"]) ? trim($_POST["email"]) : "";
$phone    = isset($_POST["phone"]) ? trim($_POST["phone"]) : "";
$subject  = isset($_POST["subject"]) ? trim($_POST["subject"]) : "";
$message  = isset($_POST["message"]) ? trim($_POST["message"]) : "";

// ========================
// VALIDATION
// ========================
if ($fullname == "") $errorMSG .= "Full Name is required. ";
if ($email == "")    $errorMSG .= "Email is required. ";
if ($phone == "")    $errorMSG .= "Phone is required. ";
if ($subject == "")  $errorMSG .= "Subject is required. ";
if ($message == "")  $errorMSG .= "Message is required. ";

if ($errorMSG != "") {
	echo $errorMSG;
	exit;
}

// ========================
// ADMIN EMAIL (TESTING)
// ========================
$adminEmail = "awaikentechnology@gmail.com";
$adminSubject = "New Contact Inquiry - BuiltUp";

$adminBody  = "NEW CONTACT INQUIRY\n\n";
$adminBody .= "Full Name: $fullname\n";
$adminBody .= "Email: $email\n";
$adminBody .= "Phone: $phone\n";
$adminBody .= "Subject: $subject\n";
$adminBody .= "Message:\n$message\n";

$adminHeaders = "From: BuiltUp <noreply@localhost>";

// ========================
// USER CONFIRMATION EMAIL
// ========================
$userSubject = "Thank you for contacting BuiltUp";

$userBody  = "Hello $fullname,\n\n";
$userBody .= "Thank you for contacting us.\n";
$userBody .= "We have received your inquiry and our team will contact you soon.\n\n";
$userBody .= "----------------------\n";
$userBody .= "Your Message:\n$message\n";
$userBody .= "----------------------\n\n";
$userBody .= "Regards,\nBuiltUp Team";

$userHeaders = "From: BuiltUp <noreply@localhost>";

// ========================
// SEND MAIL (may fail on localhost)
// ========================
$adminMail = @mail($adminEmail, $adminSubject, $adminBody, $adminHeaders);
$userMail  = @mail($email, $userSubject, $userBody, $userHeaders);

// ========================
// TESTING BACKUP (VERY IMPORTANT)
// ========================
// Agar mail() kaam na kare to bhi yeh file banegi
file_put_contents(
	"test-log.txt",
	"----- NEW SUBMISSION -----\n" .
		date("Y-m-d H:i:s") . "\n" .
		$adminBody . "\n\n",
	FILE_APPEND
);

// ========================
// FINAL RESPONSE (AJAX)
// ========================
echo "success";
exit;

<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
date_default_timezone_set('America/Denver');
set_include_path(get_include_path().PATH_SEPARATOR.'phpmailer');
require_once('PHPMailerAutoload.php');
require_once('recaptchalib.php');
$privatekey = "";

$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
    
$errors = '';

if(empty($_POST['name'])  || empty($_POST['email']) || empty($_POST['message'])) {
    $errors .= "\n Error: all fields are required";
}
 
$name = $_POST['name']; 
$email_address = $_POST['email'];
$subject = $_POST['subject']; 
$message = $_POST['message']; 
 
if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email_address)) {
    $errors .= "\n Error: Invalid email address";
}

if (empty($errors) && $resp->is_valid) {
    $email_subject = "developersBliss Contact Form Submission from $name";
    $email_body = "From: " . $name . " <" . $email_address . ">\nSubject: " . $subject . "\n\n" . $message . "\n";
 
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465;
	$mail->Username = "contact@developersbliss.com";
	$mail->Password = "";
	$mail->SetFrom("contact@developersbliss.com", "developersBliss");
	$mail->addReplyTo($email_address, $name);
	$mail->addAddress("andrew@developersbliss.com", "developersBliss");
	$mail->Subject = $email_subject;
	$mail->Body = $email_body;
	$mail->send();

    //redirect to the 'thank you' page
    header('Location: thankyou.php');
} else {
	header('Location: contact.php?error');
}
?>
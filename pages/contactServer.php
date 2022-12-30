<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
if(isset($_POST['submit'])){
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Mailer = "smtp";
	// admin end 
	$mail->SMTPDebug  = 1;  
	$mail->SMTPAuth   = TRUE;
	$mail->SMTPSecure = "tls";
	$mail->Port       = 587;
	$mail->Host       = "smtp.gmail.com";
	$mail->Username   = "827johndoe@gmail.com";
	$mail->Password   = "daozqjtaaocquyqg";
	// user end 
	$mail->IsHTML(true);
	$mail->AddAddress("uxair.abs@gmail.com", "Uxair Abbas");
	$mail->SetFrom("827johndoe@gmail.com", $_POST['submit']);
	$mail->AddReplyTo("827johndoe@gmail.com", "reply-to-name");
	$mail->AddCC("cc-827johndoe@gmail.com", "cc-uxair-abbas");
	$mail->Subject = "USER RMS";
	$content = $_POST['message'];
	// requesting 
	$mail->MsgHTML($content); 
	if(!$mail->Send()) {
	  echo "Error while sending Email.";
	  var_dump($mail);
	} else {
	  header("Location: contact.php?message=Your email has been send successfully");
	}
}

?>
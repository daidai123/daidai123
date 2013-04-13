<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require '../class.phpmailer.php';

try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	$body             = file_get_contents('contents.html');
	$body             = preg_replace('/\\\\/','', $body); //Strip backslashes

	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;                 // enable SMTP authentication
	$mail->Username   = "jamesconna";     // SMTP server username
	$mail->Password   = "jamesluo11";            // SMTP server password

	//$mail->IsSendmail();  // tell the class to use Sendmail

	$mail->AddReplyTo("jamesconna@gmail.com","First Last");

	$mail->From       = "jamesconna@gmail.com";
	$mail->FromName   = "Inter Last";

	$to = "jamesluo007@gmail.com";

	$mail->AddAddress($to);

	$mail->Subject  = "First PHPMailer Message";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);
    
	$mail->IsHTML(true); // send as HTML
   // $mail->AddAttachment("../changelog.txt"); // attachment 
	$mail->Send();
	echo 'Message has been sent.';
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>
<?php
require 'PHPMailer/class.phpmailer.php';



function passwordsmtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer(true);  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true;  // authentication enabled
	$mail->Host = 'smtpout.secureserver.net';
	$mail->Port = 80; 
	$mail->Username = "help@interbringer.com";  
	$mail->Password = "interbringer";  
	$mail->CharSet = "GB2312"; //  
    $mail->Encoding = "base64";//      
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	//$mail->Body = $body;
    $mail->WordWrap   = 80; // set word wrap
	$mail->MsgHTML($body);
	$mail->IsHTML(true); // send as HTML
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
}


function passwordretrievesendemail($email, $username, $password, $realname, $id) {

           
			$code = "here we place a secret key  with the email address: $email";
			$code = md5($code);
			$content=registor_sucess_content($code, $email, $username, $password, $realname, $id);
			if(passwordsmtpmailer($email, 'help@interbringer.com', 'Interbringer.com',  "Your Password for Interbringer.com", $content)){
			return true;
			}else{
			  return false;
			}	
} 

function registor_sucess_content($code, $email, $username, $password, $realname, $id){
            header( "Content-Type: text/html; charset=gb2312" );

           $content="<div style=\"margin: 0px;padding: 0px;background: url(http://www.interbringer.com/".LANGUAGE_SELECT_FOLDER_CHOOSE."/img01.jpg) repeat left top;font: 13px Arial, Helvetica, sans-serif;color: #212121;\">";
           $content .="<div style=\"margin: 8px;line-height: normal;font-weight: normal;color: #393939;height:90px;width:560px;background:url(http://www.interbringer.com/".LANGUAGE_SELECT_FOLDER_CHOOSE."/logo-small.png) no-repeat left;\">";
           $content .="<h2></h2>";
           $content .="</div>";
		   $content .="<table style=\"margin: 10px auto; width: 595px;\" border=\"0\" cellpadding=\"5\" cellspacing=\"5\">";
		   $content .="<tr>";
		   $content .="<td>";
		   $content .="<fieldset style=\"border:#000000 solid 3px;\">";
		   $content .="<legend style=\"color:#000000; font-size:18px; font-weight:bold;\">Your Password Information</legend>";
		   $content .="<table style=\"margin: 10px auto; width: 595px; text-align: left\ border=\"0\" cellpadding=\"5\" cellspacing=\"0\">";
           $content .="<tbody>";
           $content .="<tr>";
           $content .="<td colspan=\"2\" align=\"left\"><strong><font size=\"3\" color=\"#48a2c0\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">Dear(亲爱的) ".$realname.",</font></strong>";
           $content .="<p align=\"justify\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">Thank you for using Interbringer.com!(欢迎使用Interbringer.com)</font></p>";
           $content .="<font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">";			
		   $content .="</font>";
           $content .="<p align=\"justify\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">You have sucessfully retrieved your password in Interbringer.com.(你已经成功的注册了Interbringer网站。)</font></font></p>";
           $content .="<font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"></font></font>";
           $content .="<p align=\"justify\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">Your Account information for your interbringer account as follow: </font></font></font></p>";
           $content .="<p align=\"justify\"><font color=\"#56596c\" size=\"2\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">Username(用户名): ".$username."</font></p>";
           $content .="<p align=\"justify\"><font color=\"#56596c\" size=\"2\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">Password(密码): ".$password."</font></p>";
           $content .="<p align=\"justify\">If you have any question, Please feel free to contact us(有任何问题和建议，请与我们联系): </p>";
           $content .="<font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">";			
		   $content .="</font></font></font></font></font>";
           $content .="<p align=\"justify\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><a href=\"#\" onclick=\"javascript:mailto:help@interbringer.com\" target=\"_blank\">help@interbringer.com</a></font></font></font></font></font></font></p>";
           $content .="<font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">";		
		   $content .="</font></font></font></font></font></font>";
            $content .="<p align=\"justify\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">Enjoy your trip in www.interbringer.com!</font></font></font></font></font></font></font></p>";

            $content .="<font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">		 			</font></font></font></font></font></font></font>";
            $content .="<p align=\"left\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">Best regards, </font></font></font></font></font></font></font></font></p>";
            $content .="<font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">";
			$content .="</font></font></font></font></font></font></font></font>";
            $content .="<p align=\"left\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">The Interbringer Team<br>";
            $content .="<a href=\"http://www.interbringer.com\" target=\"_blank\">http://www.interbringer.com</a></font></font></font></font></font></font></font></font></font></p>";
            $content .="<font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">            </font></font></font></font></font></font></font></font></font>";

            $content .="<p align=\"justify\">&nbsp;</p>";           
			$content .="</td></tr>";
            $content .="</tbody>";
            $content .="</table>";
            $content .="</fieldset>";
            $content .="</td>";
            $content .="</tr>";
            $content .="</table>";		
            $content .="</div>";

             return $content;

}

?>
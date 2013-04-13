<?php
require 'PHPMailer/class.phpmailer.php';



function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer(true);  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only

$mail->SMTPAuth = true;  // authentication enabled
	$mail->Host = 'smtpout.secureserver.net';
	$mail->Port = 80; 
	$mail->Username = "administrator@interbringer.com";  
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


function email_exist($email) {
	list($userid, $domain) = split("@", $email);
	if (checkdnsrr($domain, "MX")) { return true;} else { return false;}
}

/*function checkdnsrr($hostName, $recType = '')
{
 if(!empty($hostName)) {
   if( $recType == '' ) $recType = "MX";
   exec("nslookup -type=$recType $hostName", $result);
   // check each line to find the one that starts with the host
   // name. If it exists then the function succeeded.
   foreach ($result as $line) {
     if(eregi("^$hostName",$line)) {
       return true;
     }
   }
   // otherwise there was no mail handler for the domain
   return false;
 }
 return false;
}*/



function check_email($email)
{
	$email_error = false;
	$Email = htmlspecialchars(stripslashes(strip_tags(trim($email)))); //parse unnecessary characters to prevent exploits
	if ($Email == "") { $email_error = true; }
	elseif (!eregi("^([a-zA-Z0-9._-])+@([a-zA-Z0-9._-])+\.([a-zA-Z0-9._-])([a-zA-Z0-9._-])+", $Email)) { $email_error = true; }
	else {
	list($Email, $domain) = split("@", $Email, 2);
		if (! checkdnsrr($domain, "MX")) { $email_error = true; }
		else {
		$array = array($Email, $domain);
		$Email = implode("@", $array);
		}
	} 

	if ($email_error) { return false; } else{return true;}
}

function EmailValidation($email, $username, $password, $realname, $id) {
     
    if (check_email($email)) {
    $domain = explode( "@", $email );
        if ( @fsockopen ($domain[1],80,$errno,$errstr,3)) {
			$code = "here we place a secret key  with the email address: $email";
			$code = md5($code);
            echo $code;
			$content=registor_sucess_content($code, $email, $username, $password, $realname, $id);
			smtpmailer($email, 'registration@interbringer.com', 'Interbringer.com',  "Need Your Confirm", $content);
//			mail(, );
			echo "Your account needs to be verify. We have send you an email, click the link provided and you are verified.";
			return true;
		} else {
            return false; //if a connection cannot be established return false
        }
    } else {
        return false; //if email address is an invalid format return false
    }
} 

function EmailForm(){

    if(empty($_POST['email'])&&empty($_GET["email"])){
        echo "<form action=".$_SERVER['PHP_SELF']." method='post'>
        <table border='0'>
        <tr>
        <td>Email</td>
        <td><input name='email' type='text' id='email' /></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td><input type='submit' name='Submit' value='Validate' /></td>
        </tr>
        </table>
        </form>";
    } elseif(isset($_POST['email'])) { 

        if(EmailValidation($_POST['email'])) {
            echo "An email has been sent to you. Please follow the instructions to activate your account.";
        } else {
            echo "Your email address appears to be invalid. Please try again.";
        }
    }elseif(isset($_GET['v']) && isset($_GET['email'])) {
		$clean['emai'] = $_GET['email']; //need to filter these data to be clean
		$clean['v'] = $_GET['v']; //need to filter these data to be clean
		$code = "here we place a secret key  with the email address: ".$clean['emai']."";
		echo $code;
		$code = md5($code);
         echo $code;
		if ($clean['v'] != $code) {
			echo "The Verification Code is invalid. Please Try Again.";
			exit(0);
		}else
		echo "The email ".$clean['emai']." has been verified";
		
		
/*	if(email_exist($_POST['email'])){
	  echo "email exist";
	}else{
	  echo "email not exist";
	}*/

	}else { 

        echo "An error has occured, please contact the administrator."; 

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
		   $content .="<legend style=\"color:#000000; font-size:18px; font-weight:bold;\"> Please Confirm Your Email(请确认你的邮箱地址)</legend>";
		   $content .="<table style=\"margin: 10px auto; width: 595px; text-align: left\ border=\"0\" cellpadding=\"5\" cellspacing=\"0\">";
           $content .="<tbody>";
           $content .="<tr>";
           $content .="<td colspan=\"2\" align=\"left\"><strong><font size=\"3\" color=\"#48a2c0\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">Dear(亲爱的) ".$realname.",</font></strong>";
           $content .="<p align=\"justify\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">Thank you for using Interbringer.com!(欢迎使用Interbringer.com)</font></p>";
           $content .="<font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">";			
		   $content .="</font>";
           $content .="<p align=\"justify\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">You have sucessfully registor in Interbringer.com.(你已经成功的注册了Interbringer网站。)</font></font></p>";
           $content .="<font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"></font></font>";
           $content .="<p align=\"justify\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">To use this website, please click below link to Active your account:（使用本网站，请点击一下连接对你的账户进行激活：）</font></font></font></p>";
           $content .="<font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">";			
		   $content .="</font></font></font>";
           $content .="<p align=\"justify\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><a href=\"http://www.interbringer.com/acactive.php?u=".$id."&v=".$code."&email=".$email."\" target=\"_blank\">http://www.interbringer.com/acactive.php?u=".$id."&v=".$code."&email=".$email."</a></font></font></font></font></p>";

           $content .="<font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">";			
		   $content .="</font></font></font></font>";
           $content .="<p align=\"justify\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">After you registor your account, please use information you provide to us to login(注册以后，你可以使用一下的信息进行登陆：)<font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\"><font size=\"2\" color=\"#56596c\" face=\"Tahoma, Verdana, Helvetica, sans-serif\">:</font></font></font></font></font></p>";
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
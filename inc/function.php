<?php
function CHECK_ID_CORRECT_PAGE($table, $value, $pid, $db){

         if($pid==""){  
		    echo "No such page exist!";
		    header("Location: ./error.php");
		    die();
		 } 
		
		//check wether the request id is in this page
	     $checktypesql="SELECT * FROM `".$table."` WHERE `id`=".$pid."";
	     $checktypequery= mysql_query($checktypesql, $db);
	      while($row=mysql_fetch_array($checktypequery))
	     {
	       $check_type=$row["post_type"];
	     }
		 if($check_type!=$value){
		 
		    echo "No such page exist!";
		    header("Location: ./error.php");
		    die();
		 }

}

function translate( $text, $destLang = 'es', $srcLang = 'en' ) {
 
$text = urlencode( $text );
$destLang = urlencode( $destLang );
$srcLang = urlencode( $srcLang );
 
$trans = @file_get_contents( "http://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q={$text}&langpair={$srcLang}|{$destLang}" );
$json = json_decode( $trans, true );
 
if( $json['responseStatus'] != '200' ) return false; else return $json['responseData']['translatedText'];
 
}


function translateToenglish($text){

 /* $test_orign=iconv("gb2312", "utf-8",$text);

  $text_back=translate($test_orign, 'en', 'zh-CN');*/
  
  $text_back = $text;

  return $text_back;

}


function translateTochinese($text){

  /*$test_orign=iconv("gb2312", "utf-8", $text);

 $text_back=translate($test_orign, 'zh-CN', 'en');

  return iconv("utf-8", "gb2312", $text_back);*/
  return $text;

}


function CHECK_UNREAD_MESSAGE($user_name, $db){

   $sql = "select * from chat where (chat.to = '".mysql_real_escape_string($user_name)."' AND recd = 0) order by id ASC";
   $query = mysql_query($sql, $db);
   $nummessage = mysql_num_rows($query);
   
   return $nummessage;
}


function CHECK_USER_ONLINE_OFFLINE($userid, $db){

    $time = time(); 
    $timeframe = '900'; // 900secs = 15mins || this is how long till the user is shown to be offline of in case the user exits out of browser or have logged or has user IDLE's to long but is cookie dose not time out all they have to do is refresh the page and the will be shown online again 
	
	$sql="SELECT `lastvisit` FROM user WHERE id = ".$userid."";
    $lastactionquery = mysql_query($sql, $db); 
	 while($row=mysql_fetch_array($lastactionquery)){
	  $lastaction=$row["lastvisit"];
	 }/**/
    // die();
   if ($lastaction <= $time) {
	 return false;
    }else if($lastaction > $time){
	 return true;
   }
}

function get_gender_name($id){
  
  if($id==1){
    return MALE;
  }else{
    return FEMALE;
  }
}

//this function is responsible for check $email exist or not
function check_user_email_exist($email, $db)
{
    $checksqlQuery="select * from `user` where email='".$email."'";
    $checkQuery = mysql_query($checksqlQuery, $db);
	$checkNum= mysql_num_rows($checkQuery);
	
	if($checkNum>0) return true;
    else return false;
}
//end check_user_email_exist()

//this function is responsible for check username exist or not
function check_username_exist($username, $db)
{
    $checksqlQuery="select * from `user` where username='".$username."'";
    $checkQuery = mysql_query($checksqlQuery, $db);
	$checkNum=mysql_num_rows($checkQuery);
	
	if($checkNum>0) return true;
    else return false;
}
//end check_username_exist()


//this function is responsible for get the supplier name from vendor table
function get_catergory_name($catergory_short, $db)
{
    $catergorysqlQuery = "select * from `catergory` where short = '".$catergory_short."'";
    $catergoryQuery = mysql_query($catergorysqlQuery, $db);
	while($row = mysql_fetch_array($catergoryQuery)){ 
	  
	 $catergory_name=$row["name"];
	}
	
    return  $catergory_name;
}


//this function is responsible for get the supplier name from vendor table
function get_country_name($country_id, $db)
{
    $countrysqlQuery="select * from `country` where id=".$country_id;
    $countryQuery = mysql_query($countrysqlQuery, $db);
	while($row = mysql_fetch_array($countryQuery)){ 
	  
	 $country_name=$row["country"];
	}
	
	if($country_name=="") $country_name=UNDENTIFY;
    return  $country_name;
}

//this function is responsible for get the supplier name from vendor table
function get_state_name($state_id, $db)
{
    $statesqlQuery="select * from `states` where id=".$state_id;
    $stateQuery = mysql_query($statesqlQuery, $db);
	while($row = mysql_fetch_array($stateQuery)){ 
	  
	 $state_name=$row["state_name"];
	}
    return  $state_name;
}


//this function is responsible for get the supplier name from vendor table
function get_city_name($city_id, $db)
{
    $citysqlQuery="select * from `city` where id=".$city_id;
    $cityQuery = mysql_query($citysqlQuery, $db);
	while($row = mysql_fetch_array($cityQuery)){ 
	  
	 $city_name=$row["name"];
	}
    return  $city_name;
}


//this function is responsible for get the supplier name from vendor table
function get_user_email($user_id, $db)
{
    $usersqlQuery="select * from `user` where id=".$user_id;
    $userQuery = mysql_query($usersqlQuery, $db);
	while($row = mysql_fetch_array($userQuery)){ 
	  
	 $user_email=$row["email"];
	}
    return  $user_email;
}



//this function is responsible for get the supplier name from vendor table
function get_user_country($user_id, $db)
{
    $usersqlQuery="select * from `user` where id=".$user_id;
    $userQuery = mysql_query($usersqlQuery, $db);
	while($row = mysql_fetch_array($userQuery)){ 
	  
	 $user_country=$row["country"];
	}
	
    return  $user_country;
}


//this function is responsible for get the supplier name from vendor table
function get_user_state($user_id, $db)
{
    $usersqlQuery="select * from `user` where id=".$user_id;
    $userQuery = mysql_query($usersqlQuery, $db);
	while($row = mysql_fetch_array($userQuery)){ 
	  
	 $user_state=$row["state"];
	}
    return  $user_state;
}


//this function is responsible for get the supplier name from vendor table
function get_user_city($user_id, $db)
{
    $usersqlQuery="select * from `user` where id=".$user_id;
    $userQuery = mysql_query($usersqlQuery, $db);
	while($row = mysql_fetch_array($userQuery)){ 
	  
	 $user_city=$row["city"];
	}
    return  $user_city;
}

function get_user_name($user_id, $db)
{

 $usersql="SELECT * FROM `user` WHERE `id`=".$user_id."";
 // echo $usersql;
  $userquery= mysql_query($usersql, $db);
  while($row=mysql_fetch_array($userquery))
  {
	$username=$row["username"];
  }
  return $username;

}


function get_user_gender($user_id, $db)
{

 $usersql="SELECT * FROM `user` WHERE `id`=".$user_id."";
 // echo $usersql;
  $userquery= mysql_query($usersql, $db);
  while($row=mysql_fetch_array($userquery))
  {
	$gender=$row["gendor"];
  }
  return $gender;

}

function get_user_id($user_name, $db)
{

 $usersql="SELECT * FROM `user` WHERE `username`='".$user_name."'";
  $userquery= mysql_query($usersql, $db);
  while($row=mysql_fetch_array($userquery))
  {
	$userid=$row["id"];
  }
  return $userid;

}


// Function that prints a message according to session variable MSG
function print_msg(&$_SESSION, $force_id = null)
{
	require("dbconnect.php");

	if ($force_id > 0)
	{
		$msg_id = (int)$force_id;
	}
	else if ($_SESSION['msg'] != "")
	{
		
		$msg_id = $_SESSION['msg'];
		$_SESSION['msg'] = ""; // reseting message id to null
	}

	if ($msg_id !="")
	{
			$printvar="".$msg_id."";
			
			return $printvar;
	}
}
// END print_msg

// Function that get a message type according to session variable MSG
function msg_type(&$_SESSION)
{
	require("dbconnect.php");

	 if($_SESSION['msgtype']==1) 
	 {
	  $msg_type="messageBoxSu";
	  $_SESSION['msgtype']=0;
	  }
	  else $msg_type="messageBox";
	  
	  return $msg_type;
}
// END msg_type

// Function that returns a drop down input with all the catergory from catergory table
function catergory_drop_list($name = "catergory", $forminfo = "", $selected = "none", $default = " --- ANY --- ")
{
	require("dbconnect.php");

	$query = mysql_query("SELECT * FROM `catergory` ORDER BY `id`", $db);

	$select = "<select name=$name id=$name $forminfo>";
	$select .= "<option value=\"\">$default</option>";
	while ($row = mysql_fetch_array($query))
	{
		if ($selected == $row['short']) $itemselect = 'SELECTED'; else $itemselect = "";
		$select .= "<option value='".$row['short']."'".$itemselect.">".$row['name']."</option>";
	}
	
	$select .= "</select>";

	return $select;
}
// END catergory_drop_list()

// Function that returns a drop down input with all the questions from question table
function question_drop_list($name = "question", $forminfo = "", $selected = "none", $default = " --- ANY --- ")
{
	require("dbconnect.php");

	$query = mysql_query("SELECT * FROM `question` ORDER BY `id`", $db);

	$select = "<select name=$name id=$name $forminfo>";
	$select .= "<option style=\"color:#999999;\" value=\"\">$default</option>";
	while ($row = mysql_fetch_array($query))
	{
		if ($selected == $row['id']) $itemselect = 'SELECTED'; else $itemselect = "";
		$select .= "<option value='".$row['id']."'".$itemselect.">".$row['question']."</option>";
	}
	
	$select .= "</select>";

	return $select;
}
// END question_drop_list()

function get_qustion_info($id, $db){
 
    $usersqlQuery="select * from `question` where id=".$id;
    $userQuery = mysql_query($usersqlQuery, $db);
	while($row = mysql_fetch_array($userQuery)){ 
	  
	 $question=$row["question"];
	}
    return  $question;

}

function ipcheck_country($IP){

include("geolocation/geoip.inc");

//open the database
$GeoIPDatabase = geoip_open("geolocation/GeoIP.dat", GEOIP_STANDARD);

//to get the country code (2 letters)
$country=geoip_country_code_by_addr($GeoIPDatabase, $IP);

//to get the full country name
//echo geoip_country_name_by_addr($GeoIPDatabase, $IP);
return $country;
//close the database
geoip_close($GeoIPDatabase);



}



?>
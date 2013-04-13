<?php
session_start();
include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>InterBringer-<?php echo CONTACTINFO; ?></title>
<link rel="stylesheet" type="text/css" href="index.css" />
</head>
<body>
<?php
include("threelink.php");
include("inc/function.php");

   $postid=$_GET["pid"];
   $type=$_GET["ty"];
  
	  
  if($type=="d"){
	  $search_table="demandpost";
	   $sql="SELECT * FROM `".$search_table."` WHERE `id`=".$postid."";
	  $demandquery= mysql_query($sql, $db);

	  
	  while($row=mysql_fetch_array($demandquery))
	  {
		 $user_id=$row["userid"];
	  }
	  //$check_page="demondpostdetial.php";
	} else if($type=="s"){
	  $search_table="supplypost";
	  //$check_page="suppilerpostdetail.php";
	   $sql="SELECT * FROM `".$search_table."` WHERE `id`=".$postid."";
	  $demandquery= mysql_query($sql, $db);

	  
	  while($row=mysql_fetch_array($demandquery))
	  {
		 $user_id=$row["userid"];
	  }
	} else if($type=="p"){
	  $user_id=$_SESSION['interbringeruserId'];
	}else{
	
	}
		 
  $usersql="SELECT * FROM `user` WHERE `id`=".$user_id."";
 // echo $usersql;
  $userquery= mysql_query($usersql, $db);
  while($row=mysql_fetch_array($userquery))
  {
	$username=$row["username"];
	$realname=$row["realname"];
	$countryid=$row["country"];
	$stateid=$row["state"];
	$cityid=$row["city"];
	$email=$row["email"];
	$cellphone=$row["cellphone"];
	$qq=$row["qq"];
	$msn=$row["msn"];
	$gender=$row["gendor"];
  }
  
  
  	$filename = USER_HEADSHOT_IMAGE_FOLDER_BIG."".$_SESSION['interbringeruserId']."_big.jpg";
	
    if (file_exists(dirname(__FILE__).'/'.$filename))
     {
	   $show_image_url=$filename;
	  }
    else
     {
	   if($gender==1){
	     $show_image_url=USER_HEADSHOT_IMAGE_FOLDER_BIG."default_m_big.jpg"; 
		}else if($gender==2){
		 $show_image_url=USER_HEADSHOT_IMAGE_FOLDER_BIG."default_w_big.jpg";
	    }else{
		 $show_image_url=USER_HEADSHOT_IMAGE_FOLDER_BIG."default_big.jpg";
		}
	 }
?>
  <div style="margin-left:5px;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td><fieldset style="border:#B3B3B3 solid 2px;">
          <legend><?php echo USERINFOMATION; ?></legend>
          <table cellpadding="6" cellspacing="0" border="0" width="100%">
            <tr><td>
			
			<fieldset style="border:#B3B3B3 solid 2px;">
            <legend><?php echo BASICINFOMATION; ?></legend>
			 <table cellpadding="4" cellspacing="0" border="0" width="90%">
			  <tr>
			  <td rowspan="6" width="40%">
			   <div style="width:167px; padding:2px 2px 2px 2px; height:202px; border:#999999 solid 2px;">
			     <img src="<?php echo $show_image_url; ?>" />
			   </div>
			  </td>
              <td align="right" nowrap="nowrap" style="font-weight:bold;"> <?php echo USERNAME; ?>: </td>
              <td>
			  <?php echo $username; ?>
              </td>
            </tr>
			<tr>
              <td align="right" nowrap="nowrap" style="font-weight:bold;"> <?php echo REALNAME; ?>: </td>
              <td>
			  <?php echo $realname; ?>
              </td>
            </tr>
			<tr>
              <td align="right" nowrap="nowrap" style="font-weight:bold;width:20%;"> <?php echo GENDER; ?>: </td>
              <td style="width:50%;">
			  <?php echo get_gender_name($gender); ?>
              </td>
              </tr>
			<tr>
              <td align="right" nowrap="nowrap" style="font-weight:bold;"> <?php echo COUNTRY; ?>: </td>
              <td>
			  <?php echo get_country_name($countryid, $db); ?>
              </td>
            </tr>
			<tr>
              <td align="right" nowrap="nowrap"  style="font-weight:bold;"> <?php echo STATE_OR_PROVINCE;?>: </td>
              <td>
			  <?php echo get_state_name($stateid, $db); ?>
              </td>
            </tr>
			 <tr>
              <td align="right" nowrap="nowrap"  style="font-weight:bold;"> <?php echo CITY; ?>: </td>
              <td>
			  <?php echo get_city_name($cityid, $db); ?>
              </td>
            </tr>
			</table>
			</fieldset>
			
			</td></tr>
            <tr><td>
			
	        <fieldset style="border:#B3B3B3 solid 2px;">
            <legend><?php echo EMAILINFORMATION; ?></legend>
			 <table cellpadding="4" cellspacing="0" border="0" width="90%">
			 <tr><td align="right" style="font-weight:bold;" style="width:50%"> <?php echo EMAIL; ?>: </td>
              <td style="width:50%"> 
			  <?php echo $email; ?>
              </td>
            </tr>
			</table>
			</fieldset>
			
			</td></tr>
            <tr><td>
			
			<fieldset style="border:#B3B3B3 solid 2px;">
            <legend><?php echo CONTACTINFORMATION; ?></legend>
			 <table cellpadding="4" cellspacing="0" border="0" width="90%">
			   <tr>
              <td align="right" style="font-weight:bold;" style="width:50%"> <?php echo TELEPHONE; ?>: </td>
              <td style="width:50%">
			  <?php echo $cellphone; ?>
              </td>
            </tr>
			 <tr>
              <td align="right" style="font-weight:bold;" style="width:50%"> <?php echo QQ; ?>: </td>
              <td style="width:50%"> 
			  <?php echo $qq; ?>
              </td>
            </tr>
			 <tr>
              <td align="right" style="font-weight:bold;" style="width:50%"> <?php echo MSN; ?>: </td>
              <td style="width:50%">
			  <?php echo $msn; ?>
              </td>
            </tr>
			</table>
			</fieldset>
			</td></tr> 
			<tr><td align="center">
			<input type="button" id="close" name="close" onclick="javascript: self.parent.tb_remove();" value="<?php echo CLOSE; ?>" style="width:200px;" />
			</td></tr>
          </table>
		  </form>
          </fieldset>
		  </td>
      </tr>
    </table>
	</div>
</body>
</html>

<?php
 ob_start();
 require("inc/session.php");
 sessionCheck(session_id(), $_SESSION, $_SERVER);
 checkLogin();
 include("inc/config.php");
 include("inc/unsetsession_supply_buy.php");
 include("inc/unsetsession_demond.php");
 include("inc/unsetsession_demond_buy.php");
 include("inc/unsetsession_supply_trans.php");
 include("inc/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo POST; ?>|Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<link type="text/css" rel="stylesheet" href="csshead/login2.css">
<?php if($_SESSION['interbringeruserId']>0){?>
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->
<?php } ?>
</head>

<body>
<div id="main_container" style="width:100%;">
<?php


$type=$_GET["type"];
if($type=="demand"){
 $page="postdemond.php";
}else if($type=="supply"){
$page="postsupplier.php";
}else if($type=="tdemand"){
 $page="postdemond-t.php";
}else if($type=="tsupply"){
$page="postsupplier-t.php";
}else{

echo "Sorry! No Such Page!";
header("Location: error.php");
die();

}
?>
   <?php
   
     if(($type=="demand")||($type=="supply")){
     include_once("header/header-user-buy.php");
	 }else if(($type=="tdemand")||($type=="tsupply")){
	 include_once("header/header-user-trans.php");	 
	 }else{
	 
	    echo "Sorry! You have to select post type first!";
		die();
	 }
   ?>
	
	
	
	<div class="fb_content clearfix" id="content">
    <div class="UIFullPage_Container" style="width:835px;">
	<div style="margin-top:20px;">
	
	  <div style="text-align:center">
	   <img src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/step-2.png" />
	  </div>
	  <div style="color:#000000; font-size:16px; width:850px; margin-top:30px; font-weight:bold;">
	   <?php echo PLEASE_SELECT_CAT_TYPE; ?>
	  </div>
	  
	  
      <div style="width:500px; margin-left:160px; margin-top:30px; float:left; border:#DADEE9 solid 1px; margin-bottom:20px;" >
       <div style="margin:4px 4px 4px 4px; background:#EDEFF4; border:#EDEFF4 solid 1px;"> 

		  <div class=login_form_container style="margin-top:0px; margin-bottom:0px;">
             
			 <div style="text-align:left; margin-top:10px; margin-bottom:10px;">
			 <?php
			   $country_query="SELECT * FROM `catergory` ORDER BY `short`";
	           $country_execute_query = mysql_query($country_query, $db); 
               $numCountry = mysql_num_rows($country_execute_query); 
		   ?>
            <ul id=sss1>
              
			  <?php  
				 while ($row = mysql_fetch_array($country_execute_query )){
			  ?>
			  <li style="padding-bottom:10px; padding-left:10px; font-size:14px; font-weight:bold;"><a href="<?php echo $page; ?>?ca=<?php echo $row["short"]; ?>" style="color:#3B5998; font-family:'宋体';"><?php echo $row["name"]; ?></a></li>
			  
			  <?php  
				}
			  ?>
			 </ul>
			</div>
         </div>
        </div>	
      </div>	 
	  
	 </div> 
	  
	   <div style="height:20px;">
	   </div>
      </div>
	</div>
	
	
	
 <?php
      include_once("header/footer.php");
  ?>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>	
</body>
</html>
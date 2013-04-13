<?php
ob_start();
session_start();
include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo US_FAMOUS_WEBSIT; ?>|Interbringer(代代网)</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<!--<link type="text/css" rel="stylesheet" href="csshead/login2.css">-->
<link type="text/css" rel="stylesheet" href="csshead/22o3gybn.css">
<script language="javascript" type="text/javascript" src="js/register.js"></script>
</head>
<?php
require("inc/function.php");
include("threelink.php");

 ?>
<body>
  	<?php
	if($_SESSION['interbringeruserId']>0){
     include_once("header/header-user.php");
	 }else{
	 include_once("header/header-search.php");
	 }
    ?> 
	<div class="fb_content clearfix" id="content" >
     <div class="UIFullPage_Container" style="width:900px;">
		<div style="width:100%; margin-bottom:10px;">	 
          <div style="font-family:'宋体';">    
           <span style="font-family:'宋体'; font-size:16px; color:#000000; font-weight:bold;"><?php echo US_FAMOUS_WEBSIT; ?></span>
		   <table cellpadding="8" cellspacing="8" style="width:100%;">
		     <tr>
			  <td style="text-align:center;">
			   <a href="http://www.bestbuy.com" target="_blank"><img src="image_shop/logo-sm-best-buy.jpg" height="100" width="100" /></a>
			  </td>
			  <td style="text-align:center;">
			  <a href="http://www.guess.com" target="_blank"><img src="image_shop/logo_guess.jpg" height="100" width="100" /></a>
			  </td>
			   <td style="text-align:center;">
			  <a href="http://www.macys.com" target="_blank"><img src="image_shop/ndmacys2-logo.jpg" height="100" width="100" /></a>
			  </td>
			  <td style="text-align:center;">
			  <a href="http://www.chanel.com/" target="_blank"><img src="image_shop/channel.gif" height="100" width="100" /></a>
			  </td>
			  <td style="text-align:center;">
			  <a href="http://www.swarovski.com/" target="_blank"><img src="image_shop/swarovski.jpg" height="100" width="100" /></a>
			  </td>
			 </tr>
			  <tr>
			  <td style="text-align:center;">
			  <a href="http://www.footlocker.com" target="_blank"><img src="image_shop/foot-locker-logo.jpg" height="100" width="100" /></a>
			  </td>
			  <td style="text-align:center;">
			  <a href="http://www.sephora.com" target="_blank"><img src="image_shop/logo-sephora.gif" height="100" width="100" /></a>
			  </td>
			   <td style="text-align:center;">
			  <a href="http://http://www.abercrombie.com" target="_blank"><img src="image_shop/AF.png" height="100" width="100" /></a>
			  </td>
			  <td style="text-align:center;">
			  <a href="http://www.benefitcosmetics.com/" target="_blank"><img src="image_shop/benefit_logo.jpg" height="100" width="100" /></a>
			  </td>
			  <td style="text-align:center;">
			  <a href="http://www.tiffany.com/" target="_blank"><img src="image_shop/tiffany.jpg" height="100" width="100" /></a>
			  </td>
			 </tr>
			</table>
            
		
		  </div>  
			   <!--end of the signup div-->
       <?php
           include_once("header/languagebar.php");
        ?>
	  </div>
	 </div>
             <?php
              include_once("header/footer.php");
              ?>
	
</body>
</html>

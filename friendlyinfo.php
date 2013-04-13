<?php
ob_start();
session_start();
include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo FRIENDLY_HINT; ?>|Interbringer(代代网)</title>
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
		   <div style="margin-top:10px; font-size:14px; padding-left:10px; padding-right:10px;">
           <b>求情提示:</b>
		   <br/>
		   <br />1. 如果代购者和求购者交易，建议使用<a href="https://www.alipay.com/" target="_blank">支付宝</a>或<a href="https://www.paypal.com" target="_blank" >Paypal</a>进行交易。
		   <br/>
		   <br />2. 如果代购者和求购者交易，网站不建议求购者在未拿到货物时将全部款额付给代购者。
		   <br/>
		   <br />3. 发帖地点是系统自动识别的，如果和“求购者所在地”以及“代购者购买地”国家不一致，请提高警惕。对于城市，中国城市系统识别可能会有较大误差。
		   <br/>
		   <br />4. 请尽量将对方信息收集完整，并通过校内或开心进行确认。
		   <br/>
		   <br />5. 如果你作为求购者找人帮你代购，尽量在货到手后再付款。迫不得已也只能付给对方不超过30%的定金。
		   <br/>
		   <br />6. 尽量找和你在一个地区的代购者和求购者。
		   <br/>
		   <br />7. 大多数用户只会公开其邮箱地址，但你如果决定和其进行交易，最好通过邮箱问取对方电话号码，并与其联系，确保对方的可靠性。
		   <br/>
		   <br />8. 可以通过“校内网（人人网）：<a href="http://www.renren.com" target="_blank">www.renren.com</a>”或“开心网：<a href="http://www.kaixin001.com" target="_blank">www.kaixin001.com</a>”来进行身份确认。
		   <br/>
		   <br />9. 交易时，一定要向对方索取收据或者购买凭证。
		   <br />
		   <div style="padding-top:10px; padding-bottom:10px;">网站建设初期，若有不足之处，敬请原谅。如有建议，请邮件至：<a href="#" onclick="window.location.href='mailto:administrator@interbringer.com'">administrator@interbringer.com </a>，万分感谢！</div>
		   </div>
		
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

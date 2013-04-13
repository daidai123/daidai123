<?php
    ob_start();
	
	if($_GET["pid"]!=""){
	  
	   $withurl="?pid=".$_GET["pid"]."";
	   $withurl_lan="&pid=".$_GET["pid"]."";
	 }else if($_GET["ca"]!=""){
	    
		$withurl="?ca=".$_GET["ca"]."";
	   $withurl_lan="&ca=".$_GET["ca"]."";
	   
	 }
	 
	if($_GET['lan']=="eng"){
	
	 $_SESSION["language_be_choosed"]="eng";
	 header("Location: ".$_SERVER['PHP_SELF']."".$withurl."");
	// ob_flush();
	// die();
	
	}else if($_GET['lan']=="chn"){
	
	  $_SESSION["language_be_choosed"]="chn";
	   header("Location: ".$_SERVER['PHP_SELF']."".$withurl."");
	  // ob_flush();
	  // die();
	}
?>
<div id=pageFooter style="width:80%;">
    <div style="width:100%;">
	· <a accessKey=9 title="中文(简体)" href="<?php echo $_SERVER['PHP_SELF']; ?>?lan=chn<?php echo $withurl_lan; ?>">中文(简体)</a> · <a accessKey=9 title="English(US)" href="<?php echo $_SERVER['PHP_SELF']; ?>?lan=eng<?php echo $withurl_lan; ?>">English (US)</a> ·
	</div>
    <div id=contentCurve></div>
    <div class=clearfix id=footerContainer>
      <div class=lfloat>
      <div class=uiTextSubtitle>
	     <span title="HPHP - 65 - 10.36.151.127 - 16384">Interbringer  2010</span>
	   </div>
	   </div>
    <div class="uiTextSubtitle rfloat"> · <a accessKey=9 title="<?php echo FAMOUS_US_SHOPPING_WEBSITE; ?>" href="shoplist.php"><?php echo FAMOUS_US_SHOPPING_WEBSITE; ?></a> · <a accessKey=9 title="<?php echo HOW_TO_AVOIDING_CHEAT; ?>" href="friendlyinfo.php"><?php echo HOW_TO_AVOIDING_CHEAT; ?></a> · <a accessKey=9 title="<?php echo FEEDBACK_TO_US; ?>" href="feedback.php"><?php echo FEEDBACK_TO_US; ?></a> · 
<a  accessKey=0 title="<?php echo CONTACT_US; ?>" onclick="window.location.href='mailto:administrator@interbringer.com'" href="#">Email: administrator@interbringer.com</a>
    </div>
  </div>
 </div>
</div>
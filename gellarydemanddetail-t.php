<?php
  ob_start();
  session_start();
  include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>InterBringer-<?php echo POSTDETAIL; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" href="./thinkBox/thickbox.css" type="text/css" media="screen"/>
<script type="text/javascript" src="./thinkBox/jquery-latest.js"></script>
<script type="text/javascript" src="./thinkBox/thickbox.js"></script>
<script language="javascript">
function checkPostDelete(id)
 {
  if(confirm("Are you sure to DELETE this post? "))
		     {
				  
				  open('<?echo $_SERVER['PHP_SELF']?>?op=d&pid=' + id + '', '_self');
		     }
		     else
		     {
			       return false;
		     }
 }
 
 function checkRePost(id)
 {
  if(confirm("Are you sure to Re-Post this post? "))
		     {
				  
				  open('<?echo $_SERVER['PHP_SELF']?>?op=rp&pid=' + id + '', '_self');
		     }
		     else
		     {
			       return false;
		     }
 }
</script>
</head>
<body>
<?php 
require("inc/dbconnect.php");
include("inc/function.php");
     
	   $postid=$_GET["pid"];
	   
	   if($_SESSION['interbringeruserType']>1){
       $current_user=$_SESSION['interbringeruserId'];
	   }
	   
	   
	  if($_GET["op"]!=""){
	  	 $checksql="SELECT * FROM `demandpost` WHERE `id`=".$postid."";
	     $checkquery= mysql_query($checksql, $db);
	      while($row=mysql_fetch_array($checkquery))
	     {
	       $check_user=$row["userid"];
	     }
	  }
	  
	  if(($_GET["op"]=="d")&&($current_user==$check_user))
      {	  
	    $deletesql="DELETE FROM demandpost WHERE id=".$postid;
	    $q = mysql_query($deletesql, $db);
        if ($q < 1) die("<b>Error:</b> DATABASE QUERY FAILED (Delete Post for ".$delete_table."). ERROR AVL001");	
	    header("Location: postsu.php?op=d&pid=".$postid."");	
	    die();	   
       }else if(($_GET["op"]=="rp")&&($current_user==$check_user)){
	    $repostsql= "UPDATE `demandpost` SET `postdate`= NOW() WHERE `id` = ".$postid."";
        $q = mysql_query($repostsql, $db);
        if ($q < 1) die("<b>Error:</b> DATABASE QUERY FAILED (Re-Post Post for ".$repost_table."). ERROR AVL001");	  
	    header("Location: postsu.php?op=rp&pid=".$postid."");	
	    die();	   
    }
	  
	  
      $sql="SELECT * FROM `demandpost` WHERE `id`=".$postid."";
	  $demandquery= mysql_query($sql, $db);
	  
	  while($row=mysql_fetch_array($demandquery))
	  {
		$title=$row["title"];
        $catergory=$row["catergory"];
		$countryid=$row["countryid"];
		$userid=$row["userid"];
        $stateid=$row["stateid"];
        $cityid=$row["cityid"];
		$pubic=$row["pubic"];
		$replytoemail=$row["replytoemail"];
		$showemailtype=$row["showemailtype"];
		$description=stripslashes($row["description"]);
        $postdate=$row["postdate"];
	  }
	  
	  if($showemailtype==1){
	    $emailshow=$replytoemail;
	  }else{
	    $emailshow="";
	  }
	  
	  
	 if($pubic=='Y'){
     $contactinf_link="contactinfo.php?pid=".$postid."&ty=d&t=t&keepThis=true&TB_iframe=true&height=450&width=600";
}else if($pubic=='N'){
   $contactinf_link="nocontactinfo.php?t=t&keepThis=true&TB_iframe=true&height=160&width=700";
}else{
   $contactinf_link="#";
}


?>
<div id="page">
  <div id="content"> 
  <div style="height:30px;">
  </div>
  <div>
  <table cellpadding="0" cellspacing="0" border="0" width="100%">
 <tr><td>
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td><fieldset style="background-color:#F9F9F9;">
          <legend><?php echo TITLE; ?></legend>
          <table cellpadding="4" cellspacing="0" border="0" width="100%">
            <tr>
              <td style="font-family:'Times New Roman', Times, serif; font-size:36px; font-weight:bold;">
			     <?php echo $title; ?>
              </td>
            </tr>
          </table>
		  </form>
          </fieldset></td>
      </tr>
    </table>
	
	
	</td></tr>
	<tr><td>
	
	 <table cellpadding="5" cellspacing="0" border="0" width="100%">
      <tr>
        <td>
	<!--	<fieldset style="background-color:#FFFFFF;">
          <legend>Title</legend>-->
          <table cellpadding="4" cellspacing="8" border="0" width="100%">
		     <tr>
		  <td style="font-family:'Times New Roman', Times, serif; font-size:18px; font-weight:bold;">
		    <?php echo CATERGORY; ?>: <span style="font-family:Georgia, 'Times New Roman', Times, serif; color:#FF0000; font-size:16px; font-weight:bold;"><?php echo get_catergory_name($catergory, $db); ?></span>
		  </td>
		  </tr>
		   <tr>
			 <td nowrap="nowrap" style="font-family:'Times New Roman', Times, serif; font-size:18px; font-weight:bold;">
			     <?php echo COUNTRY; ?>:&nbsp; <span style="font-family:Georgia, 'Times New Roman', Times, serif; font-weight:normal;"><?php echo get_country_name($countryid, $db);?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo STATE_OR_PROVINCE; ?>: &nbsp;<span style="font-family:Georgia, 'Times New Roman', Times, serif; font-weight:normal;"><?php echo get_state_name($stateid, $db);?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo CITY; ?>: &nbsp;<span style="font-family:Georgia, 'Times New Roman', Times, serif; font-weight:normal;"><?php echo get_city_name($cityid, $db); ?></span>
              </td> 
            </tr>
            <tr>
			  <td nowrap="nowrap" style="font-family:'Times New Roman', Times, serif; font-size:18px; font-weight:bold;">
			     <?php echo POST_TIME; ?>: <?php echo $postdate; ?>
              </td> 
            </tr>
			 <tr>
              <td style="font-family:'Times New Roman', Times, serif; font-size:18px; font-weight:bold;" nowrap="nowrap">
			     <?php echo REPLYTO; ?>: <a href="#" style="font-size:14px; color:#0000CC;"><?php echo $emailshow;?></a> [<a href="<?php echo $contactinf_link; ?>" class="thickbox" style="font-size:14px; color:#0000CC; font-weight:bold;"><?php echo NEED_MORE_POSTER_INFO_QU; ?></a>]
              </td>
            </tr>
          </table>
		
   <!--       </fieldset>-->
		  </td>
      </tr>
    </table>
	
	</td></tr>
	<tr><td>
	
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td><fieldset style="min-height:200px;">
          <legend><?php echo POSTDESCRIPTION; ?></legend>
		   <table cellpadding="1" cellspacing="0" border="0" width="100%">
		   <tr> 
              <td style="font:'Times New Roman', Times, serif; font-size:16px;">
			    <?php echo stripslashes($description); ?>
			  </td> 
            </tr>
			<tr>
			 <td>
			 <!--<div style="padding-top:20px;">-->
			<!-- <table cellpadding="1" cellspacing="0" border="0" width="100%"><tr><td align="center">
			 <img src="upload/images/test1.jpeg" alt="test1" />
			 </td>
			 <td align="center" >
			 <img src="upload/images/test2.jpeg" alt="test2" />
			 </td></tr>
			 <tr><td align="center">
			 <img src="upload/images/test3.jpeg" alt="test3" />
			 </td></tr>
			 </table>-->
			 <!--</div>-->
			 </td>
			</tr>
          </table>
		  
		  <div style="font:'Times New Roman', Times, serif; font-weight:bold; font-size:14px; padding-top:20px; padding-bottom:20px;">
			  <?php echo POSTINGID; ?>: <?php echo $postid; ?>
			</div>
          </fieldset></td>
      </tr>
    </table>
	
	</td></tr>
	</table>
	</div>
  </div>
  <!-- end #content -->
</div>
<!-- end #page -->
<!--<div id="footer">
  <p>&copy; 2010. All Rights Reserved. Design by Inter-Bringer company.</p>
</div>-->
<!-- end #footer -->
</body>
</html>

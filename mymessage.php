<?php
 ob_start();
 require("inc/session.php");
 sessionCheck(session_id(), $_SESSION, $_SERVER);
 checkLogin();
 include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo $_SESSION['interbringerusername']."".MY_MESSAGE_BORD; ?>|Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<script  src="./js/calendar.js"></script>
<?php if($_SESSION['interbringeruserId']>0){?>
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->
<?php } ?>
<link rel="STYLESHEET" type="text/css" href="./js/cwcalendar.css">
<link rel="stylesheet" type="text/css" href="css/pagination.css" />
<script type="text/javascript">
  var formatSplitter = "-";
  var monthFormat = "mm";
  var yearFormat = "yyyy";
</script>
<script language="javascript">
function checkMsgDelete(id, pageindex, ctu)
 {
  if(confirm( '<?php echo SURE_TO_DELETE_MESSAGE_MYMESSAGE; ?>'))
		     {
				  
				  open('<?php echo $_SERVER['PHP_SELF']?>?op=d&id=' + id + '&pageindex='+pageindex+'&ctu='+ctu+'', '_self');
		     }
		     else
		     {
			       return false;
		     }
 }
 
 function leaveMsgCheck(){
   
    if(document.getElementById("send_message_content").value==""){
	   alert("<?php echo MESSAGE_CANNOT_BE_EMPTY; ?>");
	   return false;   
	}else{
	  return true;
	}
     
 }
 
</script>
<style type="text/css">
img {border:0;}
.gg_width TD {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; PADDING-TOP: 0px
}
</style>
<style type=text/css>
th {
padding:3px 3px 3px 3px;
height:30px;
font-family:"Times New Roman", Times, serif;
font-size:16px;
font-weight:bolder;
color:#000000;
}
td {
	padding:3px 3px 3px 3px;
	font-family:"Times New Roman", Times, serif;
	font-size:14px;
}
td .title{
color:#0000CC;
text-decoration:underline;
font-weight:bold;
font-size:16px;
}
</style>
</head>
<body>
<div id="main_container" style="width:100%;">
  <?php 
     require("inc/function.php");
	$current_user=$_SESSION['interbringeruserId'];
	
	
	if($_POST["post_message"]!=""){
	   
	   $to=$_POST["leave_to"];
	   
	   echo $to;
	   
	  
	   $message=iconv('gb2312', 'utf-8', $_POST["send_message_content"]);
	   
	   $sql = "insert into chat (chat.from,chat.to,message,sent) values ('".mysql_real_escape_string($_SESSION['interbringerusername'])."', '".mysql_real_escape_string($to)."','".mysql_real_escape_string($message)."',NOW())";
	   $query = mysql_query($sql, $db);
	   $fID = (int)mysql_insert_id($db); 
	   echo $sql;
	   
		if ($fID < 1) die("<b>Error:</b> DATABASE QUERY FAILED (inserting new user). ERROR AVL001");
	   header("Location: ".$_SERVER['PHP_SELF']."?ctu=".$_GET["ctu"]."");	
	   die();
	 }
	
	if($_GET["op"]=="d")
   {
	  $id=$_GET["id"];
	  $pageindex=$_GET["pageindex"];
	  $ctu=$_GET["ctu"];
	    
	  $deletesql="DELETE FROM `chat` WHERE id=".$id;
	  $q = mysql_query($deletesql, $db);
       if ($q < 1) die("<b>Error:</b> DATABASE QUERY FAILED (Delete Message for chat). ERROR AVL001");	
	  
	   header("Location: ".$_SERVER['PHP_SELF']."?pageindex=".$pageindex."&ctu=".$ctu."");	
	   die();	   
   }
   
	// the value of pagenation
	if($_GET["pageindex"])
	{
	$pageindex=$_GET["pageindex"];
	}
	if($_POST["pageindex"])
	{
	$pageindex=$_POST["pageindex"];
	}
	
	if($_GET["ctu"]){
    $chattousername=$_GET["ctu"];
	}
	
	if($_GET["lmt"]){
	  $leave_message_to=$_GET["lmt"];
	}else{
	  $leave_message_to=$_SESSION['interbringerusername'];
	}
  ?>
  <?php
	 /*This is for pagination*/
	 if(!isset($_SESSION["pagesiz"]))
	$_SESSION["pagesiz"]=10;
		
	if(isset($_POST["pagesiz"]))
	$_SESSION["pagesiz"]=$_POST["pagesiz"]; 
		
	 if(!isset($totalrecord)) $totalrecord=0;
	 
	 if($chattousername!=""){
	    $chatfromquery= "and chat.from = '".mysql_real_escape_string($chattousername)."'";
	    $chattoquery= "and chat.to = '".mysql_real_escape_string($chattousername)."'";
	 }
	 
	 if($leave_message_to!=$_SESSION['interbringerusername']){
	   $leave_message_to_info=RESPONSE_TO."".$leave_message_to.":&nbsp;&nbsp";
	 }
	 

     $checkquery=mysql_query("select * from chat where (chat.to = '".mysql_real_escape_string($_SESSION['interbringerusername'])."' $chatfromquery )or (chat.from = '".mysql_real_escape_string($_SESSION['interbringerusername'])."' $chattoquery)", $db);
	 
	 $numpost = mysql_num_rows($checkquery);
	 
	 if($_SESSION["pagesiz"]>$numpost+10) 
	 {
	  $l=0;
	   while($l<=$numpost)
	  {
	    $l=$l+10;
	   }
	   $_SESSION["pagesiz"]=$l;
	}
	
	//page diliver
	 $totalrecord=$numpost;
	 if($totalrecord)
      {
			    if ($totalrecord<$_SESSION["pagesiz"])
		      { 	
		      	 $pagecount=1;
		      }	 
			    if ($totalrecord%$_SESSION["pagesiz"])
			    {
		        	$pagecount=(int)($totalrecord/$_SESSION["pagesiz"])+1;
		      }
			    else 
			    {
				      $pagecount=$totalrecord/$_SESSION["pagesiz"];
				  }
		  }
		  else
		  {
			    $pagecount=0;
		  }
	
	    if(isset($pageindex))
		  {
			    $pageindex = intval($pageindex);
			}
		  else
		  {
			    $pageindex = 1;
			}	
			
			if($pageindex > $pagecount) $pageindex=$pagecount;
			
			
			/*string for the pageination*/
			 if ($pageindex==1)
		  {
	        $string ="<li class=\"previous-off\">[".FIRST_PAGE."]</li> <li class=\"previous-off\"><< </li>";
	       }
	       else
	       {
	      	$string.="<li class=\"previous\"><a href=?pageindex=1>[".FIRST_PAGE."]</a></li>";
			$string.="<li class=\"previous\"><a href=?pageindex=".($pageindex-1)."&ctu=".$chattousername."><<</a></li>";
	        }
		   
		   if($pageindex-2<=0)$m=1;
		   else $m=$pageindex-2;
		   
		   
		   for($m;$m<=$pageindex+2&&$m<=$pagecount;$m++)
		   {
		     if($pageindex==$m)
			 {
			   $string.="<li class=\"active\"><b>".$m."</b></li>";
			  }
			  else{
			  
			    $string.="<li><a href=?pageindex=".$m."&ctu=".$chattousername.">".$m."</a></li>";
			  }
		   
		   }
		   
		 if($pageindex==$pagecount or $pagecount==0 or $pagecount==1)
		  {
	   	    $string.="<li class=\"next-off\"> >></li> <li class=\"next-off\">[".LAST_PAGE."]</li>";
	      }
	     else
	      {
	   	  $string.= "<li class=\"next\"><a href=?pageindex=".($pageindex+1)."&ctu=".$chattousername.">>></a></li>";
		  $string .= "<li class=\"next\"><a href=?pageindex=".($pagecount)."&ctu=".$chattousername.">[".LAST_PAGE."]</a></li>";
	    }
		
		/*end string for pagenation*/
			
		$startrecordindex=($pageindex-1)*$_SESSION["pagesiz"];
	       
		$pageQury=" LIMIT ". $startrecordindex.",".$_SESSION["pagesiz"];
	

	 
	 $sql="select * from chat where (chat.to = '".mysql_real_escape_string($_SESSION['interbringerusername'])."' $chatfromquery )or (chat.from = '".mysql_real_escape_string($_SESSION['interbringerusername'])."' $chattoquery) order by sent DESC $pageQury";
	 $demandquery= mysql_query($sql, $db);
	 //$numpost=mysql_num_rows($demandquery);
  ?>
  <?php
     include_once("header/header-user.php");
   ?>
  <div style="min-height:500px; width:90%; min-width: 1050px;  margin-left:90px;">
    <div style="float:left;  width:162px; margin-top:10px;">
      <div style="border:#D8DFEA solid 1px;">
        <?php
         $usersql="select DISTINCT `from` from chat where (chat.to = '".mysql_real_escape_string($_SESSION['interbringerusername'])."') order by `sent` desc";
         $userquery= mysql_query($usersql, $db);
        ?>
  
        <table cellpadding="4" cellspacing="1" style="width:160px;">
          <tr style="background:#EDEFF4; height:30px;">
            <td colspan="2" nowrap="nowrap" style="color:#000000; font-weight:bold; font-size:14px;"><?php echo CURRENT_CONTACTER; ?>&nbsp;&nbsp;(<a href="mymessage.php" style="font-size:12px;"><?php echo ALL_MESSAGE; ?></a>)</td>
          </tr>
		  <?php
		    while($row=mysql_fetch_array($userquery))
            {    
		  ?>
          <tr>
            <td colspan="2">&nbsp;&nbsp;<a href="mymessage.php?ctu=<?php echo $row["from"]; ?>" style="font-size:14px; color:#003399;">&nbsp;&nbsp;<?php echo $row["from"]; ?></a></td>
          </tr>
		   <tr>
		   <td colspan="2">
		    <div style="width:100%; border-top:#DDDDDD solid 0.1px;"></div>
		   </td>
		   </tr>
		  <?php
		    }
		   ?>
        </table>
      </div>
    </div>
	
	
	
    <div id="content" class="fb_content clearfix" style="border:#CCCCCC solid 1px; min-height:500px; min-width:800px; width:73.5%; margin-left: 230px;">
      <div id="mainContainer" style="width:65%; float:left;"  >
        <div style="margin-top:45px; margin-left:20px; padding-bottom:5px; width:100%;font-size:20px; border-bottom:#AAAAAA solid 1px; font-weight:bolder;"><?php echo $_SESSION['interbringerusername']."".MY_MESSAGE_BORD; ?></div>
        <div style="width:100%; margin-left:20px;">
		
          <div style="width:100%; height:180px; background:#E9E9E9">
		  <form name='formpage2' method=post action='<?php echo "mymessage.php?ctu=".$chattousername ?>' >
            <div style="margin-left:20px; padding-top:15px; padding-right:30px;">
			  <div><?php echo $leave_message_to_info; ?></div>
			  <textarea rows="5" name="send_message_content" id="send_message_content"  style="width:100%;"></textarea>
			  <input type="hidden" value="<?php echo $leave_message_to;?>" name="leave_to" />
            </div>
			<div style="width:100%; padding-top:10px; text-align:right;">
			<input type="submit" name="post_message" value="<?php echo LEAVE_MESSAGE_MYMESSAGE; ?>" onclick="return leaveMsgCheck();" style="width:120px; height:30px; background-color:#3B5998; color:#FFFFFF; font-weight:bold;"  />
			&nbsp;&nbsp;&nbsp;&nbsp;</div>
			</form>
          </div>
		  
          <div style="width:100%; margin-top:20px;"> 
            <table cellpadding="0" cellspacing="0" border="0" style="width:100%; border-bottom:#CCCCCC solid 1px;">
            
                <tr>
                  <td align="left" style="font-size:12px;"><?php echo CURRENT_SHOW; ?>
					
					<?php if($totalrecord>0){ ?>
					
					<?php echo (($pageindex*$_SESSION["pagesiz"])-9); ?>-<?php 
					
					if(($totalrecord-(($pageindex*$_SESSION["pagesiz"])-9))>=$_SESSION["pagesiz"])
					{
					echo ($pageindex*$_SESSION["pagesiz"]);
					}else{
					 echo $totalrecord;
					}
					?>
					<?php }else{ ?>
					
					<?php 
					    echo "0-0"; 
						
						}
					?>
					
					<?php echo RECORDS; ?>/<?php echo RECORDTOTAL; ?>:<?php echo $totalrecord; ?><?php echo RECORDS; ?></td>
                  <td style="text-align:right;">
				  <ul id="pagination-clean" >
                      <?php echo  $string;?>
                    </ul>
					</td>
                </tr>
            </table>
            <table cellpadding="5"  class="sortable" cellspacing="5" border="0" width="100%">
              <tbody>
                <?php 	
					if($numpost>0){
					 while($row=mysql_fetch_array($demandquery)){	
					 
					  $from_user_id=get_user_id($row["from"], $db);
					  $from_gender=get_user_gender($from_user_id, $db);
					  
					  $filename = USER_HEADSHOT_IMAGE_FOLDER_SMALL."".$from_user_id."_small.jpg";
	
                      if (file_exists(dirname(__FILE__).'/'.$filename))
                      {
	                    $show_image_url=$filename;
	                  }
                      else
                     {
	                  if($from_gender==1){
	                    $show_image_url=USER_HEADSHOT_IMAGE_FOLDER_SMALL."default_m_small.jpg"; 
		               }else if($from_gender==2){
		                $show_image_url=USER_HEADSHOT_IMAGE_FOLDER_SMALL."default_w_small.jpg";
	                   }else{
		                $show_image_url=USER_HEADSHOT_IMAGE_FOLDER_SMALL."default_small.jpg";
		               }
	                 }	 
				?>
                <tr>
	            <td rowspan="2" style="width:50px;">
	             <div style="height:50px; width:50px; border:#000000 solid 1px; padding:5px 2px 2px 5px;">
	              <img src="<?php echo $show_image_url; ?>"  style="width:48px; height:48px;" />
	             </div>
	             </td>
                  <td  style="width:90%;"colspan="4"><span style="font-size:14px; color:#0000FF; font-weight:bold;"><?php echo $row["from"]; ?></span>&nbsp;&nbsp;<span style="color:#666666;"><?php echo $row["sent"]; ?></span></td>
                  <td>
				    <table>
                      <tr>
                        <td align="center" nowrap="nowrap"></td>
                        <td align="center" nowrap="nowrap"></td>
                        <td align="center" nowrap="nowrap">
						<?php if($row["from"] == $_SESSION['interbringerusername']){ ?>
						 <a href="#" onclick="javascript:checkMsgDelete('<?php echo $row["id"];?>', '<?php echo $pageindex;?>', '<?php echo $_GET["ctu"]; ?>');" style="color:#0000FF;"><?php echo REMOVE; ?></a>
						 <?php } else{?>
						 
						 <a href="mymessage.php?lmt=<?php echo $row["from"]; ?>&ctu=<?php $_GET["ctu"]; ?>" onclick="" style="color:#0000FF;"><?php echo RESPONSE; ?></a>
						 
						 <?php } ?>
						</td>
                      </tr>
                    </table>
				  </td>
                </tr>
                <tr>
                  <td align="center" colspan="3"><span style="font-style:italic; font-weight:bold;"><?php echo RESPONSE_TO; ?>： <?php echo $row["to"]; ?>:</span>&nbsp;<?php echo iconv('utf-8', 'gb2312', $row["message"]); ?></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="6"><div style="border-top:#999999 solid 1px; width:100%;"></div></td>
                </tr>
                <?php } 
					}else{
					?>
                <tr>
                  <td colspan="6" style="text-align:center;" align="center" nowrap="nowrap"><?php echo NO_RECORD_HINT; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
			
			
			
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
              <form name='formpage2' method=post action='<?php echo "mymessage.php?ctu=".$chattousername ?>' >
                <tr>
                  <td align="left"><b><?php echo PAGE; ?></b><?php echo $pageindex; ?><?php echo PAGEOF ?><?php echo $pagecount; ?>&nbsp;<b><?php echo RECORDTOTAL; ?></b>:<?php echo $totalrecord; ?>&nbsp;<?php echo RECORDS; ?></td>
                  <td style="text-align:right;"><ul id="pagination-clean">
                      <?php echo $string;?>
                    </ul>
                    <b><?php echo GO_PAGE; ?></b><?php echo PAGE_PAGE; ?>
                    <select name="pageindex" onchange="document.formpage2.submit();">
                      <?php
					 for($k=1;$k<=$pagecount;$k++)
		            {
		              if($pageindex==$k)
		             {$gostring.="<option selected value=".$k.">".$k."</option>";}
		             else
		             {$gostring.="<option value=".$k.">".$k."</option>";}
		             }
					 echo  $gostring;
					?>
                    </select></td>
                </tr>
              </form>
              <form name='formpage' method=post action='<?php echo "mymessage.php?ctu=".$chattousername; ?>' >
                <tr>
                  <td align="center" nowrap="nowrap" colspan="2"><b><?php echo PAGE_SHOW; ?></b>
                    <?php 
					     if($numpost>=190) $numpage=190;
		                  else $numpage=$numpost; 
					 ?>
                    <select name="pagesiz" onchange="javascript: document.formpage.submit();" >
                      <?php 
					    for($k=10;$k<=$numpage+10;$k=$k+10)
		                {
		                  if($_SESSION["pagesiz"]==$k) {?>
                      <option selected value="<?php echo $k; ?>" ><?php echo $k; ?></option>
                      <?php }else{ ?>
                      <option value="<?php echo $k; ?>"><?php echo $k; ?></option>
                      <?php } 
						     }?>
                    </select>
                    <?php echo RECORDS_PER_PAGES; ?> </td>
                </tr>
              </form>
            </table>
          </div>
        </div>
      </div>
	  
	  
       <div  style="min-height:200px; float:right; width:30%; margin-right:10px;">
        <div style="width:100%; margin-left:80px;">
		  	
	        <?php require_once("informationbord.php"); ?>
             
        </div>
       </div>
    </div>
  </div>
  <div style="margin-top:30px;"> </div>
  <?php
   include_once("header/footer.php");
  ?>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
</body>
</html>

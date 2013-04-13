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
<title><?php echo MYACCOUNT; ?>|Interbringer</title>
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
function checkPostDelete(id, pageindex, searchfor, type, realtype, datefrom, dateto)
 {
  if(confirm( '<?php echo SURE_TO_DELETE_POST; ?>'))
		     {
				  
				  open('<?php echo $_SERVER['PHP_SELF']?>?op=d&id=' + id + '&pageindex='+pageindex+'&for='+searchfor+'&type='+type+'&datefrom='+datefrom+'&dateto='+dateto+'&realtype='+realtype+'', '_self');
		     }
		     else
		     {
			       return false;
		     }
 }
 
 function checkRePost(id, pageindex, searchfor, type, realtype, datefrom, dateto)
 {
  if(confirm('<?php echo SURE_TO_REPOST; ?>'))
		     {
				  
				  open('<?php echo $_SERVER['PHP_SELF']?>?op=rp&id=' + id + '&pageindex='+pageindex+'&for='+searchfor+'&type='+type+'&datefrom='+datefrom+'&dateto='+dateto+'&realtype='+realtype+'', '_self');
		     }
		     else
		     {
			       return false;
		     }
 }
</script>
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
	//$_SESSION['interbringeruserId']=1;
	$current_user=$_SESSION['interbringeruserId'];
	
	if($_GET["op"]=="d")
   {
	  $post_id=$_GET["id"];
	  $type= $_GET['type'];
	  $datefrom=$_GET["datefrom"];
	  $searchfor=$_GET["for"];
	  $dateto=$_GET["dateto"];
	  $pageindex=$_GET["pageindex"];
	  $realtype=$_GET["realtype"];
	  if($realtype==1){
	  $delete_table="demandpost";
	  $check_page="demondpostdetail.php";
	  } else if($realtype==2){
	  $delete_table="supplypost";
	  $check_page="supplypostdetail.php";
	  } else{
	  $delete_table="";
	  }
	  
	  
	  $deletesql="DELETE FROM ".$delete_table." WHERE id=".$post_id;
	  $q = mysql_query($deletesql, $db);
       if ($q < 1) die("<b>Error:</b> DATABASE QUERY FAILED (Delete Post for ".$delete_table."). ERROR AVL001");	
	   
	   header("Location: ".$_SERVER['PHP_SELF']."?pageindex=".$pageindex."&for=".$searchfor."&type=".$type."&datefrom=".$datefrom."&dateto=".$dateto."");	
	   die();	   
   }else if($_GET["op"]=="rp"){
     
	  $post_id=$_GET["id"];
	  $type= $_GET['type'];
	  $datefrom=$_GET["datefrom"];
	  $searchfor=$_GET["for"];
	  $dateto=$_GET["dateto"];
	  $pageindex=$_GET["pageindex"];
	  $realtype=$_GET["realtype"];
	  if($realtype==1){
	  $repost_table="demandpost";
	  $check_page="demondpostdetail.php";
	  } else if($realtype==2){
	  $repost_table="supplypost";
	  $check_page="supplypostdetail.php";
	  } else{
	  $delete_table="";
	  }
	  $repostsql= "UPDATE `".$repost_table."` SET `postdate`= NOW() WHERE `id` = ".$post_id."";
      $q = mysql_query($repostsql, $db);
      if ($q < 1) die("<b>Error:</b> DATABASE QUERY FAILED (Re-Post Post for ".$repost_table."). ERROR AVL001");	  
	  header("Location: ".$_SERVER['PHP_SELF']."?pageindex=".$pageindex."&for=".$searchfor."&type=".$type."&datefrom=".$datefrom."&dateto=".$dateto."");	
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
	
	if ($_GET['for'])
	{
		$searchfor= $_GET['for'];	
	}
	
	if ($_GET['type'])
	{
	   $type= $_GET['type'];	
	} else {
	   $type=3;
	}
	
	if ($_GET['datefrom'])
	{
	   $datefrom= $_GET['datefrom'];	
	}
	
	if ($_GET['dateto'])
	{
	   $dateto= $_GET['dateto'];	
	}
	
	if($type==1){
	  $search_table="demandpost";
	  $check_page="demondpostdetail.php";
	  $post_type_table=1;
	} else if($type==2){
	  $search_table="supplypost";
	  $check_page="supplypostdetail.php";
	  $post_type_table=1;
	} else if($type==4){
	  $search_table="demandpost";
	  $check_page="demondpostdetail-trans.php";
	  $post_type_table=2;
	}else if($type==5){
	  $search_table="supplypost";
	  $check_page="supplypostdetail-trans.php";
	  $post_type_table=2;
	}else{
	  $search_table="";
	}
	
	if($datefrom!="") $datesearchfrom=$datefrom." 00:00:00";
	else $datesearchfrom="";
    if($dateto!="") $datesearchto=$dateto." 23:59:59";
	else $datesearchto="";
	
	if($searchfor!="") $searchforQuery=" AND title LIKE '%".$searchfor."%'";
	else $searchforQuery="";
	
	if(($datesearchfrom!="")&&($datesearchto!="")) $searchdateQuery=" AND postdate between '".$datesearchfrom."' and '".$datesearchto."'";
?>
  <?php
	 /*This is for pagination*/
	 if(!isset($_SESSION["pagesiz"]))
	$_SESSION["pagesiz"]=10;
		
	if(isset($_POST["pagesiz"]))
	$_SESSION["pagesiz"]=$_POST["pagesiz"]; 
	
	 if(!isset($totalrecord)) $totalrecord=0;
	 
	 if($type==3){
	  $checkquery=mysql_query("(SELECT id, cityid, title, type, postdate, post_type FROM `demandpost` WHERE `userid`=".$current_user." $searchforQuery $searchdateQuery) UNION All (SELECT id, cityid, title, type, postdate, post_type FROM `supplypost` WHERE `userid`=".$current_user." $searchforQuery $searchdateQuery)", $db);
	 }else{
     $checkquery=mysql_query("SELECT * FROM `".$search_table."` WHERE `userid`=".$current_user." $searchforQuery $searchdateQuery AND `post_type` = ".$post_type_table."", $db);
	 }
	 
	// echo "SELECT * FROM `".$search_table."` WHERE `userid`=".$current_user." $searchforQuery $searchdateQuery AND `post_type` = ".$post_type_table."";
	 
	// die();
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
			$string.="<li class=\"previous\"><a href=?pageindex=".($pageindex-1)."&for=".$searchfor."&type=".$type."&datefrom=".$datefrom."&dateto=".$dateto."><<</a></li>";
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
			  
			    $string.="<li><a href=?pageindex=".$m."&for=".$searchfor."&type=".$type."&datefrom=".$datefrom."&dateto=".$dateto.">".$m."</a></li>";
			  }
		   
		   }
		   
		 if($pageindex==$pagecount or $pagecount==0 or $pagecount==1)
		  {
	   	    $string.="<li class=\"next-off\"> >></li> <li class=\"next-off\">[".LAST_PAGE."]</li>";
	      }
	     else
	      {
	   	  $string.= "<li class=\"next\"><a href=?pageindex=".($pageindex+1)."&for=".$searchfor."&type=".$type."&datefrom=".$datefrom."&dateto=".$dateto.">>></a></li>";
		  $string .= "<li class=\"next\"><a href=?pageindex=".($pagecount)."&for=".$searchfor."&type=".$type."&datefrom=".$datefrom."&dateto=".$dateto.">[".LAST_PAGE."]</a></li>";
	    }
		
		/*end string for pagenation*/
			
		$startrecordindex=($pageindex-1)*$_SESSION["pagesiz"];
	       
		$pageQury=" LIMIT ". $startrecordindex.",".$_SESSION["pagesiz"];
	
     if($type!=3){
     $sql="SELECT * FROM `".$search_table."` WHERE `userid`=".$current_user." $searchforQuery $searchdateQuery AND `post_type` = ".$post_type_table." ORDER BY `postdate` DESC $pageQury";
	 }else{
	 
	 $sql="(SELECT id, cityid, title, type, postdate, post_type FROM `demandpost` WHERE `userid`=".$current_user." $searchforQuery $searchdateQuery) UNION All (SELECT id, cityid, title, type, postdate, post_type FROM `supplypost` WHERE `userid`=".$current_user." $searchforQuery $searchdateQuery) ORDER BY `postdate` DESC $pageQury";
	 
	 }
	 $demandquery= mysql_query($sql, $db);
	 //$numpost=mysql_num_rows($demandquery);
	 
    ?>
  <?php
     include_once("header/header-user.php");
   ?>
  <div style="min-height:500px; width:90%; min-width: 1050px;  margin-left:90px;">
    <div style="float:left;  width:219px; margin-top:10px;">
      <div style="border:#D8DFEA solid 1px;">
        <?php
  $usersql="SELECT * FROM `user` WHERE `id`=".$current_user."";
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
  
    $filename = USER_HEADSHOT_IMAGE_FOLDER_SMALL."".$_SESSION['interbringeruserId']."_small.jpg";
	
    if (file_exists(dirname(__FILE__).'/'.$filename))
     {
	   $show_image_url=$filename;
	  }
    else
     {
	   if($gender==1){
	     $show_image_url=USER_HEADSHOT_IMAGE_FOLDER_SMALL."default_m_small.jpg"; 
		}else if($gender==2){
		 $show_image_url=USER_HEADSHOT_IMAGE_FOLDER_SMALL."default_w_small.jpg";
	    }else{
		 $show_image_url=USER_HEADSHOT_IMAGE_FOLDER_SMALL."default_small.jpg";
		}
	 }
  ?>
  
        <table cellpadding="4" cellspacing="1" style="width:218px;">
          <tr style="background:#EDEFF4; height:30px;">
            <td colspan="2" nowrap="nowrap" style="color:#000000; font-weight:bold; font-size:14px;"><?php echo BASICINFOMATION; ?> </td>
            <td style="text-align:right;"><a href="usersetting.php" style="color:#0000FF"><?php echo NEEDCHANGEQU; ?></a> </td>
          </tr>
          <tr>
		    <td rowspan="3">
			  <div style="height:50px; width:50px; border:#E0E0E0 solid 1px; padding:5px 2px 2px 5px;">
	           <img src="<?php echo $show_image_url; ?>"  style="width:48px; height:48px;" />
	          </div>
			</td>
            <td style="font-weight:bold; width:65px;" nowrap="nowrap"><?php echo USERNAME; ?>:</td>
            <td><?php echo $username; ?></td>
          </tr>
          <tr>
            <td style="font-weight:bold; width:65px" nowrap="nowrap"><?php echo REALNAME; ?>:</td>
            <td><?php echo $realname; ?></td>
          </tr>
		  <tr>
            <td style="font-weight:bold;  width:65px" nowrap="nowrap"><?php echo GENDER; ?>:</td>
            <td><?php echo get_gender_name($gender); ?></td>
          </tr>
          <tr>
		    <td rowspan="3"></td>
            <td style="font-weight:bold;  width:65px" nowrap="nowrap"><?php echo COUNTRY; ?>:</td>
            <td><?php echo get_country_name($countryid, $db); ?></td>
          </tr>
          <tr>
            <td style="font-weight:bold;  width:65px" nowrap="nowrap"><?php echo STATE_OR_PROVINCE;?>:</td>
            <td><?php echo get_state_name($stateid, $db); ?></td>
          </tr>
          <tr>
            <td style="font-weight:bold;  width:65px" nowrap="nowrap"><?php echo CITY; ?>:</td>
            <td><?php echo get_city_name($cityid, $db); ?></td>
          </tr>
        </table>
      </div>
      <div style="height:10px;"></div>
      <div style="border:#D8DFEA solid 1px;">
        <table cellpadding="4" cellspacing="1" style="width:218px;">
          <tr style="background:#EDEFF4; height:30px;">
            <td colspan="1" nowrap="nowrap" style="color:#000000; font-weight:bold; font-size:14px;"><?php echo CONTACTINFORMATION; ?> </td>
            <td style="text-align:right;"><a href="usersetting.php" style="color:#0000FF"><?php echo NEEDCHANGEQU; ?></a> </td>
          </tr>
          <tr>
            <td style="font-weight:bold;width:65px" nowrap="nowrap"><?php echo EMAIL; ?>:</td>
            <td style="color:#0033CC;"><?php echo $email; ?></td>
          </tr>
          <tr>
            <td style="font-weight:bold; width:65px" nowrap="nowrap"><?php echo TELEPHONE; ?>:</td>
            <td><?php echo $cellphone; ?></td>
          </tr>
          <tr>
            <td style="font-weight:bold; width:65px" nowrap="nowrap"><?php echo QQ; ?>:</td>
            <td><?php echo $qq; ?></td>
          </tr>
          <tr>
            <td style="font-weight:bold; width:65px" nowrap="nowrap"><?php echo MSN; ?>: </td>
            <td><?php echo $msn; ?></td>
          </tr>
        </table>
      </div>
	  <div style="height:10px; border-bottom:#D8DFEA solid 1px;"></div>
      <div style="border-bottom:#D8DFEA solid 1px;">
        <table cellpadding="4" cellspacing="1" style="width:218px;">
          <tr>
		    <td style="width:60px;"></td>
            <td style="font-weight:bold;width:30px" align="right" nowrap="nowrap"><a href="mymessage.php" title="<?php echo MESSAGE_BORD; ?>"><img src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/comment.gif" /></a></td>
            <td style="color:#0033CC;"><a href="mymessage.php" title="<?php echo MESSAGE_BORD; ?>"><?php echo MESSAGE_BORD; ?></a></td>
			
          </tr>
        </table>
      </div>
    </div>
    <div id="content" class="fb_content clearfix" style="border:#CCCCCC solid 1px; min-height:500px; min-width:800px; width:73.5%; margin-left: 230px;">
      <div id="mainContainer" style="width:65%; float:left;"  >
        <div style="margin-top:45px; margin-left:20px; padding-bottom:5px; width:100%;font-size:20px; border-bottom:#AAAAAA solid 1px; font-weight:bolder;"> <?php echo ALREADY_POSTED_POST; ?> </div>
        <div style="width:100%; margin-left:20px;">
          <div style="width:100%; height:35px; background:#E9E9E9">
            <div style="margin-left:20px; padding-top:2px;">
              <input type="image" src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/button-post.png" id="post" name="post" value="<?php echo POST; ?>" onclick="javascript:window.location='post.php';" />
            </div>
          </div>
          <div style="width:100%; margin-top:20px;"> 
            <table cellpadding="0" cellspacing="0" border="0" style="width:100%; border-bottom:#CCCCCC solid 1px;">
            
                <tr>
                  <td align="left" style="font-size:12px;">
				  
				  
				  <?php echo CURRENT_SHOW; ?>
					
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
					
					<?php echo RECORDS; ?>/<?php echo RECORDTOTAL; ?>:<?php echo $totalrecord; ?><?php echo RECORDS; ?>
				  
				  </td>
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
					 if($row["type"]==2){ 
					  if($row["post_type"]==1){
					 $check_page="supplypostdetail.php";
					 $type_information="<span style=\"color:#FD5411; font-weight:bold;\">".TAKER."</span>";
					 }else{
					  $check_page="supplypostdetail-trans.php";
					  $type_information="<span style=\"color:#68A64C; font-weight:bold;\">".CARRIER."</span>";
					  }
					 
					 }
					 else{
					 if($row["post_type"]==1){
					   $check_page="demondpostdetail.php";
					   $type_information="<span style=\"color:#FD5411; font-weight:bold;\">".BUYER."</span>";
					   }else{
					    $check_page="demondpostdetail-trans.php";
						$type_information="<span style=\"color:#68A64C; font-weight:bold;\">".NEEDER."</span>";
					   }
					  }
					 
					 ?>
                <tr>
                  <td  style="width:90%;"colspan="4"><a href="<?php echo $check_page; ?>?pid=<?php echo $row["id"];?>" class="title"><?php echo $row["title"]; ?></a></td>
                  <td><table>
                      <tr>
                        <td align="center" nowrap="nowrap"><a href="<?php echo $check_page;?>?pid=<?php echo $row["id"];?>" style="color:#0000FF;"><?php echo CHECK; ?></a></td>
                        <td align="center" nowrap="nowrap"><a href="#" onclick="javascript:checkPostDelete('<?php echo $row["id"];?>', '<?php echo $pageindex;?>', '<?php echo $searchfor; ?>', '<?php echo $type; ?>', '<?php echo $row["type"]; ?>' ,'<?php echo $datefrom; ?>' ,'<?php echo $dateto; ?>');" style="color:#0000FF;"><?php echo REMOVE; ?></a></td>
                        <td align="center" nowrap="nowrap"><a href="#" onclick="javascript:checkRePost('<?php echo $row["id"];?>', '<?php echo $pageindex;?>', '<?php echo $searchfor; ?>', '<?php echo $type; ?>', '<?php echo $row["type"]; ?>','<?php echo $datefrom; ?>' ,'<?php echo $dateto; ?>');" style="color:#0000FF;"><?php echo REPOST; ?></a></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td align="center" nowrap="nowrap">(<?php echo get_city_name($row["cityid"], $db);?>)</td>
                  <td align="center" nowrap="nowrap">(
                    <?php  echo $type_information;?>
                    )</td>
                  <td align="center" nowrap="nowrap"><?php echo $row["postdate"]; ?></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan="5"><div style="border-top:#999999 solid 1px; width:100%;"></div></td>
                </tr>
                <?php } 
					}else{
					?>
                <tr>
					  <td colspan="7" style="text-align:center;" nowrap="nowrap">
					  <table cellpadding="0" cellspacing="0" style="border:#FFFF00 solid 2px; width:100%;">
					  <tr>
					   <td style="text-align:center; background-color:#FEEDF1;">
					     <?php  echo NO_RECORD_HINT; ?>
					   </td>
					  </tr>
					  </table>
					  
					  </td>
					 </tr>
                <?php } ?>
              </tbody>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
              <form name='formpage2' method=post action='<?php echo "myaccount.php?&for=".$searchfor."&type=".$type."&datefrom=".$datefrom."&dateto=".$dateto;?>' >
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
              <form name='formpage' method=post action='<?php echo "myaccount.php?&for=".$searchfor."&type=".$type."&datefrom=".$datefrom."&dateto=".$dateto; ?>' >
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
      <div  style="min-height:200px; float:right; margin-top:76px; width:30%; margin-right:10px;">
        <div style="width:100%; padding-bottom:10px; padding-top:10px; border-bottom:#E9E9E9 solid 1px; color:#000000; border-top:#AAAAAA solid 1px; font-size:14px; font-weight:bold;"> <?php echo SEARCH_FOR_OWENER_POST; ?> </div>
        <div style="width:100%;">
          <form id="search_form" name="search_form" method="get" action="myaccount.php" enctype="multipart/form-data">
            <table cellpadding="0" cellspacing="0" border="0" style="width:90%;">
              <tr>
                <td style="height:20px;"></td>
                <td></td>
              </tr>
              <tr>
                <td style="font-w eight:bold; font-size:14px;" nowrap="nowrap"><?php echo SEARCH_FOR; ?>:</td>
                <td><input type="text" id="for" name="for" value="<?php echo $searchfor;?>" style="width:98%;height:20px;border:#BDC7D8 solid 1px;" />
                </td>
              </tr>
              <tr>
                <td style="height:10px;"></td>
                <td></td>
              </tr>
              <tr>
                <td style="font-wei ght:bold; font-size:14px;"><?php echo TYPE; ?>:</td>
                <td><select id="type" name="type" style="width:98%;border:#BDC7D8 solid 1px;height:25px;font-size:14px;">
                    <option value="3" <?php if($type==3){?> selected="selected"<?php }?> ><?php echo MYACCOUNT_ALL; ?></option>
                    <option value="1" <?php if($type==1){?> selected="selected"<?php }?> ><?php echo MYACCOUNT_DEMAND; ?></option>
                    <option value="4" <?php if($type==4){?> selected="selected"<?php }?> ><?php echo MYACCOUNT_DEMAND_TRANS; ?></option>
                    <option value="2" <?php if($type==2){?> selected="selected"<?php }?> ><?php echo MYACCOUNT_SUPPLY; ?></option>
                    <option value="5" <?php if($type==5){?> selected="selected"<?php }?> ><?php echo MYACCOUNT_SUPPLY_TRANS; ?></option>
                  </select>
                </td>
              </tr>
              <tr>
                <td style="height:10px;"></td>
                <td></td>
              </tr>
              <tr>
                <td nowrap="nowrap" style="font- weight:bold; font-size:14px;" ><?php echo POST_TIME; ?>:</td>
                <td nowrap="nowrap" style="font-we ight:bold; font-size:14px;"><?php echo FROM; ?>：
                  <input type="text" name="datefrom" value="<?php echo $datefrom; ?>"   readonly="readonly" id="datefrom" onclick="fPopCalendar('datefrom')" style="width:136px;height:20px;border:#BDC7D8 solid 1px;" />
                </td>
              </tr>
              <tr>
                <td style="height:10px;"></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td nowrap="nowrap" style="font-w eight:bold; font-size:14px;"><?php echo TO; ?>：
                  <input type="text" name="dateto" id="dateto" value="<?php echo $dateto; ?>"  readonly="readonly" onclick="fPopCalendar('dateto')" style="width:136px; height:20px;border:#BDC7D8 solid 1px;" />
                </td>
              </tr>
              <tr>
                <td colspan="2"><div style="width:100%;border-bottom:#AAAAAA solid 1px;border-top:#E9E9E9 solid 1px; padding-bottom:20px; padding-top:20px; margin-top:20px; text-align:center;">
                    <table style="width:100%;" border="0">
                      <tr>
                        <td  style="text-align:right;"><input type="image" src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/buttom-search.png" onclick="javascript: document.forms["search_form"].submit(); " />
                          <input type="hidden" id="search" name="search" value="search" />
                        </td>
                        <td  style="text-align:left;"><a href="myaccount.php"><span style="color:#000000; font-size:18px; font-weight:bold;">[<?php echo START_OVER;?>]</span></a> </td>
                      </tr>
                    </table>
                  </div></td>
              </tr>
            </table>
          </form>
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

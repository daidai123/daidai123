<?php
ob_start();
session_start();
include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo FINDBRINGER; ?> |Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<script  src="./js/calendar.js"></script>
<link rel="STYLESHEET" type="text/css" href="./js/cwcalendar.css">
<link rel="stylesheet" type="text/css" href="css/pagination.css" />
<script type="text/javascript">
    var GB_ROOT_DIR = "./greybox/";
</script>
<script type="text/javascript">
  var formatSplitter = "-";
  var monthFormat = "mm";
  var yearFormat = "yyyy";
</script>
<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<?php if($_SESSION["interbringeruserId"]>0){?>
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->
<?php } ?>
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
 include("threelink.php");
 include("inc/function.php");
 

// the value of pagenation
	if($_GET["pageindex"])
	{
	$pageindex=$_GET["pageindex"];
	}
	if($_POST["pageindex"])
	{
	$pageindex=$_POST["pageindex"];
	}
	
	if ($_GET['t'])
	{
		$title= $_GET['t'];	
	}
	
	
	if ($_GET['tt'])
	{
	   $title_search= $_GET['tt'];	
	}else{
	
	  $title_search="entire";
	}
	
   if($_GET["header_search_type"]!=""){
	  
	   if($_GET["des_in"]!="") $title_search="entire";
	   else $title_search="title";
	
	}
	
	
	if ($_GET['fc'])
	{
	   $fcountry= $_GET['fc'];	
	}
	
	if ($_GET['fs'])
	{
	   $fstate= $_GET['fs'];	
	}
	
	if ($_GET['fcity'])
	{
	   $fcity= $_GET['fcity'];	
	}
	
	if ($_GET['tc'])
	{
	   $tcountry= $_GET['tc'];	
	}
	
	if ($_GET['ts'])
	{
	   $tstate= $_GET['ts'];	
	}
	
	if ($_GET['tcity'])
	{
	   $tcity= $_GET['tcity'];	
	}
	
	if ($_GET['bt1'])
	{
	   $backtime1= $_GET['bt1'];	
	}
	
	if ($_GET['bt2'])
	{
	   $backtime2= $_GET['bt2'];	
	}
	
	if($backtime1!="") $datesearchfrom=$backtime1;
	else $datesearchfrom="";
    if($backtime2!="") $datesearchto=$backtime2;
	else $datesearchto="";
	
	if ($_GET['ca'])
	{
	   $catergory= $_GET['ca'];	
	}
	
	if($title!=""){ 
	if($title_search=="title"){
	$searchforQuery=" AND title LIKE '%".$title."%'";
	}else{
	$searchforQuery=" AND (title LIKE '%".$title."%' OR description LIKE '%".$title."%')";
	 }
	}else $searchforQuery="";
	
	if($tcountry!="") $tcountrySearch=" AND countryback = ".$tcountry."";
	else $tcountrySearch="";
	
	if($tstate!="") $tstateSearch=" AND stateback = ".$tstate."";
	else $tstateSearch="";
	
	if($tcity!="") $tcitySearch=" AND cityback = ".$tcity."";
	else $tcitySearch="";
	
	
	if($fcountry!="") $fcountrySearch=" AND countryid = ".$fcountry."";
	else $fcountrySearch="";
	
	if($fstate!="") $fstateSearch=" AND stateid = ".$fstate."";
	else $fstateSearch="";
	
	if($fcity!="") $fcitySearch=" AND cityid = ".$fcity."";
	else $fcitySearch="";
	
	
	
	
	if($catergory != "" ) $catergorySearch=" AND catergory = '".$catergory."'";
	else $catergorySearch = "";
	
	if(($datesearchfrom!="")&&($datesearchto!="")) $searchdateQuery=" AND backtime between '".$datesearchfrom."' and '".$datesearchto."'";
	else $searchdateQuery="";
	
?>

<?php
	 /*This is for pagination*/
	 if(!isset($_SESSION["pagesizforbringer"]))
	$_SESSION["pagesizforbringer"]=10;
		
	if(isset($_POST["pagesiz"]))
	$_SESSION["pagesizforbringer"]=$_POST["pagesiz"]; 
	
	 if(!isset($totalrecord)) $totalrecord=0;
     $checkquery=mysql_query("SELECT * FROM `supplypost` WHERE post_type = 1 $searchforQuery $fcountrySearch $fstateSearch $fcitySearch $tcountrySearch $tstateSearch $tcitySearch $catergorySearch $searchdateQuery", $db);
	 
	 // echo "SELECT * FROM `supplypost` WHERE 1 = 1 $searchforQuery $fcountrySearch $fstateSearch $fcitySearch $tcountrySearch $tstateSearch $tcitySearch $catergorySearch $searchdateQuery";
	  
	 $numpost = mysql_num_rows($checkquery);
	 if($_SESSION["pagesizforbringer"]>$numpost+10) 
	 {
	  $l=0;
	   while($l<=$numpost)
	  {
	    $l=$l+10;
	   }
	   $_SESSION["pagesizforbringer"]=$l;
	}
	
	//page diliver
	 $totalrecord=$numpost;
	 if($totalrecord)
      {
			    if ($totalrecord<$_SESSION["pagesizforbringer"])
		      { 	
		      	 $pagecount=1;
		      }	 
			    if ($totalrecord%$_SESSION["pagesizforbringer"])
			    {
		        	$pagecount=(int)($totalrecord/$_SESSION["pagesizforbringer"])+1;
		      }
			    else 
			    {
				      $pagecount=$totalrecord/$_SESSION["pagesizforbringer"];
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
			$string.="<li class=\"previous\"><a href=?pageindex=".($pageindex-1)."&t=".$title."&tt=".$title_search."&fc=".$fcountry."&fs=".$fstate."&fcity=".$fcity."&tc=".$tcountry."&ts=".$tstate."&tcity=".$tcity."&bt1=".$backtime1."&bt2=".$backtime2."&ca=".$catergory."><<</a></li>";
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
			  
			    $string.="<li><a href=?pageindex=".$m."&t=".$title."&tt=".$title_search."&fc=".$fcountry."&fs=".$fstate."&fcity=".$fcity."&tc=".$tcountry."&ts=".$tstate."&tcity=".$tcity."&bt1=".$backtime1."&bt2=".$backtime2."&ca=".$catergory.">".$m."</a></li>";
			  }
		   
		   }
		   
		 if($pageindex==$pagecount or $pagecount==0 or $pagecount==1)
		  {
	   	    $string.="<li class=\"next-off\"> >></li> <li class=\"next-off\">[".LAST_PAGE."]</li>";
	      }
	     else
	      {
	   	    $string.= "<li class=\"next\"><a href=?pageindex=".($pageindex+1)."&t=".$title."&tt=".$title_search."&fc=".$fcountry."&fs=".$fstate."&fcity=".$fcity."&tc=".$tcountry."&ts=".$tstate."&tcity=".$tcity."&bt1=".$backtime1."&bt2=".$backtime2."&ca=".$catergory.">>></a></li>";
			$string .= "<li class=\"next\"><a href=?pageindex=".($pagecount)."&t=".$title."&tt=".$title_search."&fc=".$fcountry."&fs=".$fstate."&fcity=".$fcity."&tc=".$tcountry."&ts=".$tstate."&tcity=".$tcity."&bt1=".$backtime1."&bt2=".$backtime2."&ca=".$catergory.">[".LAST_PAGE."]</a></li>";
	    }
		
		/*end string for pagenation*/
			
		$startrecordindex=($pageindex-1)*$_SESSION["pagesizforbringer"];
	       
		$pageQury=" LIMIT ". $startrecordindex.",".$_SESSION["pagesizforbringer"];
	

              $sql="SELECT * FROM `supplypost` WHERE post_type = 1 $searchforQuery $fcountrySearch $fstateSearch $fcitySearch $tcountrySearch $tstateSearch $tcitySearch $catergorySearch $searchdateQuery ORDER BY `postdate` DESC $pageQury";
	          $supplyquery= mysql_query($sql, $db);
	         // $numpost=mysql_num_rows($demandquery);
	 
     ?>
    
   <?php
	if($_SESSION['interbringeruserId']>0){
     include_once("header/header-user-buy.php");
	 }else{
	 include_once("header/header-search-buy.php");
	 }
    ?>


  <div style="min-height:500px; width:90%; margin-left:90px;">
  <div style="float:left; width:219px; margin-top:60px;">
  
  <div style="border:#CCCCCC solid 1px;">
  <form id="findbringer_form" method="get" name="findbringer_form" action="findbringer.php" enctype="multipart/form-data">
   <table cellpadding="4" cellspacing="1" style="width:218px;">
     <tr style="background:#E9E9E9; height:35px;">
	 <td colspan="2" nowrap="nowrap" style="color:#000000; font-weight:bold; font-size:18px;">
	  <?php echo ADVANCED_SEARCH_FINDBRINGER; ?>
	 </td>
	 </tr>
     <tr>
	 <td  colspan="2" style="font-weight:bold;" nowrap="nowrap"><?php echo KEY_WORD_FINDBRINGER; ?></td>
	 <!--<td></td>-->
     </tr>
	 <tr>
	 <td colspan="2">
	 <input type="text" style="width:200px;"value="<?php echo $title; ?>" id="t" name="t"  />
	 </td>
	 </tr>
	 <tr>
	 <td nowrap="nowrap" align="left">
	 <input type="radio" value="entire" <?php if($title_search=="entire"){?> checked="checked" <?php }?> name="ts" id="title_search" />
     <?php echo ENTIRE_TEXT_QU; ?>
	 </td>
	 <td nowrap="nowrap" align="left">
	 <input type="radio" <?php if($title_search=="title"){?> checked="checked" <?php }?> value="title" name="ts" id="title_search" />
     <?php echo ONLY_TITL_QU; ?>
	 </td>
	 </tr>
	 <tr>
	 <td colspan="2" style="height:20px;">
	 </td>
	 </tr>
	 <tr>
	 <td colspan="2" style="font-weight:bold;" nowrap="nowrap"><?php echo CATERGORIES_FINDBRINGER; ?></td>
	 <!--<td></td>-->
     </tr>
	 
	 <tr>
	 <td colspan="2">
	 <?php echo catergory_drop_list("ca", "id='ca' style=\"width:200px\"", "".$catergory."", "".ANY_OF_THEM."") ?>
	 </td>
	 </tr>
	 <tr>
	 <td colspan="2" style="height:20px;">
	 </td>
	 </tr>
	 <tr>
	 <td colspan="2" style="font-weight:bold;" nowrap="nowrap"><?php echo TAKER_PURCHASE_LOCATION; ?></td>
     </tr>
	 <tr>
	 <td  colspan="2" style="font-weight:bold;" nowrap="nowrap"><?php echo COUNTRY; ?>:</td>
     </tr>
	 <?php
	   $country_query="SELECT * FROM `country` ORDER BY `id`";
	   $country_execute_query = mysql_query($country_query, $db); 
       $numCountry = mysql_num_rows($country_execute_query); 
     ?>
	 <tr>
	 <td colspan="2" >
	 <select id="fc" name="fc" style="width:200px" onChange="changepro('fs','fc');" >
     <option value=""><?php echo ANY_OF_THEM; ?></option>
     <?php  while ($row = mysql_fetch_array($country_execute_query)) {
	 if($fcountry==$row["id"]) $fselected="selected=\"selected\"";
	 else $fselected="";
     ?>
     <option value="<?php echo $row["id"];?>" <?php echo $fselected;?>><?php echo $row["country"]; ?></option>
     <?php } ?>
     </select>
	 </td>
	 </tr>
	 <tr>
	 <td  colspan="2" style="font-weight:bold;" nowrap="nowrap"><?php echo STATE_OR_PROVINCE; ?>:</td>
     </tr>
	 <tr>
	 <td colspan="2">
	  <select id="fs" name="fs" style="width:200px" onChange="changecity('fcity','fs');">
       <option value=""><?php echo ANY_OF_THEM; ?></option>
	   <?php 
		if($fcountry!="") {
	      $state_query="SELECT * FROM `states` where `country`= ".$fcountry." ORDER BY `id`";
	      $state_execute_query = mysql_query($state_query, $db); 
	   ?>
	  <?php  
		while ($row = mysql_fetch_array($state_execute_query)) {
		  if($fstate==$row["id"]) $fselected="selected=\"selected\"";
		  else $fselected="";
	  ?>
	    <option value="<?php echo $row["id"];?>" <?php echo $fselected;?>><?php echo $row["state_name"]; ?></option>
	   <?php   } ?> 
	  <?php } ?>
      </select>
	  </td>
	 </tr>
	 <tr>
	 <td  colspan="2" align="right" style="font-weight:bold;" nowrap="nowrap"><?php echo CITY; ?>: </td>
	 </tr>
	 <tr>
	 <td colspan="2">
	 <select id="fcity" name="fcity" style="width:200px">
     <option value=""><?php echo ANY_OF_THEM; ?></option>
	<?php 
     if($fstate!="") {
	  $city_query="SELECT * FROM `city` where `state_id`= ".$fstate." ORDER BY `id`";
	  $city_execute_query = mysql_query($city_query, $db); 
	?>
    <?php  
	  while ($row = mysql_fetch_array($city_execute_query)) {
	   if($fcity==$row["id"]) $fselected="selected=\"selected\"";
	   else $fselected="";
	?>
	<option value="<?php echo $row["id"];?>" <?php echo $fselected;?>><?php echo $row["name"]; ?></option>
     <?php   } ?> 
	 <?php } ?>
     </select>
	 </td>
	 </tr>
	 <tr>
	 <td colspan="2" style="height:20px;">
	 </td>
	 </tr>
	 <tr>
	 <td colspan="2" style="font-weight:bold;" nowrap="nowrap"><?php echo TAKER_TO_LOCATION; ?></td>
     </tr>
	 <tr>
	 <td  colspan="2" style="font-weight:bold;" nowrap="nowrap"><?php echo COUNTRY; ?>:</td>
	 <!--<td></td>-->
     </tr>
	 <?php
	   $country_query="SELECT * FROM `country` ORDER BY `id`";
	   $country_execute_query = mysql_query($country_query, $db); 
       $numCountry = mysql_num_rows($country_execute_query); 
	 ?>
	 <tr>
	 <td colspan="2" >
	 <select id="tc" name="tc" style="width:200px" onChange="changepro('ts','tc');" >
           <option value=""><?php echo ANY_OF_THEM; ?></option>
       <?php  while ($row = mysql_fetch_array($country_execute_query)) {
				if($tcountry==$row["id"]) $tselected="selected=\"selected\"";
			    else $tselected="";
		?>
           <option value="<?php echo $row["id"];?>" <?php echo $tselected;?>><?php echo $row["country"]; ?></option>
        <?php } ?>
     </select>
	 </td>
	 </tr>
	 <tr>
	 <td  colspan="2" style="font-weight:bold;" nowrap="nowrap"><?php echo STATE_OR_PROVINCE; ?>:</td>
	 <!--<td></td>-->
     </tr>
	 <tr>
	 <td colspan="2">
	  <select id="ts" name="ts" style="width:200px" onChange="changecity('tcity','ts');">
       <option value=""><?php echo ANY_OF_THEM; ?></option>
	    <?php 
		if($tcountry!="") {
		$state_query="SELECT * FROM `states` where `country`= ".$tcountry." ORDER BY `id`";
	    $state_execute_query = mysql_query($state_query, $db); 
	    ?>
	    <?php  
			while ($row = mysql_fetch_array($state_execute_query)) {
			   if($tstate==$row["id"]) $tselected="selected=\"selected\"";
			   else $tselected="";
	     ?>
	    <option value="<?php echo $row["id"];?>" <?php echo $tselected;?>><?php echo $row["state_name"]; ?></option>
	    <?php   } ?> 
	    <?php } ?>
       </select>
	  </td>
	 </tr>
	 <tr>
	 <td  colspan="2" align="right" style="font-weight:bold;" nowrap="nowrap"><?php echo CITY; ?>: </td>
	 </tr>
	 <tr>
	 <td colspan="2">
	 <select id="tcity" name="tcity" style="width:200px">
      <option value=""><?php echo ANY_OF_THEM; ?></option>
	   <?php 
		  if($tstate!="") {
			$city_query="SELECT * FROM `city` where `state_id`= ".$tstate." ORDER BY `id`";
	        $city_execute_query = mysql_query($city_query, $db); 
	   ?>
	   <?php  
	      while($row = mysql_fetch_array($city_execute_query)) {
			 if($tcity==$row["id"]) $tselected="selected=\"selected\"";
		     else $tselected="";
	   ?>
	    <option value="<?php echo $row["id"];?>" <?php echo $tselected;?>><?php echo $row["name"]; ?></option>
	   <?php   } ?> 
	   <?php } ?>
     </select>
	 </td>
	 </tr>
	 <tr>
	 <td colspan="2" style="height:20px;">
	 </td>
	 </tr>
	 <tr>
	 <td colspan="2" nowrap="nowrap" style="font-weight:bold;"><?php echo BRINGER_ARRIVAL_TIME;?>:
	 </td>
     </tr>
	 <tr>                   
	 <td colspan="2" nowrap="nowrap" style="font-weight:bold;"><?php echo ARRIVAL_FROM; ?>:
	 </td>
	 </tr>
	 <tr>
	 <td colspan="2">
	 <input type="text" value="<?php echo $backtime1; ?>"  readonly="readonly" onclick="fPopCalendar('bt1')" id="bt1" name="bt1" style="width:200px;"/>
     </td>                  
	 </tr>
	 <td colspan="2" nowrap="nowrap" style="font-weight:bold;">
	 <?php echo ARRIVAL_TO; ?>:
	 </td>
	 <tr>
	 <td colspan="2">
	 <input type="text" value="<?php echo $backtime2; ?>"  readonly="readonly" onclick="fPopCalendar('bt2')"  id="bt2" name="bt2" style="width:200px;"/>
     </td>
	</tr>

	<tr>
	<td colspan="2" style="height:20px;">
	</td>
	</tr>
	<tr>
	<td  style="text-align:right; width:50%;">
	  <input type="image" src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/buttom-search.png" />
	  </td>
	  <td style="text-align:left;">
	  [<a href="findbringer.php" style="color:#000000;font-size:15px; font-weight:bold;" ><?php echo START_OVER;?></a>]
	  </td>
	</tr>
   </table>
   </form>
   </div>
   



  </div>
  <div id="content" class="fb_content clearfix" style="min-height:500px; min-width:650px; width:73.5%; margin-left: 230px;">

	<div id="mainContainer" style="width:85%; float:left;"  >
       <div style="margin-top:30px; margin-left:20px; padding-bottom:5px; width:100%;font-size:20px; border-bottom:#AAAAAA solid 1px; font-weight:bolder;">
	     <?php echo TAKER_RESULT_FINDBRINGER; ?>
	   </div>
	   <div style="width:100%; margin-left:20px;">
	     <div style="width:100%; height:35px; background:#E9E9E9">
		  <div style="margin-left:20px;">
		    <input type="image" src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/button-post.png" id="post" name="post" value="<?php echo POST; ?>" onclick="javascript:window.location='post.php';" />
		  </div>
		 </div>
		 <div style="width:100%; margin-top:20px;">
		   <table cellpadding="0" cellspacing="0" border="0" style="width:100%; border-bottom:#CCCCCC solid 1px;">
                  <tr>
                    <td align="left" style="font-size:12px;"><?php echo CURRENT_SHOW; ?>
					
					<?php if($totalrecord>0){ ?>
					
					<?php echo (($pageindex*$_SESSION["pagesizforbringer"])-9); ?>-<?php 
					
					if(($totalrecord-(($pageindex*$_SESSION["pagesizforbringer"])-9))>=$_SESSION["pagesizforbringer"])
					{
					echo ($pageindex*$_SESSION["pagesizforbringer"]);
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
					<?php echo $string;?>
                      </ul>
                      </td>
                  </tr>
				  </table>
				  
				  
				  <table cellpadding="5" class="sortable" cellspacing="5" border="0" width="100%">
                  <tbody>
                   <?php 
				     if($numpost>0){
					 while($row=mysql_fetch_array($supplyquery)){?>
					 <?php $online_offline = CHECK_USER_ONLINE_OFFLINE($row["userid"], $db); 
					    
						 if($online_offline){
						    $online_offline_m="<img src=\"".LANGUAGE_SELECT_FOLDER_CHOOSE."/online.png\" width=\"20\" height=\"20\"  alt=\"".USER_ONLINE."\" />";
							$online_offline_search_m="<img src=\"".LANGUAGE_SELECT_FOLDER_CHOOSE."/yuwolianxis.png\" alt=\"".CONTACT_ME."\" />";
							$trans_to_the_href="href=\"javascript:void(0)\" onClick=\"javascript:chatWith('".get_user_name($row["userid"], $db)."')\"";
						 }else{
						   
						    $online_offline_m="<img src=\"".LANGUAGE_SELECT_FOLDER_CHOOSE."/offline.png\" width=\"20\" height=\"20\"  alt=\"".USER_OFFLINE."\" />";
							$online_offline_search_m="<img src=\"".LANGUAGE_SELECT_FOLDER_CHOOSE."/geiwoliuyanhs.png\"  alt=\"".MESSAGE_ME."\" />";
							
							$trans_to_the_href="href=\"mymessage.php?lmt=".get_user_name($row["userid"], $db)."\"";
						 }
						 
						
						 if($_SESSION["language_be_choosed"]=="eng"){
						 $title_show=translateToenglish($row["title"]);
						 }else{
						 $title_show=translateTochinese($row["title"]);
					     }
					 ?>
					 
                    <tr>
                      <td  style="width:90%;"colspan="6"><a href="supplypostdetail.php?pid=<?php echo $row["id"];?>" target="_blank" class="title"><?php echo $title_show; ?></a></td>
					  <td>
					  <table>
					   <tr>
					     <td align="center" nowrap="nowrap"><a href="supplypostdetail.php?pid=<?php echo $row["id"];?>" style="color:#0000FF;"><?php echo CHECK; ?></a></td>
                      <td align="center" nowrap="nowrap"><a href="gellarysupplydetail.php?pid=<?php echo $row["id"];?>" title="<?php echo NEEDER_INFORMATION; ?>" rel="gb_pageset[buyerspage]" style="color:#0000FF;"><?php echo GCHECK;?></a></td>
					   </tr>
					   </table>
					  </td>
					 </tr>
					 <tr> 
                      <td align="center" nowrap="nowrap"><span style="font-size:12px;"><?php echo POSTER_FINDBRINGER;?></span>&nbsp;<span style="font-weight:bold;"><?php echo get_user_name($row["userid"], $db); ?></span><?php echo $online_offline_m; ?>
					  <?php if($_SESSION["interbringeruserId"]>0){?>
	                  <a  <?php echo $trans_to_the_href; ?> style="font-size:18px; color:#0C36E0; font-weight:bold;"><?php echo $online_offline_search_m;?></a>
	                  <?php 
	                   }else{
	                   ?>  
	                   <a href="javascript:void(0)" style="font-size:18px; color:#0C36E0; font-weight:bold;" onClick="javascript:alert('<?php echo ONLY_OPEN_FOR_RE_USER;?>');"><?php echo $online_offline_search_m;?></a>
	                 <?php } ?>
					  </td>
					  <td> 
					  </td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					 </tr>
					 <tr>
					 <tr> 
                      <td align="center" nowrap="nowrap"><span style="font-size:12px;"><?php echo PUCHAS_LOCATION; ?></span>&nbsp;<span style="font-weight:bold;"><?php echo get_city_name($row["cityid"], $db); ?></span></td>
					  <td align="center" nowrap="nowrap"><span style="font-size:12px;"><?php echo ARRIVAL_TIME; ?></span>&nbsp;<span style="font-weight:bold;"><?php echo $row["backtime"]; ?></span></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					 </tr>
					 <tr>
                      <td align="center" nowrap="nowrap"><span style="font-size:12px;"><?php echo TAKE_TO; ?></span>&nbsp;<span style="font-weight:bold;"><?php echo get_city_name($row["cityback"], $db); ?></span></td>
                      <td align="center" nowrap="nowrap"><span style="font-size:12px;"><?php echo POST_TIME; ?></span>&nbsp;<span style="font-weight:bold;"><?php echo $row["postdate"]; ?></span></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  </tr>
					 
					  </tr>
					  <tr>
					  <td colspan="7"><div style="border-top:#999999 solid 1px; width:100%;"></div></td>
					  </tr>
                    <?php } 
					}else{
					?>
					<tr>
					  <td colspan="7" style="text-align:center;" nowrap="nowrap">
					  <table cellpadding="0" cellspacing="0" style="border:#FFFF00 solid 2px; width:100%;">
					  <tr>
					   <td style="text-align:center; background-color:#FEEDF1;">
					  <!-- 您好！ 你搜索的结果为零!
					    您要搜索的东西在我们数据库中暂时还不存在！ 是否需要<a href="post.php" style="color:#0000FF; font-weight:bold;">发帖</a>？-->
                        <?php  echo NO_RECORD_HINT; ?>
					   </td>
					  </tr>
					  </table>
					  
					  <?php // echo NO_RECORD_HINT; ?></td>
					 </tr>
					<?php } ?>
                  </tbody>
                </table>
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<form name='formpage2' method=post action='<?php echo "findbringer.php?&t=".$title."&tt=".$title_search."&fc=".$fcountry."&fs=".$fstate."&fcity=".$fcity."&tc=".$tcountry."&ts=".$tstate."&tcity=".$tcity."&bt1=".$backtime1."&bt2=".$backtime2."&ca=".$catergory; ?>' style="border:#000033 solid 2px;" >
                  <tr>
                    <td align="left"><b><?php echo PAGE; ?></b><?php echo $pageindex; ?><?php echo PAGEOF ?><?php echo $pagecount; ?>&nbsp;<b><?php echo RECORDTOTAL; ?></b>:<?php echo $totalrecord; ?>&nbsp;<?php echo RECORDS; ?></td>
                    <td style="text-align:right;">
					<ul id="pagination-clean">
					<?php echo $string;?>
                    </ul>
                      <b><?php echo GO_PAGE; ?></b><?php echo PAGE_PAGE; ?>
                      <select name="pageindex" onchange="javascript: document.formpage2.submit();">
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
				  <form name='formpage' method=post action='<?php echo "findbringer.php?&t=".$title."&tt=".$title_search."&fc=".$fcountry."&fs=".$fstate."&fcity=".$fcity."&tc=".$tcountry."&ts=".$tstate."&tcity=".$tcity."&bt1=".$backtime1."&bt2=".$backtime2."&ca=".$catergory; ?>' >
                  <tr>
                    <td align="center" nowrap="nowrap" colspan="2">
					<b><?php echo PAGE_SHOW; ?></b>
					<?php 
					     if($numpost>=190) $numpage=190;
		                  else $numpage=$numpost; 
					 ?>
                      <select name="pagesiz" onchange="javascript: document.formpage.submit();" >
					  
					  <?php 
					    for($k=10;$k<=$numpage+10;$k=$k+10)
		                {
		                  if($_SESSION["pagesizforbringer"]==$k) {?>
						  
						 
		               <option selected value="<?php echo $k; ?>" ><?php echo $k; ?></option>
						   <?php }else{ ?>
		                   <option value="<?php echo $k; ?>"><?php echo $k; ?></option>
		                   <?php } 
						     }?>

                      </select> 
                     <?php echo RECORDS_PER_PAGES; ?>  
					  </td>
                  </tr>
				 </form>
          </table>  
	     
	       
		 </div>
	   </div>
    </div>
	
	<div style="width:50px; margin-right:20px; float:right;">
	 <?php require_once("informationbord.php"); ?>
    </div>
	
  </div>
  
  </div>
  
  <div style="margin-top:30px;">
  </div> 
  <?php
   include_once("header/footer.php");
  ?>
  </div>
<?php if($_SESSION["interbringeruserId"]>0){?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/chat.js"></script>
<?php } ?>
</body>
</html>
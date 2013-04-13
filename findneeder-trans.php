<?php
 ob_start();
 require("inc/session.php");
 sessionCheck(session_id(), $_SESSION, $_SERVER);
 include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo FINDNEEDERTRANS; ?>|Interbringer</title>
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
	
	if ($_GET['ts'])
	{
	   $title_search= $_GET['ts'];	
	}else{
	
	  $title_search="entire";
	}
	
	if ($_GET['pt1'])
	{
	   $posttime1= $_GET['pt1'];	
	}
	
	if ($_GET['pt2'])
	{
	   $posttime2= $_GET['pt2'];	
	}
	
	if ($_GET['country'])
	{
	   $country= $_GET['country'];	
	}
	
	if ($_GET['state'])
	{
	   $state= $_GET['state'];	
	}
	
	if ($_GET['city'])
	{
	   $city= $_GET['city'];	
	}
	
	if ($_GET['countryto'])
	{
	   $countryto= $_GET['countryto'];	
	}
	
	if ($_GET['stateto'])
	{
	   $stateto= $_GET['stateto'];	
	}
	
	if ($_GET['cityto'])
	{
	   $cityto= $_GET['cityto'];	
	}
	
	if ($_GET['nt'])
	{
	   $needtime= $_GET['nt'];	
	}
	if ($_GET['ca'])
	{
	   $catergory= $_GET['ca'];	
	}
	if($posttime1!="") $datesearchfrom=$posttime1." 00:00:00";
	else $datesearchfrom="";
    if($posttime2!="") $datesearchto=$posttime2." 23:59:59";
	else $datesearchto="";
	
	if($title!=""){ 
	if($title_search=="title"){
	$searchforQuery=" AND title LIKE '%".$title."%'";
	}else{
	$searchforQuery=" AND (title LIKE '%".$title."%' OR description LIKE '%".$title."%')";
	 }
	}else $searchforQuery="";
	
	if($country!="") $countrySearch=" AND countryid = ".$country."";
	else $countrySearch="";
	
	if($state!="") $stateSearch=" AND stateid = ".$state."";
	else $stateSearch="";
	
	if($city!="") $citySearch=" AND cityid = ".$city."";
	else $citySearch="";
	
	if($countryto!="") $countrytoSearch=" AND countryto = ".$countryto."";
	else $countrytoSearch="";
	
	if($stateto!="") $statetoSearch=" AND stateto = ".$stateto."";
	else $statetoSearch="";
	
	if($cityto!="") $citytoSearch=" AND cityto = ".$cityto."";
	else $citytoSearch="";
	
	if($catergory != "" ) $catergorySearch=" AND catergory = '".$catergory."'";
	else $catergorySearch = "";
	
	/*if($needtime != "") $needtimeSearch= " AND needtime = '".$needtime."'";
	$needtimeSearch="";*/
	
	if(($datesearchfrom!="")&&($datesearchto!="")) $searchdateQuery=" AND postdate between '".$datesearchfrom."' and '".$datesearchto."'";
	else $searchdateQuery="";

?>
  <?php
	 /*This is for pagination*/
	 if(!isset($_SESSION["pagesizfortransbuyer"]))
	$_SESSION["pagesizfortransbuyer"]=10;
		
	if(isset($_POST["pagesiz"]))
	$_SESSION["pagesizfortransbuyer"]=$_POST["pagesiz"]; 
	
	 if(!isset($totalrecord)) $totalrecord=0;
     $checkquery=mysql_query("SELECT * FROM `demandpost` WHERE post_type = 2 $searchforQuery $countrySearch $stateSearch $citySearch $countrytoSearch $statetoSearch $citytoSearch $catergorySearch $searchdateQuery", $db);
	 
	 
	 $numpost = mysql_num_rows($checkquery);
	 if($_SESSION["pagesizfortransbuyer"]>$numpost+10) 
	 {
	  $l=0;
	   while($l<=$numpost)
	  {
	    $l=$l+10;
	   }
	   $_SESSION["pagesizfortransbuyer"]=$l;
	}
	
	//page diliver
	 $totalrecord=$numpost;
	 if($totalrecord)
      {
			    if ($totalrecord<$_SESSION["pagesizfortransbuyer"])
		      { 	
		      	 $pagecount=1;
		      }	 
			    if ($totalrecord%$_SESSION["pagesizfortransbuyer"])
			    {
		        	$pagecount=(int)($totalrecord/$_SESSION["pagesizfortransbuyer"])+1;
		      }
			    else 
			    {
				      $pagecount=$totalrecord/$_SESSION["pagesizfortransbuyer"];
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
			$string.="<li class=\"previous\"><a href=?pageindex=".($pageindex-1)."&t=".$title."&ts=".$title_search."&country=".$country."&state=".$state."&city=".$city."&countryto=".$countryto."&stateto=".$stateto."&cityto=".$cityto."&pt1=".$posttime1."&pt2=".$posttime2."&ca=".$catergory."&nt=".$needtime."><<</a></li>";
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
			  
			    $string.="<li><a href=?pageindex=".$m."&t=".$title."&ts=".$title_search."&country=".$country."&state=".$state."&city=".$city."&countryto=".$countryto."&stateto=".$stateto."&cityto=".$cityto."&pt1=".$posttime1."&pt2=".$posttime2."&ca=".$catergory."&nt=".$needtime.">".$m."</a></li>";
			  }
		   
		   }
		   
		 if($pageindex==$pagecount or $pagecount==0 or $pagecount==1)
		  {
	   	    $string.="<li class=\"next-off\"> >></li> <li class=\"next-off\">[".LAST_PAGE."]</li>";
	      }
	     else
	      {
	   	    $string.= "<li class=\"next\"><a href=?pageindex=".($pageindex+1)."&t=".$title."&ts=".$title_search."&country=".$country."&state=".$state."&city=".$city."&countryto=".$countryto."&stateto=".$stateto."&cityto=".$cityto."&pt1=".$posttime1."&pt2=".$posttime2."&ca=".$catergory."&nt=".$needtime.">>></a></li>";
			$string .= "<li class=\"next\"><a href=?pageindex=".($pagecount)."&t=".$title."&ts=".$title_search."&country=".$country."&state=".$state."&city=".$city."&countryto=".$countryto."&stateto=".$stateto."&cityto=".$cityto."&pt1=".$posttime1."&pt2=".$posttime2."&ca=".$catergory."&nt=".$needtime.">[".LAST_PAGE."]</a></li>";
	    }
		
		/*end string for pagenation*/
			
		$startrecordindex=($pageindex-1)*$_SESSION["pagesizfortransbuyer"];
	       
		$pageQury=" LIMIT ". $startrecordindex.",".$_SESSION["pagesizfortransbuyer"];
	

              $sql="SELECT * FROM `demandpost` WHERE post_type = 2 $searchforQuery $countrySearch $stateSearch $citySearch $countrytoSearch $statetoSearch $citytoSearch $catergorySearch $searchdateQuery ORDER BY `postdate` DESC $pageQury";
	          $demandquery= mysql_query($sql, $db);
	         // $numpost=mysql_num_rows($demandquery);
	 
    ?>
  <?php
	if($_SESSION['interbringeruserId']>0){
     include_once("header/header-user-trans.php");
	 }else{
	 include_once("header/header-search-trans.php");
	 }
    ?>
  <div style="min-height:500px; width:90%; margin-left:90px;">
    <div style="float:left; width:219px; margin-top:60px;">
      <div style="border:#CCCCCC solid 1px;">
        <form id="findbuyer_form" method="get" name="findbuyer_form" action="findneeder-trans.php" enctype="multipart/form-data">
          <table cellpadding="4" cellspacing="1" style="width:218px;">
            <tr style="background:#E9E9E9; height:35px;">
              <td colspan="2" nowrap="nowrap" style="color:#000000; font-weight:bold; font-size:18px;"> <?php echo ADVANCED_SEARCH_FINDBRINGER; ?> </td>
            </tr>
            <tr>
              <td  colspan="2" style="font-weight:bold;" nowrap="nowrap"><?php echo KEY_WORD_FINDBRINGER; ?></td>
            </tr>
            <tr>
              <td colspan="2"><input type="text" style="width:200px;"value="<?php echo $title; ?>" id="t" name="t"  />
              </td>
            </tr>
            <tr>
              <td nowrap="nowrap" align="left"><input type="radio" value="entire" <?php if($title_search=="entire"){?> checked="checked" <?php }?> name="ts" id="title_search" />
                <?php echo ENTIRE_TEXT_QU; ?> </td>
              <td nowrap="nowrap" align="left"><input type="radio" <?php if($title_search=="title"){?> checked="checked" <?php }?> value="title" name="ts" id="title_search" />
                <?php echo ONLY_TITL_QU; ?> </td>
            </tr>
            <tr>
              <td colspan="2" style="height:20px;"></td>
            </tr>
            <tr>
              <td colspan="2" style="height:20px;"></td>
            </tr>
            <tr>
              <td colspan="2" style="font-weight:bold;" nowrap="nowrap"><?php echo CATERGORIES_FINDBRINGER; ?></td>
            </tr>
            <tr>
              <td colspan="2"><?php echo catergory_drop_list("ca", "id='ca' style=\"width:200px\"", "".$catergory."", "".ANY_OF_THEM."") ?> </td>
            </tr>
            <tr>
              <td colspan="2" style="height:20px;"></td>
            </tr>
            <tr>
              <td colspan="2" style="font-weight:bold;" nowrap="nowrap"><?php echo NEEDER_LOCATION; ?></td>
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
              <td colspan="2" ><select id="country" name="country" style="width:200px" onChange="changepro('state','country');" >
                  <option value=""><?php echo ANY_OF_THEM; ?></option>
                  <?php  while ($row = mysql_fetch_array($country_execute_query)) {
				if($country==$row["id"]) $selected="selected=\"selected\"";
				 else $selected="";
		?>
                  <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["country"]; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td  colspan="2" style="font-weight:bold;" nowrap="nowrap"><?php echo STATE_OR_PROVINCE; ?>:</td>
            </tr>
            <tr>
              <td colspan="2"><select id="state" name="state" style="width:200px" onChange="changecity('city','state');">
                  <option value=""><?php echo ANY_OF_THEM; ?></option>
                  <?php 
			if($country!="") {
			 $state_query="SELECT * FROM `states` where `country`= ".$country." ORDER BY `id`";
	         $state_execute_query = mysql_query($state_query, $db); 
	     ?>
                  <?php  
			 while ($row = mysql_fetch_array($state_execute_query)) {
			 if($state==$row["id"]) $selected="selected=\"selected\"";
		     else $selected="";
		 ?>
                  <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["state_name"]; ?></option>
                  <?php   } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td  colspan="2" align="right" style="font-weight:bold;" nowrap="nowrap"><?php echo CITY; ?>: </td>
            </tr>
            <tr>
              <td colspan="2"><select id="city" name="city" style="width:200px">
                  <option value=""><?php echo ANY_OF_THEM; ?></option>
                  <?php 
	   if($state!="") {
	     $city_query="SELECT * FROM `city` where `state_id`= ".$state." ORDER BY `id`";
	     $city_execute_query = mysql_query($city_query, $db); 
	  ?>
                  <?php  
	  while ($row = mysql_fetch_array($city_execute_query)) {
	   if($city==$row["id"]) $selected="selected=\"selected\"";
       else $selected="";
	 ?>
                  <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["name"]; ?></option>
                  <?php   } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="height:20px;"></td>
            </tr>
            <tr>
              <td colspan="2" style="font-weight:bold;" nowrap="nowrap"><?php echo NEED_TAKE_TO_LOCATION; ?></td>
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
              <td colspan="2" ><select id="countryto" name="countryto" style="width:200px" onChange="changepro('stateto','countryto');" >
                  <option value=""><?php echo ANY_OF_THEM; ?></option>
                  <?php  while ($row = mysql_fetch_array($country_execute_query)) {
				if($countryto==$row["id"]) $selected="selected=\"selected\"";
				 else $selected="";
		?>
                  <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["country"]; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr >
              <td  colspan="2" style="font-weight:bold;" nowrap="nowrap"><?php echo STATE_OR_PROVINCE; ?>:</td>
            </tr>
            <tr>
              <td colspan="2"><select id="stateto" name="stateto" style="width:200px" onChange="changecity('cityto','stateto');">
                  <option value=""><?php echo ANY_OF_THEM; ?></option>
                  <?php 
			if($countryto!="") {
			 $state_query="SELECT * FROM `states` where `country`= ".$countryto." ORDER BY `id`";
	         $state_execute_query = mysql_query($state_query, $db); 
	     ?>
                  <?php  
			 while ($row = mysql_fetch_array($state_execute_query)) {
			 if($stateto==$row["id"]) $selected="selected=\"selected\"";
		     else $selected="";
		 ?>
                  <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["state_name"]; ?></option>
                  <?php   } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td  colspan="2" align="right" style="font-weight:bold;" nowrap="nowrap"><?php echo CITY; ?>: </td>
            </tr>
            <tr>
              <td colspan="2"><select id="cityto" name="cityto" style="width:200px">
                  <option value=""><?php echo ANY_OF_THEM; ?></option>
                  <?php 
	   if($stateto!="") {
	     $city_query="SELECT * FROM `city` where `state_id`= ".$stateto." ORDER BY `id`";
	     $city_execute_query = mysql_query($city_query, $db); 
	  ?>
                  <?php  
	  while ($row = mysql_fetch_array($city_execute_query)) {
	   if($cityto==$row["id"]) $selected="selected=\"selected\"";
       else $selected="";
	 ?>
                  <option value="<?php echo $row["id"];?>" <?php echo $selected;?>><?php echo $row["name"]; ?></option>
                  <?php   } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="height:20px;"></td>
            </tr>
            <tr>
              <td colspan="2" nowrap="nowrap" style="font-weight:bold;"><?php echo POST_TIME; ?>: </td>
            </tr>
            <tr>
              <td colspan="2" nowrap="nowrap" style="font-weight:bold;"><?php echo FROM; ?>: </td>
            </tr>
            <tr>
              <td colspan="2"><input type="text" onclick="fPopCalendar('pt1')" readonly="readonly" value="<?php echo $posttime1;?>" name="pt1" id="pt1"  style="width:200px;"/>
              </td>
            </tr>
            <tr>
              <td colspan="2" nowrap="nowrap" colspan="2"  style="font-weight:bold;">
              <?php echo TO; ?>:
              </td>
            </tr>
            <tr>
              <td colspan="2"><input type="text" onclick="fPopCalendar('pt2')" readonly="readonly" value="<?php echo $posttime2;?>" name="pt2" id="pt2"  style="width:200px;"/>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="height:20px;"></td>
            </tr>
            <tr>
              <td  style="text-align:right; width:50%;"><input type="image" src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/buttom-search.png" />
              </td>
              <td style="text-align:left;"> [<a href="findneeder-trans.php" style="color:#000000;font-size:15px; font-weight:bold;" ><?php echo START_OVER;?></a>] </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
    <div id="content" class="fb_content clearfix" style="min-height:500px; min-width:650px; width:73.5%; margin-left: 230px;">
      <div id="mainContainer" style="width:85%; float:left;"  >
        <div style="margin-top:30px; margin-left:20px; padding-bottom:5px; width:100%;font-size:20px; border-bottom:#AAAAAA solid 1px; font-weight:bolder;"><?php echo NEEDER_SEARCH_RESULT; ?></div>
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
				  
				  <?php echo (($pageindex*$_SESSION["pagesizfortransbuyer"])-9); ?>-<?php 
				  
				  if(($totalrecord-(($pageindex*$_SESSION["pagesizfortransbuyer"])-9))>=$_SESSION["pagesizfortransbuyer"])
					{
					echo ($pageindex*$_SESSION["pagesizfortransbuyer"]);
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
                  <td style="text-align:right;"><ul id="pagination-clean" >
                      <?php echo $string;?>
                    </ul></td>
                </tr>
            </table>
            <table cellpadding="5" class="sortable" cellspacing="5" border="0" width="100%">
              <tbody>
                <?php 	
					if($numpost>0){
					 while($row=mysql_fetch_array($demandquery)){?>
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
					   
					 ?>
                <tr>
                  <td  style="width:90%;"colspan="4"><a href="demondpostdetail-trans.php?pid=<?php echo $row["id"];?>" class="title"><?php echo $row["title"]; ?></a> </td>
                  <td><table>
                      <tr>
                        <td align="center" nowrap="nowrap"><a href="demondpostdetail-trans.php?pid=<?php echo $row["id"];?>" style="color:#0000FF;"><?php echo CHECK; ?></a></td>
                        <td align="center" nowrap="nowrap"><a href="gellarydemanddetail.php?pid=<?php echo $row["id"];?>" title="<?php echo NEEDER_INFORMATION; ?>" rel="gb_pageset[buyerspage]" style="color:#0000FF;"><?php echo GCHECK;?></a></td>
                      </tr>
                    </table></td>
                </tr>
				<tr> 
                      <td align="center" nowrap="nowrap"><span style="font-size:12px;"><?php echo POSTER_FINDBRINGER;?> </span>&nbsp;<span style="font-weight:bold;"><?php echo get_user_name($row["userid"], $db); ?></span><?php echo $online_offline_m; ?>
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
                <?php if($row["post_type"]==1){?>
                <tr>
                  <td align="center" nowrap="nowrap"><?php echo BUYER_LOCATION; ?> <?php echo get_city_name($row["cityid"], $db);?></td>
                  <td align="center" nowrap="nowrap"><?php echo POST_DATE; ?> <?php echo $row["postdate"]; ?></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <?php }else if($row["post_type"]==2){?>
                <tr>
                  <td align="center" nowrap="nowrap"><?php echo NEEDER_LOCATION; ?> <?php echo get_city_name($row["cityid"], $db);?></td>
                  <td align="center" nowrap="nowrap"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td align="center" nowrap="nowrap"><?php echo TAKE_TO_LOCATION; ?> <?php echo get_city_name($row["cityto"], $db);?></td>
                  <td align="center" nowrap="nowrap"><?php echo POST_DATE; ?> <?php echo $row["postdate"]; ?></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <?php } ?>
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
					  
					  <?php // echo NO_RECORD_HINT; ?></td>
					 </tr>
                <?php } ?>
              </tbody>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
              <form name='formpage2' method=post action='<?php echo "findneeder-trans.php?&t=".$title."&ts=".$title_search."&country=".$country."&state=".$state."&city=".$city."&countryto=".$countryto."&stateto=".$stateto."&cityto=".$cityto."&pt1=".$posttime1."&pt2=".$posttime2."&ca=".$catergory."&nt=".$needtime; ?>' >
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
              <form name='formpage' method=post action='<?php echo "findneeder-trans.php?&t=".$title."&ts=".$title_search."&country=".$country."&state=".$state."&city=".$city."&countryto=".$countryto."&stateto=".$stateto."&cityto=".$cityto."&pt1=".$posttime1."&pt2=".$posttime2."&ca=".$catergory."&nt=".$needtime; ?>' >
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
		                  if($_SESSION["pagesizfortransbuyer"]==$k) {?>
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
	 <div style="width:50px; margin-right:20px; float:right;">
	 <?php require_once("informationbord.php"); ?>
    </div>
    </div>
  </div>
  <div style="margin-top:30px;"> </div>
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

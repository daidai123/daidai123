<?php
 ob_start();
 require("inc/session.php");
 sessionCheck(session_id(), $_SESSION, $_SERVER);
// checkLogin();
 include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo DISCOUNTINFORMATION; ?> |Interbringer</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<script  src="./js/calendar.js"></script>
<link rel="STYLESHEET" type="text/css" href="./js/cwcalendar.css">
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
<link rel="stylesheet" type="text/css" href="css/pagination.css" />
<?php if($_SESSION["interbringeruserId"]>0){?>
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
<!--[if lte IE 7]>
<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
<![endif]-->
<?php } ?>
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
	
	if($catergory != "" ) $catergorySearch=" AND catergory = '".$catergory."'";
	else $catergorySearch = "";
	
	/*if($needtime != "") $needtimeSearch= " AND needtime = '".$needtime."'";
	$needtimeSearch="";*/
	
	if(($datesearchfrom!="")&&($datesearchto!="")) $searchdateQuery=" AND postdate between '".$datesearchfrom."' and '".$datesearchto."'";
	else $searchdateQuery="";

?>

<?php
	 /*This is for pagination*/
	 if(!isset($_SESSION["pagesizforbuyer"]))
	$_SESSION["pagesizforbuyer"]=10;
		
	if(isset($_POST["pagesiz"]))
	$_SESSION["pagesizforbuyer"]=$_POST["pagesiz"]; 
	
	 if(!isset($totalrecord)) $totalrecord=0;
     $checkquery=mysql_query("SELECT * FROM `discountinfo` WHERE post_type = 1 $searchforQuery $countrySearch $stateSearch $citySearch $catergorySearch $searchdateQuery", $db);
	 
	 //echo "SELECT * FROM `demandpost` WHERE 1 = 1 $searchforQuery $countrySearch $stateSearch $citySearch $catergorySearch $searchdateQuery";
	 
	 $numpost = mysql_num_rows($checkquery);
	 if($_SESSION["pagesizforbuyer"]>$numpost+10) 
	 {
	  $l=0;
	   while($l<=$numpost)
	  {
	    $l=$l+10;
	   }
	   $_SESSION["pagesizforbuyer"]=$l;
	}
	
	//page diliver
	 $totalrecord=$numpost;
	 if($totalrecord)
      {
			    if ($totalrecord<$_SESSION["pagesizforbuyer"])
		      { 	
		      	 $pagecount=1;
		      }	 
			    if ($totalrecord%$_SESSION["pagesizforbuyer"])
			    {
		        	$pagecount=(int)($totalrecord/$_SESSION["pagesizforbuyer"])+1;
		      }
			    else 
			    {
				      $pagecount=$totalrecord/$_SESSION["pagesizforbuyer"];
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
			$string.="<li class=\"previous\"><a href=?pageindex=".($pageindex-1)."&t=".$title."&ts=".$title_search."&country=".$country."&state=".$state."&city=".$city."&pt1=".$posttime1."&pt2=".$posttime2."&ca=".$catergory."&nt=".$needtime."><<</a></li>";
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
			  
			    $string.="<li><a href=?pageindex=".$m."&t=".$title."&ts=".$title_search."&country=".$country."&state=".$state."&city=".$city."&pt1=".$posttime1."&pt2=".$posttime2."&ca=".$catergory."&nt=".$needtime.">".$m."</a></li>";
			  }
		   
		   }
		   
		 if($pageindex==$pagecount or $pagecount==0 or $pagecount==1)
		  {
	   	    $string.="<li class=\"next-off\"> >></li> <li class=\"next-off\">[".LAST_PAGE."]</li>";
	      }
	     else
	      {
	   	    $string.= "<li class=\"next\"><a href=?pageindex=".($pageindex+1)."&t=".$title."&ts=".$title_search."&country=".$country."&state=".$state."&city=".$city."&pt1=".$posttime1."&pt2=".$posttime2."&ca=".$catergory."&nt=".$needtime.">>></a></li>";
			$string .= "<li class=\"next\"><a href=?pageindex=".($pagecount)."&t=".$title."&ts=".$title_search."&country=".$country."&state=".$state."&city=".$city."&pt1=".$posttime1."&pt2=".$posttime2."&ca=".$catergory."&nt=".$needtime.">[".LAST_PAGE."]</a></li>";
	    }
		
		/*end string for pagenation*/
			
		$startrecordindex=($pageindex-1)*$_SESSION["pagesizforbuyer"];
	       
		$pageQury=" LIMIT ". $startrecordindex.",".$_SESSION["pagesizforbuyer"];
	

              $sql="SELECT * FROM `discountinfo` WHERE post_type = 1 $pageQury";
	          $demandquery= mysql_query($sql, $db);
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
   <div style="">
   </div>
  </div>
  <div id="content" class="fb_content clearfix" style="min-height:500px; min-width:650px; width:73.5%; margin-left: 230px;">

	<div id="mainContainer" style="width:85%; float:left;"  >
       <div style="margin-top:30px; margin-left:20px; padding-bottom:5px; width:100%;font-size:20px; border-bottom:#AAAAAA solid 1px; font-weight:bolder;">
	     <?php echo DISCOUNTINFORMATIONHERE_TITL; ?>
	   </div>
	   <div style="width:100%; margin-left:20px;">
	     <div style="width:100%; height:35px; background:#E9E9E9">
		  <div style="margin-left:20px;">
		 
		  </div>
		 </div>
		 <div style="width:100%; margin-top:20px;">
		   <table cellpadding="0" cellspacing="0" border="0" style="width:100%; border-bottom:#CCCCCC solid 1px;">
                  <tr>
                    <td align="left" style="font-size:12px;"><?php echo CURRENT_SHOW; ?><?php echo (($pageindex*$_SESSION["pagesizforbuyer"])-9); ?>-<?php 
					
					if(($totalrecord-(($pageindex*$_SESSION["pagesizforbuyer"])-9))>=$_SESSION["pagesizforbuyer"])
					{
					echo ($pageindex*$_SESSION["pagesizforbuyer"]);
					}else{
					 echo $totalrecord;
					} 
					
					?><?php echo RECORDS; ?>/<?php echo RECORDTOTAL; ?>:<?php echo $totalrecord; ?><?php echo RECORDS; ?></td>
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
					 while($row=mysql_fetch_array($demandquery)){?>					
                    <tr>
                     <td  style="width:90%;"colspan="4"><a href="discountinfodetial.php?pid=<?php echo $row["id"];?>" class="title"><?php echo $row["title"]; ?></a>
					 </td>
					  <td>
					  <table>
					   <tr>
					     <td align="center" nowrap="nowrap"><a href="discountinfodetial.php?pid=<?php echo $row["id"];?>" style="color:#0000FF;"><?php echo CHECK; ?></a></td>
                     <!-- <td align="center" nowrap="nowrap"><a href="gellarydemanddetail.php?pid=<?php //echo $row["id"];?>" title="<?php //echo NEEDER_INFORMATION; ?>" rel="gb_pageset[buyerspage]" style="color:#0000FF;"><?php // echo GCHECK;?></a></td>-->
					   </tr>
					   </table>
					  </td>
					 </tr>
					  <tr>
					  <td colspan="5"><div style="border-top:#999999 solid 1px; width:100%;"></div></td>
					  </tr>
					 <?php 
					 }
					}else{
					?>
					<tr>
					  <td colspan="5" style="text-align:center;" nowrap="nowrap"><?php echo NO_RECORD_HINT; ?></td>
					 </tr>
					<?php } ?>
                  </tbody>
                </table>
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<form name='formpage2' method=post action='<?php echo "discountlist.php?&t=".$title."&ts=".$title_search."&country=".$country."&state=".$state."&city=".$city."&pt1=".$posttime1."&pt2=".$posttime2."&ca=".$catergory."&nt=".$needtime; ?>' >
                  <tr>
                    <td align="left"><b><?php echo PAGE; ?></b><?php echo $pageindex; ?><?php echo PAGEOF ?><?php echo $pagecount; ?>&nbsp;<b><?php echo RECORDTOTAL; ?></b>:<?php echo $totalrecord; ?>&nbsp;<?php echo RECORDS; ?></td>
                    <td style="text-align:right;">
					<ul id="pagination-clean">
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
				  <form name='formpage' method=post action='<?php echo "discountlist.php?&t=".$title."&ts=".$title_search."&country=".$country."&state=".$state."&city=".$city."&pt1=".$posttime1."&pt2=".$posttime2."&ca=".$catergory."&nt=".$needtime; ?>' >
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
		                  if($_SESSION["pagesizforbuyer"]==$k) {?>
						  
						 
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
<!--<A onclick="return aa();" href="#"></A>-->
    <TABLE class=gg_width  height=279 cellSpacing=0 cellPadding=0 width=134 border=0>
    <TBODY>
      <TR>
       <TD>
       <TABLE class=google_width cellSpacing=0 cellPadding=0 width="100%" border=0>

	<TBODY>
	<TR>
	  <TD width="35%"><IMG height=30 src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/ads/gtop_19f_01.gif"></TD>
	  <TD width="52%"><IMG height=30 alt=’€µ˛ src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/ads/gtop_19f_02.gif" border=0></TD>
	  <TD width="13%"><IMG height=30 src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/ads/gtop_19f_03.gif"></TD></TR></TBODY></TABLE></TD></TR>
      <TR>
      <TD vAlign=center align=middle width=134 background="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/ads/gbg_19f.gif" height=240>
      <TABLE height=240 cellSpacing=0 cellPadding=0 width=120 border=0>
	<TBODY>
  <?php
              $sql="SELECT * FROM `discountinfo` WHERE post_type = 1  LIMIT 0, 12";
	          $demandquery= mysql_query($sql, $db);
			  $i=0;
  ?>
	<TR>
	  <TD width=134>

         <table style="width:100%; margin-left:10px; margin-left:10px;">
		 <tr>
		    <td style="text-align:left;">
			  <b><?php echo DISCOUNTINFORMATIONWEBSIT; ?></b>
			</td>
		   </tr>
		   	<?php				
			   
		    while($row=mysql_fetch_array($demandquery)){
			 $i++;
			 
			 if($_SESSION["language_be_choosed"]=="eng"){
		       $title_info_show=translateToenglish($row["title"]);
		      // $description_show=translateToenglish($description);
	         }else{
		      $title_info_show=translateTochinese($row["title"]);
		      //$description_show=translateTochinese($description);
	         } 
			?>	
		   <tr>
		    <td style="text-align:left">
			<a href="discountinfodetial.php?pid=<?php echo $row["id"];?>" style="font-size:12px;" target="_blank"><?php echo $i; ?>.<?php echo $title_info_show; ?></a>
			</td>
		   </tr>
		   <tr>
		     <td style="height:5px;"></td>
		   </tr>
		    <?php } ?>
			<tr>
		    <td style="text-align:left">
			<a href="advdetail.php?pid=15" style="font-size:12px;font-weight:bold;" target="_blank"><?php echo ++$i; ?>.π„∏Ê’–…Ã</a>
			</td>
		   </tr>
		   <tr>
		     <td style="height:5px;"></td>
		   </tr>
		   <tr>
		    <td style="text-align:right;">
			  <a href="discountlist.php" target="_blank" ><img src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/more.gif" alt="<?php MORE; ?>" /></a>
			</td>
		   </tr>
		 </table>
		 
	  </TD>
	  </TR>
	  </TBODY>
	  </TABLE>
	  </TD>
	  </TR>
      <TR>
      <TD>
	  <IMG height=9 src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/ads/gbottom_19f.gif"  width=134>
	  </TD>
	  </TR>
	  </TBODY>
	  </TABLE>
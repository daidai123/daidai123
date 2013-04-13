<?php
include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>InterBringer-<?php echo CONTACTINFO; ?></title>
<link rel="stylesheet" type="text/css" href="index.css" />
</head>
<body>
  <div style="margin-left:5px;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td><fieldset style="border:#B3B3B3 solid 2px;">
          <legend><?php echo NO_CONTACT_INFORMATION; ?></legend>
          <table cellpadding="0" cellspacing="0" border="0" width="100%">
            <tr><td>
			<fieldset style="border:#B3B3B3 solid 2px;">
            <legend><?php echo CONTACTINFORMATION; ?></legend>
			 <table cellpadding="0" cellspacing="0" border="0" width="90%">
			   <tr>
              <td align="center" style="font-weight:bold;">
			  <div style="font-size:24px; font-weight:bold; color:#FF0000;">
			  <?php echo SORRY_INFORMATION_FOR_NO_INFORMATION; ?>
			  </div>
			  </td>
			  </tr>
			  <tr>
			  <td align="center" style="font-weight:bold;">
			  <div style="font-size:24px; font-weight:bold; color:#FF0000;">
			  (Sorry! The user don't publish his(her) information.)			  </div>
			  </td>
            </tr>
			</table>
			</fieldset>
			</td></tr> 
			<tr><td align="center">
			<input type="button" id="close" name="close" onclick="javascript: self.parent.tb_remove();" value="<?php echo CLOSE; ?>" style="width:200px;" />
			</td></tr>
          </table>
		  </form>
          </fieldset>
		  </td>
      </tr>
    </table>
	</div>
</body>
</html>

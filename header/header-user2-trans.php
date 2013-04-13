<div id="blueBar" class="" ></div>

      <div id="headNavOut" style="margin-left:320px; width:65%;">
	  <div style="margin-top:5px;"><a class="lfloat" href="/myaccount.php" title="转到interbringer首页"><img class="fb_logo img" src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/logo-white.png" alt="interbringer logo" width="125" height="25"></a>
    </div>
	  
        <div id="headNavIn" sty le="border:#660066 solid 4px;">
          <ul id="pageNav" sty le="border:#660066 solid 4px;">
            <li><a href="myaccount.php" accesskey="1">账户首页</a></li>
			<li><a href="post.php" accesskey="2">发帖</a></li>
            <li><a href="usersetting.php" accesskey="2">设置</a></li>
            <li><a href="logoff.php" accesskey="2">注销</a></li>
          </ul>
        </div>
      </div>
   <div class=signup_bar_container style="height:50px;">
    <div class="signup_box clearfix" style="margin-left:295px;width:73.5%">
	<form name="login_form" method="post" >
	<table style="width:90%;" border="0">
	 <tr>
	  <td style="width:60%;">
	  <input type="text" id="search_title" name="search_title" style="width:98%; height:20px;">
	  </td>
	  <td>
	  <select id="header_search_type" name="header_search_type_form"  onchange="processForm(this.form)" style="width:150px; height:28px; color:#333333; font-size:18px;">
	  <option value="1">寻找代购者</option>
	  <option value="2">寻找求购者</option>
	  <option value="3">寻找代运者</option>
	  <option value="4">寻找求运者</option>
	  </select> 
	  </td>
	   <td>
	  <a href="#" onclick="javascript: document.forms['header_search_form'].submit();"><img src="<?php echo LANGUAGE_SELECT_FOLDER_CHOOSE; ?>/search-new.png" /></a>
	  </td>
	  <td nowrap="nowrap">
	   <input type="checkbox" id="des_in" name="des_in"> include description?
	  </td>
	 </tr>
	 </table>
	 </form>
	</div>
    </div>

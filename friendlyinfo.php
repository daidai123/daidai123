<?php
ob_start();
session_start();
include("inc/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo FRIENDLY_HINT; ?>|Interbringer(������)</title>
<link rel="shortcut icon" href="favicon.ico" />
<link type="text/css" rel="stylesheet" href="csshead/b0b5qkrv.css">
<link type="text/css" rel="stylesheet" href="csshead/716c6sy6.css">
<!--<link type="text/css" rel="stylesheet" href="csshead/login2.css">-->
<link type="text/css" rel="stylesheet" href="csshead/22o3gybn.css">
<script language="javascript" type="text/javascript" src="js/register.js"></script>
</head>
<?php
require("inc/function.php");
include("threelink.php");

 ?>
<body>

	<?php
	if($_SESSION['interbringeruserId']>0){
     include_once("header/header-user.php");
	 }else{
	 include_once("header/header-search.php");
	 }
    ?> 
	<div class="fb_content clearfix" id="content" >
     <div class="UIFullPage_Container" style="width:900px;">
		<div style="width:100%; margin-bottom:10px;">	 
          <div style="font-family:'����';">    
		   <div style="margin-top:10px; font-size:14px; padding-left:10px; padding-right:10px;">
           <b>������ʾ:</b>
		   <br/>
		   <br />1. ��������ߺ����߽��ף�����ʹ��<a href="https://www.alipay.com/" target="_blank">֧����</a>��<a href="https://www.paypal.com" target="_blank" >Paypal</a>���н��ס�
		   <br/>
		   <br />2. ��������ߺ����߽��ף���վ������������δ�õ�����ʱ��ȫ�����������ߡ�
		   <br/>
		   <br />3. �����ص���ϵͳ�Զ�ʶ��ģ�����͡��������ڵء��Լ��������߹���ء����Ҳ�һ�£�����߾��衣���ڳ��У��й�����ϵͳʶ����ܻ��нϴ���
		   <br/>
		   <br />4. �뾡�����Է���Ϣ�ռ���������ͨ��У�ڻ��Ľ���ȷ�ϡ�
		   <br/>
		   <br />5. �������Ϊ�������˰�������������ڻ����ֺ��ٸ���Ȳ�����Ҳֻ�ܸ����Է�������30%�Ķ���
		   <br/>
		   <br />6. �����Һ�����һ�������Ĵ����ߺ����ߡ�
		   <br/>
		   <br />7. ������û�ֻ�ṫ���������ַ�������������������н��ף����ͨ��������ȡ�Է��绰���룬��������ϵ��ȷ���Է��Ŀɿ��ԡ�
		   <br/>
		   <br />8. ����ͨ����У����������������<a href="http://www.renren.com" target="_blank">www.renren.com</a>���򡰿�������<a href="http://www.kaixin001.com" target="_blank">www.kaixin001.com</a>�����������ȷ�ϡ�
		   <br/>
		   <br />9. ����ʱ��һ��Ҫ��Է���ȡ�վݻ��߹���ƾ֤��
		   <br />
		   <div style="padding-top:10px; padding-bottom:10px;">��վ������ڣ����в���֮��������ԭ�¡����н��飬���ʼ�����<a href="#" onclick="window.location.href='mailto:administrator@interbringer.com'">administrator@interbringer.com </a>����ָ�л��</div>
		   </div>
		
		  </div>  
			   <!--end of the signup div-->
       <?php
           include_once("header/languagebar.php");
        ?>
	  </div>
	 </div>
             <?php
              include_once("header/footer.php");
              ?>
	
</body>
</html>

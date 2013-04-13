function checkform(id)
{
 var standard_email=/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
 var value=document.getElementById(id).value;
 if(value=="") 
 {
  document.getElementById(id+"_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
  document.getElementById(id).style.border="#FF0000 solid 1px"; 
 }else if((id=="new_email")&&!standard_email.test(document.getElementById(id).value))
  {
	document.getElementById(id+"_check").innerHTML="<font color='red'>Please feed me email address!<br>Ex: XXXX@gmail.com, XXXXX@sohu.com</font>";
    document.getElementById(id).style.border="#FF0000 solid 1px";
  }
  else{
   document.getElementById(id).style.border="#00FF00 solid 1px";
   document.getElementById(id+"_check").innerHTML='';
   }   
}

function formcheck(page)
  {
    var standard_email=/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var conf=true;
	  if(document.getElementById("new_email").value=="")
	  {
        document.getElementById("new_email_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
        document.getElementById("new_email").style.border="#FF0000 solid 1px";
	    conf=false;
	   }
	   else if(!standard_email.test(document.getElementById("new_email").value))
	   {
	     document.getElementById("new_email_check").innerHTML="<font color='red'>Please feed me email address!<br>Ex: XXXX@gmail.com, XXXXX@sohu.com</font>";
         document.getElementById("new_email").style.border="#FF0000 solid 1px";
		 conf=false;
	   }else if(document.getElementById("confirm_email").value!=document.getElementById("new_email").value)
	   {
        document.getElementById("confirm_email_check").innerHTML="<font color='red'>The email address you enter is not match!</font>";
        document.getElementById("confirm_email").style.border="#FF0000 solid 1px";
	    conf=false;
	   }
	   
	    if(document.getElementById("confirm_email").value=="")
	  {
        document.getElementById("confirm_email_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
        document.getElementById("confirm_email").style.border="#FF0000 solid 1px";
	    conf=false;
	   }
	   
	   
	   return conf;
  }
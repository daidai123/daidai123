function checkform(id)
{
 var standard_email=/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
 var standard_phone=/^[0-9]{3}[-][0-9]{3}[-][0-9]{4}$/;
 var standard_sfsuID=/^[9][0-9]{8}$/;
 var add_hight=0;
 var value=document.getElementById(id).value;
 if(value=="") 
 {
  //if(document.getElementById(id+"_check").innerHTML=='')add_hight=10;
  document.getElementById(id+"_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
  document.getElementById(id).style.border="#FF0000 solid 1px"; 
 } else{
   document.getElementById(id).style.border="#00FF00 solid 1px";
   document.getElementById(id+"_check").innerHTML='';
   }
   
}



 function formcheck(page)
  {
    var standard_email=/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var standard_phone=/^[0-9]{3}[-][0-9]{3}[-][0-9]{4}$/;
    var standard_sfsuID=/^[9][0-9]{8}$/;
	var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
    var conf=true;
    
    
    if(document.getElementById("username").value=="")
	 {
       document.getElementById("username_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
       document.getElementById("username").style.border="#FF0000 solid 1px"; 
	   conf=false;
	  }
	  
	  
	  if(document.getElementById("password").value=="")
	 {
       document.getElementById("password_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
       document.getElementById("password").style.border="#FF0000 solid 1px"; 
	   conf=false;
	  }
	  
	 return conf;
  }
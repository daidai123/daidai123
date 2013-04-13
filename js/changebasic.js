function checkform(id)
{
 var value=document.getElementById(id).value;
 if(value=="") 
 {
  //if(document.getElementById(id+"_check").innerHTML=='')add_hight=10;
  document.getElementById(id+"_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
  document.getElementById(id).style.border="#FF0000 solid 1px"; 
 }
 else if((id=="country")||(id=="state")||(id=="city")||(id=="sex")){
	  document.getElementById(id+"_border").style.border="";
	  document.getElementById(id+"_check").innerHTML='';
  }
  else{
   document.getElementById(id).style.border="#00FF00 solid 1px";
   document.getElementById(id+"_check").innerHTML='';
   }   
}

function formcheck(page)
  {
    var conf=true; 
    if(document.getElementById("username").value=="")
	 {
       document.getElementById("username_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
       document.getElementById("username").style.border="#FF0000 solid 1px"; 
	   conf=false;
	 }
	 
	 if(document.getElementById("realname").value=="")
	 {
       document.getElementById("realname_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
       document.getElementById("realname").style.border="#FF0000 solid 1px";
	   conf=false;
	  }
	  
	  if(document.getElementById("sex").value=="")
	 {
       document.getElementById("sex_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
       document.getElementById("sex_border").style.border="#FF0000 solid 1px";
	   conf=false;
	  }
	 
	   if(document.getElementById("country").value=="")
	 {
       document.getElementById("country_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
       document.getElementById("country_border").style.border="#FF0000 solid 1px";
	   conf=false;
	 }
	 	   
	    if(document.getElementById("state").value=="")
	  {
        document.getElementById("state_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
        document.getElementById("state_border").style.border="#FF0000 solid 1px";
	    conf=false;
	   }
	  
	   if(document.getElementById("city").value=="")
	  {
        document.getElementById("city_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
        document.getElementById("city_border").style.border="#FF0000 solid 1px";
	    conf=false;
	   }
		 
	    return conf; 
      }

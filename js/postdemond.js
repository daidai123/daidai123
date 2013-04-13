function formcheck(page)
  {
    var standard_email=/^(\w+(?:\.\w+)*)@((?:\w+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var conf=true;
	  if(document.getElementById("title").value=="")
	  {
        document.getElementById("title_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
        document.getElementById("title").style.border="#FF0000 solid 3px";
	    conf=false;
	   }
	  
	   
	    if(document.getElementById("country").value=="")
	  {
        document.getElementById("country_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
        document.getElementById("country_border").style.borderColor="#FF0000";
		document.getElementById("country_border").style.borderStyle="solid";
		document.getElementById("country_border").style.borderWidth="3px";
	    conf=false;
	   }
	   
	      if(document.getElementById("state").value=="")
	  {
        document.getElementById("state_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
        document.getElementById("state_border").style.borderColor="#FF0000";
		document.getElementById("state_border").style.borderStyle="solid";
		document.getElementById("state_border").style.borderWidth="3px";
	    conf=false;
	   }
	   
	      if(document.getElementById("city").value=="")
	  {
        document.getElementById("city_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
	    document.getElementById("city_border").style.borderColor="#FF0000";
		document.getElementById("city_border").style.borderStyle="solid";
		document.getElementById("city_border").style.borderWidth="3px";
	    conf=false;
	   }
	   
	   var oEditor = FCKeditorAPI.GetInstance("postdescription") ;

	  if(oEditor.GetXHTML(true)=="")
	  {
        document.getElementById("postdescription_check").innerHTML="<font color='red'>Please don't ignore me!</font>";
        //document.getElementById("postdescription").style.border="#FF0000 solid 3px;";
		document.getElementById("postdescription_alert").style.borderColor="#FF0000";
		document.getElementById("postdescription_alert").style.borderStyle="solid";
		document.getElementById("postdescription_alert").style.borderWidth="3px";
	    conf=false;
	   }
	   
	   return conf;
  }
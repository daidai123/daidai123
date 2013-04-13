<?php
require("inc/dbconnect.php");

 $state_query="SELECT * FROM `states` ORDER BY `id`";
 
 $state_execute_query = mysql_query($state_query, $db); 
 $numState = mysql_num_rows($state_execute_query);
 
 $aprovince;
 $bprovince;
 $cprovince;
 $i=0;
 while ($row = mysql_fetch_array($state_execute_query)) {
	 $i++;
	  if($i<$numState)
	  {
	  
	   $aprovince.="".$row["id"].",";
	   $bprovince.="\"".$row["state_name"]."\",";
	   $cprovince.="".$row["country"].",";
	  }
	else
	   {
	   $aprovince.="".$row["id"]."";
	   $bprovince.="\"".$row["state_name"]."\"";
	   $cprovince.="".$row["country"]."";
	  }
	  
	}
	
	$city_query="SELECT * FROM `city` ORDER BY `id`";
   $city_execute_query = mysql_query($city_query, $db); 
   $numCity = mysql_num_rows($city_execute_query);                        
	
	$acity;     
	$bcity;       
	$ccity;       
	
	$i=0;
	while ($row = mysql_fetch_array($city_execute_query)) {          

    $i++;
	if($i<$numCity)
	  {
	   $acity.="".$row["id"].",";
	   $bcity.="\"".$row["name"]."\",";
	   $ccity.="".$row["state_id"].",";
	  }
	else
	   {
	   $acity.="".$row["id"]."";
	   $bcity.="\"".$row["name"]."\"";
	   $ccity.="".$row["state_id"]."";
	  }
	  
	}
	?>
<script language="javascript">
var lm=new Array();
lm[1]=Array(<?php echo $aprovince;?>);
lm[2]=Array(<?php echo $bprovince;?>);
lm[3]=Array(<?php echo $cprovince;?>);

var numprovince;
numprovince=<?php echo $numState;?>;

var lm2=new Array();
lm2[1]=Array(<?php echo $acity;?>);
lm2[2]=Array(<?php echo $bcity;?>);
lm2[3]=Array(<?php echo $ccity;?>);
var numcity;
numcity=<?php echo $numCity;?>;


function changepro(pro,country)
{
	var pro=pro;
	var country=document.getElementById(country).value;
	var i;
		
	document.getElementById(pro).length=1; 
	for(i=0;i<numprovince;i++)
	{
	 if(lm[3][i]== country)
	 { 
		document.getElementById(pro).options[document.getElementById(pro).length]=new Option(lm[2][i], lm[1][i]);
	}        
	}
	
		document.getElementById(pro).onchange();
}


function changecity(city,pro)
		{
		var city=city;
		var pro=document.getElementById(pro).value;
		var j;
		document.getElementById(city).length=1; 
			for (j=0;j<numcity;j++){
			if (lm2[3][j]==pro){ 
			document.getElementById(city).options[document.getElementById(city).length]=new Option(lm2[2][j], lm2[1][j]);
			}

          }
		}
		
</script>


 


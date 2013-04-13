<?php
if(get_catergory_name($_GET["ca"], $db)=="") {
	 echo "Sorry! No Such Page";
	 header("Location: ./error.php");
     die();
   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
	<?php
	 include("inc/config.php");
	  session_start();
	  $latitude=(float)$_GET["l"];
	  $longitude=(float)$_GET["lo"];
	 // $string="发帖者所在地（此位置来自系统自动识别，由于中国使用的是动态ip地址，所以城市位置会有较大误差。此消息仅供参考)";
	?>
    <title>Poster location</title>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAbrtQWX9DxrTHrJGSo0SgnRRXCQgM7hOMYOm1swlWWKikc2EqPRSiRzpLn5UFFWDpR7W0qjgmH02NPA"
      type="text/javascript"></script>
    <script type="text/javascript">

    //<![CDATA[

    function load() {
	
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.setCenter(new GLatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>), 10);
	//map.setMapType(G_HYBRID_MAP);
    map.setMapType(G_NORMAL_MAP);
	map.addControl(new GSmallMapControl());
	map.addControl(new GScaleControl());
	map.addControl(new GMapTypeControl());
	map.addControl(new GOverviewMapControl());
     


   // var country="China";
	//var city="Shanghai";
	var marker = new GMarker(new GLatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>));
	map.addOverlay(marker);
	
	<?php if($_SESSION["language_be_choosed"]=="eng") { ?>
	
	   marker.openInfoWindowHtml("<div style=\"color:red;\">Poster Location (This is identified by system!)</div>");
	 <?php } else { ?>
     
	 marker.openInfoWindowHtml("<div style=\"color:red;\">发帖者所在地（此位置来自系统自动识别，由于中国使用的是动态ip地址，所以城市位置会有较大误差。此消息仅供参考)</div>");
    <?php } ?>

      }
    }

    //]]>
    </script>
  </head>
  <body onload="load()" onunload="GUnload()">
   
    <div id="map" style="width: 700px; height: 500px" ></div>
	<div style="text-align:center; margin-top:10px;"><input type="button" id="close" name="close" onclick="javascript: self.parent.tb_remove();" value="<?php echo CLOSE; ?>" style="width:200px;" /></div>
  </body>
</html>

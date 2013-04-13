<?php

        // $ip="61.171.150.49";
		 
		 function IP_LOOK_LOCATION($ip){
		 require_once('Net/GeoIP.php');
		 $info = array('city'=>null, 'country'=>null, 'countryCode'=>null, 'longitude'=>null, 'latitude'=>null);
         $geoip = Net_GeoIP::getInstance("geolocation/GeoLiteCity.dat", Net_GeoIP::STANDARD);
         $location = $geoip->lookupLocation($ip);
         $geoip->close(); 
		 $latitude= $location->latitude;
		 $longitude=$location->longitude;
		 $countrycode=$location->countryCode;
		 $country=$location->countryName;
		 $city=$location->city;		
		 $info["city"]=$city;
		 $info["country"]=$country;
		 $info["countryCode"]=$countrycode;
		 $info["longitude"]= $longitude;
		 $info["latitude"]=$latitude;
		 
		 return $info;
		}
		 
?>
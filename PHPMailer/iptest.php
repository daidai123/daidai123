<?php

include("geoip.inc");

$IP="192.124.154.2";
//open the database
$GeoIPDatabase = geoip_open("GeoIP.dat", GEOIP_STANDARD);

//to get the country code (2 letters)
geoip_country_code_by_addr($GeoIPDatabase, $IP);

//to get the full country name
echo geoip_country_name_by_addr($GeoIPDatabase, $IP);

//close the database
geoip_close($GeoIPDatabase);



?>
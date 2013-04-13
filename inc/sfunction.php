<?php 
function timenow($time_offset = null)
{
	if (!isset($time_offset))
		$time_offset = settings('time_offset');

	$time = time() + (int)$time_offset;

	return $time;
}


// Function that returns all setting values from settings table
function settings($var_name = 'all')
{
	require("dbconnect.php");

	if ($var_name != 'all') // if specific variable is requested
	{
		$sql = "SELECT value FROM settings WHERE name = '$var_name'";
		$query = mysql_query($sql, $db);

		if (mysql_num_rows($query) != 1)
			return false;
		else
			return mysql_result($query,0,0); // returning value of asked variable
	}

	else // no variable was requested, returning all settings
	{
		$settings = array(); // creating empty array

		$sql = "SELECT name, value FROM settings";
		$query = mysql_query($sql, $db);
		if (mysql_num_rows($query) < 1) return false; // no records were found

		while ($row = mysql_fetch_array($query)) // populating $settings array with values
		{
			$settings[$row['name']] = $row['value'];
		}

		return $settings;
	}
}
// END settings()
?>
<?php

$handle = mysql_connect("localhost", "root","");

mysql_select_db("cars") or die(mysql_error());

$year = $_GET["Year"];
$make = $_GET["Makes"];
$model = $_GET["Models"];

$query = "select distinct mileage from cars where year = " . $year . 
" AND model = '". mysql_real_escape_string($model) ."'";

$result = mysql_query($query) or die(mysql_error());

	$arr = array();
while($row = mysql_fetch_assoc($result))
{
	$arr[0] = "";
	$arr[] = $row['mileage'];
} 

echo json_encode($arr);

?>
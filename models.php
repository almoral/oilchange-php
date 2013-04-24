<?php

ini_set('display_errors', 'On');

$handle = mysql_connect("localhost", "root","");

mysql_select_db("cars") or die(mysql_error());

$year = $_GET["Year"];
$make = $_GET["Makes"];

$query = "select distinct model from cars where year = " . $year . 
" AND make = '". mysql_real_escape_string($make) . "'";

$result = mysql_query($query) or die(mysql_error());

$arr = array();

while($row = mysql_fetch_assoc($result))
{
	$arr[] = $row['model'];
} 

//$post_data = json_encode(array("makes" => $arr));

echo json_encode($arr);

//echo $post_data;

?>
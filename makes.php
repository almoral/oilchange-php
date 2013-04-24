<?php

$handle = mysql_connect("localhost", "root","");

mysql_select_db("cars") or die(mysql_error());

$year = $_GET["Year"];

$query = "select distinct make from cars where year = " . $year . " ORDER BY make ASC";

$result = mysql_query($query) or die(mysql_error());

$arr = array();

while($row = mysql_fetch_assoc($result))
{
	$arr[] = $row['make'];
} 

//$post_data = json_encode(array("makes" => $arr));

echo json_encode($arr);

//echo $post_data;

?>
<?php

$handle = mysql_connect("localhost", "root","");

mysql_select_db("cars") or die(mysql_error());

$query = "select distinct year from cars";

$result = mysql_query($query) or die(mysql_error());

	$arr = array();
while($row = mysql_fetch_assoc($result))
{
	$arr[0] = "";
	$arr[$row['year']] = $row['year'];
} 

echo json_encode($arr);

?>
<?php
header("Content-type: application/json");
header('Access-Control-Allow-Origin: *');

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysql_connect($servername, $username, $password);
         mysql_select_db("cubinto",$conn);

$trip_id = 'M-1468692028-00';       // seting the trip ID as this for Now having problem with getting data from 									   the client side  

$query = "SELECT `latitude`, `longitude` FROM `tripinfo` WHERE `trip_id`='$trip_id' " ;
$result = mysql_query($query);
//$arr[0]="location:";
for($i = 1; $arr[$i] = mysql_fetch_assoc($result); $i++) ;
    
// Delete last empty one
array_pop($arr);
$data = json_encode($arr);              // send the data to client by HTTP request 
echo $data;


?>


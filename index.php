<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = mysql_connect($servername, $username, $password);
         mysql_select_db("cubinto",$conn);
  
 


# An HTTP GET request example
set_time_limit(0);  // so that server can run infinitly untill the ride is conplete

	$url = 'http://cubito.co.in/assignment/gpslocation.php';
	$ch = curl_init($url);
	//curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	echo $data;
	$data1= json_decode($data,true);
	$trip_id= $data1['trip_id'];
	$query="INSERT INTO `trip` value('','$trip_id')";     // insert the trip_id in the trip table
	mysql_query($query);


do{
		$url = 'http://cubito.co.in/assignment/gpslocation.php?trip_id='.$trip_id;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10000);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		curl_close($ch);
		$info = json_decode($data,true);
		//var_dump($info);
		$trip_id = $info['trip_id'];
		$lastupdate = $info['lastupdate'];
		$latitude = $info['location']['latitude'];
		$longitude = $info['location']['longitude'];
		$query="INSERT INTO `tripinfo` value('$trip_id','$lastupdate','$latitude','$longitude')";    // insert trip information in the tripinfo table every 10 second interval untill trip is complete.
		mysql_query($query);
		sleep(10);
}while($info['status']=="RUNNING");   // update data base untill status is RUNNING 
	

?>
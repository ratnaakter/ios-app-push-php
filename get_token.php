<?php

// if user open his/her app: it will check device id exist or not
// if not save device id with token and date else update token and date



if (isset($_GET["token"])) {

	// $dateNow = date("Y-m-d H:i:s");
	$token = $_GET["token"];
	$deviceId = $_GET["did"];
	

	// data base connect

	/*$servername = "localhost";
	$username = "touhidap_touhid";
	$password = "dbpass";
	$dbname = "touhidap_vu_as_ios_test";*/
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "stickerpush";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	$queryGet = "SELECT * FROM ios_token WHERE device_id = '$deviceId'";
	$result = $conn->query($queryGet);
	// echo (mysql_num_rows($result) == 0) ? 'NO' : 'YES';
	if ($result->num_rows == 0) {

		//$query = "SELECT * FROM ios_token WHERE device_id = '{$deviceId}'";
		// $query2 = "insert into ios_token SET device_id = '$token' WHERE device_id='$deviceId'";
		$query1 = "INSERT INTO ios_token (date_exe, token, device_id) VALUES (NOW(), '$token', '$deviceId')"; 
		$result = $conn->query($query1);

		echo "Response token send successfully";

	}else{

		//$query = "SELECT * FROM ios_token WHERE device_id = '{$deviceId}'";
		$query2 = "UPDATE ios_token SET date_exe = NOW(), token = '$token'  WHERE device_id='$deviceId'";
		$result2 = $conn->query($query2);

		echo "Response token already exists : ";
	}


}else{

	echo 'Token not submited';

}

?>
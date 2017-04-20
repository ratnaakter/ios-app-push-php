<?php

// local
$servername = "localhost";
$database = "ios-app-push";
$username = "root";
$password = "";


// live
// $servername = "192.168.10.21";
// $database = "GCM";
// $username = "sa";
// $password = "theviggo#11";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//  echo "Connected successfully";
    } catch (PDOException $e) {
    	echo "Connection failed: " . $e->getMessage();
}

       //  $connectionInfo = array( "Database"=>$database, "UID"=>$username, "PWD"=>$password);
       //  $con = sqlsrv_connect($servername, $connectionInfo) or die("Couldn't connect to database.<hr>");
       //  // selecting database
       //  if($con){
       // // echo "Connect";
       //  }
       //  define('CONNECT', $con);

?>
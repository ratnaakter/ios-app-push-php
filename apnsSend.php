<?php

if (isset($_POST["message"]) && isset($_POST["allNotifiactionData"])) {

// Put your device token here (without spaces):
	$deviceToken = 'fdgsdfhdrty435576'; 

// Put your private key's passphrase here:
	$passphrase = '1234';

// Put your alert message here:
	$message = $_POST["message"];
	$allNotifiactionData = $_POST["allNotifiactionData"]; //'http://202.164.213.242/CMS/GraphicsPreview/Stickers//Kono_Dekha_Nei_Transperant.png',
// $graphicsCode = $_POST["GraphicsCode"]; //'274821FC-6B9D-4C7C-9170-7A6221A4DCFA'
// $contentTitle = $_POST["ContentTitle"]; //'ভালোবাসার চশমা ২'
// $contentType = $_POST["ContentType"]; //'ST'
// $physicalFileName = $_POST["PhysicalFileName"]; //'Bhalobashar_Choshma_2e'
// $chargeType = $_POST["ChargeType"]; //'Free'

////////////////////////////////////////////////////////////////////////////////

$contextOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false
    )
);

$ctx = stream_context_create($contextOptions);
// stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck_development.pem'); ck_production.pem
stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck_production.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
//for development: ssl://gateway.sandbox.push.apple.com:2195
//for production: ssl://gateway.push.apple.com:2195

$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

if (!$fp){
	exit("Failed to connect: $err $errstr<br/>" . PHP_EOL);
}else{
	// echo 'Connected to APNS<br/>' . PHP_EOL;
}


// Create the payload body
// $body['aps'] = array(
// 	'alert' => array(
//         'body' => $message,
// 		'action-loc-key' => 'Hello App',
//     ),
//     'badge' => 1,
// 	'sound' => 'oven.caf',
// 	'image_url' => 'http://202.164.213.242/CMS/GraphicsPreview/Stickers//Ki_Daho_Emne.jpg'
// 	);

$body['aps'] = array(
	'alert' => $message,
	'badge' => 1,
	'sound' => 'default',
	'content-available'=>'1',
	'allNotifiactionData' => $allNotifiactionData,
	"mediaType"=> "image"
	);

	// 'GraphicsCode' => $graphicsCode,
	// 'ContentTitle' => $contentTitle,
	// 'ContentType' => $contentType,
	// 'PhysicalFileName' => $physicalFileName,
	// 'ChargeType' => $chargeType

// Encode the payload as JSON
$payload = json_encode($body);


include "db_config.php";

// get all token from db

$queryGet = "SELECT token FROM ios_token";
$stmt = $conn->prepare($queryGet);
$stmt->execute();


if ($stmt->rowCount() > 0) {
    // match
    // Fetch rows
	$rowset = $stmt->fetchAll();
	$result2 = $rowset;

	$successCount=0;
	
	foreach ($rowset as $key => $row) {
		//echo $row[0];
		
		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $row[0]) . pack('n', strlen($payload)) . $payload;
		//echo $row[0];
		// Send it to the server to all device
	$resultMessage = fwrite($fp, $msg);//, strlen($msg)

	if ($resultMessage) {
		$successCount++;
	}



}

if ($successCount>0)
	echo '<script>alert("'.$successCount.' Message successfully delivered")</script>' . PHP_EOL;
else
	echo '<script>alert("Message not delivered")</script>' . PHP_EOL;
} else {
	echo "No Data!";
}




//}

// Close the connection to the server
fclose($fp);

} else{
	//echo "Please select an image.<br/>";
}

?>

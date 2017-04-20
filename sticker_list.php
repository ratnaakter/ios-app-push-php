<?php
	$firstNo = $_POST['startFrom'];
	$lastNo = $_POST['endTo'];
	

// function getStickerList($firstNo, $lastNo){

// 	global $firstNo;
// 	global $lastNo;

	$json_string = file_get_contents("http://wap.shabox.mobi/sticker_app_server/default.aspx?&contentCode=NEW_CONTENT&start=".$firstNo."&end=".$lastNo."");


	// $firstNo = $firstNo+10;
	// $lastNo = $lastNo+10;


	$parsed_json = json_decode($json_string, true);

	$parsed_json = $parsed_json['stickers'];
	//$parsed_json = $parsed_json['stickers']['txt_forecast']['forecastday'];
	//pr($parsed_json);
	//echo $parsed_json['PreviewURL'];

	echo "<table class='table' style='margin-top:20px'>";
	foreach($parsed_json as $key => $value){

		$allData = "http://202.164.213.242/CMS/GraphicsPreview/Stickers//".$value['PreviewURL']."-_TTTTT_-".$value['GraphicsCode']."-_TTTTT_-".$value['ContentTitle']."-_TTTTT_-".$value['ContentType']."-_TTTTT_-".$value['PhysicalFileName']."-_TTTTT_-".$value['ChargeType'];

		//echo "$allData";
		echo "<tr>";

		echo '<td><input type="radio" value="'. $allData .'" name="allNotifiactionData" id="allNotifiactionData" required/></td>';
		echo '<td>'.$value['ContentTitle'].'</td>';
	    echo "<td><img style='width:60px' src='http://202.164.213.242/CMS/GraphicsPreview/Stickers//".$value['PreviewURL']."'/></td>";


		echo "</tr>";
	}
		echo "</table>";


// }


?>
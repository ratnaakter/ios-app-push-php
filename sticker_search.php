<?php

$mySearchValue = $_POST['mySearchValue'];
$mySearchValue = str_replace(" ", "%20", $mySearchValue);

$json_string = file_get_contents("http://wap.shabox.mobi/sticker_app_server/default.aspx?&contentCode=NEW_CONTENT&title=" . $mySearchValue);


$parsed_json = json_decode($json_string, true);

$parsed_json = $parsed_json['stickers'];


echo "<table class='table' style='margin-top:20px'>";
foreach ($parsed_json as $key => $value) {

    if (!empty($value['PreviewURL'])) {
        $allData = "http://202.164.213.242/CMS/GraphicsPreview/Stickers//" . $value['PreviewURL'] . "-_TTTTT_-" . $value['GraphicsCode'] . "-_TTTTT_-" . $value['ContentTitle'] . "-_TTTTT_-" . $value['ContentType'] . "-_TTTTT_-" . $value['PhysicalFileName'] . "-_TTTTT_-" . $value['ChargeType'];

        //echo "$allData";
        echo "<tr>";

        echo '<td><input type="radio" value="' . $allData . '" name="allNotifiactionData" id="allNotifiactionData" required/></td>';
        echo '<td>' . $value['ContentTitle'] . '</td>';
        echo "<td><img style='width:60px' src='http://202.164.213.242/CMS/GraphicsPreview/Stickers//" . $value['PreviewURL'] . "'/></td>";


        echo "</tr>";
    } else {
        echo "<br/><p style='color:red'>No sticker found!</p>";
    }


}
echo "</table>";


// }


?>
<?php
function generateInfoWindowText($row){
    $result = "";
//    foreach($row as $item){
//        $result .= $item . "</br>";
//    }
    $result .= "Name: <div class='infoRight'>" . $row["name"] . "</div></br>";
    $result .= "Trans Friendly: <div class='infoRight'>" . asYesNo($row["trans_friendly"]) . "</div></br>";
    $result .= "Choice Friendly: <div class='infoRight'>" . asYesNo($row["choice_friendly"]) . "</div></br>";
    $result .= "Accepts Medical Card: <div class='infoRight'>" . asYesNo($row["medical_card_friendly"]) . "</div></br>";
    $result .= "Provides Referrals: <div class='infoRight'>" . asYesNo($row["ready_to_refer"]) . "</div>";
    return $result;
}

function asYesNo($val){
    return $val == 1 ? "Yes" : "No";
}
?>

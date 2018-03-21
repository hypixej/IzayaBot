<?php
$outputtohtml .= "<tr>";
$outputtohtml .= "<td><img height='38' src='" . $avatarbaseurl. "/" . $oneobject['user']['id'] . "/" . $oneobject['user']['avatar'] . ".png' /></td>";
$outputtohtml .= "<td><b>" . $oneobject['user']['username'] . "#" . $oneobject['user']['discriminator'] . "</b></td>";

$outputtohtml .= "<td>";
if(!($oneobject['reason'] == null)){
	$outputtohtml .= $oneobject['reason'] . "<br>";
}
$outputtohtml .= $oneobject['user']['id'] . "</td>";
	
//$outputtohtml .= "<td>";
//$outputtohtml .= "<button>Unban</button>";
//$outputtohtml .= "</td>";
$outputtohtml .= "</tr>";
?>
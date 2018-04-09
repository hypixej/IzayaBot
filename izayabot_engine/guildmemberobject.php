<?php
$outputtohtml .= "<tr>";
$outputtohtml .= "<td>" . qavatar($oneobject['user']['id'], $oneobject['user']['avatar']) . "</td>";
$outputtohtml .= "<td><b>" . $oneobject['user']['username'] . "#" . $oneobject['user']['discriminator'] . "</b><br>" . str_replace("T", " ", substr($oneobject['joined_at'], 0, -13)) . "</td>";

$outputtohtml .= "<td>";
if(!($oneobject['nick'] == null)){
	$outputtohtml .= $oneobject['nick'] . "<br>";
}
$outputtohtml .= $oneobject['user']['id'] . "</td>";

if(isset($oneobject['user']['bot'])){
	$outputtohtml .= "<td><b><font color='#bb106d'>BOT</font></b></td>";
} else {
	$outputtohtml .= "<td>User</td>";
}
	
//$outputtohtml .= "<td>";
//$outputtohtml .= "<button>Kick</button>";
//$outputtohtml .= "<button>Ban</button>";
//$outputtohtml .= "</td>";
$outputtohtml .= "</tr>";
?>
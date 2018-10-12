<?php
$outputtohtml .= "<tr>";
$outputtohtml .= "<td>" . qavatar($oneobject['user']['id'], $oneobject['user']['avatar']) . "</td>";
$outputtohtml .= "<td><b>" . $oneobject['user']['username'] . "#" . $oneobject['user']['discriminator'] . "</b>";
if(!($oneobject['nick'] == null)){
	$outputtohtml .= "<br>" . $oneobject['nick'] . "</td>";
} else{
	$outputtohtml .= "</td>";
}

$outputtohtml .= "<td>";
$outputtohtml .= $oneobject['user']['id'] . "<br>";
$outputtohtml .= str_replace("T", " ", substr($oneobject['joined_at'], 0, -13));
$outputtohtml .= "</td>";

if(isset($oneobject['user']['bot'])){
	$outputtohtml .= "<td><b><font color='#bb106d'>BOT</font></b></td>";
} else {
	$outputtohtml .= "<td>User</td>";
}
	

if(isset($_GET['sr'])){
	$outputtohtml .= "<td>";
	foreach($oneobject['roles'] as $onerolez){
		$outputtohtml .= $onerolez . "</br>\r\n";
	}
	$outputtohtml .= "</td>";
}

//$outputtohtml .= "<td>";
//$outputtohtml .= "<button>Kick</button>";
//$outputtohtml .= "<button>Ban</button>";
//$outputtohtml .= "</td>";
$outputtohtml .= "</tr>";
?>
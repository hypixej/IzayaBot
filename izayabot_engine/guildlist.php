<?php
$outputtohtml .= "<center>";
$outputtohtml .= "<table>";
$outputtohtml .= "<tr><td colspan='2'><h1>Guilds this bot is in:</h1></td></tr>";
foreach ($fetchedarray as $oneobject){
	$outputtohtml .= "<tr>";
	$outputtohtml .= "<td><img width='128' src='" . $iconbaseurl . "/" . $oneobject['id'] . "/" . $oneobject['icon'] . ".png' /></td>";
	$outputtohtml .= "<td><a href='index.php?ty=channellist&gid=" . $oneobject['id'] . "'><b>" . $oneobject['name'] . "</b></a><br>";
	$outputtohtml .= $oneobject['id'];
	$outputtohtml .= "<br><button>Leave</button>";
	$outputtohtml .= "</td></tr>";
}
$outputtohtml .= "</table>";
$outputtohtml .= "</center>";
?>
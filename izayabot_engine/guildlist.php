<?php
$outputtohtml .= "<center>";
$outputtohtml .= "<h1>Guilds this account is in:</h1>";
$outputtohtml .= "<h2>Total: " . count($fetchedarray) . "</h2>";
$outputtohtml .= "<table>";
foreach ($fetchedarray as $oneobject){

	$outputtohtml .= "<tr><td rowspan='3'>" . qicon($oneobject['id'], $oneobject['icon']) . "</td><td><a href='index.php?ty=channellist&gid=" . $oneobject['id'] . "'><b>" . $oneobject['name'] . "</b></a></td></tr>";

	$outputtohtml .= "<tr>";
	$outputtohtml .= "<td>" . $oneobject['id'] . "</td>";
	$outputtohtml .= "</tr>";

	$outputtohtml .= "<tr>";
	$outputtohtml .= "<td><a href='index.php?ty=leaveguild&gid=" . $oneobject['id'] . "'><button>Leave</button></a><a href='index.php?ty=getguild&gid=" . $oneobject['id'] . "'><button>Get Guild Info</button></a></td>";
	$outputtohtml .= "</tr>";

}
$outputtohtml .= "</table>";
$outputtohtml .= "</center>";
?>
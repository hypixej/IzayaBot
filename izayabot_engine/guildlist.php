<?php
$outputtohtml .= "<center><table border='0'><tr><th colspan='3'><b>Guilds this bot is in:</b></th></tr>";
	foreach ($fetchedarray as $oneobject){
		$outputtohtml .= "<tr><td><img width='32' src='" . $iconbaseurl . "/" . $oneobject['id'] . "/" . $oneobject['icon'] . ".png' />";
		$outputtohtml .= "</td><td>";
		$outputtohtml .= "<td><a href='index.php?ty=channellist&gid=" . $oneobject['id'] . "'>";
		$outputtohtml .= $oneobject['name'];
		$outputtohtml .= "</a>";
		$outputtohtml .= "</td><td>";
		$outputtohtml .= $oneobject['id'];
		$outputtohtml .= "</td><td id='tdkb'>";
		$outputtohtml .= "<button>Leave</button>";
		$outputtohtml .= "</td></tr>";
	}
	$outputtohtml .= "</table></center>";
?>
<?php
$outputtohtml .= "<center><table border='0'><tr><th colspan='3'><b>Guilds this bot is in:</b></th></tr>";
	foreach ($fetchedarray as $onemessage){
		$outputtohtml .= "<tr><td><img width='32' src='https://cdn.discordapp.com/icons/" . $onemessage['id'] . "/" . $onemessage['icon'] . ".png' />";
		$outputtohtml .= "</td><td>";
		$outputtohtml .= "<td><a href='index.php?ty=channellist&id=" . $onemessage['id'] . "'>";
		$outputtohtml .= $onemessage['name'];
		$outputtohtml .= "</a>";
		$outputtohtml .= "</td><td>";
		$outputtohtml .= $onemessage['id'];
		$outputtohtml .= "</td><td id='tdkb'>";
		$outputtohtml .= "<button>Leave</button>";
		$outputtohtml .= "</td></tr>";
	}
	$outputtohtml .= "</table></center>";
?>
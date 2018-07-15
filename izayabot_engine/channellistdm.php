<?php

//usort($fetchedarray, function($a, $b) {
//	return ($a["position"] < $b["position"]) ? -1 : 1;
//});

$outputtohtml .= "<h2>Total: " . count($fetchedarray) . "</h2>";
$outputtohtml .= "<table border='0'>";
	foreach($fetchedarray as $oneobject) {

		$outputtohtml .= "<tr>";

		$outputtohtml .= "<td class='' style='text-align: right;'>";
		foreach($oneobject['recipients'] as $onerecipient){
			$outputtohtml .= "" . qavatar($onerecipient['id'], $onerecipient['avatar']) . "";
		}
		$outputtohtml .= "</td>";

		$outputtohtml .= "<td class=''>";
		foreach($oneobject['recipients'] as $onerecipient){
			$outputtohtml .= "" . "<a href='index.php?ty=messages&cid=" . $oneobject['id'] . "'>" . $onerecipient['username'] . "</a>" . "<br>";
		}
		$outputtohtml .= "</td>";

		$outputtohtml .= "<td class=''>" . $oneobject['id'] . "</td>";
		$outputtohtml .= "</tr>";
	}
	$outputtohtml .= "</table>";
?>
<?php
$outputtohtml .= "<tr>";
$outputtohtml .= "<td>" . qavatar($oneobject['user']['id'], $oneobject['user']['avatar']) . "</td>";
$outputtohtml .= "<td><b>" . $oneobject['user']['username'] . "#" . $oneobject['user']['discriminator'] . "</b></td>";

$outputtohtml .= "<td>";
if(!($oneobject['reason'] == null)){
	$outputtohtml .= $oneobject['reason'] . "<br>";
}
$outputtohtml .= $oneobject['user']['id'] . "</td>";
	
$outputtohtml .= "<td>";
$outputtohtml .= "<a target='_blank' href='index.php?ty=unban&gid=$gid&uid=" . $oneobject['user']['id'] . "'><button>Unban</button></a>";
$outputtohtml .= "</td>";
$outputtohtml .= "</tr>";
$lastuserobject = $oneobject['user']['id'];
?>
<?php
if(isset($fetchedarray['code'])){
	$outputtohtml .= "The bot has no access to this channel";
} else {
	$outputtohtml .= "
	Channel id: " . $cid . "</b>
	<hr>
	<table border='0'>
	<form action='index.php?ty=postmessage&cid=$cid' method='POST'>
		<tr>
			<td class='tbavatar'><img src='" . $avatarbaseurl. "/" . $bid . "/" . $bavatar . ".png' height='38' /></td>
			<td class='tbusername'>" . $buser . "</td>
			<td class='tbtext'><textarea name='content' style='width: 100%' placeholder='Type your message here and then click Post.'></textarea></td>
			<td class='tbbuttons'><input type='submit' value='Post' /></td>
		</tr>
	</form>";

	foreach ($fetchedarray as $oneobject) {
		include("izayabot_engine/messageobject.php");
	}
	$outputtohtml .= "</table>";
	$extrabuttonarray = array(
//		"&#x2BC7; Previous Page" => "index.php?ty=messages&cid=" . $cid . "&lastm=" . $lastmessageidfornp,
		"&#x2BC8; Next Page" => "index.php?ty=messages&cid=" . $cid . "&lastm=" . $lastmessageidfornp,
	);
}
// $gobacklink = "index.php?ty=channellist&gid=" . $gid;
?>
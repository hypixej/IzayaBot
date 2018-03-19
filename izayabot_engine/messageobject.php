<?php
if(!isset($oneobject)){
	$oneobject = $fetchedarray;
}
if(isset($tablemarkup)){
	$outputtohtml .= "<table>";
}
$outputtohtml .= "<tr>";
$outputtohtml .= "<td class='tbavatar'><img height='38' src='" . $avatarbaseurl. "/" . $oneobject['author']['id'] . "/" . $oneobject['author']['avatar'] . ".png' /></td>";
$outputtohtml .= "<td class='tbusername'><b>" . $oneobject['author']['username'] . "#" . $oneobject['author']['discriminator'] . "</b><br>" . str_replace("T", " ", substr($oneobject['timestamp'], 0, -13)) . "</td>";
$outputtohtml .= "<td class='tbtext'><pre>" . $oneobject['content'] . "</pre>";
if(isset($oneobject['attachments']['0']['url'])){
	$outputtohtml .= "<a target='_blank' href='" . $oneobject['attachments']['0']['url'] . "'>" . imgme($oneobject['attachments']['0']['proxy_url'], 200, 1) . "<br>" . $oneobject['attachments']['0']['filename'] . "</a>";
}
if(isset($oneobject['mentions']['0']['username'])){
	$outputtohtml .= "<pre>Mentions: ";
	foreach($oneobject['mentions'] as $onemention){
		$outputtohtml .= $onemention['username'] . "#" . $onemention['discriminator'] . " (" . $onemention['id'] . "), ";
	}
	$outputtohtml .= "</pre>";
}
if(isset($oneobject['reactions'])){
	$outputtohtml .= "<pre>Reactions: ";
	foreach($oneobject['reactions'] as $oneemoji){
		$outputtohtml .= $oneemoji['emoji']['name'] . " (" . $oneemoji['emoji']['id'] . "), ";
	}
	$outputtohtml .= "</pre>";
}
// if(isset($oneobject['embeds']['0'])){
	// $outputtohtml .= imgme($oneobject['embeds']['0']['thumbnail']['proxy_url'], 0, 0);
	// $outputtohtml .= "<br>";
	// $outputtohtml .= $oneobject['embeds']['0']['author']['name'];
	// $outputtohtml .= "<br>";
	// $outputtohtml .= $oneobject['embeds']['0']['title'];
	// $outputtohtml .= "<br>";
	// $outputtohtml .= $oneobject['embeds']['0']['footer']['text'];
	// $outputtohtml .= "<br>";
	// $outputtohtml .= imgme($oneobject['embeds']['0']['footer']['proxy_icon_url'], 32, 1);
// }
$outputtohtml .= "</td>";
$outputtohtml .= "<td class='tbbuttons'>";
if($oneobject['author']['id'] == $_COOKIE['bid']){
	$outputtohtml .= "<a href='index.php?ty=msgedit&cid=$cid&mid=" . $oneobject['id'] . "'><button>Edit</button></a>";
}
$outputtohtml .= "<a href='index.php?ty=msgdel&cid=$cid&mid=" . $oneobject['id'] . "'><button>Delete</button></a>";
//$outputtohtml .= "<button>Kick</button>";
//$outputtohtml .= "<button>Ban</button>";
$outputtohtml .= "</td>";
$outputtohtml .= "</tr>";
if(isset($tablemarkup)){
	$outputtohtml .= "</table>";
}
?>
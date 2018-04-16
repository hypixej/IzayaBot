<?php
if(!isset($oneobject)){
	$oneobject = $fetchedarray;
}
if(isset($tablemarkup)){
	$outputtohtml .= "<table>";
}
$outputtohtml .= "<tr>";
$outputtohtml .= "<td class='tbavatar'>" . qavatar($oneobject['author']['id'], $oneobject['author']['avatar']) . "</td>";
$outputtohtml .= "<td class='tbusername'><b>" . $oneobject['author']['username'] . "#" . $oneobject['author']['discriminator'] . "</b><br>" . str_replace("T", " ", substr($oneobject['timestamp'], 0, -13)) . "</td>";
$outputtohtml .= "<td class='tbtext'>";
if(!empty($oneobject['content'])){
	$outputtohtml .= "<pre>" . $oneobject['content'] . "</pre>";
}
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
if(isset($oneobject['embeds']['0'])){
	$outputtohtml .= "<pre>";
	if(isset($oneobject['embeds']['0']['thumbnail']['proxy_url'])){
		if(isset($oneobject['embeds']['0']['url'])){
			$outputtohtml .= "<a target='_blank' href='" . $oneobject['embeds']['0']['url'] . "'>" . imgme($oneobject['embeds']['0']['thumbnail']['proxy_url'], 0, 0) . "</a>";
		} else {
			$outputtohtml .= imgme($oneobject['embeds']['0']['thumbnail']['proxy_url'], 0, 0);
		}
		$outputtohtml .= "<br>";
	}
	if(isset($oneobject['embeds']['0']['author']['name'])){
		$outputtohtml .= $oneobject['embeds']['0']['author']['name'];
		$outputtohtml .= "<br>";
	}
	if(isset($oneobject['embeds']['0']['title'])){
		if(isset($oneobject['embeds']['0']['url'])){
			$outputtohtml .= "<a target='_blank' href='" . $oneobject['embeds']['0']['url'] . "'>" . $oneobject['embeds']['0']['title'] . "</a>";
		} else {
			$outputtohtml .= $oneobject['embeds']['0']['title'];
		}
		$outputtohtml .= "<br>";
	}
	if(isset($oneobject['embeds']['0']['description'])){
		$outputtohtml .= $oneobject['embeds']['0']['description'];
		$outputtohtml .= "<br>";
	}
	if(!empty($oneobject['embeds']['0']['fields'])){
		foreach($oneobject['embeds']['0']['fields'] as $field){
			$outputtohtml .= $field['name'];
			$outputtohtml .= ": ";
			$outputtohtml .= $field['value'];
			$outputtohtml .= "<br>";
		}
	}
	if(isset($oneobject['embeds']['0']['footer']['proxy_icon_url'])){
		$outputtohtml .= imgme($oneobject['embeds']['0']['footer']['proxy_icon_url'], 32, 1);
//		$outputtohtml .= "<br>";
	}
	if(isset($oneobject['embeds']['0']['footer']['text'])){
		$outputtohtml .= $oneobject['embeds']['0']['footer']['text'];
		$outputtohtml .= "<br>";
	}
	$outputtohtml .= "</pre>";
}
$outputtohtml .= "</td>";
$outputtohtml .= "<td class='tbbuttons'>";
if($oneobject['author']['id'] == $_COOKIE['bid']){
	$outputtohtml .= "<a href='index.php?ty=msgedit&cid=$cid&mid=" . $oneobject['id'] . "'><button>Edit</button></a>";
}
$outputtohtml .= "<a target='_blank' href='index.php?ty=msgdel&cid=$cid&mid=" . $oneobject['id'] . "'><button>Delete</button></a>";
//$outputtohtml .= "<button>Kick</button>";

$outputtohtml .= "<a target='_blank' href='index.php?ty=guildspecialthings&gid=$gid&uid=" . $oneobject['author']['id'] . "&imply=ban'><button>Ban</button></a>";
$outputtohtml .= "</td>";

$outputtohtml .= "</tr>";
if(isset($tablemarkup)){
	$outputtohtml .= "</table>";
}
$lastmessageidfornp = $oneobject['id'];
?>
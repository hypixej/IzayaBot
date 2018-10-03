<?php
/*
function arrangeChannelsCorrectly($fetchedArray){
	$returnArray = [];
	$categoryList = [];
	$channelList = [];
	usort($fetchedArray, function($a, $b) {
		return ($a["position"] < $b["position"]) ? -1 : 1;
	});
	foreach($fetchedArray as $oneChannelObject){
		if($oneChannelObject['type'] == "4"){
			$categoryList[$oneChannelObject['id']] = [];
		}
	}
	foreach($fetchedArray as $oneChannelObject){
		if($oneChannelObject['type'] !== "4"){
			if($oneChannelObject['parent_id'] == null){
				$parentid = "0";
			} else {
				$parentid = $oneChannelObject['parent_id'];
			}
			array_push($categoryList[$parentid], $oneChannelObject['id']);
		}
	}
	return $categoryList;
}

$blueprint = arrangeChannelsCorrectly($fetchedarray);
*/
$outputtohtml .= "<h2>Total: " . count($fetchedarray) . "</h2>";
$outputtohtml .= "<table border='0'>";
	foreach($fetchedarray as $oneobject) {
		if($oneobject['type'] == "0"){
			$channeltypeicon = "#";
			$channelhypertext = "<a href='index.php?ty=messages&cid=" . $oneobject['id'] . "&gid=" . $gid . "'>" . $oneobject['name'] . "</a>";
		} elseif($oneobject['type'] == "2"){
			$channeltypeicon = "&#x1F4DE;";
			$channelhypertext = $oneobject['name'];
		} elseif($oneobject['type'] == "4"){
			$channeltypeicon = "&#x26BC;";
			$channelhypertext = $oneobject['name'];
		} elseif($oneobject['type'] == "1"){
			$channeltypeicon = qavatar($oneobject['recipients'][0]['id'], $oneobject['recipients'][0]['avatar']);
			$channelhypertext = "<a href='index.php?ty=messages&cid=" . $oneobject['id'] . "&gid=" . $gid . "'>" . $oneobject['recipients'][0]['username'] . "</a>";
		}
		$outputtohtml .= "<tr>";
		$outputtohtml .= "<td class=''>" . $channeltypeicon . "</td>";

		$outputtohtml .= "<td class=''>" . $channelhypertext . "</td>";

		if(!empty($oneobject['topic'])){
			$outputtohtml .= "<td class=''>" . $oneobject['topic'] . "</td>";
		} else {
			$outputtohtml .= "<td class=''>&nbsp;</td>";
		}

		$outputtohtml .= "<td class=''>" . $oneobject['id'] . "</td>";
//		$outputtohtml .= "<td class='tbbuttons'>";
//		$outputtohtml .= "<button>Edit</button>";
//		$outputtohtml .= "<button>Delete</button>";
//		$outputtohtml .= "</td>";
		$outputtohtml .= "</tr>";
	}
	$outputtohtml .= "</table>";
?>
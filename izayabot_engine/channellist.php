<?php
$outputtohtml .= "<table border='0'>";
	foreach($fetchedarray as $oneobject) {
		if($oneobject['type'] == "0"){
			$channeltypeicon = "&#x270E;";
			$channelhypertext = "<a href='index.php?ty=messages&cid=" . $oneobject['id'] . "'>" . $oneobject['name'] . "</a>";
		} elseif($oneobject['type'] == "2"){
			$channeltypeicon = "&#x1F508;";
			$channelhypertext = $oneobject['name'];
		} elseif($oneobject['type'] == "4"){
			$channeltypeicon = "&#x26BC;";
			$channelhypertext = $oneobject['name'];
		}
		$outputtohtml .= "<tr>";
		$outputtohtml .= "<td class='tbavatar'>" . $channeltypeicon . "</td>";
		$outputtohtml .= "<td class='tbusername'>" . $channelhypertext . "</td>";
		$outputtohtml .= "<td class='tbtext'>" . $oneobject['id'] . "</td>";
//		$outputtohtml .= "<td class='tbbuttons'>";
//		$outputtohtml .= "<button>Edit</button>";
//		$outputtohtml .= "<button>Delete</button>";
//		$outputtohtml .= "</td>";
		$outputtohtml .= "</tr>";
	}
	$outputtohtml .= "</table>";
?>
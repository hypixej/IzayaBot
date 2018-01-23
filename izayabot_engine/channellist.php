<?php
$outputtohtml .= "<center><table border='0'>";
	foreach ($fetchedarray as $onemessage) {
		$outputtohtml .= "<tr><td>";
		if($onemessage['type'] == "0"){
			$outputtohtml .= "&#x270E;";
		} elseif($onemessage['type'] == "2"){
			$outputtohtml .= "&#x1F508;";
		} elseif($onemessage['type'] == "4"){
			$outputtohtml .= "&#x26BC;";
		}
		$outputtohtml .= "</td>";
		$outputtohtml .= "<td><a href='index.php?ty=messages&id=" . $onemessage['id'] . "'>";
		$outputtohtml .= $onemessage['name'];
		$outputtohtml .= "</a>";
		$outputtohtml .= "<td>";
		$outputtohtml .= $onemessage['id'];
		$outputtohtml .= "</td><td id='tdkb'>";
		$outputtohtml .= "<button>Edit</button><button>Delete</button>";
		$outputtohtml .= "</td></tr>";
	}
	$outputtohtml .= "</table></center>";
?>
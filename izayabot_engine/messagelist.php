<?php
$outputtohtml .= "
<form action='index.php?ty=postmessage&id=$id' method='POST'>
		<table border='0'>
		<tr>
		<td width='5%'><img src='" . $avatarbaseurl. "/" . $bid . "/" . $bavatar . ".png' height='32' /></td>
		<td width='15%'>" . $buser . "</td>
		<td width='60%'><textarea name='content' style='width: 100%' placeholder='Type your message here and then click Post.'></textarea></td>
		<td width='5%'><input type='submit' value='Post' /></td>
</tr></table></form>";
		$outputtohtml .= "<hr><center><table border='0'><tr><th colspan='3'><b>Channel id: " . $id . "</b></th></tr>";

		foreach ($fetchedarray as $onemessage) {
			$outputtohtml .= "<tr><td>";
//			$outputtohtml .= $onemessage['timestamp'];
//			$outputtohtml .= "</td><td>";
			$outputtohtml .= "<img height='32' src='" . $avatarbaseurl. "/" . $onemessage['author']['id'] . "/" . $onemessage['author']['avatar'] . ".png' />";
			$outputtohtml .= "</td><td>";
			$outputtohtml .= $onemessage['author']['username'];
			$outputtohtml .= "#";
			$outputtohtml .= $onemessage['author']['discriminator'];
			$outputtohtml .= "</td><td>";
			$outputtohtml .= $onemessage['content'];
			if(isset($onemessage['attachments']['0']['url'])){
				$outputtohtml .= "<br><a href='";
				$outputtohtml .= $onemessage['attachments']['0']['url'];
				$outputtohtml .= "'>";
				$outputtohtml .= $onemessage['attachments']['0']['filename'];
				$outputtohtml .= "</a>";
			}
			$outputtohtml .= "</td>";
			$outputtohtml .= "<td id='tdkb'>";
			$outputtohtml .= "<a href='index.php?ty=msgedit&cid=$id&id=" . $onemessage['id'] . "'><button>Edit</button></a><button>Delete</button><button>Kick</button><button>Ban</button>";
			$outputtohtml .= "</td></tr>";
		}
		$outputtohtml .= "</table></center>";
?>
<?php
$outputtohtml .= "
<table border='0'>
<form action='index.php?ty=editmessage&mid=$mid&cid=$cid' method='POST'>
	<tr>
		<td class='tbavatar'><img src='" . $avatarbaseurl. "/" . $bid . "/" . $bavatar . ".png' height='38' /></td>
		<td class='tbusername'>" . $buser . "</td>
		<td class='tbtext'><textarea  class='tbtext' name='content' style='width: 100%' placeholder='Type your message here and then click Post.'>" . htmlspecialchars($fetchedarray['content']) . "</textarea></td>
		<td class='tbbuttons'><input type='submit' value='Submit Edit' /></td>
	</tr>
</form></table>";
?>
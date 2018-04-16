<?php
$outputtohtml .= "
<table border='0'>
<form action='index.php?ty=editmessage&mid=$mid&cid=$cid' method='POST'>
	<tr>
		<td class='tbavatar'>" . qavatar($bid, $bavatar) . "</td>
		<td class='tbusername'>" . $buser . "</td>
		<td class='tbtext'><textarea name='content' style='width: 100%' placeholder='Type your message here and then click Post.'>" . htmlspecialchars($fetchedarray['content']) . "</textarea></td>
		<td class='tbbuttons'><input type='submit' value='Submit Edit' /></td>
	</tr>
</form></table>";
?>
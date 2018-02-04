<?php
$outputtohtml .= "
<form action='index.php?ty=editmessage&id=$id&cid=$cid' method='POST'>
		<table border='0'>
		<tr>
		<td width='5%'><img src='" . $avatarbaseurl. "/" . $bid . "/" . $bavatar . ".png' height='32' /></td>
		<td width='15%'>" . $buser . "</td>
		<td width='60%'><textarea name='content' style='width: 100%' placeholder='Type your message here and then click Post.'></textarea></td>
		<td width='5%'><input type='submit' value='Post' /></td>
</tr></table></form>";
?>
<?php
$outputtohtml .= "<h1>Advanced things</h1>";
$outputtohtml .= "<form action='index.php' method='GET'>
<table border='0'>
<tr>
<td>Guild ID:</td><td><input name='gid' value='$gid'></input></td>
</tr>
<tr>
<td>Channel ID:</td><td><input name='cid' value='$cid'></input></td>
</tr>
<tr>
<td>User ID:</td><td><input name='uid' value='$uid'></input></td>
</tr>
<tr>
<td>Message ID:</td><td><input name='mid' value='$mid'></input></td>
</tr>
<tr>
<td>Action:</td><td><select name='ty'><option value='massnick'>Change Everyone's Nickname</option><option value='changeusername'>Change Bot's username</option></select></td>
</tr>
<tr>
<td>New Value:</td><td><input name='nv' value=''></input></td>
</tr>
<tr>
<td>&nbsp;</td><td><input type='submit' value='Submit'></td>
</tr>
</table>
</form>
Note: Leave fields empty if not applicable.";
?>
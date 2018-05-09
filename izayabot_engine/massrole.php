<?php
$outputtohtml .= "<center><h1>Massnick</h1></center>";
$outputtohtml .= "<table>";
foreach ($fetchedarray as $oneguilduserobject){
	$newrole = array($_GET['nv']);
	if(1){
		$secondrequestarray = array(
			"roles" => $newrole,
		);
		sleep(1);
		$secondresponcearray = apirequest("/guilds/$gid/members/" . $oneguilduserobject['user']['id'], $secondrequestarray, 'PATCH', $headers);
	}
	$outputtohtml .= "<tr>";
	$outputtohtml .= "<td>" . qavatar($oneguilduserobject['user']['id'], $oneguilduserobject['user']['avatar']) . "</td>";
	$outputtohtml .= "<td><b>" . $oneguilduserobject['user']['username'] . "#" . $oneguilduserobject['user']['discriminator'] . "</b><br>" . str_replace("T", " ", substr($oneguilduserobject['joined_at'], 0, -13)) . "</td>";
	$outputtohtml .= "<td>";
	$outputtohtml .= $oneguilduserobject['user']['id'] . "</td>";
	if(isset($oneguilduserobject['user']['bot'])){
		$outputtohtml .= "<td><b><font color='#bb106d'>BOT</font></b></td>";
	} else {
		$outputtohtml .= "<td>User</td>";
	}
	$outputtohtml .= "<td><pre>";
	$outputtohtml .= $secondresponcearray;
	$outputtohtml .= "</pre></td>"; 
	$outputtohtml .= "</tr>";
}
$outputtohtml .= "</table>";
$gobacklink = "index.php?ty=channellist&gid=" . $gid;
?>
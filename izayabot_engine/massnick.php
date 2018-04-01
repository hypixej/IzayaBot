<?php
$outputtohtml .= "<center><h1>Massnick</h1></center>";
$outputtohtml .= "<table>";
foreach ($fetchedarray as $oneguilduserobject){
	$newnickname = $_GET['nv'];
	$secondrequest = "/guilds/$gid/members/" . $oneguilduserobject['user']['id'];
	if($newnickname != $oneguilduserobject['nick']){
		$secondrequestarray = array(
			"nick" => $newnickname,
		);
		$secondrequestquery = json_encode($secondrequestarray);
		array_push($headers, "Content-Type: application/json");
		$secondcurl = curl_init();
		curl_setopt($secondcurl, CURLOPT_CUSTOMREQUEST, 'PATCH');
		curl_setopt($secondcurl, CURLOPT_POSTFIELDS, $secondrequestquery);
		curl_setopt($secondcurl, CURLOPT_URL, $baseurl . $secondrequest);
		curl_setopt($secondcurl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($secondcurl, CURLOPT_USERAGENT, $useragent);
		curl_setopt($secondcurl, CURLOPT_COOKIEJAR, 'cookie.txt');
		curl_setopt($secondcurl, CURLOPT_COOKIEFILE, 'cookie.txt');
		curl_setopt($secondcurl, CURLOPT_RETURNTRANSFER, 1);
		$secondjsonresponce = curl_exec($secondcurl);
		$secondresponcearray = json_decode($secondjsonresponce, true);
		curl_close($secondcurl);
	} else {
		$secondjsonresponce = "This user's nickname is already " . $newnickname;
	}
	$outputtohtml .= "<tr>";
	$outputtohtml .= "<td><img height='38' src='" . $avatarbaseurl. "/" . $oneguilduserobject['user']['id'] . "/" . $oneguilduserobject['user']['avatar'] . ".png' /></td>";
	$outputtohtml .= "<td><b>" . $oneguilduserobject['user']['username'] . "#" . $oneguilduserobject['user']['discriminator'] . "</b><br>" . str_replace("T", " ", substr($oneguilduserobject['joined_at'], 0, -13)) . "</td>";
	$outputtohtml .= "<td>";
	$outputtohtml .= $oneguilduserobject['user']['id'] . "</td>";
	if(isset($oneguilduserobject['user']['bot'])){
		$outputtohtml .= "<td><b><font color='#bb106d'>BOT</font></b></td>";
	} else {
		$outputtohtml .= "<td>User</td>";
	}
	$outputtohtml .= "<td><pre>";
	$outputtohtml .= $secondjsonresponce;
	$outputtohtml .= "</pre></td>"; 
	$outputtohtml .= "</tr>";
}
$outputtohtml .= "</table>";
$gobacklink = "index.php?ty=channellist&gid=" . $gid;
?>
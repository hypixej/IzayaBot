<?php
ini_set('max_execution_time', 3000);
$outputtohtml = "";

$iconbaseurl = "https://cdn.discordapp.com/icons";

function imgme($wimg, $whi, $uw){
	if($uw == 1){
		return "<img style='max-height: " . $whi . "px;' src='$wimg' />";
	} else {
		return "<img style='max-width:100%; max-height:100%;' src='$wimg' />";
	}
}

function qavatar($userid, $avtid){
	return "<img height='38' src='https://cdn.discordapp.com/avatars/" . $userid . "/" . $avtid . ".png' />";
}

function qicon($eyedee, $eyekon){
	return "<img height='64' src='https://cdn.discordapp.com/icons/" . $eyedee . "/" . $eyekon . ".png' />";
}

function sinvite($guildid, $wannapremissions){
	return "https://discordapp.com/oauth2/authorize?client_id=" . $guildid . "&scope=bot&permissions=" . $wannapremissions;
}

if(isset($_GET['logout'])) {
	setcookie('logintoken', '', time()-10000000);
	setcookie('buser', '', time()-10000000);
	setcookie('bid', '', time()-10000000);
	setcookie('bavatar', '', time()-10000000);
	setcookie('tokentype', '', time()-10000000);
	$outputtohtml .= "You have logged out.<hr>";
	include("izayabot_engine/loginpage.php");
} elseif(isset($_POST['logintoken'])) {
	$token_in_use = $_POST['logintoken'];
	$tokentypeused = $_POST['tokentype'];
	$ty = "loggedin";
} elseif(isset($_COOKIE['logintoken'])){
	$token_in_use = $_COOKIE['logintoken'];
	if(isset($_COOKIE['tokentype'])){
		$tokentypeused = $_COOKIE['tokentype'];
	} else {
		$tokentypeused = "";
	}
} else {
	include("izayabot_engine/loginpage.php");
}
if(isset($_COOKIE['botusername'])){
	$pagetitle = $_COOKIE['botusername'];
} else {
	$pagetitle = "IzayaBot";
}

if(isset($token_in_use)){
	if(isset($_GET['ty'])){
		$ty = $_GET['ty'];
	} else {
		$ty = "guildlist";
	}
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	} else {
		$id = null;
	}
	if(isset($_GET['gid'])){
		$gid = $_GET['gid'];
	} else {
		$gid = null;
	}
	if(isset($_GET['uid'])){
		$uid = $_GET['uid'];
	} else {
		$uid = null;
	}
	if(isset($_GET['cid'])){
		$cid = $_GET['cid'];
	} else {
		$cid = null;
	}
	if(isset($_GET['mid'])){
		$mid = $_GET['mid'];
	} else {
		$mid = null;
	}
	if(isset($_GET['spe'])){
		$spe = $_GET['spe'];
	} else {
		$spe = "Bot";
	}
	if(isset($_POST['content'])){
		$content = $_POST['content'];
	}
	if(isset($_COOKIE['buser'])){
		$buser = $_COOKIE['buser'];
	} else {
		$buser = null;
	}
	if(isset($_COOKIE['bid'])){
		$bid = $_COOKIE['bid'];
	} else {
		$bid = null;
	}
	if(isset($_COOKIE['bavatar'])){
		$bavatar = $_COOKIE['bavatar'];
	} else {
		$bavatar = null;
	}

	$headers = array('Authorization: ' . $tokentypeused . ' ' . $token_in_use,);

	function apirequest($requesturl, $postfieldarray, $requesttype, $headers){
		$baseurl = "https://discordapp.com/api";
		$url = "https://github.com/Kyuunex/IzayaBot";
		$versionNumber = "18.05.09";
		$useragent = "IzayaBot ($url, $versionNumber)";
		$ch = curl_init();
		$postfields = json_encode($postfieldarray);
		if($requesttype == 'GET'){
			/*
			curl_setopt($ch, CURLOPT_URL, $baseurl . $requesturl . "?" . http_build_query($postfieldarray));
			*/
		} elseif($requesttype == 'POST') {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requesttype);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		} elseif($requesttype == 'PATCH'){
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requesttype);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
			array_push($headers, "Content-Type: application/json");
		} elseif($requesttype == 'DELETE'){
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requesttype);
			array_push($headers, "Content-Type: application/json");
		}elseif($requesttype == 'PUT'){
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requesttype);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
			array_push($headers, "Content-Type: application/json");
		}

		curl_setopt($ch, CURLOPT_URL, $baseurl . $requesturl);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$corejson = curl_exec($ch);
		curl_close($ch);
		return json_decode($corejson, true);
	}

	if($ty == "messages"){
		// Gives us a list of messages located in the channel
		if(isset($_GET['lastm'])){
			$fetchedarray = apirequest("/channels/$cid/messages?limit=100&before=" . $_GET['lastm'], '', 'GET', $headers);
		} else {
			$fetchedarray = apirequest("/channels/$cid/messages?limit=100", '', 'GET', $headers);
		}
		include("izayabot_engine/messagelist.php");
	} elseif($ty == "connections"){
		$fetchedarray = apirequest("/users/@me/connections", '', 'GET', $headers);
	} elseif($ty == "channellist"){
		$fetchedarray = apirequest("/guilds/$gid/channels", '', 'GET', $headers);
		include("izayabot_engine/channellist.php"); 
		$extrabuttonarray = array(
			"&#9786; Member List" => "index.php?ty=guildmembers&gid=" . $gid,
			"&#9949; Ban List" => "index.php?ty=guildbanlist&gid=" . $gid,
			"&#x2744; Special Things" => "index.php?ty=guildspecialthings&gid=" . $gid,
		);
	} elseif($ty == "guildspecialthings"){
		include("izayabot_engine/guildspecialthings.php"); 
	} elseif($ty == "dmlist"){
		$fetchedarray = apirequest("/users/@me/channels", '', 'GET', $headers);
		$outputtohtml .= "<h2>Total: " . count($fetchedarray) . "</h2>";
		include("izayabot_engine/channellist.php"); 
	} elseif($ty == "msgedit"){
		$fetchedarray = apirequest("/channels/$cid/messages/$mid", '', 'GET', $headers);
		include("izayabot_engine/msgedit.php"); 
	} elseif($ty == "leaveguild"){
		$fetchedarray = apirequest("/users/@me/guilds/$gid", '', 'DELETE', $headers);
		$outputtohtml .= "done?";
	} elseif($ty == "guildmembers"){
		if(isset($_GET['lastuo'])){
			$fetchedarray = apirequest("/guilds/$gid/members?limit=500&after=" . $_GET['lastuo'], '', 'GET', $headers);
		} else {
			$fetchedarray = apirequest("/guilds/$gid/members?limit=500", '', 'GET', $headers);
		}
		$outputtohtml .= "<center><h1>There are the glorious members in this guild:</h1></center>";
		$outputtohtml .= "<h2>Total: " . count($fetchedarray) . "</h2><table>";
		foreach ($fetchedarray as $oneobject) {
			include("izayabot_engine/guildmemberobject.php"); 
		}
		$outputtohtml .= "</table>";
		$extrabuttonarray = array(
			"&#x2BC8; Next Page" => "index.php?ty=guildmembers&gid=" . $gid . "&lastuo=" . $oneobject['user']['id'],
		);
		$gobacklink = "index.php?ty=channellist&gid=" . $gid;
	} elseif($ty == "massnick"){
		$fetchedarray = apirequest("/guilds/$gid/members?limit=1000", '', 'GET', $headers);
		include("izayabot_engine/massnick.php");
	} elseif($ty == "massrole"){
		$fetchedarray = apirequest("/guilds/$gid/members?limit=1000", '', 'GET', $headers);
		include("izayabot_engine/massrole.php");
	} elseif($ty == "guildbanlist"){
		$fetchedarray = apirequest("/guilds/$gid/bans", '', 'GET', $headers);
		$outputtohtml .= "<center><h1>Guild ban list:</h1></center>";
		$outputtohtml .= "<h2>Total: " . count($fetchedarray) . "</h2><table>";
		foreach ($fetchedarray as $oneobject) {
			include("izayabot_engine/guildbanobject.php"); 
		}
		$outputtohtml .= "</table>";
		$gobacklink = "index.php?ty=channellist&gid=" . $gid;
	} elseif($ty == "msgdel"){
		$fetchedarray = apirequest("/channels/$cid/messages/$mid", '', 'DELETE', $headers);
		if(isset($fetchedarray['code'])){
			$outputtohtml .= "The bot has no permissions to delete messages";
		} else {
			$outputtohtml .= "Message was deleted, I think...
			<script language='javascript' type='text/javascript'>
			window.close();
			</script>";
		}
		$gobacklink = "index.php?ty=messages&cid=$cid";
	} elseif($ty == "unban"){
		$fetchedarray = apirequest("/guilds/$gid/bans/$uid", '', 'DELETE', $headers);
		if(isset($fetchedarray['code'])){
			$outputtohtml .= "The bot has no permissions to Unban";
		} else {
			$outputtohtml .= "User unbanned, I think...";
		}
		$gobacklink = "index.php?ty=guildbanlist&gid=$gid";
	} elseif($ty == "ban"){
		$banarray = array("reason" => "User was banned suing a bot client");
		$fetchedarray = apirequest("/guilds/$gid/bans/$uid", $banarray, 'PUT', $headers);
		if(isset($fetchedarray['code'])){
			$outputtohtml .= "The bot has no permissions to Ban";
		} else {
			$outputtohtml .= "The judgement has been bestowed upon this user! May he never bother you again";
		}
		$gobacklink = "index.php?ty=guildbanlist&gid=$gid";
		$rdump = 1;
	} elseif($ty == "editmessage"){
		// Edit a message in a channel
		$postarray = array(
			"content" => $content,
		);
		$fetchedarray = apirequest("/channels/$cid/messages/$mid", $postarray, 'PATCH', $headers);
		$gobacklink = "index.php?ty=messages&cid=$cid";
		$tablemarkup = true;
		include("izayabot_engine/messageobject.php");
	} elseif($ty == "changeusername"){
		// Changes username
		$newusername = $_GET['nv'];
		$postarray = array(
			"username" => $newusername,
		);
		$fetchedarray = apirequest("/users/@me", $postarray, 'PATCH', $headers);
		$rdump = true;
		$buser = $fetchedarray['username'] . "#" . $fetchedarray['discriminator'];
		setcookie('buser', $buser, time()+10000000);
		setcookie('botusername', $fetchedarray['username'], time()+10000000);
		setcookie('bid', $fetchedarray['id'], time()+10000000);
		setcookie('bavatar', $fetchedarray['avatar'], time()+10000000);
	} elseif($ty == "loggedin"){
		// Gets info about the bot
		$fetchedarray = apirequest("/users/@me", '', 'GET', $headers);

		setcookie('logintoken', $_POST['logintoken'], time()+10000000);
		setcookie('tokentype', $_POST['tokentype'], time()+10000000);
		$buser = $fetchedarray['username'] . "#" . $fetchedarray['discriminator'];
		setcookie('buser', $buser, time()+10000000);
		setcookie('botusername', $fetchedarray['username'], time()+10000000);
		setcookie('bid', $fetchedarray['id'], time()+10000000);
		setcookie('bavatar', $fetchedarray['avatar'], time()+10000000);
		$outputtohtml .= "You have logged in as: " . $buser;
		$outputtohtml .= "<br><a href='index.php?ty=guildlist'><button>&#10096; Get guild list</button></a>";
		$bidforadd = $fetchedarray['id'];
		$outputtohtml .= "<br>You may use <a target='_blank' href='" . sinvite($bidforadd, "1") . "'>this</a> link to add your bot to a server, or just copy the following and paste it into your address bar: <br><input type='text' onClick='this.select();' style='width: 100%' value='" . sinvite($bidforadd, "1") . "'></input><hr/>";
	} elseif($ty == "postmessage"){
		// Posts a message in a channel
		$postarray = array(
			"content" => $content,
//			"embed" => $embedobjectexample,
		);
		/*
		$embedobjectexample = array(
			"title" => "test title",
			"type" => "rich",
			"description" => "test description",
		);
		*/
		$fetchedarrayhidden = apirequest("/channels/$cid/messages", $postarray, 'POST', $headers);
//		$gobacklink = "index.php?ty=messages&cid=$cid";
		$tablemarkup = true;
		$fetchedarray = apirequest("/channels/$cid/messages?limit=100", '', 'GET', $headers);
		include("izayabot_engine/messagelist.php");
	} elseif($ty == "guildlist"){
		// Gets a list of guilds a bot is in
		$fetchedarray = apirequest("/users/@me/guilds", '', 'GET', $headers);
		$extrabuttonarray = array(
			"&#x2744; Special Things" => "index.php?ty=guildspecialthings",
			"&#x2744; DM list" => "index.php?ty=dmlist",
		);
		include("izayabot_engine/guildlist.php"); 
	}
	$rdump = true;
	if((isset($_GET['dump'])) OR (isset($rdump))){
		$outputtohtml .= "<hr><h1>Debug Mode</h1><textarea onClick='this.select();' style='width: 100%; height: 500px'>";
		$outputtohtml .= json_encode($fetchedarray, JSON_PRETTY_PRINT);
		$outputtohtml .= "</textarea>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>IzayaBot</title>
	<link rel="stylesheet" href="style.css" media="screen,projection,tv,handheld,print,speech">
	<link rel="stylesheet" href="style-layout.css" media="screen,projection,tv,handheld,print,speech">
	<meta name=viewport content="width=device-width, initial-scale=1">
</head>
<body>
<div class="main">
<a href="index.php"><h1><?=$pagetitle ?></h1></a>
<hr>
<?php
echo $outputtohtml;
?>
<hr>
<?php
if(isset($gobacklink)){
	echo "<a href=\"" . $gobacklink . "\"><button>&#10096; Go Back</button></a>";
}
if(isset($extrabuttonarray)){
	foreach ($extrabuttonarray as $b_text => $b_link){
		echo "<a href=\"" . $b_link . "\"><button>$b_text</button></a>";
	}
} 
if(isset($token_in_use)){
	echo "<a href=\"index.php?logout\"><button>&#9919; Logout</button></a><br>";
	echo "Logged in as: " . $buser;
	echo "<br>";
}
?>
<a target="_blank" href="https://github.com/Kyuunex/IzayaBot">IzayaBot on GitHub</a>
</div>
</body>
</html>
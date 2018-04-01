<?php
$outputtohtml = "";

include("izayabot_engine/versions.php");

$baseurl = "https://discordapp.com/api";
$avatarbaseurl = "https://cdn.discordapp.com/avatars";
$iconbaseurl = "https://cdn.discordapp.com/icons";

function imgme($wimg, $whi, $uw){
	if($uw == 1){
		return "<img style='max-height: " . $whi . "px;' src='$wimg' />";
	} else {
		return "<img src='$wimg' />";
	}
}

function sinvite($guildid, $wannapremissions){
	return "https://discordapp.com/oauth2/authorize?client_id=" . $guildid . "&scope=bot&permissions=" . $wannapremissions;
}

if(isset($_GET['logout'])) {
	setcookie('logintoken', '', time()-10000000);
	setcookie('buser', '', time()-10000000);
	setcookie('bid', '', time()-10000000);
	setcookie('bavatar', '', time()-10000000);
	$outputtohtml .= "You have logged out.<hr>";
	include("izayabot_engine/loginpage.php");
} elseif(isset($_POST['logintoken'])) {
	$token_in_use = $_POST['logintoken'];
	$ty = "loggedin";
} elseif(isset($_COOKIE['logintoken'])){
	$token_in_use = $_COOKIE['logintoken'];
} else {
	include("izayabot_engine/loginpage.php");
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

	$headers = array('Authorization: Bot ' . $token_in_use,);

	$ch = curl_init();
	if($ty == "channellist"){
		// Gives us a list of channels in the server
		$request = "/guilds/$gid/channels"; 
		$extrabuttonarray = array(
			"&#9786; Member List" => "index.php?ty=guildmembers&gid=" . $gid,
			"&#9949; Ban List" => "index.php?ty=guildbanlist&gid=" . $gid,
			"&#x2744; Special Things" => "index.php?ty=guildspecialthings&gid=" . $gid,
		);
	} elseif($ty == "dmlist"){
		// Gives us a list of current bot DM channels
		$request = "/users/@me/channels"; 
	} elseif($ty == "connections"){
		$request = "/users/@me/connections"; 
		$rdump = true;
	} elseif($ty == "guildmembers"){
		if(isset($_GET['lastuo'])){
			$request = "/guilds/$gid/members?limit=10&after=" . $_GET['lastuo']; 
		} else {
			$request = "/guilds/$gid/members?limit=10";
		}
	} elseif($ty == "massnick"){
		$request = "/guilds/$gid/members?limit=1000";
	} elseif($ty == "guildbanlist"){
		$request = "/guilds/$gid/bans"; 
	} elseif($ty == "messages"){
		// Gives us a list of messages located in the channel
		if(isset($_GET['lastm'])){
			$request = "/channels/$cid/messages?limit=100&before=" . $_GET['lastm']; 
		} else {
			$request = "/channels/$cid/messages?limit=100"; 
		}
	} elseif($ty == "guildlist"){
		// Gets a list of guilds a bot is in
		$request = "/users/@me/guilds";
		$extrabuttonarray = array(
			"&#x2744; Special Things" => "index.php?ty=guildspecialthings",
		);
	} elseif($ty == "changeusername"){
		// Changes username
		$request = "/users/@me";
		$newusername = $_GET['nv'];
		$postarray = array(
			"username" => $newusername,
		);
		$post = json_encode($postarray);
		array_push($headers, "Content-Type: application/json");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	} elseif($ty == "loggedin"){
		// Gets info about the bot
		$request = "/users/@me";
	} elseif($ty == "msgedit"){
		// Returns that one message for editing
		$request = "/channels/$cid/messages/$mid";
	} elseif($ty == "msgdel"){
		// delete message
		$request = "/channels/$cid/messages/$mid";
		array_push($headers, "Content-Type: application/json");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
	} elseif($ty == "postmessage"){
		// Posts a message in a channel
		$request = "/channels/$cid/messages";
		$post = ['content' => $content,
				];
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	} elseif($ty == "editmessage"){
		// Edit a message in a channel
		$request = "/channels/$cid/messages/$mid";
		$postarray = array(
			"content" => $content,
		);
		$post = json_encode($postarray);
		array_push($headers, "Content-Type: application/json");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	} 
	if(isset($request)){
		curl_setopt($ch, CURLOPT_URL, $baseurl . $request);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
		curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$corejson = curl_exec($ch);
		curl_close($ch);
		$fetchedarray = json_decode($corejson, true);
	}

	if($ty == "messages"){
		include("izayabot_engine/messagelist.php");
	} elseif($ty == "channellist"){
		include("izayabot_engine/channellist.php"); 
	} elseif($ty == "guildspecialthings"){
		include("izayabot_engine/guildspecialthings.php"); 
	} elseif($ty == "dmlist"){
		include("izayabot_engine/channellist.php"); 
	} elseif($ty == "msgedit"){
		include("izayabot_engine/msgedit.php"); 
	} elseif($ty == "guildmembers"){
		$outputtohtml .= "<center><h1>There are the glorious members in this guild:</h1></center><table>";
		foreach ($fetchedarray as $oneobject) {
			include("izayabot_engine/guildmemberobject.php"); 
		}
		$outputtohtml .= "</table>";
		$extrabuttonarray = array(
			"&#x2BC8; Next Page" => "index.php?ty=guildmembers&gid=" . $gid . "&lastuo=" . $oneobject['user']['id'],
		);
		$gobacklink = "index.php?ty=channellist&gid=" . $gid;
	} elseif($ty == "massnick"){
		include("izayabot_engine/massnick.php");
	} elseif($ty == "guildbanlist"){
		$outputtohtml .= "<center><h1>Guild ban list:</h1></center><table>";
		foreach ($fetchedarray as $oneobject) {
			include("izayabot_engine/guildbanobject.php"); 
		}
		$outputtohtml .= "</table>";
		$gobacklink = "index.php?ty=channellist&gid=" . $gid;
	} elseif($ty == "msgdel"){
		if(isset($fetchedarray['code'])){
			$outputtohtml .= "The bot has no permissions to delete messages";
		} else {
			$outputtohtml .= "Message was deleted, I think...";
		}
		$gobacklink = "index.php?ty=messages&cid=$cid";
	} elseif($ty == "editmessage"){ 
		$gobacklink = "index.php?ty=messages&cid=$cid";
		$tablemarkup = true;
		include("izayabot_engine/messageobject.php");
	} elseif($ty == "changeusername"){
		$rdump = true;
		$buser = $fetchedarray['username'] . "#" . $fetchedarray['discriminator'];
		setcookie('buser', $buser, time()+10000000);
		setcookie('bid', $fetchedarray['id'], time()+10000000);
		setcookie('bavatar', $fetchedarray['avatar'], time()+10000000);
	} elseif($ty == "loggedin"){
		setcookie('logintoken', $_POST['logintoken'], time()+10000000);
		$buser = $fetchedarray['username'] . "#" . $fetchedarray['discriminator'];
		setcookie('buser', $buser, time()+10000000);
		setcookie('bid', $fetchedarray['id'], time()+10000000);
		setcookie('bavatar', $fetchedarray['avatar'], time()+10000000);
		$outputtohtml .= "You have logged in as: " . $buser;
		$outputtohtml .= "<br><a href='index.php?ty=guildlist'><button>&#10096; Get guild list</button></a>";
		$bidforadd = $fetchedarray['id'];
		$outputtohtml .= "<br>You may use <a target='_blank' href='" . sinvite($bidforadd, "1") . "'>this</a> link to add your bot to a server, or just copy the following and paste it into your address bar: <br><input type='text' onClick='this.select();' style='width: 100%' value='" . sinvite($bidforadd, "1") . "'></input><hr/>";
	} elseif($ty == "postmessage"){ 
		$gobacklink = "index.php?ty=messages&cid=$cid";
		$tablemarkup = true;
		include("izayabot_engine/messageobject.php");
	} elseif($ty == "guildlist"){
		include("izayabot_engine/guildlist.php"); 
	}
	//$rdump = true;
	if((isset($_GET['dump'])) OR (isset($rdump))){
		$outputtohtml .= "<hr><h1>Debug Mode</h1><pre>";
		$outputtohtml .= var_export($fetchedarray, true);
		$outputtohtml .= "</pre>";
		$outputtohtml .= "<hr><h1>JSON</h1><pre>";
		$outputtohtml .= $corejson;
		$outputtohtml .= "</pre>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>IzayaBot</title>
	<link rel="stylesheet" href="style.css" media="screen,projection,tv,handheld,print,speech">
	<link rel="stylesheet" href="style-layout.css" media="screen,projection,tv,handheld,print,speech">
</head>
<body>
<div class="main">
<a href="index.php"><h1>IzayaBot</h1></a>
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
IzayaBot (<?=$versionNumber; ?>) by <a href="https://github.com/Kyuunex">Kyuunex</a>
</div>
</body>
</html>
<?php
$outputtohtml = "";

include("izayabot_engine/versions.php");

$baseurl = "https://discordapp.com/api";
$avatarbaseurl = "https://cdn.discordapp.com/avatars";

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
	if(isset($_GET['cid'])){
		$cid = $_GET['cid'];
	} else {
		$cid = null;
	}
	if(isset($_POST['content'])){
		$content = $_POST['content'];
	}
	if(isset($_COOKIE['buser'])){
		$buser = $_COOKIE['buser'];
	} else {
		$id = null;
	}
	if(isset($_COOKIE['bid'])){
		$bid = $_COOKIE['bid'];
	} else {
		$id = null;
	}
	if(isset($_COOKIE['bavatar'])){
		$bavatar = $_COOKIE['bavatar'];
	} else {
		$id = null;
	}

	$headers = array('Authorization: Bot ' . $token_in_use,);

	$ch = curl_init();
	if($ty == "channellist"){
		// Gives us a list of channels in the server
		$request = "/guilds/$id/channels"; 
	} elseif($ty == "messages"){
		// Gives us a list of messages located in the channel
		$request = "/channels/$id/messages?limit=100"; 
	} elseif($ty == "dump"){
		// debug puropses
		$request = "/channels/$id/messages?limit=100";
	} elseif($ty == "guildlist"){
		// Gets a list of guilds a bot is in
		$request = "/users/@me/guilds";
	} elseif($ty == "loggedin"){
		// Gets info about the bot
		$request = "/users/@me";
	} elseif($ty == "postmessage"){
		// Posts a message in a channel
		$request = "/channels/$id/messages";
		$post = ['content' => $content,
				];
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	} elseif($ty == "editmessage"){
		// Edit a message in a channel PATCH
		$request = "/channels/$cid/messages/$id";
		$post = "{'content': '$content'}";
		array_push($headers, "Content-Type: application/json");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		
		// this does not work.
	} 
	if(isset($request)){
		curl_setopt($ch, CURLOPT_URL, $baseurl . $request);
		//curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1/izayabot/debug.json");
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
	} elseif($ty == "msgedit"){
		include("izayabot_engine/msgedit.php"); 
	} elseif($ty == "editmessage"){ 
		$gobacklink = "index.php?ty=messages&id=$cid";
		$outputtohtml .= "<pre>";
		$outputtohtml .= var_export($fetchedarray, true);
		$outputtohtml .= "</pre>";
		//var_dump($_GET);
		//var_dump($_POST);
		// this does not work.
	} elseif($ty == "dump"){
		$outputtohtml .= "<pre>";
		$outputtohtml .= var_export($fetchedarray, true);
		$outputtohtml .= "</pre>";
	} elseif($ty == "loggedin"){
		setcookie('logintoken', $_POST['logintoken'], time()+10000000);
		$buser = $fetchedarray['username'] . "#" . $fetchedarray['discriminator'];
		setcookie('buser', $buser, time()+10000000);
		setcookie('bid', $fetchedarray['id'], time()+10000000);
		setcookie('bavatar', $fetchedarray['avatar'], time()+10000000);
		$outputtohtml .= "You have logged in as: " . $buser;
		$outputtohtml .= "<br><a href='index.php?ty=guildlist'><button>&#10096; Get guild list</button></a>";
		$outputtohtml .= "<hr><pre>";
		$outputtohtml .= var_export($fetchedarray, true);
		$outputtohtml .= "</pre>";
	} elseif($ty == "postmessage"){ 
		$gobacklink = "index.php?ty=messages&id=$id";
		$outputtohtml .= "<pre>";
		$outputtohtml .= var_export($fetchedarray, true);
		$outputtohtml .= "</pre>";
	} elseif($ty == "guildlist"){
		include("izayabot_engine/guildlist.php"); 
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>IzayaBot</title>
	<link rel="stylesheet" href="style.css" media="screen,projection,tv,handheld,print,speech">
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
if(isset($token_in_use)){
	echo "<a href=\"index.php?logout\"><button>&#9919; Logout</button></a><br>";
	echo "Logged in as: " . $buser;
	echo "<br>";
}
?>
IzayaBot by <a href="https://github.com/Kyuunex">Kyuunex</a>
</div>
</body>
</html>
<html>
<head>
	<title>IzayaBot</title>
	<!--link rel="stylesheet" href="style.css" media="screen,projection,tv,handheld,print,speech" /-->
	<style>
		/*@import url(style-table.css);*/

	html {
		font: 13px/22px Tahoma, Geneva, sans-serif;
	}

	body {
		background-color: #FFCCFF;
		color: #525c66;
	}

	.main {
		background: #FFFFFF;
		color: #111111;
		max-width: 900px;
		align: center;
		margin: 25px auto 10px auto;
		padding: 40px;
		border-width: 20px;
		word-wrap: break-word;
		overflow:hidden;
	}

	h9 {
		text-align: right;
	}

	#wslogo{
		align: center;
	}

	#rbtn {
		max-width: 360px;
	}

	a {
		color: #0082d9; 
		border-bottom: 1px solid rgba(0,130,217,0.2);
		text-decoration: none;
	}

	a:hover {
		color: #008ae5;
		border-color: rgba(0,130,217,0.5);
	}

	h1 {
		margin: 0 0 0.1em 0;
		line-height: 1;
		font-size: 1.8em;
		color: #0082d9; 
		text-shadow: 0 1px rgba(255,255,255,0.5);
	}

	h2 {
		font-size: 1.2em;
	/*	margin: 0 0 0.4em 0;*/
		text-shadow: 0 1px rgba(255,255,255,0.5);
	}

	input {
		vertical-align: middle;
		/*box-sizing: border-box; */
	}

	.pp1 {
		float: left;
		width: 220px;
	}

	.pdet {
		float: left;
		/*min-height: 200px;*/
		overflow:hidden;
	}

	.footer {
		clear: all;
	}



	table {
	/*  width: 100%;*/
	  margin: 0 0 15px 0;
	  border-collapse: collapse;
	}

	tr {
	  border-bottom: 1px solid rgba(0,0,0,0.1);
	}

	tr:nth-child(even) {
	  background-color: rgba(0,0,0,0.03);  
	}

	td {
	  padding: 0.2em 1em 0.2em 6;
	  color: #666;
	 vertical-align: top; 
	 
		word-wrap: break-word;
	}

	th {
	  text-align: left;
	/*  width: 230px;*/
	  font-weight: inherit;
	  color: #999;
	  padding: 4px 6px 4px 0;
	  vertical-align: top;
	  border-bottom: 1px solid #ccc;
	}
	</style>
</head>
<body>
<div class="main">
<a href="index.php"><h1>IzayaBot</h1></a>
<hr>
<form action='index.php' method='GET'>
<center>
<table border='0'>
<tr>
<td>Action:</td>
<td><select name='ty'>
<option value='guildlist'>guildlist</option>
<option value='channellist'>channellist</option>
<option value='messages'>messages</option>
<option value='postmessage' <?php if(isset($_GET['id'])){ if($_GET['ty'] == "messages"){ echo "selected"; } } ?>>postmessage</option>
<option value='dump'>dump</option>
</select></td>
</tr><tr>
<td>Id:</td><td><input name='id' type='text' value='<?php if(isset($_GET['id'])){ if($_GET['ty'] == "messages"){ echo $_GET['id']; } } ?>'></input></td>
</tr><tr>
<td>Content:</td><td><textarea name="content"></textarea></td>
</tr><tr>
<td>&nbsp;</td><td><input type="submit" value="Do"></td>
</tr>
</table>
</center>
</form>

<?php
include "config.php";

$url = "https://github.com/kyuunex/IzayaBot";
$versionNumber = "0.0.0.1a";
$useragent = "IzayaBot ($url, $versionNumber)";

$baseurl = "https://discordapp.com/api";
$headers = array('Authorization: Bot ' . $bottoken,);

if(isset($_GET['id'])){
	$ty = $_GET['ty'];
	$id = $_GET['id'];
	$content = $_GET['content'];
	
	
	$ch = curl_init();
	if($_GET['ty'] == "channellist"){
		$request = "/guilds/$id/channels"; 
	} elseif($_GET['ty'] == "messages"){
		$request = "/channels/$id/messages?limit=100"; 
	} elseif($_GET['ty'] == "guildlist"){
		$request = "/users/@me/guilds";
	} elseif($_GET['ty'] == "dump"){
		$request = "/channels/$id/messages?limit=100";
	} elseif($_GET['ty'] == "postmessage"){
		$request = "/channels/$id/messages";
		$post = [	'content' => $content,
				];
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	} 

	curl_setopt($ch, CURLOPT_URL, $baseurl . $request);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$corejson = curl_exec($ch);
	curl_close($ch);

	$fetchedarray = json_decode($corejson, true);
	
	echo "<hr>";
	
	if($ty == "messages"){
		echo "Channel id: " . $id;
		echo "<hr><center><table border='0'>";
		foreach ($fetchedarray as $onemessage) {
			echo "<tr><td>";
//			echo $onemessage['timestamp'];
//			echo "</td><td>";
			echo $onemessage['author']['username'];
			echo "#";
			echo $onemessage['author']['discriminator'];
			echo "</td><td>";
			echo $onemessage['content'];
			if(isset($onemessage['attachments']['0']['url'])){
				echo "<br><a href='";
				echo $onemessage['attachments']['0']['url'];
				echo "'>";
				echo $onemessage['attachments']['0']['filename'];
				echo "</a>";
			}
			echo "</td></tr>";
		}
		echo "</table></center>";
	} elseif($ty == "guildlist") { 
		echo "<center><table border='0'>";
		foreach ($fetchedarray as $onemessage) {
			echo "<tr><td><a href='index.php?ty=channellist&id=" . $onemessage['id'] . "&content='>";
			echo $onemessage['name'];
			echo "</a></td><td>";
			echo $onemessage['id'];
			echo "</td></tr>";
		}
		echo "</table></center>";
	} elseif($ty == "channellist") { 
		echo "<center><table border='0'>";
		foreach ($fetchedarray as $onemessage) {
			echo "<tr><td><a href='index.php?ty=messages&id=" . $onemessage['id'] . "&content='>";
			echo $onemessage['name'];
			echo "</a></td><td>";
			echo $onemessage['id'];
			echo "</td></tr>";
		}
		echo "</table></center>";
	} elseif($ty == "postmessage") { 
		echo "<a href='index.php?ty=messages&id=$id&content='>Go Back</a><br>";
		echo "<pre>";
		echo var_dump($fetchedarray);
		echo "</pre>";
	} elseif($ty == "dump") { 
		echo "<pre>";
		echo var_dump($fetchedarray);
		echo "</pre>";
	}
}

?>
<hr>
IzayaBot by <a href="https://github.com/Kyuunex">Kyuunex</a>

</div>
</body>
</html>
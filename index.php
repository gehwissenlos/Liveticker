<!doctype html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Liveticker</title>
	<meta name="description" content="Liveticker hilft dir bei Sport, Konferenzen und Co deine Fans schnell zu informieren, egal ob daheim oder unterwegs auf iPhone, Smartphone und Tablet">
	<meta name="author" content="Manuel Altherr">
	<meta property="og:image" content="img/liveticker.png"/>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="style.css">
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="icon" href="http://www.juniorenauswahl.de/wp-content/themes/sgm.sport/sgmicon.png" type="image/png" />
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-30088607-2']);
	  _gaq.push(['_gat._anonymizeIp']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</head>
<body>
<div id="header"><b>Live</b>ticker <small>beta</small></div>
<div id="main">
<?php
include ('functions.php');

$name = trim(strip_tags($_POST['name']));
$send = $_POST['send'];
$id;
$password;

if ($send == "true") {
	if (strlen($name) >= 7 AND strlen($name) <= 100) {
		$password = createPassword();
		include ('dbconnect.php');
		$eintrag = $db->query("INSERT INTO lt_event (password, name) VALUES ('".$db->real_escape_string($password)."', '".$db->real_escape_string($name)."')");
		$id = $db->insert_id;
		$db->close();
		$id = base36_encode($id);
	} else {
		$send = false;
		echo "Name must be between 7 and 100 characters";		
	}
}

?>
<form name="createTicker" action="" method="post">
<input type="hidden" name="send" value="true" />
<input name="name" title="event name" id="name" type="text" placeholder="Name des Livetickers" value="<?php echo $name; ?>" maxlength="100" <?php if ($send == "true") {echo "readonly";} ?> /><br />
<?php
if ($send == "true") {
?>
	<input name="id" id="eventid" title="Ticker-ID" type="text" value="<?php echo $id; ?>" readonly /><br />
	<input name="password" id="password" title="Passwort" type="text" value="<?php echo $password; ?>" readonly /><br />
<?php
} else {
?>
	<input type="submit" name="" id="button" value="erstellen" />
<?php
}
?>
</form>

<?php
if ($send == "true") {
echo "Liveticker aufrufen: <a href='http://live.juniorenauswahl.de/".$id."' />http://live.juniorenauswahl.de/".$id."</a>";
echo "<br />";
echo "Liveticker editieren: <a href='http://live.juniorenauswahl.de/edit/".$id."' />http://live.juniorenauswahl.de/edit/".$id."</a>";
}
?>
</div>
<div id="footer"><a href="http://live.juniorenauswahl.de" target="_blank" alt="Liveticker" title="Liveticker"><b>Live</b>ticker</a> | <a href="http://live.juniorenauswahl.de/impressum.htm" target="_blank" alt="Impressum zum Liveticker" title="Impressum zum Liveticker">Impressum</a> | <a href="http://live.juniorenauswahl.de/faq.htm" target="_blank" alt="FAQ zum Liveticker" title="FAQ zum Liveticker">FAQ</a> | <a href="https://www.facebook.com/pages/Liveticker/457446247599647" target="_blank" alt="Liveticker auf Facebook" title="Liveticker auf Facebook"><img src="img/facebook.png" style="margin-bottom:-0.188em;" /></a> | <a href="http://www.altherr.me" target="_blank" alt="powered by Webagentur Altherr" title="powered by Webagentur Altherr">&copy; altherr.me</a></div>
</body>
</html>
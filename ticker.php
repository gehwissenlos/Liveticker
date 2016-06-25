<!doctype html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="description" content="Liveticker hilft dir bei Sport, Konferenzen und Co deine Fans schnell zu informieren, egal ob daheim oder unterwegs auf iPhone, Smartphone und Tablet">
	<meta name="author" content="Manuel Altherr">
	<meta property="og:image" content="img/liveticker.png"/>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="tstyle.css">
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="icon" href="http://www.juniorenauswahl.de/wp-content/themes/sgm.sport/sgmicon.png" type="image/png" />
	<script type="text/javascript" >
	interval = window.setInterval("fetch('<?php echo htmlentities($_GET['id'],ENT_QUOTES,"UTF-8"); ?>');", 120000); //alle 120 Sekunden aktualisieren
	
	//AJAX
	function getXMLHTTP() {
	  var result = false;
	  if( typeof XMLHttpRequest != "undefined" ) {
		result = new XMLHttpRequest();
	  } else {
		try {
			result = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				result = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (ie) {}
		}
	  }
	  if (typeof netscape != 'undefined' && typeof netscape.security !=
		  'undefined') {
		  try {
			  netscape.security.PrivilegeManager.enablePrivilege('UniversalBrowserRead');
		  }
		  catch (e) {
		  }
	  }
		return result;
	}
	 
	//Fetch entries of the shoutbox
	function fetch(id){
		var timestamp = new Date().getTime();
		xmlget = getXMLHTTP();
		//xmlget.overrideMimeType('text/xml; charset=ISO-8859-1');
		xmlget.open("POST", "entry.php");
		
		//create params for POST
		var params = "id="+id+"&action=read";

		//Send the proper header information along with the request
		xmlget.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		xmlget.onreadystatechange = function(){
			if ( xmlget.readyState == 4 && xmlget.responseText) {
					if( document.getElementById("liveticker").innerHTML != xmlget.responseText){
						document.getElementById("liveticker").innerHTML = xmlget.responseText;
					}
			}
		}
		xmlget.send(params);
		return true;
	}
	</script>
	<?php
	include ('dbconnect.php');
	include ('functions.php');
	$event;

	$id = htmlentities($_GET['id'],ENT_QUOTES,"UTF-8");
	$eventid = base36_decode($id);

	$ergebnis = $db->query("SELECT name FROM lt_event WHERE id = '".$eventid."'");
	if ($ergebnis->num_rows != '1') {
		echo "<title>Liveticker</title>";
	} else {
		while($row = $ergebnis->fetch_object()){
			$event = $row->name;
			echo "<title>".$event." | Liveticker</title>\r\n";
		}
	}
	$ergebnis->close();
	$db->close();	
	?>
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
<body onload="fetch('<?php echo htmlentities($_GET['id'],ENT_QUOTES,"UTF-8"); ?>')">
<?php
if (!isset($event)) {
	echo "No ticker found!";
} else {
	echo "<b>".$event."</b>";
	
	echo "<div id=\"liveticker\"><p>"; //Erstes <p> wird durch explode entfernt
	$data = "id=".$id."&action=read";
	$ajaxdata = PostToHost(
					  "live.juniorenauswahl.de",
					  "/entry.php",
					  "http://live.juniorenauswahl.de/entry.php",
					  $data
	);
	$ajaxdata = explode('<p>',$ajaxdata,2);
	echo $ajaxdata[1];
	echo "</div>";
}
?>
<div id="footer"><a href="http://live.juniorenauswahl.de" target="_blank" alt="Liveticker" title="Liveticker"><b>Live</b>ticker</a> | <a href="http://live.juniorenauswahl.de/faq.htm" target="_blank" alt="FAQ zum Liveticker" title="FAQ zum Liveticker">FAQ</a> | <a href="https://www.facebook.com/pages/Liveticker/457446247599647" target="_blank" alt="Liveticker auf Facebook" title="Liveticker auf Facebook"><img style="margin-bottom:-0.188em;" src="img/facebook_black.png" /></a> | <a href="http://www.altherr.me" target="_blank" alt="powered by Webagentur Altherr" title="powered by Webagentur Altherr">&copy; altherr.me</a></div>
</body>
</html>
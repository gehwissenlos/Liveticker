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
	<link rel="stylesheet" href="../style.css">
	<link rel="icon" href="http://www.juniorenauswahl.de/wp-content/themes/sgm.sport/sgmicon.png" type="image/png" />
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
	
	<script type="text/javascript" >
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
	//Shout something
	function shout(){
		document.getElementById("ajax_butt").value = "Sende...";
		document.getElementById("ajax_butt").disabled = true; 
		var timestamp = new Date().getTime();
		xmlget = getXMLHTTP();
		// 	xmlget.overrideMimeType('text/xml; charset=ISO-8859-1');   //Funktioniert nur im Mozilla, ist hier auch nicht nötig
		xmlget.open("POST", "../entry.php");
		
		//create params for POST
		var params = "action=write&id="+escape(document.getElementById("eventid").value)+"&password="+escape(document.getElementById("password").value)+"&message="+escape(document.getElementById("message").value);

		//Send the proper header information along with the request
		xmlget.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		xmlget.onreadystatechange = function(){
			if ( xmlget.readyState == 4 ) {
					document.getElementById("ajax_butt").value = "Senden";
					document.getElementById("ajax_butt").disabled = false;
					document.getElementById("message").value = "";
					document.getElementById("response").innerHTML = xmlget.responseText;
					document.getElementById("response").style.display = "block";
					setTimeout("document.getElementById(\"response\").innerHTML = \"&nbsp;\";", 5000); 
			}
		}
		xmlget.send(params);
		return true;
	} 
	</script>
</head>
<body>
<div id="header"><b>Live</b>ticker <small>beta</small></div>
<div id="main">
	<input type="text" maxlength="10" size="10" id="eventid" placeholder="Ticker-ID" value="<?php echo htmlentities($_GET[id],ENT_QUOTES,"UTF-8"); ?>">
	<input type="text" maxlength="10" size="10" id="password" placeholder="Passwort" value=""><br />
	<textarea id="message" cols="40" rows="10" maxlength="1000" placeholder="Nachricht" value=""></textarea><br />
    <div id="loading"></div><input type="button" id="ajax_butt" value="Senden" onClick="shout();"><div id="response">&nbsp;</div>
</div>
<div id="footer"><a href="http://live.juniorenauswahl.de" target="_blank" alt="Liveticker" title="Liveticker"><b>Live</b>ticker</a> | <a href="http://live.juniorenauswahl.de/impressum.htm" target="_blank" alt="Impressum zum Liveticker" title="Impressum zum Liveticker">Impressum</a> | <a href="http://live.juniorenauswahl.de/faq.htm" target="_blank" alt="FAQ zum Liveticker" title="FAQ zum Liveticker">FAQ</a> | <a href="https://www.facebook.com/pages/Liveticker/457446247599647" target="_blank" alt="Liveticker auf Facebook" title="Liveticker auf Facebook"><img src="../img/facebook.png" style="margin-bottom:-0.188em;" /></a> | <a href="http://www.altherr.me" target="_blank" alt="powered by Webagentur Altherr" title="powered by Webagentur Altherr">&copy; altherr.me</a></div>
</body>
</html>
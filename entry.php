<?php
include('dbconnect.php');
include('functions.php');

$action = htmlentities($_POST['action'],ENT_QUOTES,"UTF-8");

//Lesen aus der Datenbank
if ($action == "read") {
	$id = htmlentities($_POST['id'],ENT_QUOTES,"UTF-8");
	$eventid = base36_decode($id);

	$ergebnis = $db->query("SELECT time, text FROM lt_entry WHERE id = '".$eventid."' ORDER BY time DESC");
	if ($ergebnis->num_rows <= '0') {
		die("Keine Nachrichten gefunden!");
	} else {
		while($row = $ergebnis->fetch_object()){
			echo "<p><b>";
			//Datum und Uhrzeit umformen
			$tdate = utf8_encode($row->time);
			$datearray = explode(" ", $tdate); //trennt in Datum und Uhrzeit
			if($datearray[0] != date("Y-m-d")) {
				$datearray[0] = str_replace("-", ".", $datearray[0]);
				$datearray2 = explode(".", $datearray[0]); //trennt Datum in Jahr, Monat, Tag
				if ($datearray2[0] == date("Y")) {
						echo $datearray2[2].".".$datearray2[1].".";
				} else {
					echo $datearray2[2].".".$datearray2[1].".".$datearray2[0];
				}
			}
			echo " ".$datearray[1]."</b> ";
			echo utf8_encode($row->text);
			echo "</p>";
		}
	}
	$ergebnis->close();
	$db->close();

//Schreiben in die Datenbank
} else if ($action == "write") {
	$id = htmlentities($_POST['id'],ENT_QUOTES,"UTF-8");
	$eventid = base36_decode($id);
	$password = htmlentities($_POST['password'],ENT_QUOTES,"UTF-8");
	$message = $_POST['message'];
	
	if($message != '') {
		$password_db;
		$message = trim(strip_tags($message));
		$ergebnis = $db->query("SELECT password FROM lt_event WHERE id = '".$eventid."'");
		if ($ergebnis->num_rows != '1') {
			echo "Kein Ticker gefunden! ";
		} else {
			while($row = $ergebnis->fetch_object()){
				$password_db = $row->password;
			}
			
			if ($password == $password_db) {
			$eintrag = $db->query("INSERT INTO lt_entry (id, text) VALUES ('".$db->real_escape_string($eventid)."', '".$db->real_escape_string($message)."')");
			$ergebnis->close();
			echo "Nachricht gespeichert!";
			} else {
				echo "Das Passwort ist falsch! ";
			}
		}
		$ergebnis->close();
		$db->close();
	
	} else {
		echo "Keine Nachricht eingetragen! ";
	}
	
	

}
?>
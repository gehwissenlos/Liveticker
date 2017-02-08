# Liveticker

### Introduction
Liveticker ist ein auf PHP und MySQL basierender Liveticker, welchen ich vor Jahren für ein Fußballturnier geschrieben habe.

### Installation
1. PHP-Dateien auf Server packen
2. Datenbank-Zugangsdaten in der dbconnect.php anpassen
3. Datenbank anlegen (s.u.)
4. htaccess.txt in .htaccess umbenennen

### Datenbank
Es werden 2 Tabellen benötigt.

#### lt_event
	id	int(250)
	password	text
    name	char(100)
    
#### lt_entry
	id	int(250)
	time	timestamp		on update CURRENT_TIMESTAMP
	text	varchar(1000)
	
### Anmerkung
Dieser Liveticker ist recht einfach gestaltet. Wer einen Liveticker machen möchte, welcher in Echtzeit die Nachrichten an die Leser schickt, dem würde ich heute Node.js und socket.io empfehlen.

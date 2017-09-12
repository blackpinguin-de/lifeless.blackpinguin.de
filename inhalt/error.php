<?php

//	1	season abgelaufen
//	2	passwort falsch oder gesperrt
//	3	user existiert nicht

if($loginerror!=0)
	{
	echo "\n<table width=\"100%\">";
	echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"100%\"><font color=\"$colortextdunkel\">";
	echo "\n<a href=\"index.php?mode=login\">Login</a>";
	echo "\n</font>";
	echo "\n</td></tr></table><br>";

	if($loginerror==1) //season abgelaufen
		{
		echo "\n<font size=\"6\">Hinweis</font>";
		echo "\n<br>Sie wurden Ausgeloggt.<br>Dies hat folgenden Grund:<br><br>";
		echo "Auf ihrem Benutzeraccount ist innerhalb der<br>letzten 15 Minuten keine Aktion erfolgt.<br>Bitte loggen sie sich erneut ein.";
		echo "\n<br><br><a href=\"index.php?mode=login\">einloggen?</a><br>";
		}
	if($loginerror==2) // passwort falsch oder gesperrt
		{
		echo "\n<font size=\"6\">Fehler</font>";
		echo "\n<br>Sie konnten nicht eingeloggt werden.<br>Dies kann einen der Folgenden Gr&uuml;nde haben:<br><br>Sie haben ihr Passwort falsch geschrieben<br>Ihr Benutzeraccount wurde gesperrt<br>";
		echo "\n<br><br><a href=\"index.php?mode=login\">einloggen?</a><br>";
		}

	if($loginerror==3) //user existiert nicht
		{
		echo "\n<font size=\"6\">Fehler</font>";
		echo "\n<br>Sie konnten nicht eingeloggt werden.<br>Dies hat folgenden Grund:<br><br>";
		echo "\nDer angegebene Benutzer konnte nicht gefunden werden.<br>Achten sie auf die korrekte schreibweise und probieren sie es erneut.";
		echo "\n<br><br><a href=\"index.php?mode=login\">einloggen?</a> <a href=\"index.php?mode=register\">registrieren?</a><br>";
		}	
	}




mysql_close($sqlconnection);
?>
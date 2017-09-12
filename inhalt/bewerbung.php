<?php
/*
0 Druide
1 Hexenmeister
2 JÃ¤ger
3 Krieger
4 Magier
5 Paladin
6 Priester
7 Schamane
8 Schurke
*/


echo "\n<table width=\"100%\">";
echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"100%\"><font color=\"$colortextdunkel\">";
if($seasonid=="")
	{
	echo "\n<a href=\"index.php?mode=bewerbung\">Bewerben</a>";
	}
else
	{
	echo "\n<a href=\"index.php?mode=bewerbung&amp;season=$seasonid\">Bewerben</a>";
	}
echo "\n</font>";

echo "\n</td></tr></table><br>";




$fakename = post('p_name');
$fakeemail = post('p_email');
$fakegebd = post('p_geb_d');
$fakegebm = post('p_geb_m');
$fakegeby = post('p_geb_y');
$fakeraidexp = post('p_raidexpierience');
$fakekritik = post('p_kritik');



if($fakename == "" || $fakeemail == "" || $fakegebd == "" || $fakegebm == "" || $fakegeby == "" || $fakeraidexp == "" || $fakekritik == "")
	{
	echo "Bitte alle Felder ausf&uuml;llen<br><br>";
	echo "\n<form action=\"index.php?mode=bewerbung\" method=\"post\">";
	echo "\nCharacktername:<br><input name=\"p_name\" type=\"text\"  size=\"40\" maxlength=\"30\"><br><br>";
	echo "\nKlasse:<br><select name=\"p_klasse\" size=\"1\">";
	echo "<option value=\"0\" selected>Druide</option>";
	echo "<option value=\"1\">Hexenmeister</option>";
	echo "<option value=\"2\">J&auml;ger</option>";
	echo "<option value=\"3\">Krieger</option>";
	echo "<option value=\"4\">Magier</option>";
	echo "<option value=\"5\">Paladin</option>";
	echo "<option value=\"6\">Priester</option>";
	echo "<option value=\"7\">Schamane</option>";
	echo "<option value=\"8\">Schurke</option>";
	echo "</select><br><br>";
	echo "\nGilde:<br><input name=\"p_gilde\" type=\"text\"  size=\"40\" maxlength=\"30\"><br><br>";
	echo "\neMail:<br><input name=\"p_email\" type=\"text\"  size=\"40\" maxlength=\"50\"><br><br>";
	echo "\nGeburtsdatum:<br>";
	echo "\nTag: <input name=\"p_geb_d\" type=\"text\" size=\"3\" maxlength=\"2\" value=\"00\"> ";
	echo "\nMonat: <input name=\"p_geb_m\" type=\"text\" size=\"3\" maxlength=\"2\" value=\"00\"> ";
	echo "\nJahr: <input name=\"p_geb_y\" type=\"text\" size=\"6\" maxlength=\"4\" value=\"0000\"><br><br>";
	
	echo "Bisherige Raiderfahrung:<br><textarea name=\"p_raidexpierience\" rows=\"7\" cols=\"50\">kleiner Text in dem ihr erkl&auml;rt in was f&uuml;r Raidinstanzen ihr bisher wart, mit welcher Raidgruppe und wie erfolgreich.</textarea><br><br>";
	echo "Selbsteinsch&auml;tzung:<br><textarea name=\"p_kritik\" rows=\"7\" cols=\"50\">kleiner Text in dem ihr euch selbst _einsch&auml;tzt_: wie ihr Ausger&uuml;stet (keine Auflistung der Items) und wie gut ihr seid.</textarea><br><br>";
	echo "\n<input type=\"submit\" value=\"Bewerben\"></form>";
	}
else
	{
	if((post('p_raidexpierience')!="kleiner Text in dem ihr erkl&auml;rt in was fÃ¼r Raidinstanzen ihr bisher wart, mit welcher Raidgruppe und wie erfolgreich.") && (post('p_kritik')!="kleiner Text in dem ihr euch selbst _einsch&auml;tzt_: wie ihr Ausger&uuml;stet (keine Auflistung der Items) und wie gut ihr seid."))
		{
		$name = htmlentities($fakename);
		$klassezahl = (int) htmlentities(post('p_klasse'));
		if($klassezahl==0){$klasse="Druide";}
		if($klassezahl==1){$klasse="Hexenmeister";}
		if($klassezahl==2){$klasse="J&auml;ger";}
		if($klassezahl==3){$klasse="Krieger";}
		if($klassezahl==4){$klasse="Magier";}
		if($klassezahl==5){$klasse="Paladin";}
		if($klassezahl==6){$klasse="Priester";}
		if($klassezahl==7){$klasse="Schamane";}
		if($klassezahl==0){$klasse="Schurke";}
		$gilde=htmlentities(post('p_gilde'));
		$email=htmlentities($fakeemail);
		$d=htmlentities($fakegebd);
		$m=htmlentities($fakegebm);
		$md=$m;
		$md.=$d;
		$y=htmlentities($fakegeby);
		$gdatum="$Y-$m-$d";
		$raidexpierience=htmlentities($fakeraidexp);
		$kritik=htmlentities($fakekritik);
		$thistime=time();
		$datum=date("Y-m-d H:i:s",$thistime);
		$ip=getenv('REMOTE_ADDR');
		$host=gethostbyaddr($ip);
		
		$alter=(($y-date("Y",$thistime))+(date("md",$thistime)<$md))*(-1);
		
		$caption="[$klasse] - $name ";
		$text="Name: <font color=\"$colortextedit\">$name</font>\nKlasse: <font color=\"$colortextedit\">$klasse</font>\nGilde: <font color=\"$colortextedit\">$gilde</font>\nAlter: <font color=\"$colortextedit\">$alter</font>\neMail Adresse: <font color=\"$colortextedit\">$email</font>\n\nRaiderfahrung:\n<font color=\"$colortextedit\">$raidexpierience</font>\n\nKritik:\n<font color=\"$colortextedit\">$kritik</font>";
		$text.="\n\n<a href=\"http://eu.wowarmory.com/character-sheet.xml?r=Zuluhed&n=$name\">Armory</a>";
		
		$sqlquery4 = "INSERT INTO `".$sqlpraefix."threads` ( `id` , `forumid` , `userid`, `modus` , `name`)";
		$sqlquery4 .= "VALUES ('', '$bewerbungsforumid', '0', 1, '$caption')";
		mysql_query($sqlquery4);
		
		
		$sqlquery5 = "SELECT * FROM `".$sqlpraefix."threads` WHERE `forumid` = '$bewerbungsforumid' AND `userid` = '0' AND `name` = '$caption' ORDER BY `id`";
		$sqlresult5 = mysql_query($sqlquery5);
		while($row5 = mysql_fetch_object($sqlresult5))
			{
			$threadid = $row5->id;
			}
		
		
		$sqlquery2 = "INSERT INTO `".$sqlpraefix."posts` ( `id` , `threadid` , `userid` , `text` , `datum`, `ip`, `host` )";
		$sqlquery2 .= "VALUES ('', '$threadid', '0', '$text', '$datum', '$ip', '$host')";
		mysql_query($sqlquery2);
		echo "\n<br>Erfolgreich beworben";
		echo "\n<br><a href=\"index.php\">Zur Startseite</a><br>";
		}
	else
		{
		echo "Bitte gebt einen Individuellen Text für die Bisherige Raiderfahrung und die Selbsteinschätzung ein.";
		echo "\n<br><a href=\"index.php?mode=bewerbung\">Zur&uuml;ck</a><br>";
		}
	}




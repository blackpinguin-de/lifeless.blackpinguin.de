<?php
$charid =  (int) get('id');

$sqlchars  = "SELECT chars.name charname, klassen.name klassenname, users.id userid, users.name username ";
$sqlchars .= "FROM `".$dkpsyntax."chars` chars ";
$sqlchars .= "LEFT JOIN `".$dkpsyntax."klassen` klassen ON `chars`.`class_id` = `klassen`.`class_id` ";
$sqlchars .= "LEFT JOIN `".$forumsyntax."users` users ON `chars`.`user_id` = `users`.`id` ";
$sqlchars .= "WHERE `chars`.`char_id` = '$charid'";
$reschars  = mysql_query($sqlchars);
while($rowchars = mysql_fetch_object($reschars))
{
$charname=$rowchars->charname;
$klassenname=$rowchars->klassenname;
$userid=$rowchars->userid;
$username=$rowchars->username;

}

echo "Charid: $charid <br>";
echo "Charname: $charname <br>";
echo "Klasse: $klassenname <br>";
echo "Forenaccount: $userid <br>";
echo "Forenaccount: $username <br>";

echo "<br><br><br><br>";



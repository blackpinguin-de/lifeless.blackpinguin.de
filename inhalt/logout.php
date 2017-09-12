<?php


echo "\n<table width=\"100%\">";
echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"100%\"><font color=\"$colortextdunkel\">";
if($seasonid=="")
	{
		echo "\n<a href=\"index.php?mode=logout\">Logout</a>";
	}
else
	{
	echo "\n<a href=\"index.php?mode=logout&season=$seasonid\">Logout</a>";
	}
echo "\n</font>";

echo "\n</td></tr></table><br>";







if($seasonid == "")
{
echo "Sie sind nicht eingeloggt.";
echo "<br><a href=\"index.php?mode=login\">einloggen?</a><br>";
}

else
{
$thistime=time();
$sqlquery = "SELECT * FROM `".$sqlpraefix."season` WHERE `key` = '$seasonid'";
$sqlresult = mysql_query($sqlquery);
while($row = mysql_fetch_object($sqlresult))
{
$sqlkey = $row->key;
$sqltime = $row->expire;
}

if($sqlkey==""||(strtotime($sqltime))<$thistime)
{
echo "Sie sind nicht eingeloggt.";
echo "<br><a href=\"index.php?mode=login\">einloggen?</a><br>";
}

else
{
$sqlquery = "DELETE FROM `".$sqlpraefix."season` WHERE `key` = '$seasonid' LIMIT 1";
mysql_query($sqlquery);
		echo "Sie sind nun ausgeloggt.";
		echo "<br><a href=\"index.php\">Zur Startseite</a><br>";
}
}
mysql_close($sqlconnection);


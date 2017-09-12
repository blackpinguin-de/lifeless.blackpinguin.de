<?php

echo "<table width=\"100%\" cellspacing=\"0\" align=\"center\">";
echo "<tr><td align=\"right\" bgcolor=\"$colorbgdunkel\">Online:</td><td align=\"left\" bgcolor=\"$colorbgdunkel\">";

$userid = 0;
$sqlquery = "SELECT `s`.`userid` as useridr, `s`.`expire` as expirer, `u`.`name` as namer, `u`.`rang` as rangr FROM `".$sqlpraefix."season` `s`, `".$sqlpraefix."users` `u`  WHERE `s`.`userid` = `u`.`id` ORDER BY `u`.`rang` DESC";
$sqlresult = mysql_query($sqlquery);
while($row = mysql_fetch_object($sqlresult))
	{
	$thistime=time();
	$seasonexpire=StrToTime($row->expirer);
	if($seasonexpire > $thistime)
		{
		$userid=$row->useridr;
		$username=$row->namer;
		$userrang=$row->rangr;

		echo "<a href=\"index.php?mode=profil&amp;userid=$userid";
		if($seasonid!="")
			{
			echo "&amp;season=$seasonid";
			}
		echo "\"><font color=\"";
		if($userrang==1){echo "#ffffff";}
		if($userrang==2){echo "#00ff00";}
		echo "\">";
		echo $username;
		echo "</font></a> ";
		}
	}
if($userid==0)
	{echo "<font color=\"$colortextdunkel\">keiner</font>";}

echo "</td></tr></table>";


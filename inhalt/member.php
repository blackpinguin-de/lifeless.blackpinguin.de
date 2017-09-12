<?php


echo "\n<table width=\"100%\">";
echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"100%\"><font color=\"$colortextdunkel\">";
if($seasonid=="")
	{
	echo "\n<a href=\"index.php?mode=member\">Mitglieder</a>";
	}
else
	{
	echo "\n<a href=\"index.php?mode=member&season=$seasonid\">Mitglieder</a>";
	}
echo "\n</font>";

echo "\n</td></tr></table><br>";

echo "\n<table width=\"90%\">";
echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"5%\" align=\"center\"><font color=\"$colortextdunkel\"><a href=\"index.php?mode=member";
if($seasonid!=""){echo "&amp;season=$seasonid";}echo "\">ID</a></font></td>";
echo "\n<td bgcolor=\"$colorbgdunkel\" width=\"40%\" align=\"center\"><font color=\"$colortextdunkel\"><a href=\"index.php?mode=member&amp;order=name";
if($seasonid!=""){echo "&amp;season=$seasonid";}echo "\">Name</a></font></td>";
echo "\n<td bgcolor=\"$colorbgdunkel\" width=\"15%\" align=\"center\"><font color=\"$colortextdunkel\"><a href=\"index.php?mode=member&amp;order=rang";
if($seasonid!=""){echo "&amp;season=$seasonid";}echo "\">Rang</a></font></td>";
echo "\n<td bgcolor=\"$colorbgdunkel\" width=\"20%\" align=\"center\"><font color=\"$colortextdunkel\">Anzahl Posts</font></td>";
echo "\n<td bgcolor=\"$colorbgdunkel\" width=\"20%\" align=\"center\"><font color=\"$colortextdunkel\"><a href=\"index.php?mode=member&amp;order=reg";
if($seasonid!=""){echo "&amp;season=$seasonid";}echo "\">Im Forum seit</a></font></td>";
echo "</tr></table>\n";

$sqlabfrage0 = "SELECT * FROM `".$sqlpraefix."users` ORDER BY id ASC";
if(mysql_real_escape_string($_GET['order'])=="name"){$sqlabfrage0 = "SELECT * FROM `".$sqlpraefix."users` ORDER BY name ASC";}
if(mysql_real_escape_string($_GET['order'])=="rang"){$sqlabfrage0 = "SELECT * FROM `".$sqlpraefix."users` ORDER BY rang DESC";}
if(mysql_real_escape_string($_GET['order'])=="reg"){$sqlabfrage0 = "SELECT * FROM `".$sqlpraefix."users` ORDER BY register ASC";}
$sqlergebnis0 = mysql_query($sqlabfrage0);

echo "\n<table width=\"90%\">";
while($rowa = mysql_fetch_object($sqlergebnis0))
	{
	$tempuserid=$rowa->id;
	$tempusername=$rowa->name;
	$tempuserrang=$rowa->rang;
	$timed=strtotime($rowa->register);
	$tempuserregister=date("d.m.Y",$timed);
	
	$sqlabfrage1 = "SELECT COUNT(*) AS a FROM `".$sqlpraefix."posts` WHERE userid = $tempuserid AND `deleted` != '1'";
	$sqlergebnis1 = mysql_query($sqlabfrage1);
	while($rowb = mysql_fetch_object($sqlergebnis1))
		{
		$tempuserposts = $rowb->a;
		}
	
	echo "\n<tr><td bgcolor=\"$colorbghell\" width=\"5%\" align=\"center\"><font color=\"$colortexthell\">$tempuserid</font></td>";

	echo "\n<td bgcolor=\"$colorbghell\" width=\"40%\" align=\"center\"><a href=\"index.php?mode=profil&amp;userid=$tempuserid";
	if($seasonid!=""){echo "&amp;season=$seasonid";}
	echo "\"><font color=\"$colortexthell\">$tempusername</font></a></td>";
	echo "\n<td bgcolor=\"$colorbghell\" width=\"15%\" align=\"center\"><font color=\"$colortexthell\">";
	if($tempuserrang==0){echo "Gesperrt";}if($tempuserrang==1){echo "User";}if($tempuserrang==2){echo "Admin";}
	echo "</font></td>";
	echo "\n<td bgcolor=\"$colorbghell\" width=\"20%\" align=\"center\"><font color=\"$colortexthell\">$tempuserposts</font></td>";
	echo "\n<td bgcolor=\"$colorbghell\" width=\"20%\" align=\"center\"><font color=\"$colortexthell\">$tempuserregister</font></td>";
	echo "</tr>";

	}
echo "</table>\n<br>";
include("inhalt/nowonline.php");

mysql_close($sqlconnection);
?>
















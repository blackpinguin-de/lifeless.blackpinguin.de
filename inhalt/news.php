<?php
include_once("inhalt/config.php");

$postcount = 0;

$abb = "SELECT * FROM `".$sqlpraefix."threads` WHERE `forumid` = $newsforumid AND `modus` != 3"; 
$erb = mysql_query($abb);
while($row = mysql_fetch_object($erb))
	{
	$postcount++;
	}
$maxpages = ceil($postcount/$newscount);
if(get("page")=="")
	{
	$page = 1;
	}
else
	{
	$page = (int) get("page");
	}
$pageb=$page;

$page--;
$page=$page*$newscount;


$abfrageb = "SELECT * FROM `".$sqlpraefix."threads` WHERE `forumid` = $newsforumid AND `modus` != 3 ORDER BY `id` DESC LIMIT $page, $newscount"; 
$ergebnisb = mysql_query($abfrageb);
while($rowb = mysql_fetch_object($ergebnisb))
	{
	$tempthreadid=$rowb->id;
	$abfrage = "SELECT * FROM `".$sqlpraefix."posts` WHERE `threadid` = $tempthreadid LIMIT 0, 1"; 
	$ergebnis = mysql_query($abfrage);
	while($row = mysql_fetch_object($ergebnis))
		{
		$time = strtotime($row->datum);
		echo "\n<table width=\"100%\" border=\"0\"><tr>";
		echo "\n<td align=\"center\" width=\"80%\" height=\"30\" bgcolor=\"$colorbgdunkel\" style=\"font-size:18pt;color:$colortextdunkel;\">";
				if($seasonid=="")
					{
					echo "<a href=\"index.php?mode=posts&amp;threadid=$tempthreadid\">";
					}
				else
					{
					echo "<a href=\"index.php?mode=posts&amp;threadid=$tempthreadid&amp;season=$seasonid\">";
					}
				echo $rowb->name;
				echo "</a>";
		echo "</td>\n<td align=\"center\" width=\"20%\" height=\"30\" bgcolor=\"$colorbgdunkel\" style=\"font-size:16pt;color:$colortextdunkel;\">";
		echo date("d.m.Y",$time);
		echo "</td>\n</tr><tr><td bgcolor=\"$colorbghell\" colspan=\"2\" style=\"color:$colortexthell;\">\n";
		echo bbcodenews(str_replace("\n", "<br>", $row->text));
		$userid=$row->userid;
		echo "<br><br><div align=\"right\"><font color=\"$colortextedit\" size=\"3\"><i>Posted by <a href=\"index.php?mode=profil&amp;userid=$userid";
		if($seasonid!="")
			{
			echo "&amp;season=$seasonid";
			}
		echo "\"><font color=\"$colortextedit\"><i>";
		$abfrage2 = "SELECT name FROM `".$sqlpraefix."users` WHERE `id`='$userid'"; 
		$ergebnis2 = mysql_query($abfrage2);
		while($row2 = mysql_fetch_object($ergebnis2))
			{
			echo $row2->name;
			}
		echo "</i></font></a>, ";
		$abfrage3 = "SELECT count(id) as coun FROM `".$sqlpraefix."posts` WHERE `threadid`='$tempthreadid' AND `deleted` != 1"; 
		$ergebnis3 = mysql_query($abfrage3);
		while($row3 = mysql_fetch_object($ergebnis3))
			{
			$count = $row3->coun;
			}
		echo ($count-1);
		if($seasonid=="")
			{
			echo " <a href=\"index.php?mode=posts&amp;threadid=$tempthreadid\">";
			}
		else
			{
			echo " <a href=\"index.php?mode=posts&amp;threadid=$tempthreadid&amp;season=$seasonid\">";
			}
		echo "<font color=\"$colortextedit\"><i>Kommentar";
		if(($count-1)!=1)
			{
			echo "e";
			}
		echo "</i></font></a></i></font></div></td></table><br>\n";
		}
	}

if($maxpages!=1)
	{
	echo "<table align=\"right\"><tr><td align=\"right\"><div align=\"center\"><font color=\"#ffffff\">Seiten: ";
	for($i=1;$i<=$maxpages;$i++)
		{
		if($pageb==$i)
			{
			echo "<b>[$i]</b> ";
			}
	else
			{
			echo "<a href=\"index.php?mode=news&amp;page=$i";
			if($seasonid!="")
				{
				echo "&amp;season=$seasonid";
				}
			echo "\">$i</a> ";
			}
		}
	echo "</font></div></td></tr></table><br>";
	}

mysql_close($sqlconnection);


<?php


echo "\n<table width=\"100%\">";
echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"100%\"><font color=\"$colortextdunkel\">";


	echo "\nForum";


echo "\n</font>";

echo "\n</td></tr></table><br>";

echo "\n<table width=\"90%\">";
echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"50%\" align=\"center\"><font color=\"$colortextdunkel\">Forenname</font></td>";
echo "\n<td bgcolor=\"$colorbgdunkel\" width=\"15%\" align=\"center\"><font color=\"$colortextdunkel\">Threads</font></td>";
echo "\n<td bgcolor=\"$colorbgdunkel\" width=\"10%\" align=\"center\"><font color=\"$colortextdunkel\">Posts</font></td>";
echo "\n<td bgcolor=\"$colorbgdunkel\" width=\"25%\" align=\"center\"><font color=\"$colortextdunkel\">Letzter Eintrag</font></td></tr></table>\n";




$sqlabfrage = "SELECT * FROM `".$sqlpraefix."forums` ORDER BY size DESC";
$sqlergebnis = mysql_query($sqlabfrage);
echo "\n<table width=\"90%\">";
while($rowa = mysql_fetch_object($sqlergebnis))
	{
	if($rowa->modus!=3 || $headeruserrang==2)
		{
		if($rowa->visible==1 || $headeruserrang>=1)
			{
			echo "<tr><td bgcolor=\"$colorbghell\" width=\"50%\" align=\"center\">";
			$forumid=$rowa->id;
			echo "<table align=\"center\"><tr><td><font color=\"$colortextdunkel\">";
			if($rowa->visible==0){echo "<img src=\"img/admin/visible.gif\" alt=\"invisible\">";}
			if($rowa->modus==2){echo "<img src=\"img/admin/locked.gif\" alt=\"geschlossen\"></font></td><td><font color=\"$colortextdunkel\">";}//locked
			if($rowa->modus==3){echo "<img src=\"img/admin/deleted.gif\" alt=\"gelöscht\"></font></td><td><font color=\"$colortextdunkel\">";}//deleted
			if($seasonid=="")
				{
				echo "\n<a href=\"index.php?mode=threads&amp;forumid=$forumid\"><font color=\"$colortextlinkhell\">";
				}
			else
				{
				echo "\n<a href=\"index.php?mode=threads&amp;forumid=$forumid&amp;season=$seasonid\"><font color=\"$colortextlinkhell\">";
				}
			echo substr($rowa->name,0,30);
			echo "</font></a></font></td></tr></table></td>";
			$lastpost=0;
			$sqlquery1 = "SELECT * FROM `".$sqlpraefix."threads` WHERE forumid = $forumid AND `modus` != 3";
			$sqlresult1 = mysql_query($sqlquery1);
			$threadzaehler=0;
			$postzaehler=0;
			while($rowb = mysql_fetch_object($sqlresult1))
				{
				$threadzaehler=$threadzaehler+1;
				$tempthreadidabc=$rowb->id;
	
				$sqlquery2 = "SELECT * FROM `".$sqlpraefix."posts` WHERE `threadid` = '$tempthreadidabc' AND `deleted` != '1'";
				$sqlresult2 = mysql_query($sqlquery2);
				while($rowc = mysql_fetch_object($sqlresult2))
					{
					$postzaehler=$postzaehler+1;
					if($lastpost < strtotime($rowc->datum))
						{
						$lastpost=strtotime($rowc->datum);
						}
					}
				}
			echo "\n<td bgcolor=\"$colorbghell\" width=\"15%\" align=\"center\"><font color=\"$colortexthell\">$threadzaehler</font></td>";
			echo "\n<td bgcolor=\"$colorbghell\" width=\"10%\" align=\"center\"><font color=\"$colortexthell\">$postzaehler</font></td>";
			echo "\n<td bgcolor=\"$colorbghell\" width=\"25%\" align=\"center\"><font color=\"$colortexthell\">";
			$thistime=time();
			if(StrToTime(date("d.m.Y",$thistime))-StrToTime(date("d.m.Y",$lastpost)) == 0)
				{
				echo date("H:i",$lastpost);echo " Uhr";
				}
			else
				{
				echo date("d.m.Y",$lastpost);
				}
		
			echo "\n</font></td></tr>";
			}
		}
	}
echo "</table><br>\n";

include_once("inhalt/nowonline.php");


mysql_close($sqlconnection);


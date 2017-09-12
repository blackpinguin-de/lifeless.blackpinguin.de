<?php

$forumid=mysql_real_escape_string($_GET["forumid"]);
if($forumid=="")
	{
	echo "\n<table width=\"100%\">";
	echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"70%\"><font color=\"$colortextdunkel\">";
	if($seasonid=="")
		{
		echo "\nForum";
		}
	else
		{
		echo "\nForum";
		}
	echo "\n</font></td><td bgcolor=\"$colorbgdunkel\" width=\"30%\" align=\"center\"><font color=\"$colortextdunkel\">";
	echo "</font></td></tr></table><br>";
	if($seasonid=="")
		{
		echo "<br><a href=\"index.php?mode=forums\">Sie m&uuml;ssen ein Forum angeben</a><br>";
		}
	else
		{
		echo "<br><a href=\"index.php?mode=forums&amp;season=$seasonid\">Sie m&uuml;ssen ein Forum angeben</a><br>";
		}
	}
else
	{
	$sqlquery0 = "SELECT * FROM `".$sqlpraefix."forums` WHERE id = $forumid";
	$sqlresult0 = mysql_query($sqlquery0);
	while($row0 = mysql_fetch_object($sqlresult0))
		{
		$forumname=$row0->name;
		$forummodus=$row0->modus;
		$forumvisible=$row0->visible;
		$sforumid=$row0->id;
		}
	
	echo "\n<table width=\"100%\">";
	echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"70%\"><font color=\"$colortextdunkel\">";
	if($seasonid=="")
		{
		echo "\n<a href=\"index.php?mode=forums\">Forum</a> -> ";
		echo substr($forumname,0,30);
		}
	else
		{
		echo "\n<a href=\"index.php?mode=forums&amp;season=$seasonid\">Forum</a> -> ";
		echo substr($forumname,0,30);
		}
	echo "\n</font></td><td bgcolor=\"$colorbgdunkel\" width=\"30%\" align=\"center\">";
	echo "<table align=\"center\"><tr>";
	//oben in threads.php
	if($headeruserrang==2)
		{
		echo "<td><font color=\"$colortextdunkel\">";
		//Forum normal:
		if($forummodus==1)
			{
			echo "<a href=\"index.php?mode=edit&amp;order=1&amp;id=$sforumid&amp;season=$seasonid\">";
			echo "<img src=\"img/admin/edit.gif\" border=\"0\" alt=\"Forum umbenennen\"></a>";
			echo "<a href=\"index.php?mode=admin&amp;order=2&amp;id=$sforumid&amp;season=$seasonid\">";
			echo "<img src=\"img/admin/open.gif\" border=\"0\" alt=\"Forum schlie&szlig;en\"></a>";
			echo "<a href=\"index.php?mode=admin&amp;order=3&amp;id=$sforumid&amp;season=$seasonid\">";
			echo "<img src=\"img/admin/redeleted.gif\" border=\"0\" alt=\"Forum l&ouml;schen\"></a></font></td><td>";
			echo "&nbsp;";
			}
		//Forum geschlossen:
		if($forummodus==2)
			{
			echo "<a href=\"index.php?mode=edit&amp;order=1&amp;id=$sforumid&amp;season=$seasonid\">";
			echo "<img src=\"img/admin/edit.gif\" border=\"0\" alt=\"Forum umbenennen\"></a>";
			echo "<a href=\"index.php?mode=admin&amp;order=6&amp;id=$sforumid&amp;season=$seasonid\">";
			echo "<img src=\"img/admin/locked.gif\" border=\"0\" alt=\"Forum &ouml;ffnen\"></a>";
			echo "<a href=\"index.php?mode=admin&amp;order=3&amp;id=$sforumid&amp;season=$seasonid\">";
			echo "<img src=\"img/admin/redeleted.gif\" border=\"0\" alt=\"Forum l&ouml;schen\"></a></font></td><td>";
			echo "&nbsp;";
			}
		//Forum gelöscht:
		if($forummodus==3)
			{
			echo "<a href=\"index.php?mode=edit&amp;order=1&amp;id=$sforumid&amp;season=$seasonid\">";
			echo "<img src=\"img/admin/edit.gif\" border=\"0\" alt=\"Forum umbenennen\"></a>";
			echo "<a href=\"index.php?mode=admin&amp;order=2&amp;id=$sforumid&amp;season=$seasonid\">";
			echo "<img src=\"img/admin/open.gif\" border=\"0\" alt=\"Forum schlie&szlig;en\"></a>";
			echo "<a href=\"index.php?mode=admin&amp;order=6&amp;id=$sforumid&amp;season=$seasonid\">";
			echo "<img src=\"img/admin/deleted.gif\" border=\"0\" alt=\"Forum wiederherstellen\"></a></font></td><td>";
			echo "&nbsp;";
			}
		echo "</td>";
		}
	
	if(($forummodus!=2 && $forummodus!=3) || $headeruserrang==2)
		{
		echo "<td><font color=\"$colortextdunkel\">";
		echo "<a href=\"index.php?mode=newthread&amp;forumid=$sforumid";
		if($seasonid!="")
			{
			echo "&amp;season=$seasonid";
			}
		echo "\"><img src=\"img/admin/new.gif\" border=\"0\" alt=\"Neuer Eintrag\"></a></font></td>";
		}
	else
		{
		
		if($forummodus==2)//locked
			{
			echo "<td><font color=\"$colortextdunkel\">";
			echo "<img src=\"img/admin/locked.gif\" alt=\"geschlossen\"></font></td><td>";
			echo " <font color=\"$colortextdunkel\">Geschlossen</font>";
			echo "</td>";
			}
		if($forummodus==3)//deleted
			{
			echo "<td><font color=\"$colortextdunkel\">";
			echo "<img src=\"img/admin/deleted.gif\" alt=\"gelöscht\"></font></td><td>";
			echo " <font color=\"$colortextdunkel\">Gel&ouml;scht</font>";
			echo "</td>";
			}
		}	
	echo "</tr></table>";
	echo "</td></tr></table><br>";
	if($forummodus==3 && $headeruserrang!=2)
		{
		echo "Dieses Forum wurde von einem Administrator gel&ouml;scht.<br><br>";
		}
	else
		{
		if($forumvisible==1 || $headeruserrang>=1)
			{
			if($forummodus==3)
				{
				echo "Dieses Forum wurde von einem Administrator gel&ouml;scht. Normale User k&ouml;nnen es nicht lesen.<br><br>";
				}
			echo "\n<table width=\"90%\">";
			echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"45%\" align=\"center\"><font color=\"$colortextdunkel\">Threadtitel</font></td>";
			echo "\n<td bgcolor=\"$colorbgdunkel\" width=\"20%\" align=\"center\"><font color=\"$colortextdunkel\">Ersteller</font></td>";
			echo "\n<td bgcolor=\"$colorbgdunkel\"	width=\"8%\" align=\"center\"><font color=\"$colortextdunkel\">Posts</font></td>";
			echo "\n<td bgcolor=\"$colorbgdunkel\"	width=\"25%\" align=\"center\"><font color=\"$colortextdunkel\">Letzter Eintrag</font></td></tr></table>";
			$sqlquery1 = "SELECT * FROM `".$sqlpraefix."threads` WHERE forumid = $forumid ORDER BY id ASC";
			$sqlresult1 = mysql_query($sqlquery1);
			echo "\n<table width=\"90%\">";
			while($rowa = mysql_fetch_object($sqlresult1))
				{
				if($rowa->modus!=3 || $headeruserrang==2)
					{
					$temppostdate=0;
					$threadid=$rowa->id;
					$tempuserida=$rowa->userid;
					echo "\n<tr><td bgcolor=\"$colorbghell\" width=\"45%\" align=\"center\" valign=\"MIDDLE\">";
					echo "<table align=\"center\"><tr><td>";
					if($rowa->modus==2){echo "<img src=\"img/admin/locked.gif\" alt=\"geschlossen\">";}//locked
					if($rowa->modus==3){echo "<img src=\"img/admin/deleted.gif\" alt=\"gelöscht\">";}//deleted
					echo "</td><td>";
					if($seasonid=="")
						{
						echo "<a href=\"index.php?mode=posts&amp;threadid=$threadid\"><font color=\"$colortextlinkhell\">";
						}
					else
						{
						echo "<a href=\"index.php?mode=posts&amp;threadid=$threadid&amp;season=$seasonid\"><font color=\"$colortextlinkhell\">";
						}
					echo $rowa->name;
					echo "</font></a>";
					$abb = "SELECT `id` FROM `".$sqlpraefix."posts` WHERE `threadid` = '$threadid' AND `deleted` != '1'"; 
					$erb = mysql_query($abb);
					$postcount = 0;
						while($row = mysql_fetch_object($erb))
						{
						$postcount++;
						}
					$maxpages = ceil($postcount/$pageacount);
					if($maxpages!=1&&$maxpages!=0&&$maxpages!="")
						{
						echo "&nbsp;&nbsp;<font size=\"1\">(Seiten:&nbsp;</font>";
						for($i=1;$i<=$maxpages;$i++)
							{
							echo "<a href=\"index.php?mode=posts&amp;threadid=$threadid&amp;page=$i";
							if($seasonid!="")
								{
								echo "&amp;season=$seasonid";
								}
							echo "\"><font color=\"$colortexthell\" size=\"1\">$i</font></a><font size=\"1\">&nbsp;</font>";
							}
						echo "<font size=\"1\">)</font>";
						}
					echo "</td></tr></table></td>\n<td bgcolor=\"$colorbghell\" width=\"20%\" align=\"center\">";
					$sqlquery2 = "SELECT * FROM `".$sqlpraefix."users` WHERE `id` = '$tempuserida'";
					$sqlresult2 = mysql_query($sqlquery2);
					while($rowb = mysql_fetch_object($sqlresult2))
						{
						$tempusername=$rowb->name;
						if($seasonid=="")
							{
							echo "<a href=\"index.php?mode=profil&amp;userid=$tempuserida\"><font color=\"$colortextlinkhell\">$tempusername</font></a></td>";
							}
						else
							{
							echo "<a href=\"index.php?mode=profil&amp;userid=$tempuserida&amp;season=$seasonid\">";
							echo "<font color=\"$colortextlinkhell\">$tempusername</font></a></td>";
							}
						}
					$sqlabfrage3 = "SELECT datum FROM `".$sqlpraefix."posts` WHERE threadid = $threadid";
					$sqlergebnis3 = mysql_query($sqlabfrage3);
					$tempthreadposts=0;
					while($rowc = mysql_fetch_object($sqlergebnis3))
						{
						$tempthreadposts = $tempthreadposts+1;
						if($temppostdate < strtotime($rowc->datum))
							{
							$temppostdate=strtotime($rowc->datum);
							}
						}
					echo "\n<td bgcolor=\"$colorbghell\" width=\"8%\" align=\"center\"><font color=\"$colortexthell\">";
					echo $tempthreadposts;
					echo "</font></td>\n<td bgcolor=\"$colorbghell\" width=\"25%\" align=\"center\"><font color=\"$colortexthell\">";
					$thistime=time();
					if(StrToTime(date("d.m.Y",$thistime))-StrToTime(date("d.m.Y",$temppostdate)) == 0)
						{
						echo date("H:i",$temppostdate);echo " Uhr";
						}
					else
						{
						echo date("d.m.Y",$temppostdate);
						}
					echo "</font></td></tr>";
					}
				}
			echo "</table>\n";
			}
		else
			{
			echo "Dieses Forum ist nur f&uuml;r Benutzer zug&auml;nglich. Nicht registrierte User d&uuml;rfen es nicht lesen.<br><br>";
			}
		}
	}
	
mysql_close($sqlconnection);
?>

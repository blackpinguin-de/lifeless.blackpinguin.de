<?php
$threadid = (int) get("threadid");

$sqlquery2 = "SELECT * FROM `".$sqlpraefix."threads` WHERE id = $threadid";
$sqlresult2 = mysql_query($sqlquery2);
while($row2 = mysql_fetch_object($sqlresult2))
	{
	$threadname=$row2->name;
	$threadmodus=$row2->modus;
	$forumid=$row2->forumid;
	}
$sqlquery3 = "SELECT * FROM `".$sqlpraefix."forums` WHERE id = $forumid";
$sqlresult3 = mysql_query($sqlquery3);
while($row3 = mysql_fetch_object($sqlresult3))
	{
	$forumname=$row3->name;
	}
echo "\n<table width=\"100%\">";
echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"70%\"><font color=\"$colortextdunkel\">";
if($seasonid=="")
	{
	echo "\n<a href=\"index.php?mode=forums\">Forum</a> -> ";
	echo "\n<a href=\"index.php?mode=threads&amp;forumid=$forumid\">$forumname</a> -> ";
	echo "\n<a href=\"index.php?mode=posts&amp;threadid=$threadid\">$threadname</a> ->";
	echo "\nNeuer Post";
	}
else
	{
	echo "\n<a href=\"index.php?mode=forums&amp;season=$seasonid\">Forum</a> -> ";
	echo "\n<a href=\"index.php?mode=threads&amp;forumid=$forumid&amp;season=$seasonid\">$forumname</a> -> ";
	echo "\n<a href=\"index.php?mode=posts&amp;threadid=$threadid&amp;season=$seasonid\">$threadname</a> ->";
	echo "\nNeuer Eintrag";
	}
echo "\n</font></td></table>";




if($seasonid=="")
	{
	echo "\n<br>Sie müssen eingeloggt sein um zu posten<br>";
	echo "\n<br><a href=\"index.php?mode=login\">einloggen?</a> <a href=\"index.php?mode=register\">registrieren?</a><br>";
	}

else
	{
	if($threadid==0)
		{
		echo "<br><a href=\"index.php?mode=forums&amp;season=$seasonid\">Sie m&uuml;ssen einen Thread angeben</a><br>";
		}
	else
		{
		$faketext = post('p_text');
		if($faketext=="")
			{
			if(($threadmodus!=2&&$threadmodus!=3)||$headeruserrang==2)
				{
				echo "<br><form action=\"index.php?mode=newpost&amp;threadid=$threadid&amp;season=$seasonid\" method=\"post\">";
				echo "Text:<br><textarea name=\"p_text\" rows=\"14\" cols=\"50\"></textarea><br>";
				echo "<input type=\"submit\" value=\"Abschicken\"></form><br>";
				}
			else
				{
				echo "\n<br>Du kannst nicht in einen geschlossenen oder gel&ouml;schten Thread posten";
				echo "\n<br><a href=\"index.php?mode=posts&amp;threadid=$threadid&amp;season=$seasonid\">Zum Thread zur&uuml;ck</a><br>";
				}
			}
		else
			{
			$text=htmlentities($faketext);
			$thistime=time();
			$datum=date("Y-m-d H:i:s",$thistime);

			$sqlquery0 = "SELECT * FROM `".$sqlpraefix."season` WHERE `key` = '$seasonid'";
			$sqlresult0 = mysql_query($sqlquery0);
			while($row0 = mysql_fetch_object($sqlresult0))
				{
				$abcduserid = $row0->userid;
				}
			$sqlquery1 = "SELECT * FROM `".$sqlpraefix."posts` WHERE `userid` = '$abcduserid' ORDER BY `datum` ASC";
			$sqlresult1 = mysql_query($sqlquery1);
			while($row1 = mysql_fetch_object($sqlresult1))
				{
				$lastpost = $row1->datum;
				}
			if((strtotime($lastpost)+60)>$thistime)
				{
				$nextposttime=(strtotime($lastpost)+60)-$thistime;
				echo "\n<br>Du kannst nur alle 60 Sekunden posten";
				echo "\n<br>Du musst noch $nextposttime Sekunden warten";
				echo "\n<br><a href=\"index.php?mode=posts&amp;threadid=$threadid&amp;season=$seasonid\">Zum Thread zur&uuml;ck</a><br>";
				}
			else
				{
				if(($threadmodus!=2&&$threadmodus!=3)||$headeruserrang==2)
					{
					$ip=getenv('REMOTE_ADDR');
					$host=gethostbyaddr($ip);
					$sqlquery2 = "INSERT INTO `".$sqlpraefix."posts` ( `id` , `threadid` , `userid` , `text` , `datum`, `ip`, `host` )";
					$sqlquery2 .= "VALUES ('', '$threadid', '$abcduserid', '$text', '$datum', '$ip', '$host')";
					mysql_query($sqlquery2);
					echo "\n<br>Nachricht gepostet";
					echo "\n<br><a href=\"index.php?mode=posts&amp;threadid=$threadid&amp;season=$seasonid\">";
					echo "Zum Thread zur&uuml;ck</a><br>";
					}
				else
					{
					echo "\n<br>Du kannst nicht in einen geschlossenen oder gel&ouml;schten Thread posten";
					echo "\n<br><a href=\"index.php?mode=posts&amp;threadid=$threadid&amp;season=$seasonid\">";
					echo "Zum Thread zur&uuml;ck</a><br>";
					}
				}
			}
		}
	}




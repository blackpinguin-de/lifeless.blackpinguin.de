<?php
//order
// 1 = Name vom Forum �ndern
// 2 = Name vom Thread �ndern
// 3 = Post editieren






if($headeruserrang==2)
	{
	$id = (int) get("id");
	$order = (int) get("order");
	$fakeadminedit = (int) get("adminedit");
	
	if($order==1) // Name vom Forum ändern
		{
		if($fakeadminedit==1) // Ausführen
			{
			$sqlabfrage1 = "SELECT `name` FROM `".$sqlpraefix."forums` WHERE `id` = '$id'";
			$sqlergebnis1 = mysql_query($sqlabfrage1);
			while($row = mysql_fetch_object($sqlergebnis1))
				{
				$forumname=$row->name;
				}
			echo "\n<table width=\"100%\">";
			echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"100%\"><font color=\"$colortextdunkel\">";
			if($seasonid=="")
				{
				echo "\n<a href=\"index.php?mode=forums\">Forum</a> -> ";
				echo "\n<a href=\"index.php?mode=threads&amp;forumid=$id\">$forumname</a> -> ";
				}
			else
				{
				echo "\n<a href=\"index.php?mode=forums&amp;season=$seasonid\">Forum</a> -> ";
				echo "\n<a href=\"index.php?mode=threads&amp;forumid=$id&amp;season=$seasonid\">$forumname</a> -> ";
				}
			echo "Name &auml;ndern";
			echo "\n</font>";
			echo "\n</td></tr></table><br>";
			
			$newforumname = post("p_name");
			if($newforumname != "")
				{
				$sqlabfrage1 = "UPDATE `".$sqlpraefix."forums` SET `name` = '$newforumname' WHERE `id` ='$id'";
				mysql_query($sqlabfrage1);
				echo "\nForenname ge&auml;ndert";
				echo "\n<br><a href=\"index.php?mode=threads&amp;forumid=$id&amp;season=$seasonid\">";
				echo "Zum Forum zur&uuml;ck</a><br>";
				}
			}
		else // Formular
			{
			$sqlabfrage1 = "SELECT `name` FROM `".$sqlpraefix."forums` WHERE `id` = '$id'";
			$sqlergebnis1 = mysql_query($sqlabfrage1);
			while($row = mysql_fetch_object($sqlergebnis1))
				{
				$forumname=$row->name;
				}
			echo "\n<table width=\"100%\">";
			echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"100%\"><font color=\"$colortextdunkel\">";
			if($seasonid=="")
				{
				echo "\n<a href=\"index.php?mode=forums\">Forum</a> -> ";
				echo "\n<a href=\"index.php?mode=threads&amp;forumid=$id\">$forumname</a> -> ";
				}
			else
				{
				echo "\n<a href=\"index.php?mode=forums&amp;season=$seasonid\">Forum</a> -> ";
				echo "\n<a href=\"index.php?mode=threads&amp;forumid=$id&amp;season=$seasonid\">$forumname</a> -> ";
				}
			echo "Name &auml;ndern";
			echo "\n</font>";
			echo "\n</td></tr></table><br>";

			echo "\n<form action=\"index.php?mode=edit&amp;id=$id&amp;order=1&amp;adminedit=1&amp;season=$seasonid\" method=\"post\">";
			echo "\nName des Forums:<br><input name=\"p_name\" type=\"text\"  size=\"40\" maxlength=\"20\" value=\"$forumname\"><br><br>";
			echo "\n<input type=\"submit\" value=\"&auml;ndern\"></form>";
			}
		}

	if($order==2) // Name vom Thread ändern
		{
		if($fakeadminedit==1) // Ausführen
			{
			$sqlabfrage1 = "SELECT `name`,`forumid` FROM `".$sqlpraefix."threads` WHERE `id` = '$id'";
			$sqlergebnis1 = mysql_query($sqlabfrage1);
			while($rowa = mysql_fetch_object($sqlergebnis1))
				{
				$threadname=$rowa->name;
				$ida=$rowa->forumid;
				}

			$sqlabfrage1 = "SELECT `name` FROM `".$sqlpraefix."forums` WHERE `id` = '$ida'";
			$sqlergebnis1 = mysql_query($sqlabfrage1);
			while($rowb = mysql_fetch_object($sqlergebnis1))
				{
				$forumname=$rowb->name;
				}

			echo "\n<table width=\"100%\">";
			echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"100%\"><font color=\"$colortextdunkel\">";
			if($seasonid=="")
				{
				echo "\n<a href=\"index.php?mode=forums\">Forum</a> -> ";
				echo "\n<a href=\"index.php?mode=threads&amp;forumid=$ida\">$forumname</a> -> ";
				echo "\n<a href=\"index.php?mode=posts&amp;threadid=$id\">$threadname</a> -> ";
				}
			else
				{
				echo "\n<a href=\"index.php?mode=forums&amp;season=$seasonid\">Forum</a> -> ";
				echo "\n<a href=\"index.php?mode=threads&amp;forumid=$ida&amp;season=$seasonid\">$forumname</a> -> ";
				echo "\n<a href=\"index.php?mode=posts&amp;threadid=$id&amp;season=$seasonid\">$threadname</a> -> ";
				}
			echo "Name &auml;ndern";
			echo "\n</font>";
			echo "\n</td></tr></table><br>";


			$newthreadname = post("p_name");
			if($newthreadname != "")
				{
				$sqlabfrage1 = "UPDATE `".$sqlpraefix."threads` SET `name` = '$newthreadname' WHERE `id` ='$id'";
				mysql_query($sqlabfrage1);
				echo "\nThreadname ge&auml;ndert";
				echo "\n<br><a href=\"index.php?mode=posts&amp;threadid=$id&amp;season=$seasonid\">";
				echo "Zum Thread zur&uuml;ck</a><br>";
				}








			}
		else // Formular
			{
			$sqlabfrage1 = "SELECT `name`,`forumid` FROM `".$sqlpraefix."threads` WHERE `id` = '$id'";
			$sqlergebnis1 = mysql_query($sqlabfrage1);
			while($rowa = mysql_fetch_object($sqlergebnis1))
				{
				$threadname=$rowa->name;
				$ida=$rowa->forumid;
				}

			$sqlabfrage1 = "SELECT `name` FROM `".$sqlpraefix."forums` WHERE `id` = '$ida'";
			$sqlergebnis1 = mysql_query($sqlabfrage1);
			while($rowb = mysql_fetch_object($sqlergebnis1))
				{
				$forumname=$rowb->name;
				}

			echo "\n<table width=\"100%\">";
			echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"100%\"><font color=\"$colortextdunkel\">";
			if($seasonid=="")
				{
				echo "\n<a href=\"index.php?mode=forums\">Forum</a> -> ";
				echo "\n<a href=\"index.php?mode=threads&amp;forumid=$ida\">$forumname</a> -> ";
				echo "\n<a href=\"index.php?mode=posts&amp;threadid=$id\">$threadname</a> -> ";
				}
			else
				{
				echo "\n<a href=\"index.php?mode=forums&amp;season=$seasonid\">Forum</a> -> ";
				echo "\n<a href=\"index.php?mode=threads&amp;forumid=$ida&amp;season=$seasonid\">$forumname</a> -> ";
				echo "\n<a href=\"index.php?mode=posts&amp;threadid=$id&amp;season=$seasonid\">$threadname</a> -> ";
				}
			echo "Name &auml;ndern";
			echo "\n</font>";
			echo "\n</td></tr></table><br>";

			echo "\n<form action=\"index.php?mode=edit&amp;id=$id&amp;order=2&amp;adminedit=1&amp;season=$seasonid\" method=\"post\">";
			echo "\nName des Threads:<br><input name=\"p_name\" type=\"text\"  size=\"40\" maxlength=\"20\" value=\"$threadname\"><br><br>";
			echo "\n<input type=\"submit\" value=\"&auml;ndern\"></form>";
			}
		}

	if($order==3) // Post editieren
		{
		if($fakeadminedit==1) // Ausführen
			{
			$sqlabfrage1 = "SELECT `threadid` FROM `".$sqlpraefix."posts` WHERE `id` = '$id'";
			$sqlergebnis1 = mysql_query($sqlabfrage1);
			while($rowa = mysql_fetch_object($sqlergebnis1))
				{
				$idb=$rowa->threadid;
				}

			$sqlabfrage1 = "SELECT `name`,`forumid` FROM `".$sqlpraefix."threads` WHERE `id` = '$idb'";
			$sqlergebnis1 = mysql_query($sqlabfrage1);
			while($rowa = mysql_fetch_object($sqlergebnis1))
				{
				$threadname=$rowa->name;
				$ida=$rowa->forumid;
				}

			$sqlabfrage1 = "SELECT `name` FROM `".$sqlpraefix."forums` WHERE `id` = '$ida'";
			$sqlergebnis1 = mysql_query($sqlabfrage1);
			while($rowb = mysql_fetch_object($sqlergebnis1))
				{
				$forumname=$rowb->name;
				}

			echo "\n<table width=\"100%\">";
			echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"100%\"><font color=\"$colortextdunkel\">";
			if($seasonid=="")
				{
				echo "\n<a href=\"index.php?mode=forums\">Forum</a> -> ";
				echo "\n<a href=\"index.php?mode=threads&amp;forumid=$ida\">$forumname</a> -> ";
				echo "\n<a href=\"index.php?mode=posts&amp;threadid=$idb\">$threadname</a> -> ";
				}
			else
				{
				echo "\n<a href=\"index.php?mode=forums&amp;season=$seasonid\">Forum</a> -> ";
				echo "\n<a href=\"index.php?mode=threads&amp;forumid=$ida&amp;season=$seasonid\">$forumname</a> -> ";
				echo "\n<a href=\"index.php?mode=posts&amp;threadid=$idb&amp;season=$seasonid\">$threadname</a> -> ";
				}
			echo "Post &auml;ndern";
			echo "\n</font>";
			echo "\n</td></tr></table><br>";
				$thistime = time();
				$newposttext = htmlentities(post("p_text"));;
				$editdatum = date("Y-m-d H:i:s",$thistime);
				$sqlabfrage1 = "UPDATE `".$sqlpraefix."posts` SET `text` = '$newposttext', `edituserid` = '$headeruserid', `editdatum` = '$editdatum' WHERE `id` ='$id'";

			mysql_query($sqlabfrage1);
			echo "\nPost ge&auml;ndert";
			echo "\n<br><a href=\"index.php?mode=posts&amp;threadid=$idb&amp;season=$seasonid\">";
			echo "Zum Thread zur&uuml;ck</a><br>";
			}
		else // Formular
			{
			$sqlabfrage1 = "SELECT `threadid` FROM `".$sqlpraefix."posts` WHERE `id` = '$id'";
			$sqlergebnis1 = mysql_query($sqlabfrage1);
			while($rowa = mysql_fetch_object($sqlergebnis1))
				{
				$idb=$rowa->threadid;
				}

			$sqlabfrage1 = "SELECT `name`,`forumid` FROM `".$sqlpraefix."threads` WHERE `id` = '$idb'";
			$sqlergebnis1 = mysql_query($sqlabfrage1);
			while($rowa = mysql_fetch_object($sqlergebnis1))
				{
				$threadname=$rowa->name;
				$ida=$rowa->forumid;
				}

			$sqlabfrage1 = "SELECT `name` FROM `".$sqlpraefix."forums` WHERE `id` = '$ida'";
			$sqlergebnis1 = mysql_query($sqlabfrage1);
			while($rowb = mysql_fetch_object($sqlergebnis1))
				{
				$forumname=$rowb->name;
				}

			echo "\n<table width=\"100%\">";
			echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"100%\"><font color=\"$colortextdunkel\">";
			if($seasonid=="")
				{
				echo "\n<a href=\"index.php?mode=forums\">Forum/a> -> ";
				echo "\n<a href=\"index.php?mode=threads&amp;forumid=$ida\">$forumname</a> -> ";
				echo "\n<a href=\"index.php?mode=posts&amp;threadid=$idb\">$threadname</a> -> ";
				}
			else
				{
				echo "\n<a href=\"index.php?mode=forums&amp;season=$seasonid\">Forum</a> -> ";
				echo "\n<a href=\"index.php?mode=threads&amp;forumid=$ida&amp;season=$seasonid\">$forumname</a> -> ";
				echo "\n<a href=\"index.php?mode=posts&amp;threadid=$idb&amp;season=$seasonid\">$threadname</a> -> ";
				}
			echo "Post &auml;ndern";
			echo "\n</font>";
			echo "\n</td></tr></table><br>";

			$sqlabfrage1 = "SELECT text FROM `".$sqlpraefix."posts` WHERE `id` = '$id'";
			$sqlergebnis1 = mysql_query($sqlabfrage1);
			while($row = mysql_fetch_object($sqlergebnis1))
				{
				$text=$row->text;
				}
			echo "\n<form action=\"index.php?mode=edit&amp;id=$id&amp;order=3&amp;adminedit=1&amp;season=$seasonid\" method=\"post\">";
			echo "\nBeitrag:<br><textarea name=\"p_text\" rows=\"14\" cols=\"50\">$text</textarea><br><br>";
			echo "\n<input type=\"submit\" value=\"&auml;ndern\"></form>";
			}
		}
	}
else
	{
	echo "\n<table width=\"100%\">";
	echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"100%\"><font color=\"$colortextdunkel\">";
	if($seasonid=="")
		{
		echo "\n<a href=\"index.php?mode=forums\">Forum</a>";
		}
	else
		{
		echo "\n<a href=\"index.php?mode=forums&amp;season=$seasonid\">Forum</a>";
		}
	
	echo " -> Administrationsbefehl";
	
	echo "\n</font>";
	echo "\n</td></tr></table><br>";

	echo "Sie k&ouml;nnen den Befehl nur als Administrator ausf&uuml;hren";
	if($seasonid=="")
		{
		echo "\n<br><a href=\"index.php\">Zum Forum zur&uuml;ck</a><br>";
		}
	else
		{
		echo "\n<br><a href=\"index.php?season=$seasonid\">Zum Forum zur&uuml;ck</a><br>";
		}
	}
mysql_close($sqlconnection);


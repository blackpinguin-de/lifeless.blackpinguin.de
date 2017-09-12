<?php


echo "\n<table width=\"100%\">";
echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"100%\"><font color=\"$colortextdunkel\">";
if($seasonid=="")
	{
	echo "\n<a href=\"index.php\">Forum</a>";
	}
else
	{
	echo "\n<a href=\"index.php?mode=forums&amp;season=$seasonid\">Index</a>";
	}

echo " -> Administrationsbefehl";

echo "\n</font>";
echo "\n</td></tr></table><br>";


if($headeruserrang!=2)
	{
	echo "Sie k&ouml;nnen den Befehl nur als Administrator ausf&uuml;hren";
	if($seasonid=="")
		{
		echo "\n<br><a href=\"index.php?mode=forums&amp;\">Zum Forum zur&uuml;ck</a><br>";
		}
	else
		{
		echo "\n<br><a href=\"index.php?mode=forums&amp;season=$seasonid\">Zum Forum zur&uuml;ck</a><br>";
		}
	}
else
	{
	$id=mysql_real_escape_string($_GET["id"]);
	$order=mysql_real_escape_string($_GET["order"]);
	if($id!="" && $order !="")
		{
		//Adminbefehle hier rein

		echo "<font color=\"#FFFFFF\">Befehl: <b>";
		if($order==0) //threadclose need: threadid
			{
			$sqlabfrage = "UPDATE `".$sqlpraefix."threads` SET `modus` = '2' WHERE `id` =$id";
			echo "Thread CLOSE";
			}
	
		if($order==1) //threaddelete need:threadid
			{
			$sqlabfrage = "UPDATE `".$sqlpraefix."threads` SET `modus` = '3' WHERE `id` =$id";
			echo "Thread DELETE";
			}
	
	
		if($order==2) //forumclose need: forumid
			{
			$sqlabfrage = "UPDATE `".$sqlpraefix."forums` SET `modus` = '2' WHERE `id` =$id";
			echo "Forum CLOSE";
			}
	
	
		if($order==3) //forumdelete need: forumid
			{
			$sqlabfrage = "UPDATE `".$sqlpraefix."forums` SET `modus` = '3' WHERE `id` =$id";
			echo "Forum DELETE";
			}
	
	
		if($order==4) //postdelete need postid
			{
			$sqlabfrage = "UPDATE `".$sqlpraefix."posts` SET `deleted` = '1' WHERE `id` =$id";
			echo "Post DELETE";
			}




		if($order==5) //threadnormal need: threadid
			{
			$sqlabfrage = "UPDATE `".$sqlpraefix."threads` SET `modus` = '1' WHERE `id` =$id";
			echo "Thread NORMAL";
			}
	
	
		if($order==6) //forumnormal need: forumid
			{
			$sqlabfrage = "UPDATE `".$sqlpraefix."forums` SET `modus` = '1' WHERE `id` =$id";
			echo "Forum NORMAL";
			}

	
		if($order==7) //postnormal need postid
			{
			$sqlabfrage = "UPDATE `".$sqlpraefix."posts` SET `deleted` = '0' WHERE `id` =$id";
			echo "Post NORMAL";
			}

		if($order==8) //usersperren need userid
			{
			$sqlabfrage = "UPDATE `".$sqlpraefix."users` SET `rang` = '0' WHERE `id` =$id";
			echo "User BAN";
			}

		if($order==9) //usernormal need userid
			{
			$sqlabfrage = "UPDATE `".$sqlpraefix."users` SET `rang` = '1' WHERE `id` =$id";
			echo "User NORMAL";
			}

		if($order==10) //usernormal need userid
			{
			$sqlabfrage = "UPDATE `".$sqlpraefix."users` SET `rang` = '2' WHERE `id` =$id";
			echo "User ADMIN";
			}
		echo " id = $id</b><br>";
		mysql_query($sqlabfrage);
		echo "Erfolgreich ausgef&uuml;hrt</font><br>";
		}
	else
		{
		echo "'ID' oder 'Order' nicht korrekt angegeben<br>";
		if($seasonid=="")
			{
			echo "\n<br><a href=\"index.php?mode=forums\">Zum Forum zur&uuml;ck</a><br>";
			}
		else
			{
			echo "\n<br><a href=\"index.php?mode=forums&amp;season=$seasonid\">Zum Forum zur&uuml;ck</a><br>";
			}
		}
	}
?>

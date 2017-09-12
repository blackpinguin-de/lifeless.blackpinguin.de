<?php
echo "\n<table width=\"100%\">";
echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"100%\"><font color=\"$colortextdunkel\">";
if($seasonid=="")
	{
	echo "\n<a href=\"index.php?mode=register\">Registrieren</a>";
	}
else
	{
	echo "\n<a href=\"index.php?mode=register&season=$seasonid\">Registrieren</a>";
	}
echo "\n</font>";

echo "\n</td></tr></table><br>";





if($seasonid!="")
	{
	echo "Sie haben bereits einen Account<br>";
	echo "\n<br><a href=\"index.php?season=$seasonid\">Zum Index zur&uuml;ck</a><br>";
	}

else
	{
	$fakename = post('p_name');
	$fakepwd = post('p_pwd');
	$fakepwdc = post('p_pwdc');
	$fakeemail = post('p_email');
	$fakeemailc = post('p_emailc');
	
	
	
	if($fakename == "" || $fakepwd == "" || $fakepwdc == "" || $fakeemail == "" || $fakeemailc == "")
		{

		echo "\n<form action=\"index.php?mode=register\" method=\"post\">";
		echo "\nBenutzername:<br><input name=\"p_name\" type=\"text\"  size=\"40\" maxlength=\"20\"><br><br>";
		echo "\nPasswort:<br><input name=\"p_pwd\" type=\"password\"  size=\"40\" maxlength=\"50\"><br>";
		echo "\n<input name=\"p_pwdc\" type=\"password\"  size=\"40\" maxlength=\"50\"><br><br>";
		echo "\neMail:<br><input name=\"p_email\" type=\"text\"  size=\"40\" maxlength=\"80\"><br>";
		echo "\n<input name=\"p_emailc\" type=\"text\"  size=\"40\" maxlength=\"80\"><br>";
		echo "\nzeigen?:<input type=\"checkbox\" name=\"p_emailv\" value=\"true\"><br><br>";
		echo "\nSignatur:<br><input name=\"p_sig\" type=\"text\"  size=\"40\" maxlength=\"200\"><br>";
		echo "\nAvatar:<br><input name=\"p_ava\" type=\"text\"  size=\"40\" maxlength=\"100\" value=\"http://\"><br>";
		echo "\nGeburtsdatum:<br>";
		echo "\nTag: <input name=\"p_geb_d\" type=\"text\" size=\"3\" maxlength=\"2\" value=\"00\"> ";
		echo "\nMonat: <input name=\"p_geb_m\" type=\"text\" size=\"3\" maxlength=\"2\" value=\"00\"> ";
		echo "\nJahr: <input name=\"p_geb_y\" type=\"text\" size=\"6\" maxlength=\"4\" value=\"0000\"><br><br>";
		echo "\n<input type=\"submit\" value=\"Registrieren\"></form>";

		}


	else
		{
		if(($fakepwd==$fakepwdc) && ($fakeemail==$fakeemailc))
			{
			$fakesig = post('p_sig');
			$fakeava = post('p_ava');
			$fakegeby = post('p_geb_y');
			$fakegebm = post('p_geb_m');
			$fakegebd = post('p_geb_d');
			$fakeemailv = post('p_emailv');
			
			
			$name=htmlentities($fakename);
			$passwd=md5(str_rot13(md5(crc32(md5(str_rot13(md5(crc32(md5(strtoupper($fakepwd))))))))));
			$email=htmlentities($fakeemail);
			$signatur=htmlentities($fakesig);
			$avatar=htmlentities($fakeava);
			$bday=htmlentities($fakegeby);
			$bday.="-";
			$bday.=htmlentities($fakegebm);
			$bday.="-";
			$bday.=htmlentities($fakegebd);
			$thistime=time();
			$register=date("Y-m-d",$thistime);
			if($fakeemailv=="true"){$emailv=1;}
			else {$emailv=0;}
			$sqlquery1 = "SELECT id FROM `".$sqlpraefix."users` WHERE `name`='$name'";
			$sqlresult1= mysql_query($sqlquery1);
			while($rowb = mysql_fetch_object($sqlresult1))
				{
				$tempidzahl=$rowb->id;
				}
			if($tempidzahl != "")
				{
				echo "\nDer Benutzername ist bereits vorhanden.<br>";
				echo "\n<br><a href=\"index.php?mode=register\">Zur&uuml;ck</a><br>";
				}
			else
				{
				$sqlquery1 = "INSERT INTO `".$sqlpraefix."users` ";
				$sqlquery1 .= "( `id` , `name` , `passwd` , `rang` , `semail`,";
				$sqlquery1 .= " `email` , `signatur` , `avatar` , `register` , `birthday` ) ";
				$sqlquery1 .= "VALUES ('', '$name', '$passwd', '0', '$emailv', '$email', '$signatur', '$avatar', '$register', '$bday')";
				mysql_query($sqlquery1);
				echo "\nIhr Account wurde erstellt, um sich einloggen zu k&ouml;nnen muss ihr Account erst von einem Administrator freigegeben werden.<br>";
				echo "\n<br><a href=\"index.php?mode=forums\">Zum Forum zur&uuml;ck</a><br>";
				}
			}
		else
			{
			echo "\nDie eMail / Passwort wiederholung muss mit ihrer/m angegebenen eMail / Passwort &uuml;bereinstimmen.<br>";
			echo "\n<br><a href=\"index.php?mode=register\">Zur&uuml;ck</a><br>";

			}
		}
	}
mysql_close($sqlconnection);


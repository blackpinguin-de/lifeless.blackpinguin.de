<?php

echo "\n<table width=\"100%\">";
echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"100%\"><font color=\"$colortextdunkel\">";

	echo "\n<a href=\"index.php?mode=login\">Login</a>";


echo "\n</font>";

echo "\n</td></tr></table><br>";





if($seasonid != "")
{
echo "Sie sind bereits eingeloggt.";
echo "<a href=\"index.php?mode=logout&amp;season=",$seasonid,"\">ausloggen?</a><br>";
}

else
{
$user=mysql_real_escape_string($_POST["p_user"]);
$pass=mysql_real_escape_string($_POST["p_passwd"]);

if($user == "" || $pass == "")
{
echo "<form name=\"login\" action=\"index.php\" method=\"post\">";
echo "Benutzername: <input name=\"p_user\" type=\"text\"  size=\"40\" maxlength=\"20\"><br>";
echo "Passwort: <input name=\"p_passwd\" type=\"password\"  size=\"40\" maxlength=\"50\"><br>";
echo "<input type=\"submit\" value=\"Ok\"></form>";
}

}
mysql_close($sqlconnection);
?>

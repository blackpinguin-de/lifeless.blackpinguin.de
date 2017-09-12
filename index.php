<?php
include_once("/rcl/www/funktionen.php");
include_once("inhalt/config.php");

function bbcodepost($string)
    {
	global $colortextlinkhell;
	$string =  str_replace("[img]", "<img alt=\"\" height=\"190\" width=\"250\" border=\"0\" src=\"", $string);
	$string =  str_replace("[/img]", "\">", $string);
	$string =  str_replace("[link]", "<a href=\"", $string);
	$string =  str_replace("[/link]", "\"><font color=\"$colortextlinkhell\">link</font></a>", $string);
	return $string;
    }

function bbcodenews($string)
    {
	global $colortextlinkhell;
	$string =  str_replace("[img]", "<img alt=\"\" height=\"340\" width=\"450\" border=\"0\" src=\"", $string);
	$string =  str_replace("[/img]", "\">", $string);
	$string =  str_replace("[link]", "<a href=\"", $string);
	$string =  str_replace("[/link]", "\"><font color=\"$colortextlinkhell\">link</font></a>", $string);
	return $string;
	}

/*
function bbcodenews($string)
{
$string = eregi_replace("\[b\]([^\[]+)\[/b\]","<b>\\1</b>",$string);
$string = eregi_replace("\[i\]([^\[]+)\[/i\]","<i>\\1</i>",$string);
$string = eregi_replace("\[u\]([^\[]+)\[/u\]","<u>\\1</u>",$string);
$string = eregi_replace("\[img\]([^\[]+)\[/img\]","<img src=\"\\1\" border=\"0\">",$string);
$string= eregi_replace("\[url\]([^\[]+)\[/url\]","<a href=\"\\1\" target=\"_blank\">\\1</a>",$string);
$string= eregi_replace("\[url=\"([^\"]+)\"]([^\[]+)\[/url\]","<a href=\"\\1\" target=\"_blank\">\\2</a>",$string);
}
*/



$counterausgabe=0;
include("inhalt/counter.php");


$seasonid = "";
$loginerror = 0;
$abcdeferror = 0;
$fakedseason = get("season");

if($fakedseason != "")
	{
	$thistime=time();
	$seasonid = $fakedseason;
	$sqlquery = "SELECT * FROM `".$sqlpraefix."season`";
	$sqlresult = mysql_query($sqlquery);
	while($row = mysql_fetch_object($sqlresult))
		{
		if($seasonid == $row->key)
			{
			$sqltime=$row->expire;
			$sqlseasonuserid=$row->userid;
			}
		}
	if((strtotime($sqltime))<$thistime)
		{
		$sqlquery = "DELETE FROM `".$sqlpraefix."season` WHERE `key` = '$seasonid' LIMIT 1";
		mysql_query($sqlquery);
		$seasonid = "";
		$loginerror = 1; //season abgelaufen
		}
	else
		{
		$thistime=time();
		$datum=date("Y-m-d H:i:s",($thistime+900));
		$sqlquery = "UPDATE `".$sqlpraefix."season` SET `expire` = '$datum' WHERE `key` = '$seasonid'";
		mysql_query($sqlquery);
		}
	}

if($fakedseason == "")
	{
	$fakeuser = post("p_user");
	$fakepass = post("p_passwd");
	if ($fakeuser != "" || $fakepass != "")
		{
		$user = $fakeuser;
		$passwd = md5(str_rot13(md5(crc32(md5(str_rot13(md5(crc32(md5(strtoup($fakepass))))))))));

		$sqlquery = "SELECT * FROM `".$sqlpraefix."users`";
		$sqlresult = mysql_query($sqlquery);
		while($row = mysql_fetch_object($sqlresult))
			{
			if(strtoup($row->name) == strtoup($user))
				{
				$resultid = $row->id;
				$sqlseasonuserid = $resultid;
				$resultpasswd = $row->passwd;
				$resultrang = $row->rang;
				}
			}
		if($resultid != 0)
			{
			if($passwd == $resultpasswd && $resultrang != 0)
				{
				$sqlquery = "DELETE FROM `".$sqlpraefix."season` WHERE userid='$resultid'";
				mysql_query($sqlquery);

				$seasonid = md5(rand(1, 50000000));
				$sqlquery = "SELECT * FROM `".$sqlpraefix."season`";
				$sqlresult = mysql_query($sqlquery);
				$fehler=1;
				while($fehler==1)
					{
					while($row = mysql_fetch_object($sqlresult))
						{
						if($seasonid == $row->key)
							{
							$seasonid = md5(rand(1,50000000));break;
							}
						}
					$fehler = 0;
					}
				$thistime=time();
				$datum=date("Y-m-d H:i:s",($thistime+900));
				$sqlquery = "INSERT INTO `".$sqlpraefix."season` ( `id` , `userid` , `key` , `expire` )"; 
				$sqlquery .= "VALUES ('', '$resultid', '$seasonid', '$datum')";
				mysql_query($sqlquery);
				}
			else
				{
				$seasonid = "";
				$loginerror = 2; //passwort falsch abgelaufen
				}
			}
		else
			{
			$seasonid = "";
			$loginerror = 3; //user nicht gefunden
			}
		}
	else if (isset($_GET["p_user"]) || isset($_GET["p_passwd"]))
		{
		$seasonid = "";
		$loginerror = 3;
		}
	}


$headeruserid = 0;
$headeruserrang = 0;
if ($seasonid != "")
	{
	$thistime = time();
	$datum = date("Y-m-d H:i:s",($thistime+900));
	$sqlquery = "UPDATE `".$sqlpraefix."season` SET `expire` = '$datum' WHERE `key` = '$seasonid'";
	mysql_query($sqlquery);

	$headeruserid = $sqlseasonuserid;
	
	$sqlquery = "SELECT * FROM `".$sqlpraefix."users` WHERE id=$headeruserid";
	$sqlresult = mysql_query($sqlquery);
	while($row = mysql_fetch_object($sqlresult))
		{
		$headerusername = $row->name;
		$headeruserrang = (int) $row->rang;
		}
	// $headeruserid
	// $headerusername
	// $headeruserrang
	}
?>
<!doctype html public '-//W3C//DTD HTML 4.01 Strict//DE'>
<html lang="de">
<head>
<title>Lifeless</title>
</head>
<?php
echo "<body text=\"#ffffff\" link=\"$colortextlinkdunkel\" alink=\"$colortextlinkdunkel\" vlink=\"$colortextlinkdunkel\"  bgcolor=\"#000000\">"
?>
<br>


<table border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td colspan="2"><img src="img/style/lifelessbanner.gif" alt="" border="0"></td>
</tr>
<tr>
<td valign="top">
<table border="0" cellspacing="0" cellpadding="0" align="left" width="150">
<tr><td height="70" style="background-image:url(img/style/navi_up.gif);"></td></tr>
<tr><td height="299" style="background-image:url(img/style/navi_middle.gif);" align="center">

<?php
$fakemode = get("mode");

if($seasonid == "" || $fakemode == "logout")
{
echo "\n<a href=\"index.php\">News</a><br>";
echo "\n<a href=\"index.php?mode=forums\">Forum</a><br>";
echo "\n<a href=\"index.php?mode=member\">Mitglieder</a><br>";
echo "\n<a href=\"index.php?mode=glead\">Gildenleitung</a><br>";
echo "\n<a href=\"index.php?mode=dkp\">DKP-System</a><br>";
echo "\n<a href=\"index.php?mode=login\">Login</a><br>";
echo "\n<a href=\"index.php?mode=register\">Registrieren</a><br>";
echo "\n<a href=\"index.php?mode=bewerbung\">Bewerben</a><br>";
echo "\n<a href=\"index.php?mode=imp\">Impressum</a>";
}

if($seasonid != "" && $fakemode != "logout")
{
echo "\n<a href=\"index.php?season=$seasonid\">News</a><br>";
echo "\n<a href=\"index.php?mode=forums&amp;season=$seasonid\">Forum</a><br>";
echo "\n<a href=\"index.php?mode=member&amp;season=$seasonid\">Mitglieder</a><br>";
echo "\n<a href=\"index.php?mode=glead&amp;season=$seasonid\">Gildenleitung</a><br>";
echo "\n<a href=\"index.php?mode=dkp&amp;season=$seasonid\">DKP-System</a><br>";
echo "\n<a href=\"index.php?mode=profil&amp;season=$seasonid\">Profil</a><br>";
echo "\n<a href=\"index.php?mode=logout&amp;season=$seasonid\">Logout</a><br>";
echo "\n<a href=\"index.php?mode=imp&amp;season=$seasonid\">Impressum</a>";
}
?>
</td></tr>
<tr><td height="70" style="background-image:url(img/style/navi_down.gif);"></td></tr>
<tr>
<td align="center">
<br>
<font color="#ffffff">
<a href="https://validator.w3.org/check?uri=referer">
<img src="https://www.w3.org/Icons/valid-html401-blue" alt="Valid HTML 4.01 Transitional" border="0"></a>
<br>&copy; 2007<br>by Robin Ladiges
</font>
</td>
</table>

</td>
<td valign="top">

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td height="70" width="70" style="background-image:url(img/style/content_up_left.gif);"></td>
<td height="70" style="background-image:url(img/style/content_up.gif);"></td>
<td height="70" width="70" style="background-image:url(img/style/content_up_right.gif);"></td>
</tr>
<tr>
<td width="70" style="background-image:url(img/style/content_left.gif);"></td>
<td width="500" align="center" valign="top">
<?php

if($loginerror == 1 || $loginerror == 2 || $loginerror == 3)
	{
	$go ="inhalt/error.php";
	include_once($go);
	}
else
	{
	if($fakemode!="")
		{
		$go  ="inhalt/";
		$go .=$fakemode;
		$go .=".php";
		if($fakemode=="dkp")
			{
			$fakesite=get("site");
			if($fakesite!="")
				{
				$go2  ="inhalt/dkp/";
				$go2 .=$fakesite;
				$go2 .=".php";
				if (!file_exists($go2))
					{
					include_once("inhalt/404.php");
					mysql_close($sqlconnection);
					$abcdeferror=1;
					}
				}
			}
		else
			{
			if(!file_exists($go)) 
				{
				include_once("inhalt/404.php");
				mysql_close($sqlconnection);
				$abcdeferror=1;
				}
			}
		}
	if($abcdeferror!=1)
		{
		if($fakemode!="")
			{
			include_once("include.php");
			}
		else
			{
			include_once("inhalt/news.php");
			}
		if($fakemode!="posts")
			{
			echo "<br>";
			}
		}
	}


?>
</td>
<td width="70" style="background-image:url(img/style/content_right.gif);"></td>
</tr>
<tr>
<td height="70" width="70" style="background-image:url(img/style/content_down_left.gif);"></td>
<td height="70" style="background-image:url(img/style/content_down.gif);"></td>
<td height="70" width="70" style="background-image:url(img/style/content_down_right.gif);"></td>
</tr>
<tr><td align="right" colspan="3">
<?php
$counterausgabe=1;
include("inhalt/counter.php");
?> Besucher
</td></tr>
</table>
</td>
</tr>
</table>
</body>
</html>


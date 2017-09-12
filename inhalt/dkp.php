<?php

include_once("inhalt/dkp/dkpconfig.php");

echo "\n<table width=\"100%\">";
echo "\n<tr><td bgcolor=\"$colorbgdunkel\" width=\"70%\" align=\"center\"><font color=\"$colortextdunkel\">";

if($seasonid=="")
	{
	echo "\n<a href=\"index.php?mode=dkp&amp;site=overview\">&Uuml;bersicht</a> ";
	echo "\n<a href=\"index.php?mode=dkp&amp;site=raids\">Raids</a>";
	}
else
	{
	echo "\n<a href=\"index.php?mode=dkp&amp;site=overview&amp;season=$seasonid\">&Uuml;bersicht</a> ";
	echo "\n<a href=\"index.php?mode=dkp&amp;site=raids&amp;season=$seasonid\">Raids</a> ";
	echo "\n<a href=\"index.php?mode=dkp&amp;site=chars&amp;season=$seasonid\">Meine Chars</a>";
	if($headeruserrang==2)
		{
		echo " \n<a href=\"index.php?mode=dkp&amp;site=admin&amp;order=1&amp;season=$seasonid\">Raid hinzuf&uuml;gen</a> ";
		echo "\n<a href=\"index.php?mode=dkp&amp;site=admin&amp;order=2&amp;season=$seasonid\">Char hinzuf&uuml;gen</a> ";
		echo "\n<a href=\"index.php?mode=dkp&amp;site=admin&amp;order=3&amp;season=$seasonid\">Korrekturen</a>";
		}
	}
echo "\n</font>";
echo "\n</td>";
echo "</tr></table><br>";

$fakesite=get("site");

if($fakesite!="")
	{
	include_once("dkp/include.php");
	}
else
	{
	include_once("inhalt/dkp/overview.php");
	}



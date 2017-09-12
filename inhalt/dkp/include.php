<?php
switch ($go2)
{

case "inhalt/404.php":
include_once($go2);
break;

case "inhalt/dkp/admin.php":
include_once($go2);
break;

case "inhalt/dkp/chars.php":
include_once($go2);
break;

case "inhalt/dkp/dkpconfig.php":
include_once($go2);
break;

case "inhalt/dkp/overview.php":
include_once($go2);
break;

case "inhalt/dkp/raid.php":
include_once($go2);
break;

case "inhalt/dkp/raids.php":
include_once($go2);
break;

case "inhalt/dkp/admin/charadd.php":
include_once($go2);
break;

case "inhalt/dkp/admin/korrekturen.php":
include_once($go2);
break;

case "inhalt/dkp/admin/raidadd.php":
include_once($go2);
break;




default:
include_once("inhalt/404.php");
break;
}


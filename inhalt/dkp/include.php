<?php
switch ($go2)
{

case "inhalt/404.php":
include($go2);
break;

case "inhalt/dkp/admin.php":
include($go2);
break;

case "inhalt/dkp/chars.php":
include($go2);
break;

case "inhalt/dkp/dkpconfig.php":
include($go2);
break;

case "inhalt/dkp/overview.php":
include($go2);
break;

case "inhalt/dkp/raid.php":
include($go2);
break;

case "inhalt/dkp/raids.php":
include($go2);
break;

case "inhalt/dkp/admin/charadd.php":
include($go2);
break;

case "inhalt/dkp/admin/korrekturen.php":
include($go2);
break;

case "inhalt/dkp/admin/raidadd.php":
include($go2);
break;




default:
include("inhalt/404.php");
break;
}

?>
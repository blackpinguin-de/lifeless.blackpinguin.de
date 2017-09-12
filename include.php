<?php
switch ($go)
{

case "inhalt/404.php":
include($go);
break;

case "inhalt/admin.php":
include($go);
break;

case "inhalt/bewerbung.php":
include($go);
break;

case "inhalt/dkp.php":
include($go);
break;

case "inhalt/edit.php":
include($go);
break;

case "inhalt/eprofil.php":
include($go);
break;

case "inhalt/error.php":
include($go);
break;

case "inhalt/forums.php":
include($go);
break;

case "inhalt/glead.php":
include($go);
break;

case "inhalt/imp.php":
include($go);
break;

case "inhalt/login.php":
include($go);
break;

case "inhalt/logout.php":
include($go);
break;

case "inhalt/member.php":
include($go);
break;

case "inhalt/newpost.php":
include($go);
break;

case "inhalt/news.php":
include($go);
break;

case "inhalt/newthread.php":
include($go);
break;

case "inhalt/nowonline.php":
include($go);
break;

case "inhalt/posts.php":
include($go);
break;

case "inhalt/profil.php":
include($go);
break;

case "inhalt/register.php":
include($go);
break;

case "inhalt/threads.php":
include($go);
break;









default:
include("inhalt/404.php");
break;
}

?>
<?php
$sqluser="blackpinguin_02";
$sqlpasswd="mau5mmu6EAaA/KfXkcQP";
$sqlserver="localhost";
$sqldatenbank="blackpinguin_02";

$pageacount=10; //wieviele Posts pro Seite
$newscount=5; //wieviele News pro Seite
$newsforumid=3; //Forum in dem News gepostet werden
$bewerbungsforumid=5; //Forum in dem Bewerbungen gepostet werden


$sqlpraefix="lifeless_";

//forenfarben
$colorbgdunkel="#8b0000";
$colorbghell="#ff9999";
$colortextdunkel="#ffffff";
$colortexthell="#000000";
$colortextedit="#006400";
$colortextlinkdunkel="#ffffff";
$colortextlinkhell="#000000";

$sqlconnection=@mysql_connect($sqlserver, $sqluser, $sqlpasswd);
if (!$sqlconnection) {
    die('<br><br><br><br>Keine Verbindung mit MySQL-Datenbank möglich:<br><br><b>' . mysql_error() . '</b>');
}
mysql_select_db($sqldatenbank);
@mysql_query("set names 'utf8';");
?>

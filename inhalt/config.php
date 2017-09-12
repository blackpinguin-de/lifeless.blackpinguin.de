<?php

include_once("/rcl/www/funktionen.php");

$pageacount = 10; //wieviele Posts pro Seite
$newscount = 5; //wieviele News pro Seite
$newsforumid = 3; //Forum in dem News gepostet werden
$bewerbungsforumid = 5; //Forum in dem Bewerbungen gepostet werden


$sqlpraefix = "lifeless_";

//forenfarben
$colorbgdunkel       = "#8b0000";
$colorbghell         = "#ff9999";
$colortextdunkel     = "#ffffff";
$colortexthell       = "#000000";
$colortextedit       = "#006400";
$colortextlinkdunkel = "#ffffff";
$colortextlinkhell   = "#000000";


if ($err = mysql_init("localhost", "lifeless", "mau5mmu6EAaA/KfXkcQP", "lifeless")) {
    die('<br><br><br><br>Keine Verbindung mit MySQL-Datenbank möglich:<br><br><b>' . $err . '</b>');
}

$sqlconnection = $rcl->mysqli();


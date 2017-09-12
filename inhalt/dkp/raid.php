<?php
$raidid = (int) get('id');

$sqlraid  = "SELECT instanzen.name instanzname, raid.start raidstart, raid.ende raidende ";
$sqlraid .= "FROM `".$dkpsyntax."raid` raid ";
$sqlraid .= "LEFT JOIN `".$dkpsyntax."instanzen` instanzen ON `raid`.`instanz_id` = `instanzen`.`instanz_id` ";
$sqlraid .= "WHERE `raid`.`raid_id` = '$raidid' ";
$resraid  = mysql_query($sqlraid);
while($rowraid = mysql_fetch_object($resraid))
	{
	$instanzname=$rowraid->instanzname;
	$raidstart=$rowraid->raidstart;
	$raidende=$rowraid->raidende;


	$sqlwipes  = "SELECT COUNT(*) raidwipes ";
	$sqlwipes .= "FROM `".$dkpsyntax."wipes` wipes ";
	$sqlwipes .= "WHERE `wipes`.`raid_id` = '$raidid' ";
	$reswipes  = mysql_query($sqlwipes);
	while($rowwipes = mysql_fetch_object($reswipes))
		{
		$raidwipes=$rowwipes->raidwipes;
		}
		
	$sqlbosse  = "SELECT COUNT(*) raidbosse ";
	$sqlbosse .= "FROM `".$dkpsyntax."raid_bosse` raid_bosse ";
	$sqlbosse .= "WHERE `raid_bosse`.`raid_id` = '$raidid' ";
	$resbosse  = mysql_query($sqlbosse);
	while($rowbosse = mysql_fetch_object($resbosse))
		{
		$raidbosse=$rowbosse->raidbosse;
		}
		
		
		
	$sqlitems  = "SELECT COUNT(*) raiditems ";
	$sqlitems .= "FROM `".$dkpsyntax."raid_items` raid_items ";
	$sqlitems .= "WHERE `raid_items`.`raid_id` = '$raidid' ";
	$resitems  = mysql_query($sqlitems);
	while($rowitems = mysql_fetch_object($resitems))
		{
		$raiditems=$rowitems->raiditems;
		}

	}

echo "Raidid: $raidid <br>";
echo "Instanz: $instanzname <br>";
echo "Start: $raidstart <br>";
echo "Ende: $raidende <br>";
echo "Wipes: $raidwipes <br>";
echo "Items: $raiditems <br>";
echo "Bosskills: $raidbosse <br>";


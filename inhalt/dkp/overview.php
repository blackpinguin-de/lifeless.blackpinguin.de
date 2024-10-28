<?php

echo "<table width=\"90%\" align=\"center\"><tr>";
/*echo "<th align=\"center\">ID</th>"; */
echo "<th align=\"center\" bgcolor=\"$colorbgdunkel\"><font color=\"$colortextdunkel\">name</font></th>";
echo "<th align=\"center\" bgcolor=\"$colorbgdunkel\"><font color=\"$colortextdunkel\">class</font></th>";
echo "<th align=\"center\" bgcolor=\"$colorbgdunkel\"><font color=\"$colortextdunkel\">edit</font></th>";
echo "<th align=\"center\" bgcolor=\"$colorbgdunkel\"><font color=\"$colortextdunkel\">item</font></th>";
echo "<th align=\"center\" bgcolor=\"$colorbgdunkel\"><font color=\"$colortextdunkel\">boss</font></th>";
echo "<th align=\"center\" bgcolor=\"$colorbgdunkel\"><font color=\"$colortextdunkel\">wipe</font></th>";
echo "<th align=\"center\" bgcolor=\"$colorbgdunkel\"><font color=\"$colortextdunkel\">intime</font></th>";
echo "<th align=\"center\" bgcolor=\"$colorbgdunkel\"><font color=\"$colortextdunkel\">time</font></th>";
echo "<th align=\"center\" bgcolor=\"$colorbgdunkel\"><font color=\"$colortextdunkel\">all</font></th>";
echo "</tr>";


$sqlchars  = "SELECT chars.char_id charid, chars.name charname, klassen.name klassenname, klassen.rgb_farbe klassenfarbe ";
$sqlchars .= "FROM `".$dkpsyntax."chars` chars ";
$sqlchars .= "LEFT JOIN `".$dkpsyntax."klassen` klassen ON `chars`.`class_id` = `klassen`.`class_id` ";
$sqlchars .= "ORDER BY `chars`.`name`";
$reschars  = mysql_query($sqlchars);
while($rowchars = mysql_fetch_object($reschars))
	{
	$charid=$rowchars->charid;
	$charname=$rowchars->charname;
	$charklasse=$rowchars->klassenname;
	if($charklasse==""){$charklasse="unbekannt";}
	$klassenfarbe=$rowchars->klassenfarbe;
	if($klassenfarbe==""){$klassenfarbe=$colortexthell;}
	
	//WIPES
	$sqlwipes  = "SELECT COUNT(*) wipeanzahl ";
	$sqlwipes .= "FROM `".$dkpsyntax."chars` chars LEFT JOIN `".$dkpsyntax."raid_member` raid_member ON `chars`.`char_id` = `raid_member`.`char_id` ";
	$sqlwipes .= "LEFT JOIN `".$dkpsyntax."wipes` wipes ON `raid_member`.`raid_id`=`wipes`.`raid_id` ";
	$sqlwipes .= "WHERE `wipes`.`zeitpunkt` BETWEEN `raid_member`.`start` AND `raid_member`.`ende` ";
	$sqlwipes .= " AND `chars`.`char_id`='$charid'";
	$RSwipes = mysql_query($sqlwipes);
	while($rowwipes = mysql_fetch_object($RSwipes))
		{
		$raidwipes=$rowwipes->wipeanzahl;
		}

	//ZEITPUNKTE
	$memberraidtime=0;
	$intimedkp=0;
	$sqlzeit  = "SELECT `raid_member`.`start` start, `raid_member`.`ende` ende, `raid`.`start` raidstart ";
	$sqlzeit .= "FROM `".$dkpsyntax."chars` chars ";
	$sqlzeit .= "LEFT JOIN `".$dkpsyntax."raid_member` raid_member ON `chars`.`char_id` = `raid_member`.`char_id` ";
	$sqlzeit .= "LEFT JOIN `".$dkpsyntax."raid` raid ON `raid_member`.`raid_id` = `raid`.`raid_id` ";
	$sqlzeit .= "WHERE `chars`.`char_id`='$charid'";
	$RSzeit = mysql_query($sqlzeit);
	while($rowzeit = mysql_fetch_object($RSzeit))
		{
		$memberstart=strtotime($rowzeit->start);
		$memberende=strtotime($rowzeit->ende);
		$memberraidtime=$memberraidtime+($memberende-$memberstart);
		
		$raidstart=strtotime($rowzeit->raidstart);
		if($raidstart>=($memberstart-300))
			{$intimedkp=$intimedkp+$dkppuenktlich;}
		}
	
	
	//BOSSKILLDKP
	$bossdkp=0;
	$thisbossdkp=0;
	$sqlbosse  = "SELECT `bosse`.`dkp` dkpbosse, `raid_bosse`.`firstkill` firstkill ";
	$sqlbosse .= "FROM `".$dkpsyntax."chars` chars ";
	$sqlbosse .= "LEFT JOIN `".$dkpsyntax."raid_member` raid_member ON `chars`.`char_id` = `raid_member`.`char_id` ";
	$sqlbosse .= "LEFT JOIN `".$dkpsyntax."raid_bosse` raid_bosse ON `raid_member`.`raid_id` = `raid_bosse`.`raid_id` ";
	$sqlbosse .= "LEFT JOIN `".$dkpsyntax."bosse` bosse ON `raid_bosse`.`boss_id` = `bosse`.`boss_id` ";
	$sqlbosse .= "WHERE `chars`.`char_id`='$charid' AND ";
	$sqlbosse .= "`raid_bosse`.`zeitpunkt` BETWEEN `raid_member`.`start` AND `raid_member`.`ende` ";
	$RSbosse = mysql_query($sqlbosse);
	while($rowbosse = mysql_fetch_object($RSbosse))
		{
		$thisbossdkp=$rowbosse->dkpbosse;
		$fk=$rowbosse->firstkill;
		if($fk==true){$thisbossdkp=$thisbossdkp*$dkpfirstkillfaktor;}
		$bossdkp=$bossdkp+$thisbossdkp;
		}
	
	if($bossdkp=="")
		{
		$bossdkp=0;
		}
		
	//KORREKTUREN
	$sqlkorrekturen  = "SELECT SUM(`korrekturen`.`dkp`) dkpkorrekturen ";
	$sqlkorrekturen .= "FROM `".$dkpsyntax."chars` chars ";
	$sqlkorrekturen .= "LEFT JOIN `".$dkpsyntax."korrekturen` korrekturen ON `chars`.`char_id` = `korrekturen`.`char_id` ";
	$sqlkorrekturen .= "WHERE `chars`.`char_id`='$charid'";
	$RSkorrekturen = mysql_query($sqlkorrekturen);
	while($rowkorrekturen = mysql_fetch_object($RSkorrekturen))
		{
		$korrekturdkp=$rowkorrekturen->dkpkorrekturen;
		}
	if($korrekturdkp=="")
		{
		$korrekturdkp=0;
		}
	
	//Itemabzüge
	$sqlraiditems  = "SELECT SUM(`raid_items`.`dkp`) dkpraiditems ";
	$sqlraiditems .= "FROM `".$dkpsyntax."chars` chars ";
	$sqlraiditems .= "LEFT JOIN `".$dkpsyntax."raid_items` raid_items ON `chars`.`char_id` = `raid_items`.`char_id` ";
	$sqlraiditems .= "WHERE `chars`.`char_id`='$charid'";
	$RSraiditems = mysql_query($sqlraiditems);
	while($rowraiditems = mysql_fetch_object($RSraiditems))
		{
		$raiditemsdkp=$rowraiditems->dkpraiditems;
		}
	if($raiditemsdkp=="")
		{
		$raiditemsdkp=0;
		}
	
	
	$timedkp=number_format((($memberraidtime/60/60)*$dkpprostunde),0,".",".");
	$dkpwipes=$raidwipes*$dkpprowipe;
	$dkpgesammt=$korrekturdkp+$raiditemsdkp+$bossdkp+$dkpwipes+$timedkp+$intimedkp;
	
	echo "<tr>";
/*	echo "<td align=\"center\">$charid</td>";  */
	echo "<td align=\"center\" bgcolor=\"$colorbghell\"><a href=\"index.php?mode=dkp&amp;site=chars&amp;id=$charid\"><font color=\"$colortexthell\">$charname</font></a></td>";
	echo "<td align=\"center\" bgcolor=\"$colorbghell\"><font color=\"$klassenfarbe\">$charklasse</font></td>";
	echo "<td align=\"center\" bgcolor=\"$colorbghell\"><font color=\"$colortexthell\">$korrekturdkp</font></td>";
	echo "<td align=\"center\" bgcolor=\"$colorbghell\"><font color=\"$colortexthell\">$raiditemsdkp</font></td>";
	echo "<td align=\"center\" bgcolor=\"$colorbghell\"><font color=\"$colortexthell\">$bossdkp</font></td>";
	echo "<td align=\"center\" bgcolor=\"$colorbghell\"><font color=\"$colortexthell\">$dkpwipes</font></td>";
	echo "<td align=\"center\" bgcolor=\"$colorbghell\"><font color=\"$colortexthell\">$intimedkp</font></td>";
	echo "<td align=\"center\" bgcolor=\"$colorbghell\"><font color=\"$colortexthell\">$timedkp</font></td>";
	echo "<td align=\"center\" bgcolor=\"$colorbghell\"><font color=\"$colortexthell\">$dkpgesammt</font></td>";
	echo "</tr>";

	}
echo "</table>";


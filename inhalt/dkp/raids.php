<?php




echo "<table width=\"90%\" align=\"center\"><tr>";
echo "<th align=\"center\" bgcolor=\"$colorbgdunkel\"><font color=\"$colortextdunkel\">instanz</font></th>";
echo "<th align=\"center\" bgcolor=\"$colorbgdunkel\"><font color=\"$colortextdunkel\">datum</font></th>";
echo "<th align=\"center\" bgcolor=\"$colorbgdunkel\"><font color=\"$colortextdunkel\">wipes</font></th>";
echo "<th align=\"center\" bgcolor=\"$colorbgdunkel\"><font color=\"$colortextdunkel\">bosse</font></th>";
echo "<th align=\"center\" bgcolor=\"$colorbgdunkel\"><font color=\"$colortextdunkel\">items</font></th>";
echo "<th align=\"center\" bgcolor=\"$colorbgdunkel\"><font color=\"$colortextdunkel\">member</font></th>";
echo "<th align=\"center\" bgcolor=\"$colorbgdunkel\"><font color=\"$colortextdunkel\">dkp</font></th>";
echo "</tr>";




$sqlraid  = "SELECT raid.raid_id raidid, instanzen.name instanzname, raid.start raidstart, raid.ende raidende ";
$sqlraid .= "FROM `".$dkpsyntax."raid` raid ";
$sqlraid .= "LEFT JOIN `".$dkpsyntax."instanzen` instanzen ON `raid`.`instanz_id` = `instanzen`.`instanz_id` ";
$resraid  = mysql_query($sqlraid);	
while($rowraid = mysql_fetch_object($resraid))
	{
	$raidid=$rowraid->raidid;
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
		
	$bossdkp=0;
	$sqlbosse  = "SELECT COUNT(*) raidbosse, raid_bosse.boss_id bossid, `raid_bosse`.`firstkill` firstkill ";
	$sqlbosse .= "FROM `".$dkpsyntax."raid_bosse` raid_bosse ";
	$sqlbosse .= "WHERE `raid_bosse`.`raid_id` = '$raidid' ";
	$sqlbosse .= "GROUP BY `bossid`";
	$resbosse  = mysql_query($sqlbosse);	
	while($rowbosse = mysql_fetch_object($resbosse))
		{
		$raidbosse=$rowbosse->raidbosse;	
		$fk=$rowbosse->firstkill;
		$thisbossdkp=0;
		$thisbossid=$rowbosse->bossid;
		
		$sqlbossdkp  = "SELECT `bosse`.`dkp` dkpbosse ";
		$sqlbossdkp .= "FROM `".$dkpsyntax."bosse` bosse ";
		$sqlbossdkp .= "WHERE `bosse`.`boss_id` = '$thisbossid'";
		$resbossdkp  = mysql_query($sqlbossdkp);	
		while($rowbossdkp = mysql_fetch_object($resbossdkp))
			{
			$thisbossdkp=$rowbossdkp->dkpbosse;
			$fk=$rowbosse->firstkill;
			if($fk==true){$thisbossdkp=$thisbossdkp*$dkpfirstkillfaktor;}
			$bossdkp=$bossdkp+$thisbossdkp;
			}		
		}
	if($raidbosse==""){$raidbosse="0";}
		
		
		
	$sqlitems  = "SELECT COUNT(*) raiditems ";
	$sqlitems .= "FROM `".$dkpsyntax."raid_items` raid_items ";
	$sqlitems .= "WHERE `raid_items`.`raid_id` = '$raidid' ";
	$resitems  = mysql_query($sqlitems);	
	while($rowitems = mysql_fetch_object($resitems))
		{
		$raiditems=$rowitems->raiditems;
		}

		
	$sqlmember  = "SELECT COUNT(*) raidmember ";
	$sqlmember .= "FROM `".$dkpsyntax."raid_member` raid_member ";
	$sqlmember .= "WHERE `raid_member`.`raid_id` = '$raidid' ";
	$resmember  = mysql_query($sqlmember);	
	while($rowmember = mysql_fetch_object($resmember))
		{
		$raidmember=$rowmember->raidmember;
		}
		
		
	$wipedkp=$raidwipes*$dkpprowipe;
	
	$raidtime=strtotime($raidende)-strtotime($raidstart);
	$timedkp=number_format((($raidtime/60/60)*$dkpprostunde),0,".",".");
	
	$dkpgesammt=$bossdkp+$wipedkp+$timedkp+$dkppuenktlich;
	
	echo "<tr>";
	echo "<td align=\"center\" bgcolor=\"$colorbghell\"><a href=\"index.php?mode=dkp&amp;site=raid&amp;id=$raidid\"><font color=\"$colortexthell\">$instanzname</font></a></td>";
	echo "<td align=\"center\" bgcolor=\"$colorbghell\"><font color=\"$colortexthell\">".date("d.m.Y",(strtotime($raidstart)))."</font></td>";
	echo "<td align=\"center\" bgcolor=\"$colorbghell\"><font color=\"$colortexthell\">$raidwipes</font></td>";
	echo "<td align=\"center\" bgcolor=\"$colorbghell\"><font color=\"$colortexthell\">$raidbosse</font></td>";
	echo "<td align=\"center\" bgcolor=\"$colorbghell\"><font color=\"$colortexthell\">$raiditems</font></td>";
	echo "<td align=\"center\" bgcolor=\"$colorbghell\"><font color=\"$colortexthell\">$raidmember</font></td>";
	echo "<td align=\"center\" bgcolor=\"$colorbghell\"><font color=\"$colortexthell\">$dkpgesammt</font></td>";
	echo "</tr>";
	
	
	
	
	
	}
echo "</table>";




?>
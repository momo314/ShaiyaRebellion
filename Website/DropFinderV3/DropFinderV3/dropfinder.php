<html>
<head>
<title>Shaiya Drop Finder V3</title>
<link rel="stylesheet" type="text/css" href="css/theme.css">
</head>
<body>
<section id="main">
<section id="content">
<?php 
/*
DESC: 			This page don't need changes to work
INCLUDED BY: 	N/A
CREATOR:		Trayne01
LAST DATE:		27/07/2016 4 h 43 pm
*/

include('inc/odbcConnect.php');
include('inc/ItemBlacklist.php');

?>
		<center>
			<h2>Shaiya Drop Finder !</h2>
			<form action = "<?php echo($_SERVER['PHP_SELF']); ?>" method="post">
			<small>You can press the first letter of your item name to find it quickly!</small>
				<p>Item Name <select name = "Var1">
				
		<?php
	$query = odbc_prepare($odb_conn,"SELECT * FROM PS_GameDefs.dbo.Items WHERE LEFT(ItemName, 1) != '?' AND ItemID not in ".$item_blacklist." ORDER BY ItemName Asc");
	odbc_execute($query);
    while ($row=odbc_fetch_array($query)) {
        echo('<option value="'.$row['ItemID'].'">'.$row['ItemName'].'</option>');
    }
?>
							</select>
							<br />
				</p>
				<br/>
				<input type="submit" name="send_price" value="Find">
			</form>
			<br/>
			<?php 
			if(isset($_POST["Var1"])){
			$ele = array(0 => 'None', 1 => 'Fire', 2=> 'Water', 3=> 'Earth', 4=> 'Wind');
			
			$itemid = $_POST["Var1"];
			
			
			$query = odbc_prepare($odb_conn, "SELECT TOP 1 ItemName FROM PS_GameDefs.dbo.Items WHERE ItemID = ? ;");
			odbc_execute($query, array($itemid));
			while($row=odbc_fetch_array($query)) {
			$DisplayItemName=$row["ItemName"];
			}

		
		$query = odbc_prepare($odb_conn, "USE PS_GameDefs
		SELECT dbo.Mobs.MobID, dbo.Mobs.MobName, dbo.Mobs.HP, dbo.Mobs.Level, dbo.Mobs.Attrib, dbo.MobItems.DropRate, dbo.MobItems.ItemOrder, dbo.MapNames.MapName
			FROM dbo.MobItems 
			INNER JOIN Mobs ON dbo.Mobs.MobID = dbo.MobItems.MobID 
				  JOIN MapNames ON dbo.Mobs.MapID = dbo.MapNames.MapID
		WHERE Grade = (SELECT TOP 1 Grade FROM PS_GameDefs.dbo.Items WHERE ItemID = ?) ORDER BY dbo.MobItems.DropRate DESC");
			odbc_execute($query, array($itemid));
			$countt=0;
	while($row=odbc_fetch_array($query)) {
			
			if($countt == 0){
				echo "<center>Monsters who are dropping: $DisplayItemName
				  <table cellspacing=1 cellpadding=2 border=1 style=\"border-style:hidden;\">
				  <tr>
				  <th>Name Monster</th>
				  <th>Mob HP</th>
				  <th>Mob Level</th>
				  <th>Mob Ele</th>
				  <th>Drop Percentage Rate</th>
				  <th>Map Name</th>
				  </tr>";
				  $countt=1;
			}
				  
				  echo "<tr>";
					echo "<td>";				
					echo utf8_encode($row['MobName']);
					echo "</td>";
					echo "<td>";
					echo $nombre_format_francais = number_format($row['HP'], 2, '.', ',');
					echo "</td>";
					echo "<td>";
					echo ($row['Level']);
					echo "</td>";
					echo "<td>";
					echo ($ele[$row['Attrib']].' <img src="img/ele_'.$row['Attrib'].'.png" />');
					echo "</td>";
					echo "<td>";
					$DropRate=$row['DropRate'];
						if ($row['ItemOrder'] > 4)
						{
							$DropRate=($DropRate/100000);
						}
						if ($DropRate > 100)
						{
							$DropRate=100;
						}
					echo (($DropRate)." %");
					echo "</td>";
					echo "<td>";
					echo ($row['MapName']);
					echo "</td>";
					echo "</tr>";
			}
			if($countt==1){
				echo "</table></center>";  
			}else{
				echo"The wished items: $DisplayItemName can't be dropped for now! Contact our staff if you think that it an error!";
			}
			
			
			
			
			}
		
		
	

?>
			<br/>
		</center>
		</section>			<center><div id="footer"><small> <font color="white">Original programming by Trayne01, 2016.</font></small></div></center>
</section>
</body>
</html>
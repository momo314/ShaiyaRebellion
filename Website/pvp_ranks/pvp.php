<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shaiya Extenza - PvP Ranks</title>
<link rel="icon" href="./favicon.ico" type="image/x-icon">
<link href="./style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="./contentslider.css" />
<script type="text/javascript" src="./contentslider.js">
</script>
</head>
<body>
<script language="javascript"
type="text/javascript"
src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js">
 
</script>
 
 
<script type="text/javascript" language="javascript">
 
     $(function() {
 
            $(this).bind("contextmenu", function(e) {
 
                e.preventDefault();
 
            });
 
        }); 
</script>
	
				<div class="templatemo_post">
                    
                    <div class="post_body">
						<?
						$page=$_SERVER['PHP_SELF'];
						$dbhost='127.0.0.1';
						$dbuser='Vodkaa';
						$dbpass='Mnbdmx66';
						$dbname='PS_UserData';
						function FormatErrors($error){
						//	Display errors.
    						echo "Error information: <br/>";
						echo "SQLSTATE: ".$error[0]."<br/>";
						echo "Code: ".$error[1]."<br/>";
						echo "Message: ".$error[2]."<br/><br/>";
						}
						try {
							$conn= new PDO("sqlsrv:Server=$dbhost;Database=$dbname", $dbuser, $dbpass);
						}
						catch (PDOException $e) {
						die("Failed to connect to database.");
						}
						echo "<center><a href=\"".$page."?faction=2&class=6\"><img src=\"./ranking_images/Alliance-of-Light.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"".$page."?faction=1&class=6\"><img src=\"./ranking_images/Union-of-Fury.jpg\"></a></center>";
							if ((isset($_GET['faction'])) && (!empty($_GET['faction']))) {
							$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
							JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
							JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
							WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1, c.K2, c.CharName DESC');
								if($selecteverything == false) {
									echo "Error in preparing the select query.<br />";
									die(FormatErrors($conn->errorInfo()));
								} else {
									if ($_GET['faction'] == 2) {
									//light
									echo "<center><a href=\"".$page."?faction=2&class=6\"><img src=\"./ranking_images/Fighter.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href=\"".$page."?faction=2&class=1\"><img src=\"./ranking_images/Defender.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href=\"".$page."?faction=2&class=2\"><img src=\"./ranking_images/Ranger.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href=\"".$page."?faction=2&class=3\"><img src=\"./ranking_images/Archer.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href=\"".$page."?faction=2&class=4\"><img src=\"./ranking_images/Mage.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href=\"".$page."?faction=2&class=5\"><img src=\"./ranking_images/Priest.jpg\"></a>";
									$faction=0;
										if((isset($_GET['class'])) && (!empty($_GET['class']))) {
										// si la classe est choisie
										$job=$_GET['class'];
										if($job == 6) {
										$job=0;
										echo "<center><table border=\"1\" width=\"530\">";
										echo "<tr><td colspan=\"4\"><center>LIGHT --- FIGHTER</td></tr>";
										echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
										$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
										JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
										JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
										WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
											if($selecteverything == false) {
												echo "Error in preparing the select query.<br />";
												die(FormatErrors($conn->errorInfo()));
											} else {
											$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
											$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
												if($selecteverything->execute() == false) {
													echo "Error while executing query to select the ranked chars.<br />";
													die(FormatErrors($selecteverything->errorInfo()));
												} else {
												$begin=1;
													for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
														if($i >= $begin) {
															echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
														}
													}
												}
											}
										} elseif ($job == 1) {
										echo "<center><table border=\"1\" width=\"530\">";
										echo "<tr><td colspan=\"4\"><center>LIGHT --- DEFENDER</td></tr>";
										echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
										$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
										JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
										JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
										WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
											if($selecteverything == false) {
												echo "Error in preparing the select query.<br />";
												die(FormatErrors($conn->errorInfo()));
											} else {
											$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
											$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
												if($selecteverything->execute() == false) {
													echo "Error while executing query to select the ranked chars.<br />";
													die(FormatErrors($selecteverything->errorInfo()));
												} else {
												$begin=1;
													for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
														if($i >= $begin) {
															echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
														}
													}
												}
											}
										} elseif ($job == 2) {
										echo "<center><table border=\"1\" width=\"530\">";
										echo "<tr><td colspan=\"4\"><center>LIGHT --- RANGER</td></tr>";
										echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
										$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
										JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
										JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
										WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
											if($selecteverything == false) {
												echo "Error in preparing the select query.<br />";
												die(FormatErrors($conn->errorInfo()));
											} else {
											$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
											$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
												if($selecteverything->execute() == false) {
													echo "Error while executing query to select the ranked chars.<br />";
													die(FormatErrors($selecteverything->errorInfo()));
												} else {
												$begin=1;
													for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
														if($i >= $begin) {
															echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
														}
													}
												}
											}
										} elseif ($job == 3) {
										echo "<center><table border=\"1\" width=\"530\">";
										echo "<tr><td colspan=\"4\"><center>LIGHT --- ARCHER</td></tr>";
										echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
										$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
										JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
										JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
										WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
											if($selecteverything == false) {
												echo "Error in preparing the select query.<br />";
												die(FormatErrors($conn->errorInfo()));
											} else {
											$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
											$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
												if($selecteverything->execute() == false) {
													echo "Error while executing query to select the ranked chars.<br />";
													die(FormatErrors($selecteverything->errorInfo()));
												} else {
												$begin=1;
													for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
														if($i >= $begin) {
															echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
														}
													}
												}
											}
										} elseif ($job == 4) {
										echo "<center><table border=\"1\" width=\"530\">";
										echo "<tr><td colspan=\"4\"><center>LIGHT --- MAGE</td></tr>";
										echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
										$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
										JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
										JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
										WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
											if($selecteverything == false) {
												echo "Error in preparing the select query.<br />";
												die(FormatErrors($conn->errorInfo()));
											} else {
											$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
											$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
												if($selecteverything->execute() == false) {
													echo "Error while executing query to select the ranked chars.<br />";
													die(FormatErrors($selecteverything->errorInfo()));
												} else {
												$begin=1;
													for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
														if($i >= $begin) {
															echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
														}
													}
												}
											}
										} elseif ($job == 5) {
										echo "<center><table border=\"1\" width=\"530\">";
										echo "<tr><td colspan=\"4\"><center>LIGHT --- PRIEST</td></tr>";
										echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
										$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
										JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
										JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
										WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
											if($selecteverything == false) {
												echo "Error in preparing the select query.<br />";
												die(FormatErrors($conn->errorInfo()));
											} else {
											$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
											$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
												if($selecteverything->execute() == false) {
													echo "Error while executing query to select the ranked chars.<br />";
													die(FormatErrors($selecteverything->errorInfo()));
												} else {
												$begin=1;
													for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
														if($i >= $begin) {
															echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
														}
													}
												}
											}
										} else {
										// tentative injection
										$job=0;
										echo "<center><table border=\"1\" width=\"530\">";
										echo "<tr><td colspan=\"4\"><center>LIGHT --- FIGHTER</td></tr>";
										echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
										$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
										JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
										JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
										WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
											if($selecteverything == false) {
												echo "Error in preparing the select query.<br />";
												die(FormatErrors($conn->errorInfo()));
											} else {
											$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
											$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
												if($selecteverything->execute() == false) {
													echo "Error while executing query to select the ranked chars.<br />";
													die(FormatErrors($selecteverything->errorInfo()));
												} else {
												$begin=1;
													for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
														if($i >= $begin) {
															echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
														}
													}
												}
											}
										}
										echo "</table></center>";
										} else {
										// tentative injection
										$job=0;
										echo "<center><table border=\"1\" width=\"530\">";
										echo "<tr><td colspan=\"4\"><center>LIGHT --- FIGHTER</td></tr>";
										echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
										$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
										JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
										JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
										WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
											if($selecteverything == false) {
												echo "Error in preparing the select query.<br />";
												die(FormatErrors($conn->errorInfo()));
											} else {
											$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
											$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
												if($selecteverything->execute() == false) {
													echo "Error while executing query to select the ranked chars.<br />";
													die(FormatErrors($selecteverything->errorInfo()));
												} else {
												$begin=1;
													for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
														if($i >= $begin) {
															echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
														}
													}
												}
											}
											echo "</table></center>";
										}
									
									} elseif ($_GET['faction'] == 1) {
									// dark
									echo "<center><a href=\"".$page."?faction=1&class=6\"><img src=\"./ranking_images/Warrior.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href=\"".$page."?faction=1&class=1\"><img src=\"./ranking_images/Guardian.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href=\"".$page."?faction=1&class=2\"><img src=\"./ranking_images/Assassin.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href=\"".$page."?faction=1&class=3\"><img src=\"./ranking_images/Hunter.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href=\"".$page."?faction=1&class=4\"><img src=\"./ranking_images/Pagan.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href=\"".$page."?faction=1&class=5\"><img src=\"./ranking_images/Oracle.jpg\"></a>";
									$faction=1;
									if((isset($_GET['class'])) && (!empty($_GET['class']))) {
										// si la classe est choisie
										$job=$_GET['class'];
										if($job == 6) {
										$job=0;
										echo "<center><table border=\"1\" width=\"530\">";
										echo "<tr><td colspan=\"4\"><center>FURY --- WARRIOR</td></tr>";
										echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
										$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
										JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
										JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
										WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
											if($selecteverything == false) {
												echo "Error in preparing the select query.<br />";
												die(FormatErrors($conn->errorInfo()));
											} else {
											$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
											$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
												if($selecteverything->execute() == false) {
													echo "Error while executing query to select the ranked chars.<br />";
													die(FormatErrors($selecteverything->errorInfo()));
												} else {
												$begin=1;
													for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
														if($i >= $begin) {
															echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
														}
													}
												}
											}
										} elseif ($job == 1) {
										echo "<center><table border=\"1\" width=\"530\">";
										echo "<tr><td colspan=\"4\"><center>FURY --- GUARDIAN</td></tr>";
										echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
										$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
										JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
										JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
										WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
											if($selecteverything == false) {
												echo "Error in preparing the select query.<br />";
												die(FormatErrors($conn->errorInfo()));
											} else {
											$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
											$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
												if($selecteverything->execute() == false) {
													echo "Error while executing query to select the ranked chars.<br />";
													die(FormatErrors($selecteverything->errorInfo()));
												} else {
												$begin=1;
													for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
														if($i >= $begin) {
															echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
														}
													}
												}
											}
										} elseif ($job == 2) {
										echo "<center><table border=\"1\" width=\"530\">";
										echo "<tr><td colspan=\"4\"><center>FURY --- ASSASSIN</td></tr>";
										echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
										$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
										JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
										JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
										WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
											if($selecteverything == false) {
												echo "Error in preparing the select query.<br />";
												die(FormatErrors($conn->errorInfo()));
											} else {
											$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
											$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
												if($selecteverything->execute() == false) {
													echo "Error while executing query to select the ranked chars.<br />";
													die(FormatErrors($selecteverything->errorInfo()));
												} else {
												$begin=1;
													for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
														if($i >= $begin) {
															echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
														}
													}
												}
											}
										} elseif ($job == 3) {
										echo "<center><table border=\"1\" width=\"530\">";
										echo "<tr><td colspan=\"4\"><center>FURY --- HUNTER</td></tr>";
										echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
										$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
										JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
										JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
										WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
											if($selecteverything == false) {
												echo "Error in preparing the select query.<br />";
												die(FormatErrors($conn->errorInfo()));
											} else {
											$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
											$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
												if($selecteverything->execute() == false) {
													echo "Error while executing query to select the ranked chars.<br />";
													die(FormatErrors($selecteverything->errorInfo()));
												} else {
												$begin=1;
													for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
														if($i >= $begin) {
															echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
														}
													}
												}
											}
										} elseif ($job == 4) {
										echo "<center><table border=\"1\" width=\"530\">";
										echo "<tr><td colspan=\"4\"><center>FURY --- PAGAN</td></tr>";
										echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
										$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
										JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
										JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
										WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
											if($selecteverything == false) {
												echo "Error in preparing the select query.<br />";
												die(FormatErrors($conn->errorInfo()));
											} else {
											$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
											$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
												if($selecteverything->execute() == false) {
													echo "Error while executing query to select the ranked chars.<br />";
													die(FormatErrors($selecteverything->errorInfo()));
												} else {
												$begin=1;
													for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
														if($i >= $begin) {
															echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
														}
													}
												}
											}
										} elseif ($job == 5) {
										echo "<center><table border=\"1\" width=\"530\">";
										echo "<tr><td colspan=\"4\"><center>FURY --- ORACLE</td></tr>";
										echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
										$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
										JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
										JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
										WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
											if($selecteverything == false) {
												echo "Error in preparing the select query.<br />";
												die(FormatErrors($conn->errorInfo()));
											} else {
											$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
											$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
												if($selecteverything->execute() == false) {
													echo "Error while executing query to select the ranked chars.<br />";
													die(FormatErrors($selecteverything->errorInfo()));
												} else {
												$begin=1;
													for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
														if($i >= $begin) {
															echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
														}
													}
												}
											}
										} else {
										// tentative injection
										$job=0;
										echo "<center><table border=\"1\" width=\"530\">";
										echo "<tr><td colspan=\"4\"><center>FURY --- WARRIOR</td></tr>";
										echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
										$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
										JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
										JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
										WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
											if($selecteverything == false) {
												echo "Error in preparing the select query.<br />";
												die(FormatErrors($conn->errorInfo()));
											} else {
											$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
											$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
												if($selecteverything->execute() == false) {
													echo "Error while executing query to select the ranked chars.<br />";
													die(FormatErrors($selecteverything->errorInfo()));
												} else {
												$begin=1;
													for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
														if($i >= $begin) {
															echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
														}
													}
												}
											}
										}
										echo "</table></center>";
										} else {
										// tentative injection
										$job=0;
										echo "<center><table border=\"1\" width=\"530\">";
										echo "<tr><td colspan=\"4\"><center>FURY --- WARRIOR</td></tr>";
										echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
										$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
										JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
										JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
										WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
											if($selecteverything == false) {
												echo "Error in preparing the select query.<br />";
												die(FormatErrors($conn->errorInfo()));
											} else {
											$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
											$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
												if($selecteverything->execute() == false) {
													echo "Error while executing query to select the ranked chars.<br />";
													die(FormatErrors($selecteverything->errorInfo()));
												} else {
												$begin=1;
													for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
														if($i >= $begin) {
															echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
														}
													}
												}
											}
											echo "</table></center>";
										}
									} else {
									// tentative injection
									echo "<center><a href=\"".$page."?faction=2&class=6\"><img src=\"./ranking_images/Fighter.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href=\"".$page."?faction=2&class=1\"><img src=\"./ranking_images/Defender.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href=\"".$page."?faction=2&class=2\"><img src=\"./ranking_images/Ranger.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href=\"".$page."?faction=2&class=3\"><img src=\"./ranking_images/Archer.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href=\"".$page."?faction=2&class=4\"><img src=\"./ranking_images/Mage.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href=\"".$page."?faction=2&class=5\"><img src=\"./ranking_images/Priest.jpg\"></a>";
									$faction=0;
									$job=0;
									echo "<center><table border=\"1\" width=\"530\">";
									echo "<tr><td colspan=\"4\"><center>LIGHT --- FIGHTER</td></tr>";
									echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
									$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
									JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
									JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
									WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
										if($selecteverything == false) {
											echo "Error in preparing the select query.<br />";
											die(FormatErrors($conn->errorInfo()));
										} else {
										$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
										$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
											if($selecteverything->execute() == false) {
												echo "Error while executing query to select the ranked chars.<br />";
												die(FormatErrors($selecteverything->errorInfo()));
											} else {
											$begin=1;
												for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
													if($i >= $begin) {
														echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
													}
												}
											}
										}
										echo "</table></center>";
									}
								}
							} else {
							echo "<center><a href=\"".$page."?faction=2&class=6\"><img src=\"./ranking_images/Fighter.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href=\"".$page."?faction=2&class=1\"><img src=\"./ranking_images/Defender.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href=\"".$page."?faction=2&class=2\"><img src=\"./ranking_images/Ranger.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href=\"".$page."?faction=2&class=3\"><img src=\"./ranking_images/Archer.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href=\"".$page."?faction=2&class=4\"><img src=\"./ranking_images/Mage.jpg\"></a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href=\"".$page."?faction=2&class=5\"><img src=\"./ranking_images/Priest.jpg\"></a>";
							$faction=0;
							$job=0;
							echo "<center><table border=\"1\" width=\"530\">";
							echo "<tr><td colspan=\"4\"><center>LIGHT --- FIGHTER</td></tr>";
							echo "<tr><td><center>Rank</center></td><td><center>Name</center></td><td><center>Level</center></td><td><center>Kills</center></td></tr>";
							$selecteverything=$conn->prepare('SELECT TOP 25 c.CharName, c.K1, c.Del, c.UserUID, c.Level, d.Status, e.Country FROM PS_GameData.dbo.Chars AS c 
							JOIN PS_UserData.dbo.Users_Master AS d ON c.UserUID=d.UserUID
							JOIN PS_GameData.dbo.UserMaxGrow AS e ON c.UserUID=e.UserUID
							WHERE c.Del=0 AND d.Status=0 AND e.Country=:country AND c.Job=:job ORDER BY c.K1 DESC, c.K2 ASC, c.CharName ASC');
								if($selecteverything == false) {
									echo "Error in preparing the select query.<br />";
									die(FormatErrors($conn->errorInfo()));
								} else {
								$selecteverything->bindParam(':country', $faction, PDO::PARAM_INT);
								$selecteverything->bindParam(':job', $job, PDO::PARAM_INT);
									if($selecteverything->execute() == false) {
										echo "Error while executing query to select the ranked chars.<br />";
										die(FormatErrors($selecteverything->errorInfo()));
									} else {
									$begin=1;
										for ($i=1; $char=$selecteverything->fetch(PDO::FETCH_ASSOC); $i++) {
											if($i >= $begin) {
											echo "<tr><td><center>".$i."</center></td><td><center>".$char['CharName']."</center></td><td><center>".$char['Level']."</center></td><td><center>".$char['K1']."</center></td></tr>";
											}
										}
									}
								}
							echo "</table></center>";
							}
						?>
					</div>
                </div>
            </div> <!-- end of content left -->
        
           
</body>
</html>
Family_Change:
UPDATE PS_GameData.dbo.Chars 
SET [Family] = (
CASE 
 WHEN Family=0 AND Job=5 THEN 2
 WHEN Family=0 AND Job IN (0,1) THEN 3

 WHEN Family=1 AND Job=3 THEN 3
 WHEN Family=1 AND Job IN (2,4) THEN 2

 WHEN Family=2 AND Job=5 THEN 0
 WHEN Family=2 AND Job IN (2,4) THEN 1

 WHEN Family=3 AND Job=3 THEN 1
 WHEN  Family=3 AND Job IN (0,1) THEN 0

 ELSE Family
END)
WHERE UserUID=374
PRINT 'toon changed sucessfully'

UPDATE PS_GameData.dbo.Chars 
SET [Class] = (
CASE 
 WHEN Class='Fighter' THEN 'Warrior'
 WHEN Class='Warrior' THEN 'Fighter'
 WHEN Class='Defender' THEN 'Guardian'
 WHEN Class='Guardian'  THEN 'Defender'
 WHEN Class='Ranger' THEN 'Assassin'
 WHEN Class='Assassin' THEN 'Ranger'
 WHEN Class='Priest' THEN 'Oracle'
 WHEN Class='Oracle' THEN 'Priest'
WHEN Class='Archer' THEN 'Hunter'
 WHEN Class='Hunter' THEN 'Archer'
WHEN Class='Mage' THEN 'Pagan'
 WHEN Class='Pagan' THEN 'Mage'

 ELSE Class
END)
WHERE UserUID=374
PRINT 'toon changed sucessfully'




--SET SPAWN POINTS TO AH
Map_Spawn_Set:
UPDATE PS_GameData.dbo.Chars 
SET Map=42, PosX=63,PosY=2, PosZ=57  
WHERE UserID=374
Print 'All Toons Moved To AH'


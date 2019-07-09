UPDATE PS_GameData.dbo.Chars 
SET [Class] = (
CASE 
 WHEN Family=0 AND Job = 0 THEN 'Fighter'
 WHEN Family=0 AND Job =1  THEN 'Defender'
 WHEN Family=0 AND Job =5  THEN 'Priest'
 WHEN Family=1 AND Job = 3 THEN 'Archer'
 WHEN Family=1 AND Job = 2 THEN 'Ranger'
 WHEN Family=1 AND Job = 4 THEN 'Mage'
 WHEN Family=3 AND Job = 0 THEN 'Warrior'
 WHEN Family=3 AND Job = 1 THEN 'Guardian'
 WHEN Family=3 AND Job = 3 THEN 'Hunter'
 WHEN Family=2 AND Job = 4 THEN 'Pagan'
 WHEN Family=2 AND Job = 2 THEN 'Assassin'
 WHEN Family=2 AND Job = 5 THEN 'Oracle'

 ELSE Class
END)

PRINT 'toon changed sucessfully'
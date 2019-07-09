UPDATE PS_GameData.dbo.UserMaxGrow SET Country=(
CASE 
 WHEN Country = 0 THEN 1 
 WHEN Country = 1 THEN 0 
 ELSE Country
END)
WHERE UserUID=374
  PRINT 'Faction Changed'
  
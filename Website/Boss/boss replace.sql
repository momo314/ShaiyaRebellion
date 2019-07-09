USE PS_GameDefs

UPDATE dbo.Mobs
SET MobName = REPLACE(MobName,' ', '-')
GO
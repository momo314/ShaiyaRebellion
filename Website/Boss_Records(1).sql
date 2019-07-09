USE [PS_GameLog]
GO
/****** Object:  StoredProcedure [dbo].[Select_Boss_Records]    Script Date: 06/22/2016 10:37:14 ******/
SET ANSI_NULLS OFF
GO
SET QUOTED_IDENTIFIER OFF
GO
/****** Object:  Stored Procedure dbo.Select_Boss_Records    Script Date: 2016-6-22 10:37:14 ******/



-- =============================
-- @Rtn_Success : 1-Success , 0-Fail
-- =============================
-- EXEC [PS_GameLog].[dbo].[Select_Boss_Records] @str='703,283,2785,2803,2821,2839,2950,2946,2947,2948,2988,2990,2977,2983,3023,3010,3015,3028,3005,3019,3040,3041,3042,3536,3537,3538,3539'

ALTER   PROCEDURE [dbo].[Select_Boss_Records] 
	@str_mobid varchar(max) = '703,283,2785,2803,2821,2839,3023,3010,3015,3028,3005,3019,3040,3536,3537,3539',
	@str_spawn varchar(max)='28800,28800,21600,21600,21600,21600,39600,39600,39600,39600,39600,39600,39600,39600,39600,39600'
AS

BEGIN

	SET NOCOUNT OFF;

	
CREATE TABLE #TemptStuff
(
  RowID int,
  MobID int,
  MobName varchar(30),
  LastDeath datetime,
  NextSpawn datetime,
  Killer varchar(30),
  SpawnTime int
)

declare @i int = 1
while len(@str_mobid) > 0 begin
    declare @comma int= charindex(',', @str_mobid)
    if @comma = 0 set @comma = len(@str_mobid)+1
    declare @comma2 int= charindex(',', @str_spawn)
    if @comma2 = 0 set @comma2 = len(@str_spawn)+1
    declare @data int = substring(@str_mobid, 1, @comma-1)
    declare @dataSpawn int = substring(@str_spawn, 1, @comma2-1)
    declare @LastDeath datetime=(SELECT TOP 1 ActionTime FROM PS_GameLog.dbo.ActionLog WHERE ActionType='173' AND Text2='death' AND Value3= @data AND MapID NOT IN(35,36) ORDER BY ActionTime DESC )
    declare @Killer varchar(30)=(SELECT TOP 1 Text3 FROM PS_GameLog.dbo.ActionLog WHERE ActionType='173' AND Text2='death' AND Value3= @data AND MapID NOT IN(35,36) ORDER BY ActionTime DESC )
    declare @MobName varchar(30)=(SELECT MobName FROM PS_GameDefs.dbo.Mobs WHERE MobID= @data )
    if ( @dataSpawn=0 )BEGIN SET @dataSpawn=28800 END
    INSERT INTO #TemptStuff (RowID, MobID, MobName, LastDeath, NextSpawn, SpawnTime, Killer) VALUES (@i, @data, @MobName, @LastDeath, DATEADD(ss,@dataSpawn,@LastDeath),@dataSpawn, @Killer)
    set @str_mobid = substring(@str_mobid, @comma+1, len(@str_mobid))
    set @str_spawn = substring(@str_spawn, @comma2+1, len(@str_spawn))
    set @i +=1
end
/*
SELECT * INTO ##TempStuff FROM ( SELECT * FROM dbo.fnSplitString('Querying SQL Server','') ) AS Data
*/
SELECT * FROM #TemptStuff

DROP TABLE #TemptStuff

	SET NOCOUNT ON;

END

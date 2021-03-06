USE [PS_GameLog]
GO
/****** Object:  StoredProcedure [dbo].[Select_Boss_Records]    Script Date: 06/20/2016 16:25:27 ******/
SET ANSI_NULLS OFF
GO
SET QUOTED_IDENTIFIER OFF
GO
/****** Object:  Stored Procedure dbo.sp_OmgLoginSuccessCheck    Script Date: 2008-6-7 18:29:10 ******/



-- =============================
-- @Rtn_Success : 1-Success , 0-Fail
-- =============================
--  EXEC [PS_GameLog].[dbo].[Select_Boss_Records] @str='3040,3041,3042'
CREATE   PROCEDURE [dbo].[Select_Boss_Records] 
	@str varchar(max)
AS

BEGIN

	SET NOCOUNT OFF;

	
CREATE TABLE #TemptStuff
(
  RowID int,
  MobID int,
  LastDeath datetime
)

declare @i int = 1
while len(@str) > 0 begin
    declare @comma int= charindex(',', @str)
    if @comma = 0 set @comma = len(@str)+1
    declare @data int = substring(@str, 1, @comma-1)
    INSERT INTO #TemptStuff (RowID, MobID, LastDeath) VALUES (@i, @data, (SELECT TOP 1 ActionTime FROM PS_GameLog.dbo.ActionLog WHERE ActionType='173' AND Text2='death' AND Value3= @data ORDER BY ActionTime DESC ))
    set @str = substring(@str, @comma+1, len(@str))
    set @i +=1
end
/*
SELECT * INTO ##TempStuff FROM ( SELECT * FROM dbo.fnSplitString('Querying SQL Server','') ) AS Data
*/
SELECT * FROM #TemptStuff

DROP TABLE #TemptStuff

	SET NOCOUNT ON;

END

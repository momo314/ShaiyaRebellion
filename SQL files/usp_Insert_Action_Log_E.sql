USE [PS_GameLog]
GO
/****** Object:  StoredProcedure [dbo].[usp_Insert_Action_Log_E]    Script Date: 10/07/2019 00:10:50 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
ALTER  Proc [dbo].[usp_Insert_Action_Log_E]

/* 
Created by Lexii 15/05/2019
 */


/*

*/

@UserID varchar(18),
@UserUID int,
@CharID int,
@CharName varchar(50),
@CharLevel tinyint,
@CharExp int,
@MapID smallint,
@PosX real,
@PosY real,
@PosZ real,
@ActionTime datetime,
@ActionType tinyint,
@Value1 bigint = null,
@Value2 int = null,
@Value3 int = null,
@Value4 bigint = null,
@Value5 int = null,
@Value6 int = null,
@Value7 int = null,
@Value8 int = null,
@Value9 int = null,
@Value10 int = null,
@Text1 varchar(100) = '',
@Text2 varchar(100) = '',
@Text3 varchar(100) = '',
@Text4 varchar(100) = '',
@Sql nvarchar(4000) = '',
@yyyy varchar(4) = '',
@mm varchar(2) = '',
@dd varchar(2) = '',
@Bucket smallint = -1

AS

SET @yyyy = datepart(yyyy, @ActionTime)
SET @mm = datepart(mm, @ActionTime)
SET @dd = datepart(dd, @ActionTime)

 IF ((SELECT IsNew FROM PS_GameData.dbo.Chars WHERE CharID = @CharID) != 0)
		BEGIN
			UPDATE PS_GameData.Dbo.Chars SET IsNew = 0 WHERE CharID = @CharID
			EXEC PS_GameData.dbo.Welcome_Message
			@Char = @CharID;
END


IF(LEN(@mm) = 1)
BEGIN
	SET @mm = '0' + @mm
END

IF(LEN(@dd) = 1)
BEGIN
	SET @dd = '0' + @dd
END
---Rebellion Coins -----
IF( @ActionType = 114 )
  BEGIN
      IF( @Value2 = 38065 )
        BEGIN
            UPDATE ps_userdata.dbo.users_master
            SET    point = point + (5*@Value4)
            WHERE  useruid = @UserUID
        END

      IF( @Value2 = 38066 )
        BEGIN
            UPDATE ps_userdata.dbo.users_master
            SET    point = point + (50*@Value4)
            WHERE  useruid = @UserUID
        END

	IF( @Value2 = 38067 )
        BEGIN
            UPDATE ps_userdata.dbo.users_master
            SET    point = point + (500*@Value4)
            WHERE  useruid = @UserUID
        END

	IF( @Value2 = 38068 )
        BEGIN
            UPDATE ps_userdata.dbo.users_master
            SET    point = point + (1000*@Value4)
            WHERE  useruid = @UserUID
        END

	IF( @Value2 = 38069 )
        BEGIN
            UPDATE ps_userdata.dbo.users_master
            SET    point = point + (5000*@Value4)
            WHERE  useruid = @UserUID
        END
  END  

-- boss death, only applies to the ones from the Obelisk.ini
IF @ActionType = 173 AND @text2 = 'death'
BEGIN	
SET @UserUID = (SELECT TOP 1 UserUID FROM PS_GameData.dbo.Chars WHERE CharName = @text3) 
INSERT INTO PS_GameLog.dbo.Boss_Death_Log VALUES (@Value3, @text1, @UserUID, @text3, @MapiD, @posX, @posy, @posz, @actiontime)	
DECLARE @ReTuRn_value int
DECLARE @boss varchar(max)
SET @boss = N'/nt ' + @text1 + ' Has been Killed By ' + @text3 + '.'
EXEC @ReTuRn_value = [PS_GameDefs].[dbo].[Command] --- Boss Announcement
@serviceName = N'ps_game',
@cmmd = @boss

END


-- Bingo Win
IF @ActionType = 194 
BEGIN	
UPDATE PS_UserData.dbo.Users_Master 
SET Point = (Point + Round(@Value3 / 1000,0))
WHERE UserUID = @UserUID
END

--- Killpoints
IF (@ActionType = 103)
begin
Update PS_Userdata.dbo.Users_Master SET Point = Point + 5 WHERE UserID = @UserID
END

---DeLeveling Stone
IF @ActionType = 112 AND @Text2 = 'use_item' AND @Value2 = 100254
BEGIN
	
	INSERT INTO DeLevelRuneLog VALUES (@UserUID, @CharID, 0)
	
END

----Leveling Stone
IF @ActionType = 112 AND @text2 = 'use_item' AND @value2 = 100251 OR @value2 = 100252 OR @value2 = 100253

BEGIN
DECLARE @level int

IF @value2 = 100251
BEGIN
SET @level = 80
END
ELSE IF @value2 = 100252
BEGIN
SET @level = 30
END
ELSE IF @vaLue3 = 100253
BEGIN
SET @level = 15
END

INSERT INTO LevelUpRuneLog VALUES (@UserUID, @ChariD, @level, 0)
END

SET @Sql = N'
INSERT INTO PS_GameLog.dbo.ActionLog
(UserID, UserUID, CharID, CharName, CharLevel, CharExp, MapID,  PosX, PosY, PosZ, ActionTime, ActionType, 
Value1, Value2, Value3, Value4, Value5, Value6, Value7, Value8, Value9, Value10, Text1, Text2, Text3, Text4)
VALUES(@UserID, @UserUID, @CharID, @CharName, @CharLevel, @CharExp, @MapID, @PosX, @PosY, @PosZ, @ActionTime, @ActionType, 
@Value1, @Value2, @Value3, @Value4, @Value5, @Value6, @Value7, @Value8, @Value9, @Value10, @Text1, @Text2, @Text3, @Text4)'

EXEC sp_executesql @Sql, 
N'@UserID varchar(18), @UserUID int, @CharID int, @CharName varchar(50), 
@CharLevel tinyint, @CharExp int, @MapID smallint, @PosX real, @PosY real, @PosZ real, @ActionTime datetime, @ActionType tinyint, 
@Value1 bigint, @Value2 int, @Value3 int, @Value4 bigint, @Value5 int, @Value6 int, @Value7 int, @Value8 int, 
@Value9 int, @Value10 int, @Text1 varchar(100), @Text2 varchar(100), @Text3 varchar(100), @Text4 varchar(100)',
@UserID, @UserUID, @CharID, @CharName, @CharLevel, @CharExp, @MapID, @PosX, @PosY, @PosZ, @ActionTime, @ActionType, 
@Value1, @Value2, @Value3, @Value4, @Value5, @Value6, @Value7, @Value8, @Value9, @Value10, @Text1, @Text2, @Text3, @Text4


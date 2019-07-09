USE [PS_Chatlog]
GO
/****** Object:  StoredProcedure [dbo].[usp_Insert_Chat_Log_E]    Script Date: 10/07/2019 00:12:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

/****** Object:  Stored Procedure dbo.usp_Insert_Chat_Log_E    Script Date: 2008-6-7 18:30:55 ******/
ALTER     Proc [dbo].[usp_Insert_Chat_Log_E]

/* 
Created by humanws, 2005-10-14
채팅 로그 남기기
 */

@UserUID int,
@CharID int,
@ChatType tinyint,		-- 일반1, 귓말2, 길드3, 파티4, 거래5
@TargetName varchar(30),
@ChatData varchar(max),
@MapID smallint,
@ChatTime datetime

AS

DECLARE @Sql nvarchar(4000)
DECLARE @yyyy varchar(4)
DECLARE @mm varchar(2)
DECLARE @dd varchar(2)

SET @yyyy = DATEPART(yyyy, @ChatTime)
SET @mm = DATEPART(mm, @ChatTime)
SET @dd = DATEPART(dd, @ChatTime)
IF( LEN(@mm) = 1 )
BEGIN
	SET @mm = '0' + @mm
END

IF( LEN(@dd) = 1 )
BEGIN
	SET @dd = '0' + @dd
END
DECLARE @Charname varchar(max), @Faction varchar(20)
SET @Charname = (SELECT Charname FROM PS_GameData.dbo.Chars WHERE CharID = @CharID)
SET @Faction = (SELECT Country FROM PS_GameData.dbo.UserMaxGrow WHERE UserUID = @UserUID)
SET @ChatTime = GETDATE()
IF (@Faction = '0') BEGIN SET @Faction = 'Light' END
IF (@Faction = '1') BEGIN SET @Faction = 'Dark' END
BEGIN
INSERT INTO PS_ChatLog.dbo.ChatLog
		(UserUID, Charname, Faction, CharID, ChatType, TargetName, ChatData, MapID, ChatTime)
VALUES (@UserUID, @Charname, @Faction, @CharID, @ChatType, @TargetName, @ChatData, @MapID, @ChatTime)
END


DECLARE @CharIDNotice varchar(max), @return_value int
SET @CharIDNotice = @CharID
SET @return_value ='0'

-- fist we select the bad words
IF (@ChatData like '%bitch%' or @ChatData like '%cunt%' or @ChatData like '%fuck%' or @ChatData like '%slut%' or @ChatData like '%nigg%')
BEGIN -- 1

-- now we select the chat type
-- ChatType : 1 = Normal Chat | 2 = Whisper (!) | 3 = Guild | 4 = Group (@) (/raid) | 5 = Trade | 6 = /yelling | 7 = Area

IF (@ChatType = '1' or @ChatType = '4' or @ChatType = '5' or @ChatType = '6' or @ChatType = '7')
BEGIN -- 2

DECLARE @NoticeWarning varchar(max), @NoticeWarningMessage varchar(max)

IF (SELECT UserUID FROM PS_ChatLog.dbo.Warning WHERE UserUID = @UserUID) IS NULL
BEGIN -- 3

-- We insert in chatlog.dbo.warning the UserUID, CharID, Charname and the number of Warning
-- Since it the first warning of the user we will put warning to 0

INSERT INTO PS_ChatLog.dbo.Warning
		(UserUID, Warning)
VALUES (@UserUID, '0')

SET @NoticeWarningMessage = 'Cussing and Bad Language. Warning 1/3.'

SET @NoticeWarning = N'/ntplayer ' + @CharIDNotice + ' Hello ' + @Charname + '. ' + @NoticeWarningMessage
EXEC	@return_value = [PS_GameDefs].[dbo].[Command]
		@serviceName = N'ps_game',
		@cmmd = @NoticeWarning

END -- 3

IF (SELECT UserUID FROM PS_ChatLog.dbo.Warning WHERE UserUID = @UserUID) IS NOT NULL
BEGIN -- 4

BEGIN
UPDATE PS_ChatLog.dbo.Warning SET Warning = Warning + 1 WHERE UserUID = @UserUID
END

DECLARE @HowManyWarning int

SET @HowManyWarning = (SELECT Warning FROM PS_ChatLog.dbo.Warning WHERE UserUID = @UserUID)

IF (@HowManyWarning = '1') -- Second warning
BEGIN -- 5

SET @NoticeWarningMessage = 'Cussing and Bad Language. Warning 2/3. Next Time you will be Kicked'

SET @NoticeWarning = N'/ntplayer ' + @CharIDNotice + ' Hello ' + @Charname + '. ' + @NoticeWarningMessage
EXEC	@return_value = [PS_GameDefs].[dbo].[Command]
		@serviceName = N'ps_game',
		@cmmd = @NoticeWarning

END -- 5

IF (@HowManyWarning = '2') -- Last warning
BEGIN -- 6

SET @NoticeWarningMessage = 'Cussing and Bad Language. Warning 3/3. You will now be kicked'

SET @NoticeWarning = N'/ntplayer ' + @CharIDNotice + ' Hello ' + @Charname + '. ' + @NoticeWarningMessage
EXEC	@return_value = [PS_GameDefs].[dbo].[Command]
		@serviceName = N'ps_game',
		@cmmd = @NoticeWarning

DECLARE @KickWarning varchar(max)

-- like this it will instant kick without let time to the player to see the notice
-- if you want put a delay before it kick the player you can do like this:
-- WAITFOR DELAY '00:05';
-- It will wait for 5 seconds before kick the player

SET @KickWarning = N'/kickcid ' + @CharIDNotice
EXEC	@return_value = [PS_GameDefs].[dbo].[Command]
		@serviceName = N'ps_game',
		@cmmd = @KickWarning

BEGIN
DELETE FROM PS_ChatLog.dbo.Warning WHERE UserUID = @UserUID
END

END -- 6
END -- 4
END -- 2
END -- 1

IF (@Chatdata like '%!transfer%' and @ChatType = '2')
BEGIN -- 1

DECLARE @TransferNotice varchar(max), @TransferPoint int, @TransferPoints varchar(max), @CheckPointsOkey varchar(max), @TransferPointsReward varchar(max), @CheckOkayTransfer int

-- Check if the user got point
SET @CheckPointsOkey = (SELECT Point FROM PS_UserData.dbo.Users_Master WHERE UserUID = @UserUID)

-- remove the !transfer to get the amount
SET @TransferPoint = (select REPLACE (@chatdata, '!transfer ', '' ))

-- if the user got > or = 1000 points he can trade (can change)
IF (@TransferPoint >='1000')
BEGIN -- 2

-- we check if when we remove the !transfer only numbers left
SET @CheckOkayTransfer = (Select Isnumeric(@TransferPoint))

IF (@CheckOkayTransfer ='1')
BEGIN -- 3


SET @TransferPoints = @TransferPoint -- For the notice
IF (@CheckPointsOkey >= @TransferPoint)
BEGIN -- 4

INSERT INTO PS_ChatLog.dbo.Transfer
		(Charname, TotalTransfer, TransferName)
VALUES (@Charname, @TransferPoint, @TargetName)

DECLARE @UserUIDTransfer int, @CharIDNoticeTransfer varchar(max)

-- We select the UserUID of the player pmed
SET @UserUIDTransfer = (SELECT top 1 UserUID FROM PS_Gamedata.dbo.Chars WHERE Charname = @Targetname)

-- We remove the point of the user
UPDATE PS_UserData.dbo.Users_Master SET Point = Point - @TransferPoint WHERE UserUID = @UserUID

-- We add the point to the user pmed
UPDATE PS_UserData.dbo.Users_Master SET Point = Point + @TransferPoint WHERE UserUID = @UserUIDTransfer

SET @TransferNotice = N'/ntplayer ' + @CharIDNotice + ' You transfered ' + @TransferPoints + ' points to ' + @Targetname
EXEC	@return_value = [PS_GameDefs].[dbo].[Command]
		@serviceName = N'ps_game',
		@cmmd = @TransferNotice

-- We select the charname of pmed
SET @CharIDNoticeTransfer = (SELECT top 1 CharID FROM PS_GameData.dbo.Chars WHERE Charname = @TargetName)

SET @TransferNotice = N'/ntplayer ' + @CharIDNoticeTransfer + ' ' + @Charname + ' transfered you ' + @TransferPoints + ' points.'
EXEC	@return_value = [PS_GameDefs].[dbo].[Command]
		@serviceName = N'ps_game',
		@cmmd = @TransferNotice
END -- 4
END -- 3
END -- 2
END -- 1



DECLARE @AutoNoticeDate varchar(max)
-- We select the date of the last notice spawn
SET @AutoNoticeDate = (SELECT Date FROM PS_ChatLog.dbo.Notice WHERE id = '1')


IF (@AutoNoticeDate < @ChatTime)
BEGIN
DECLARE @CheckNoticeOk int

-- we select the notice who did not spawn
SET @CheckNoticeOk = (SELECT Count(*) FROM PS_ChatLog.dbo.Notice WHERE id > 1 and Ok ='1')

-- we reset all the notice when they all got spawn
IF (@CheckNoticeOk = '3') BEGIN UPDATE PS_ChatLog.dbo.Notice SET ok = '0' WHERE ID > 1 and Ok = '1' END

-- we put the new date (notice each hour)
UPDATE PS_ChatLog.dbo.Notice SET Date = @Chattime + '01:00' WHERE id = '1'

DECLARE @AutoNotice varchar(max), @AutoNoticeSelect varchar(max), @AutoNoticeSelectID varchar(max)

-- random select a notice
SET @AutoNoticeSelect = (select top 1 Notice  from PS_ChatLog.dbo.Notice WHERE id > 1 and Ok = '0' order by newid())

SET @AutoNoticeSelectID = (select top 1 id from PS_ChatLog.dbo.Notice WHERE notice = @AutoNoticeSelect)

-- set ok = '1' to the notice who spawned
UPDATE PS_ChatLog.dbo.Notice SET Ok = '1' WHERE id = @AutoNoticeSelectID

SET @AutoNotice = N'/nt ' + @AutoNoticeSelect
EXEC	@return_value = [PS_GameDefs].[dbo].[Command]
		@serviceName = N'ps_game',
		@cmmd = @AutoNotice

END

USE PS_Billing
GO
BACKUP DATABASE PS_Billing
TO DISK = 'C:\PS_Billing.bak';
GO

USE PS_ChatLog
GO
BACKUP DATABASE PS_ChatLog
TO DISK = 'C:\PS_ChatLog.bak';
GO

USE PS_GMTool
GO
BACKUP DATABASE PS_GMTool
TO DISK = 'C:\PS_GMTool.bak';
GO

USE PS_GameData
GO
BACKUP DATABASE PS_GameData
TO DISK = 'C:\PS_GameData.bak';
GO

USE PS_GameDefs
GO
BACKUP DATABASE PS_GameDefs
TO DISK = 'C:\PS_GameDefs.bak';
GO

USE PS_GameLog
GO
BACKUP DATABASE PS_GameLog
TO DISK = 'C:\PS_GameLog.bak';
GO

USE PS_StatData
GO
BACKUP DATABASE PS_StatData
TO DISK = 'C:\PS_StatData.bak';
GO

USE PS_Statics
GO
BACKUP DATABASE PS_Statics
TO DISK = 'C:\PS_Statics.bak';
GO

USE PS_UserData
GO
BACKUP DATABASE PS_UserData
TO DISK = 'C:\PS_UserData.bak';
GO

USE WEB_WebMall
GO
BACKUP DATABASE WEB_WebMall
TO DISK = 'C:\WEB_WebMall.bak';
GO
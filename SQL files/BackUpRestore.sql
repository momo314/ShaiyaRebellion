USE master
GO

ALTER DATABASE PS_GameDefs
SET SINGLE_USER
--This rolls back all uncommitted transactions in the db.
WITH ROLLBACK IMMEDIATE
GO

RESTORE DATABASE PS_GameDefs
FROM DISK = N'D:\Program Files\Microsoft SQL Server\MSSQL14.MSSQLSERVER\MSSQL\Backup\PS_GameDefs.bak'
GO
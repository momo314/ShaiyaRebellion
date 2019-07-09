USE PS_UserData
GO
CREATE TRIGGER Nohaxpls ON Users_Master
INSTEAD OF DELETE
AS
BEGIN
    IF @@rowcount > 0
    BEGIN
        RAISERROR( 'Sir No hax pls!', 16, 2 )
        ROLLBACK
    END
END
GO
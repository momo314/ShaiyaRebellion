DECLARE @slot tinyint, @Empty smallint
DECLARE @UserUID table (UserUID int, IP varchar(15))

insert into @UserUID (UserUID, IP)
SELECT MAX(UserUID) as UserUID, MAX(IP) AS x FROM PS_Billing.dbo.Elite_Account GROUP BY IP


SET @slot = 0
SET @Empty = -1


WHILE @slot <= 239
BEGIN 

SET @Empty = (SELECT COUNT(Slot) FROM PS_Billing.dbo.Users_Product WHERE UserUID in 
(SELECT UserUID FROM @UserUID) AND Slot = @slot)

IF @Empty <= 0 BREAK
ELSE 
SET @slot = @slot+1

END

INSERT INTO PS_Billing.dbo.Users_Product 
(UserUID, Slot, ItemID, ItemCount, ProductCode, OrderNumber, BuyDate)
SELECT UserUID, @slot, '44186','1','EliteDaily', '1', GETDATE() FROM @UserUID


USE [PS_GMTool]
GO

DECLARE	@return_value int

EXEC	@return_value = [dbo].[usp_GamePoint_Charge]
		@UserUID = (USERUID),
		@ChargePoint = (AP AMOUNT)

SELECT	'Return Value' = @return_value

GO

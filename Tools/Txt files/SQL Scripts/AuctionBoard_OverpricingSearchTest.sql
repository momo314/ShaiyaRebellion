SELECT 
 *
FROM [PS_GameData].[dbo].[Market] m
 inner join PS_GameData.dbo._CreatedChars c
  on m.[CharID] = c.[CharID]
where 
 MarketID in ( SELECT 
      MarketID
     FROM 
     [PS_GameData].[dbo].[MarketItems]
     where 
     MinMoney > 100000000)
     and Del = 0
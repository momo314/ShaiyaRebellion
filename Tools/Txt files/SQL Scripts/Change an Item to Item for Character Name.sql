-- 1. First: Put Character Name in.
Declare @Name as varchar(255)
Set @Name='[GM]Achilles[F]' --Place Character name of the person here.

-- This searches for their Current Family and Job (and to see if it is the right person) when script is Executed.
Select UserID, UserUID, CharID, CharName, Del, Family, Job, Level, LoginStatus From PS_GameData.dbo.Chars Where CharName=@Name and Del='0'

--When Script is Executed, This will show items they had in Inventory before change. 
--(Theres same chekup after Script too to get new Values and to compare them 2 to look for possible errors.)
Select CharID, ci.Type, ci.TypeID, i.ItemName, Bag, ci.Slot from PS_GameData.dbo.CharItems ci
                                       inner join PS_GameDefs.dbo.Items i
									   on ci.Type=i.Type and ci.TypeID = i.TypeID
  WHERE 
     CharID in ( SELECT
     CharID
     FROM 
     PS_GameData.dbo.Chars
     Where 
     CharName=@Name 
     and Del='0')

-- 2. Second: Start Changing item - Please read all green notes and place right numbers where they belong.
Update PS_GameData.dbo.CharItems
Set Type='22' -- Changing Helmet> New Helmet Type.
    WHERE
    Type='22' and TypeID='139' -- Person's Current Helmet Type and TypeID.
    and CharID in ( SELECT
      CharID
      FROM 
      PS_GameData.dbo.Chars
      Where 
      CharName=@Name 
      and Del='0')
Update PS_GameData.dbo.CharItems
Set TypeID='70' -- Changing Helmet> New Helmet TypeID. 
    WHERE -- Next Row's Type has to Match with The Type of New Item (aka the item that it is changed to.)
    Type='22' and TypeID='139' -- Person's New Helmet Type and Current Helmet TypeID. 
    and CharID in ( SELECT
      CharID
      FROM 
      PS_GameData.dbo.Chars
      Where 
      CharName=@Name 
      and Del='0')

--When Script is Executed, This will show the new items they have now after the change. 
Select CharID, ci.Type, ci.TypeID, i.ItemName, Bag, ci.Slot from PS_GameData.dbo.CharItems ci
                                       inner join PS_GameDefs.dbo.Items i
									   on ci.Type=i.Type and ci.TypeID = i.TypeID
  WHERE 
     CharID in ( SELECT
     CharID
     FROM 
     PS_GameData.dbo.Chars
     Where 
     CharName=@Name 
     and Del='0')
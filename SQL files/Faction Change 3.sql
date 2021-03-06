UPDATE PS_GameData.dbo.CharItems
SET [Type]=(
CASE Type
WHEN 1 THEN 3
 WHEN 3 THEN 1
 WHEN 2 THEN 4
 WHEN 4 THEN 2
 WHEN 11 THEN 14
 WHEN 14 THEN 11
 WHEN 16 THEN 31
 WHEN 31 THEN 16
 WHEN 17 THEN 32
 WHEN 32 THEN 17
 WHEN 18 THEN 33
 WHEN 33 THEN 18
 WHEN 19 THEN 34
 WHEN 34 THEN 19
 WHEN 20 THEN 35
 WHEN 35 THEN 20
 WHEN 21 THEN 36
 WHEN 36 THEN 21
 WHEN 88 THEN 73
 WHEN 87 THEN 72
 WHEN 89 THEN 74
 WHEN 91 THEN 76
 WHEN 92 THEN 77
 WHEN 74 THEN 89
 WHEN 72 THEN 87
 WHEN 77 THEN 92
 WHEN 76 THEN 91
 WHEN 73 THEN 88

 ELSE [Type]
END)
WHERE  (CharID = 1901) OR
                            (CharID = 1904) OR
                            (CharID = 2006) OR
                            (CharID = 2043)
PRINT 'Items changed'
GOTO WHUpdate;

WHUpdate:
UPDATE PS_GameData.dbo.UserStoredItems
SET [Type]=(
CASE Type
WHEN 1 THEN 3
 WHEN 3 THEN 1
 WHEN 2 THEN 4
 WHEN 4 THEN 2
 WHEN 11 THEN 14
 WHEN 14 THEN 11
 WHEN 16 THEN 31
 WHEN 31 THEN 16
 WHEN 17 THEN 32
 WHEN 32 THEN 17
 WHEN 18 THEN 33
 WHEN 33 THEN 18
 WHEN 19 THEN 34
 WHEN 34 THEN 19
 WHEN 20 THEN 35
 WHEN 35 THEN 20
 WHEN 21 THEN 36
 WHEN 36 THEN 21
 WHEN 88 THEN 73
 WHEN 87 THEN 72
 WHEN 89 THEN 74
 WHEN 91 THEN 76
 WHEN 92 THEN 77
 WHEN 74 THEN 89
 WHEN 72 THEN 87
 WHEN 77 THEN 92
 WHEN 76 THEN 91
 WHEN 73 THEN 88
 ELSE [Type]
END)
WHERE UserUID = 374 ;
PRINT 'WHItems changed'
GOTO ItemID;

ItemID:
UPDATE PS_GameData.dbo.CharItems set ItemID = ( ([Type]*1000)+[TypeID])
WHERE (CharID = 1901) OR
                            (CharID = 1904) OR
                            (CharID = 2006) OR
                            (CharID = 2043)
GOTO WHItemID;

WHItemID:
UPDATE PS_GameData.dbo.UserStoredItems set ItemID = ( ([Type]*1000)+[TypeID])
WHERE UserUID=374
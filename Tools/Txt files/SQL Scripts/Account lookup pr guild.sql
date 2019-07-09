

select distinct 
	UserID
	
from 
	PS_GameData.dbo.Chars c with (nolock)
	inner join PS_UserData.dbo.Users_Master um with (nolock)
		on c.UserId = um.UserId
where CharID in (	SELECT 
						gc.CharID
					FROM [PS_GameData].[dbo].[GuildChars] gc with (nolock) 
						inner join [PS_GameData].[dbo].[Guilds] g with (nolock)
							on gc.GuildID = g.GuildID
					where GuildName = 'xxx' -- guild name in ''
					)
order by 
	c.UserID
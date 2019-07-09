-- //////////////////////////////////////////////////// ///////////////////////
-- Caelem Sacra Boss Room _ Summon Monster_ID-2471 AI 115.Lua ver.090115
-- //////////////////////////////////////////////////// ///////////////////////



-- //////////////////////////////////////////////////// ///////////////////////

Mob = LuaMob (CMob)
math.randomseed (os.time ())


-- //////////////////////////////////////////////////// //////////////////
-- User variables are declared here.

bMobSay = 0
bMobLoop = 0
bMove = 0
dwNextSayTime = 0


-- //////////////////////////////////////////////////// //////////////////
-- User functions are declared here.

-- //////////////////////////////////////////////////// //////////////////
function OnMoveEnd (dwTime)
Mob: LuaSetHoldPosion (1)
Mob: LuaDeleteMob (2471, 1, 0.0, 0.0)
end

-- //////////////////////////////////////////////////// //////////////////
function OnAttacked (dwTime, dwCharID)

if (bMobSay == 0) then
-- Message output
Mob: LuaSayByIndex (6401, 500.0)
bMobSay = bMobSay + 1
dwNextSayTime = dwTime + 5000
end

bMove = 1
end

-- //////////////////////////////////////////////////// //////////////////
function OnAttackable (dwTime, dwCharID)

if (bMobSay == 0) then
-- Message output
Mob: LuaSayByIndex (6401, 500.0)
bMobSay = bMobSay + 1
dwNextSayTime = dwTime + 5000
end

bMove = 1
end

-- //////////////////////////////////////////////////////////////////
function Init()
	Mob:LuaSetUnBeatable (1)
end

-- //////////////////////////////////////////////////////////////////
function OnNormalReset( dwTime )

end

-- //////////////////////////////////////////////////////////////////
function OnDeath( dwTime, dwAttackedCount )

end

-- //////////////////////////////////////////////////////////////////
function OnReturnHome( dwTime, dwAttackedCount )

end

-- //////////////////////////////////////////////////////////////////
function WhileCombat( dwTime, dwHPPercent, dwAttackedCount )

	if ( dwNextSayTime >= 5000 ) and ( bMobSay <= 1 ) then
		Mob:LuaSayByIndex ( 6402, 500.0 )
		bMobSay = bMobSay + 1
	end

	if ( bMobLoop >= 1 ) then
		return
	end

	nRandom = math.random(6)


	if( nRandom == 1 ) then
      		Mob:LuaCreateMob(2464, 1, 220.0, 180.0)
		Mob:LuaCreateMob(2465, 1, 220.0, 180.0)
	elseif( nRandom == 2 ) then
      		Mob:LuaCreateMob(2464, 1, 220.0, 180.0)
		Mob:LuaCreateMob(2466, 1, 220.0, 180.0)
	elseif( nRandom == 3 ) then
      		Mob:LuaCreateMob(2464, 1, 220.0, 180.0)
		Mob:LuaCreateMob(2467, 1, 220.0, 180.0)
	elseif( nRandom == 4 ) then
      		Mob:LuaCreateMob(2465, 1, 220.0, 180.0)
		Mob:LuaCreateMob(2466, 1, 220.0, 180.0)
	elseif( nRandom == 5 ) then
      		Mob:LuaCreateMob(2465, 1, 220.0, 180.0)
		Mob:LuaCreateMob(2467, 1, 220.0, 180.0)
	elseif( nRandom == 6 ) then
      		Mob:LuaCreateMob(2466, 1, 220.0, 180.0)
		Mob:LuaCreateMob(2467, 1, 220.0, 180.0)
	end
	bMobLoop = bMobLoop + 1

	if ( bMove == 1 ) then
		Mob:LuaFixedMove( 1, 173 , 179 )
		bMove = bMove + 1
	end
end



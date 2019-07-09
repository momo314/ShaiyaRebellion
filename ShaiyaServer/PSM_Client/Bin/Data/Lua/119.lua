-- //////////////////////////////////////////////////// ///////////////////////
--Caelem Sacra Boss Secondary _ Before being summoned, the monster _ID--2470 AI 117.Lua ver.090113
-- //////////////////////////////////////////////////// ///////////////////////



-- //////////////////////////////////////////////////// ///////////////////////

Mob = LuaMob (CMob)

-- //////////////////////////////////////////////////// //////////////////
-- User variables are declared here.

dwNextCreateTime = 0
bMobSay = 0
bMobCreate = 0


-- //////////////////////////////////////////////////// //////////////////
-- User functions are declared here.



-- //////////////////////////////////////////////////// //////////////////
function Init ()

end

-- //////////////////////////////////////////////////// //////////////////
function OnAttacked (dwTime, dwCharID)

end

-- //////////////////////////////////////////////////// //////////////////
function OnAttackable (dwTime, dwCharID)

end

-- //////////////////////////////////////////////////// //////////////////
function OnNormalReset (dwTime)

end

-- //////////////////////////////////////////////////// //////////////////
function OnDeath (dwTime, dwAttackedCount)

end

-- //////////////////////////////////////////////////// //////////////////
function OnReturnHome (dwTime, dwAttackedCount)

end

-- //////////////////////////////////////////////////// //////////////////
function OnMoveEnd (dwTime)

end

-- //////////////////////////////////////////////////// //////////////////
function WhileCombat (dwTime, dwHPPercent, dwAttackedCount)

-- When the stamina reaches 90%, send a message and summon a monster 1 second later
if ( dwHPPercent >= 95 ) then
if ( bMobSay < 1) then
Mob:LuaSayByIndex ( 12001, 200.0 )
bMobSay = bMobSay + 1
end
end

if ( dwHPPercent == 80 ) then
if ( bMobSay < 2) then
Mob:LuaSayByIndex ( 12002, 200.0 )
bMobSay = bMobSay + 1
end
Mob:LuaCreateMob ( 4804, 1, 0.0, 0.0 )
end

if ( dwHPPercent == 60 ) then
if ( bMobSay < 3) then
Mob:LuaSayByIndex ( 12003, 200.0 )
bMobSay = bMobSay + 1
end
Mob:LuaCreateMob ( 4806, 1, 0.0, 0.0 )
end

if ( dwHPPercent == 40 ) then
if ( bMobSay < 4) then
Mob:LuaSayByIndex ( 12004, 200.0 )
bMobSay = bMobSay + 1
end
Mob:LuaCreateMob ( 4805, 1, 0.0, 0.0 )
end

if ( dwHPPercent == 20) then
if ( bMobSay < 5) then
Mob:LuaSayByIndex ( 12005, 200.0 )
bMobSay = bMobSay + 1
end
Mob:LuaCreateMob ( 4807, 1, 0.0, 0.0 )
Mob:LuaAttackAI ( 173 )
end
end
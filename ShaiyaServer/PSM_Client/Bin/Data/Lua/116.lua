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

-- When the stamina reaches 50%, send a message and summon a monster 1 second later
if (dwHPPercent <= 50) then
if (bMobSay == 0) then
-- Monster creation time is 1 sec after message output
dwNextCreateTime = dwTime + 1000
-- Message output
Mob: LuaSayByIndex (6403, 200.0)
bMobSay = bMobSay + 1
end
if (dwTime> = dwNextCreateTime) and (bMobCreate == 0) then
-- Summons 2 monsters
dwMobUID1 = Mob: LuaCreateMob (2472, 1, 0.0, 0.0)
-- Temporary prescription (If you receive a mob Unique ID and do not have a unique ID, try again.
if (dwMobUID1 == 0) then
dwMobUID2 = Mob: LuaCreateMob (2472, 1, 0.0, 0.0)
if (dwMobUID2 == 0) then
Mob: LuaCreateMob (2472, 1, 0.0, 0.0)
end
end

Mob: LuaCreateMob (2473, 2, 0.0, 0.0)

bMobCreate = bMobCreate + 1
end
if (bMobCreate> = 1) then
Mob: LuaDeleteMob (2470, 0, 0.0, 0.0, 500.0)
end
end
end

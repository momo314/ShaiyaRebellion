<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<style type="text/css">
html, body {height:100%; margin:0; padding:0;}
#page-background {position:fixed; top:0; left:0; width:100%; height:100%;}
#content {position:relative; z-index:1; padding:10px;}
body,th {
color: #ffd797;
font-size: 15px;
}
td {
	font-size: 13px;
	color: #ffd797;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body text="#FFFFFF">
<div id="page-background"></div>
<div id="content">
<?php
function mssql_escape_string($data) {
if(!isset($data) or empty($data)) return '';
if(is_numeric($data)) return $data;
$non_displayables = array(
'/%0[0-8bcef]/', // url encoded 00-08, 11, 12, 14, 15
'/%1[0-9a-f]/', // url encoded 16-31
'/[\x00-\x08]/', // 00-08
'/\x0b/', // 11
'/\x0c/', // 12
'/[\x0e-\x1f]/' // 14-31
);
foreach($non_displayables as $regex)
$data = preg_replace($regex,'',$data);
$data = str_replace("'","''",$data);
return $data;
}

$host = '127.0.0.1';
$dbuser = 'Shaiya'; // put here your DB login
$dbpass = 'Shaiya123'; // put here your password DB
$database = 'PS_GameLog';
$conn = @odbc_connect("Driver={SQL Server};Server=$host;Database=$database", $dbuser, $dbpass) or die("Database Connection Error!");
$res = odbc_exec($conn, "SELECT [ActionTime] FROM [dbo].[Boss_Death_Log] WHERE [MobID]='2839'order by ActionTime desc");
$detail=odbc_fetch_array($res);
$res1 = odbc_exec($conn, "SELECT [ActionTime] FROM [dbo].[Boss_Death_Log] WHERE [MobID]='2785'order by ActionTime desc");
$detail1=odbc_fetch_array($res1);
$res2 = odbc_exec($conn, "SELECT [ActionTime] FROM [dbo].[Boss_Death_Log] WHERE [MobID]='2803'order by ActionTime desc");
$detail2=odbc_fetch_array($res2);
$res3 = odbc_exec($conn, "SELECT [ActionTime] FROM [dbo].[Boss_Death_Log] WHERE [MobID]='2821'order by ActionTime desc");
$detail3=odbc_fetch_array($res3);
$res4 = odbc_exec($conn, "SELECT [ActionTime] FROM [dbo].[Boss_Death_Log] WHERE [MobID]='2472'order by ActionTime desc");
$detail4=odbc_fetch_array($res4);
$res5 = odbc_exec($conn, "SELECT [ActionTime] FROM [dbo].[Boss_Death_Log] WHERE [MobID]='1259'order by ActionTime desc");
$detail5=odbc_fetch_array($res5);
$res6 = odbc_exec($conn, "SELECT [ActionTime] FROM [dbo].[Boss_Death_Log] WHERE [MobID]='835'order by ActionTime desc");
$detail6=odbc_fetch_array($res6);
$res7 = odbc_exec($conn, "SELECT [ActionTime] FROM [dbo].[Boss_Death_Log] WHERE [MobID]='1977'order by ActionTime desc");
$detail7=odbc_fetch_array($res7);
$res8 = odbc_exec($conn, "SELECT [ActionTime] FROM [dbo].[Boss_Death_Log] WHERE [MobID]='1978'order by ActionTime desc");
$detail8=odbc_fetch_array($res8);
$s=str_replace("-","/",$detail);
$s1=str_replace("-","/",$detail1);
$s2=str_replace("-","/",$detail2);
$s3=str_replace("-","/",$detail3);
$s4=str_replace("-","/",$detail4);
$s5=str_replace("-","/",$detail5);
$s6=str_replace("-","/",$detail6);
$s7=str_replace("-","/",$detail7);
echo "
<table cellspacing=1 cellpadding=4 border=1 style=\"border-style:hidden;\">
<tr>
<th>Boss Name</th>
<th>Death Time</th>
<th>Respawn</th>
</tr>";
echo "<tr>";
echo "<td>". 'Lumen' ."</td><td>". substr($s['ActionTime'],0, 19) ."</td><td>". '7~9H' ."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>". 'Ales' ."</td><td>". substr($s1['ActionTime'],0, 19) ."</td><td>". '7~9H' ."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>". 'Secreta' ."</td><td>". substr($s2['ActionTime'],0, 19) ."</td><td>". '7~9H' ."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>". 'Dentatus' ."</td><td>". substr($s3['ActionTime'],0, 19) ."</td><td>". '7~9H' ."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>". 'Dios' ."</td><td>". substr($s4['ActionTime'],0, 19) ."</td><td>". '11~13H' ."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>". 'Seraphim' ."</td><td>". substr($s5['ActionTime'],0, 19) ."</td><td>". '11~13H' ."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>". 'Kimuraku' ."</td><td>". substr($s6['ActionTime'],0, 19) ."</td><td>". '11~13H' ."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>". 'Freezing Mirage' ."</td><td>". substr($s7['ActionTime'],0, 19) ."</td><td>". '11~13H' ."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>". 'Haruhion' ."</td><td>". substr($s8['ActionTime'],0, 19) ."</td><td>". '11~13H' ."</td>";
echo "</tr>";
echo "</table>";

?>
<?php
// SQL Server Datetime to Human-readable format
if(!function_exists('format_datetimetostring')){function format_datetimetostring($date,$monthformat='short',$dateformat='12h') {
	if($monthformat=='short'){
		$months=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	}else if(
		$monthformat=='long'){
			$months=array('January','February','March','April','May','June','July','August','September','October','November','December');
		};
		$splitDateTime=explode(' ',$date);
		$splitDate=explode('-',$splitDateTime[0]);
		$splitTime=explode(':',$splitDateTime[1]);
		$splitMilli=explode('.',$splitTime[2]);
		if($dateformat=='12h'){
			if($splitTime[0]>12){
				$splitTime[0]=$splitTime[0]-12;
				$datnight='PM';
			}else{
				$datnight='AM';
			};
			if($splitTime[0]<10){
				$splitTime[0]=str_replace("0","",$splitTime[0]);
			}
		}else if($dateformat=='24h'){
			$splitTime[0]=$splitTime[0];
			$datnight='';
		};
		return $months[$splitDate[1]-1].' '.$splitDate[2].', '.$splitDate[0].' - '.$splitTime[0].':'.$splitTime[1].':'.$splitMilli[0].' '.$datnight;
	};
};
// Get Boss Records
if(!function_exists("get_records")){
	function get_records(){
		$return=false;
		
		include('../config/db.config.php');
		$sql="EXEC [PS_GameLog].[dbo].[Select_Boss_Records]";
				
		$exec=odbc_exec($dbConn,$sql);
		if($exec){	
			$return=array();
			$cnt=0;
			while($results=odbc_fetch_array($exec)){
				//$return["BossData"]=get_monster_by_id($results["MobID"]);
				foreach($results as $key=>$value){
					if(!isset($return[$key])){$return[$key]=array();}
					$return[$key][].=$value;
				}
				$cnt++;
			}
		}
		//echo json_encode($return);
		return $return;
		odbc_free_result($exec);
		odbc_close($dbConn);
	}
}
// Usage
$boss_records=get_records();
$ret.='<h1>Boss Records</h1>';
$ret.='<table width="100%" class="selectable">';
$ret.='<tr><th>Boss</th><th>Killer</th><th>Death</th><th>Spawn</th></tr>';
for($i=0;$i<count($boss_records["RowID"]); $i++){
	$ret.='<tr>';
	$ret.='<td>'.$boss_records["MobName"][$i].'</td>';
	$ret.='<td>'.($boss_records["Killer"][$i]!==''?$boss_records["Killer"][$i]:'Unknown').'</td>';
	$ret.='<td align="right">'.($boss_records["LastDeath"][$i]!==''? format_datetimetostring($boss_records["LastDeath"][$i]):'Unknown').'</td>';
	$ret.='<td align="right">'.($boss_records["NextSpawn"][$i]!==''?format_datetimetostring($boss_records["NextSpawn"][$i]):'Spawned').'</td></tr>';
}
$ret.='</table>';
?>
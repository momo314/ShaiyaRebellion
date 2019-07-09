<?php 

/*
DESC: 			Please provide the items id that you don't wish on the select list
INCLUDED BY: 	dropfinder.php
CREATOR:		Trayne01
LAST DATE:		27/07/2016 4 h 46 pm
*/



/*-----------CHANGE BELLOW--------------*/
//leave $item_blacklist = ''; if you don't want to use it
$item_blacklist = '(98005,98006,98007,98009,98012,98018,98019,98020,98025,98022,98013,98010,98011,98001,98002,98014,98015,98026,98023,98024,98004,98008,98021,98017,98003,98016,38147,38149,38151,38150,38148,72037,87037,87017,87057,72017,72057,38170,38170,44032,44039,44033,44034,44035,44036,44037,44038,44040,44041,41164,44138,44141)';
/*--------------------------------------*/



if ($item_blacklist == ''){
	$item_blacklist = '(0)';
}
?>

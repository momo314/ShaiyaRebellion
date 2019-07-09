<?php 

/*
DESC: 			Please provide your database password, user and ip.
INCLUDED BY: 	dropfinder.php
CREATOR:		Trayne01
LAST DATE:		27/07/2016 4 h 37 pm
*/
/*-----------CHANGE BELLOW--------------*/
$sqlUser = "sa";		//<-- your sql server account
$sqlPass = "123456";		//<-- your sql server password
$sqlHost = "127.0.0.1";		//<-- change to your sql server ip (if not hosted on the same machine)
$databaseg = "PS_GameDefs";	//<-- don't change if you are not using custom dbs
/*--------------------------------------*/



$odb_conn = odbc_connect("Driver={SQL Server Native Client 11.0};Server=$sqlHost;Database=$databaseg;", $sqlUser, $sqlPass); 
?>

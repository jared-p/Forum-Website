<?php
	$username = "SA";
	$password = "YourStrong@Passw0rd";
	$database = "tempdb";
	$server = "db";
	$connectionInfo = array( "Database"=>$database, "UID"=>$username, "PWD"=>$password, "CharacterSet" => "UTF-8");
	$con = sqlsrv_connect($server, $connectionInfo);
    if( $con === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
?>
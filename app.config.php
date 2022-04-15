<?php

error_reporting(E_ALL ^ E_NOTICE);

$DB['server'] = 'localhost';
$DB['user'] = '';//Enter user name for database
$DB['password'] = '';//Enter password for database
$DB['db'] = '';//Enter the name of database

try 
{
	$conn = new PDO("mysql:host=".$DB['server'].";dbname=".$DB['db'],
	                $DB['user'],
					$DB['password']);
					
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	
}
catch (PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
	exit();
}
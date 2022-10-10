<?php

$dbCoonnection = [
    'host' => '127.0.0.1',
    'user' => 'root',
    'password' => '',
    'database' => 'vor2'
];

$dbConn= new mysqli($dbCoonnection['host'],
                    $dbCoonnection['user'],
                    $dbCoonnection['password'],
                    $dbCoonnection['database']);

if($dbConn->connect_error){
    die("Error connection to database ".$dbConn->connect_error);
}


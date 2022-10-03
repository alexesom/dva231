<?php

$server = 'localhost';
$user = 'root';
$password = '';
$base = 'nasa_assignment';

$connection = new mysqli($server, $user, $password, $base);

    if(!$connection->connect_error)
    {
        return true;
    }
    else{
        die("Error! ". $connection->connect_error);
    }

?>
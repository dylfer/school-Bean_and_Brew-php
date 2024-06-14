<?php

$mysqli = new mysqli("localhost", "root", "", "login_system"); 

if ($mysqli->connect_error) { die("Connection failed: " . $mysqli->connect_error); } 

?>
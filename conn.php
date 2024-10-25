<?php
$server = "localhost";

$user = "postgres";
$password = "Superp@ss123";
$dbname = "boutique";

$conn = new PDO("pgsql:host=$server;dbname=$dbname", $user, $password);


$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "Connected successfully";
// 

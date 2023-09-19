<?php 

$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'recetas';

try {
    $conn =  new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo '';
} catch (PDOException $e) {
    echo 'Failed' . $e;
}

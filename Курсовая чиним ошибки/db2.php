<?php
// db.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CustomWorldTest";

$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}
?>

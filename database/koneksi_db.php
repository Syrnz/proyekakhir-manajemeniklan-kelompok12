<?php
$dsn = "mysql:host=localhost;dbname=manajemen_iklan;charset=utf8mb4";
$dbuser = "root";
$dbpass = "";

try {
    $conn = new PDO($dsn, $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
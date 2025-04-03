<?php
$host = '127.0.0.1';
$dbname = 's2754638_website';
$username = 's2754638';
$password = 'Kavyamg123!@#';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}

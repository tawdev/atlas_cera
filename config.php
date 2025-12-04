<?php
/**
 * Database configuration for Atlas Cera.
 * Update the DSN, username and password to match your MySQL setup.
 */

$dbHost = '127.0.0.1';
$dbName = 'u627894251_atlas';
$dbUser = 'u627894251_atlascera';
$dbPass = 'Atlascera212@';
$dbCharset = 'utf8mb4';
$adminUsername = 'atlas_admin'; // Change this in production
$adminPassword = 'atlas_admin2025'; // Change this in production

$dsn = "mysql:host={$dbHost};dbname={$dbName};charset={$dbCharset}";
$pdoOptions = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, $pdoOptions);
} catch (PDOException $e) {
    // You can log the error message and show a generic alert on the page.
    error_log('Database connection failed: ' . $e->getMessage());
    $pdo = null;
}


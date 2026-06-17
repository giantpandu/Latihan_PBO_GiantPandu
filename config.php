<?php
/**
 * Application Configuration
 * 
 * Centralized configuration for database and application settings.
 * This separates configuration from business logic and presentation layer.
 * 
 * Best Practice: In production, move sensitive data to .env file or environment variables
 */

return [
    // Database Configuration
    'database' => [
        'host' => $_ENV['DB_HOST'] ?? 'localhost',
        'username' => $_ENV['DB_USER'] ?? 'root',
        'password' => $_ENV['DB_PASS'] ?? '',
        'name' => $_ENV['DB_NAME'] ?? 'db_latihan_pbo_trpl1b_giant_pandu_titisan_budiansyah',
        'charset' => 'utf8mb4',
    ],

    // Application Settings
    'app' => [
        'debug' => $_ENV['APP_DEBUG'] ?? true,
        'timezone' => 'Asia/Jakarta',
    ],

    // PDO Options
    'pdo' => [
        'errmode' => PDO::ERRMODE_EXCEPTION,
        'default_fetch_mode' => PDO::FETCH_ASSOC,
        'emulate_prepares' => false,
    ],
];

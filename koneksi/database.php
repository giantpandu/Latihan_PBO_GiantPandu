<?php

class Database {
    private string $host;
    private string $username;
    private string $password;
    private string $dbName;
    private ?PDO $pdo = null;

    /**
     * Constructor untuk menginisialisasi koneksi database
     * 
     * @param array $config Database configuration array
     */
    public function __construct(array $config) {
        $this->host = $config['host'] ?? 'localhost';
        $this->username = $config['username'] ?? 'root';
        $this->password = $config['password'] ?? '';
        $this->dbName = $config['name'] ?? 'db_latihan_pbo_trpl1b_giant_pandu_titisan_budiansyah';
        
        $this->connect();
    }

    /**
     * Membuat koneksi ke database menggunakan PDO
     * 
     * @throws PDOException Jika koneksi gagal
     */
    private function connect(): void {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4";
            
            $this->pdo = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die("Koneksi Database Gagal: " . $e->getMessage());
        }
    }

    /**
     * Mendapatkan instance PDO
     * 
     * @return PDO Objek PDO untuk melakukan query
     */
    public function getConnection(): PDO {
        return $this->pdo;
    }

    /**
     * Menutup koneksi database
     */
    public function closeConnection(): void {
        $this->pdo = null;
    }
}

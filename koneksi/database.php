<?php

class Database {
    private string $host = 'localhost';
    private string $username = 'root';
    private string $password = '';
    private string $dbName = 'DB_LATIHAN_PBO_TRPL1B_GiantPandu';
    private ?PDO $pdo = null;

    /**
     * Constructor untuk menginisialisasi koneksi database
     * 
     * @param string|null $customDbName Nama database custom (opsional)
     */
    public function __construct(?string $customDbName = null) {
        if ($customDbName !== null) {
            $this->dbName = $customDbName;
        }
        
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

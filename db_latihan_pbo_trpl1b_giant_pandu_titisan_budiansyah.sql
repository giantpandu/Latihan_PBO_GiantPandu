-- =====================================================
-- Cinema Ticket Management System - Database Setup
-- =====================================================
-- Complete SQL script to create database, table, and sample data
-- Run this script in phpMyAdmin or HeidiSQL

-- Step 1: Create Database (if not exists)
CREATE DATABASE IF NOT EXISTS `db_latihan_pbo_trpl1b_giantpandu` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Step 2: EXPLICITLY select the database
USE `db_latihan_pbo_trpl1b_giantpandu`;

-- Step 3: Drop existing table (to avoid schema conflicts)
DROP TABLE IF EXISTS `tabel_tiket`;

-- Step 4: Create tabel_tiket Table with correct schema
CREATE TABLE `tabel_tiket` (
    `id_tiket` INT PRIMARY KEY AUTO_INCREMENT,
    `nama_film` VARCHAR(100) NOT NULL,
    `jadwal_tayang` DATETIME NOT NULL,
    `jumlah_kursi` INT NOT NULL,
    `harga_dasar_tiket` DECIMAL(10, 2) NOT NULL,
    `jenis_studio` ENUM('Regular', 'IMAX', 'Velvet') NOT NULL,
    
    -- Specific properties for ticket types (all nullable)
    `tipe_audio` VARCHAR(50),
    `lokasi_baris` VARCHAR(10),
    `kacamata_3d_id` VARCHAR(50),
    `efek_gerak_fitur` VARCHAR(50),
    `bantal_selimut_pack` VARCHAR(50),
    `layanan_butler` VARCHAR(50),
    
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    KEY `idx_jenis_studio` (`jenis_studio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Step 5: Insert 20 Sample Data Rows
-- Distributed: 7 Regular, 6 IMAX, 7 Velvet
-- =====================================================

INSERT INTO `tabel_tiket` (
    `nama_film`, `jadwal_tayang`, `jumlah_kursi`, `harga_dasar_tiket`,
    `jenis_studio`, `tipe_audio`, `lokasi_baris`,
    `kacamata_3d_id`, `efek_gerak_fitur`,
    `bantal_selimut_pack`, `layanan_butler`
) VALUES
-- Regular Tickets (7 rows)
('Avengers: Endgame', '2024-06-17 10:00:00', 2, 50000, 'Regular', 'Dolby Digital', 'A', NULL, NULL, NULL, NULL),
('The Dark Knight', '2024-06-17 13:00:00', 3, 50000, 'Regular', 'Stereo', 'B', NULL, NULL, NULL, NULL),
('Inception', '2024-06-17 16:00:00', 4, 50000, 'Regular', 'Dolby Digital', 'C', NULL, NULL, NULL, NULL),
('Interstellar', '2024-06-17 19:00:00', 2, 50000, 'Regular', 'Stereo', 'D', NULL, NULL, NULL, NULL),
('The Matrix', '2024-06-18 10:00:00', 3, 50000, 'Regular', 'Dolby Digital', 'A', NULL, NULL, NULL, NULL),
('Pulp Fiction', '2024-06-18 13:00:00', 2, 50000, 'Regular', 'Stereo', 'B', NULL, NULL, NULL, NULL),
('Forrest Gump', '2024-06-18 16:00:00', 4, 50000, 'Regular', 'Dolby Digital', 'E', NULL, NULL, NULL, NULL),

-- IMAX Tickets (6 rows)
('Avatar', '2024-06-17 11:00:00', 2, 75000, 'IMAX', NULL, NULL, 'IMAX-3D-001', 'Motion Seats', NULL, NULL),
('Dune', '2024-06-17 14:00:00', 3, 75000, 'IMAX', NULL, NULL, 'IMAX-3D-002', 'XPlus', NULL, NULL),
('Avatar 2', '2024-06-17 17:00:00', 2, 75000, 'IMAX', NULL, NULL, 'IMAX-3D-003', 'Motion Seats', NULL, NULL),
('Jungle Book', '2024-06-18 11:00:00', 3, 75000, 'IMAX', NULL, NULL, 'IMAX-3D-004', 'XPlus', NULL, NULL),
('Twisters', '2024-06-18 14:00:00', 2, 75000, 'IMAX', NULL, NULL, 'IMAX-3D-005', 'Motion Seats', NULL, NULL),
('Mission Impossible 7', '2024-06-18 17:00:00', 4, 75000, 'IMAX', NULL, NULL, 'IMAX-3D-006', 'XPlus', NULL, NULL),

-- Velvet Tickets (7 rows)
('La La Land', '2024-06-17 12:00:00', 2, 100000, 'Velvet', NULL, NULL, NULL, NULL, 'Premium', 'Full Service'),
('The Grand Budapest Hotel', '2024-06-17 15:00:00', 3, 100000, 'Velvet', NULL, NULL, NULL, NULL, 'Standard', 'Partial'),
('Parasite', '2024-06-17 18:00:00', 2, 100000, 'Velvet', NULL, NULL, NULL, NULL, 'Premium', 'Full Service'),
('Moonlight', '2024-06-18 12:00:00', 2, 100000, 'Velvet', NULL, NULL, NULL, NULL, 'Premium', 'Full Service'),
('Arrival', '2024-06-18 15:00:00', 3, 100000, 'Velvet', NULL, NULL, NULL, NULL, 'Standard', 'Partial'),
('Blade Runner 2049', '2024-06-18 18:00:00', 2, 100000, 'Velvet', NULL, NULL, NULL, NULL, 'Premium', 'Full Service'),
('Oppenheimer', '2024-06-19 12:00:00', 4, 100000, 'Velvet', NULL, NULL, NULL, NULL, 'Standard', 'Partial');

-- =====================================================
-- Verification: View all inserted data
-- =====================================================
-- SELECT * FROM `tabel_tiket` ORDER BY `jenis_studio`, `id_tiket`;

<?php
/**
 * Cinema Ticket Management System - Main View
 * Stage 6: Interface (View) & Dynamic Polymorphism
 * 
 * This script fetches ticket data from database and displays them
 * grouped by studio type using polymorphic calls.
 */

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
require_once __DIR__ . '/koneksi/database.php';

// Include abstract class and concrete subclasses
require_once __DIR__ . '/Tiket.php';
require_once __DIR__ . '/TiketRegular.php';
require_once __DIR__ . '/TiketIMAX.php';
require_once __DIR__ . '/TiketVelvet.php';

// Initialize database connection (update 'GiantPandu' with your name if different)
$db = new Database('DB_LATIHAN_PBO_TRPL1B_GiantPandu');
$pdo = $db->getConnection();

// Arrays to group tickets by studio type
$tiketRegular = [];
$tiketImax = [];
$tiketVelvet = [];

try {
    // Fetch all tickets from database
    $query = "SELECT * FROM tabel_tiket ORDER BY jenis_studio, id_tiket";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll();

    // Factory pattern: Instantiate appropriate object based on jenis_studio
    foreach ($data as $row) {
        $jenis_studio = strtolower($row['jenis_studio'] ?? '');

        if ($jenis_studio === 'regular') {
            $tiket = new TiketRegular(
                (int) $row['id_tiket'],
                (string) $row['nama_film'],
                (string) $row['jadwal_tayang'],
                (int) $row['jumlah_kursi'],
                (float) $row['hargaDasarTiket'],
                (string) $row['tipeAudio'],
                (string) $row['lokasiBaris']
            );
            $tiketRegular[] = $tiket;
        } elseif ($jenis_studio === 'imax') {
            $tiket = new TiketIMAX(
                (int) $row['id_tiket'],
                (string) $row['nama_film'],
                (string) $row['jadwal_tayang'],
                (int) $row['jumlah_kursi'],
                (float) $row['hargaDasarTiket'],
                (string) $row['kacamata3dId'],
                (string) $row['efekGerakFitur']
            );
            $tiketImax[] = $tiket;
        } elseif ($jenis_studio === 'velvet') {
            $tiket = new TiketVelvet(
                (int) $row['id_tiket'],
                (string) $row['nama_film'],
                (string) $row['jadwal_tayang'],
                (int) $row['jumlah_kursi'],
                (float) $row['hargaDasarTiket'],
                (string) $row['bantalSelimutPack'],
                (string) $row['layananButler']
            );
            $tiketVelvet[] = $tiket;
        }
    }
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Tiket Bioskop</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            color: white;
            margin-bottom: 50px;
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .studio-section {
            margin-bottom: 40px;
        }

        .studio-title {
            background: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            border-left: 5px solid #667eea;
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .studio-title.imax {
            border-left-color: #f59e0b;
        }

        .studio-title.velvet {
            border-left-color: #ec4899;
        }

        .table-wrapper {
            background: white;
            border-radius: 0 0 8px 8px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f3f4f6;
            border-bottom: 2px solid #e5e7eb;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            color: #4b5563;
        }

        tbody tr:hover {
            background: #f9fafb;
            transition: background 0.2s ease;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .film-name {
            font-weight: 600;
            color: #1f2937;
        }

        .schedule {
            font-size: 0.9rem;
            color: #6b7280;
        }

        .facilities {
            font-size: 0.9rem;
            color: #4b5563;
            line-height: 1.6;
        }

        .price {
            font-weight: 700;
            color: #059669;
            font-size: 1.05rem;
        }

        .empty-message {
            background: white;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            color: #6b7280;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .rupiah {
            font-size: 0.85rem;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.8rem;
            }

            th, td {
                padding: 10px;
                font-size: 0.85rem;
            }

            .price {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🎬 Sistem Manajemen Tiket Bioskop</h1>
            <p>Tampilan Tiket Berdasarkan Jenis Studio</p>
        </div>

        <!-- Studio Regular Section -->
        <div class="studio-section">
            <div class="studio-title">Studio Regular</div>
            <div class="table-wrapper">
                <?php if (empty($tiketRegular)): ?>
                    <div class="empty-message">Tidak ada tiket untuk Studio Regular</div>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID Tiket</th>
                                <th>Film</th>
                                <th>Jadwal Tayang</th>
                                <th>Jumlah Kursi</th>
                                <th>Harga Dasar</th>
                                <th>Fasilitas</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tiketRegular as $tiket): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars((string) $tiket->getIdTiket()); ?></td>
                                    <td class="film-name"><?php echo htmlspecialchars($tiket->getNamaFilm()); ?></td>
                                    <td class="schedule"><?php echo htmlspecialchars($tiket->getJadwalTayang()); ?></td>
                                    <td><?php echo htmlspecialchars((string) $tiket->getJumlahKursi()); ?></td>
                                    <td>Rp<?php echo number_format($tiket->getHargaDasarTiket(), 0, ',', '.'); ?></td>
                                    <td class="facilities">
                                        <?php $tiket->tampilkanInfoFasilitas(); ?>
                                    </td>
                                    <td class="price">Rp<?php echo number_format($tiket->hitungTotalHarga(), 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>

        <!-- Studio IMAX Section -->
        <div class="studio-section">
            <div class="studio-title imax">Studio IMAX</div>
            <div class="table-wrapper">
                <?php if (empty($tiketImax)): ?>
                    <div class="empty-message">Tidak ada tiket untuk Studio IMAX</div>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID Tiket</th>
                                <th>Film</th>
                                <th>Jadwal Tayang</th>
                                <th>Jumlah Kursi</th>
                                <th>Harga Dasar</th>
                                <th>Fasilitas</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tiketImax as $tiket): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars((string) $tiket->getIdTiket()); ?></td>
                                    <td class="film-name"><?php echo htmlspecialchars($tiket->getNamaFilm()); ?></td>
                                    <td class="schedule"><?php echo htmlspecialchars($tiket->getJadwalTayang()); ?></td>
                                    <td><?php echo htmlspecialchars((string) $tiket->getJumlahKursi()); ?></td>
                                    <td>Rp<?php echo number_format($tiket->getHargaDasarTiket(), 0, ',', '.'); ?></td>
                                    <td class="facilities">
                                        <?php $tiket->tampilkanInfoFasilitas(); ?>
                                    </td>
                                    <td class="price">Rp<?php echo number_format($tiket->hitungTotalHarga(), 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>

        <!-- Studio Velvet Section -->
        <div class="studio-section">
            <div class="studio-title velvet">Studio Velvet</div>
            <div class="table-wrapper">
                <?php if (empty($tiketVelvet)): ?>
                    <div class="empty-message">Tidak ada tiket untuk Studio Velvet</div>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID Tiket</th>
                                <th>Film</th>
                                <th>Jadwal Tayang</th>
                                <th>Jumlah Kursi</th>
                                <th>Harga Dasar</th>
                                <th>Fasilitas</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tiketVelvet as $tiket): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars((string) $tiket->getIdTiket()); ?></td>
                                    <td class="film-name"><?php echo htmlspecialchars($tiket->getNamaFilm()); ?></td>
                                    <td class="schedule"><?php echo htmlspecialchars($tiket->getJadwalTayang()); ?></td>
                                    <td><?php echo htmlspecialchars((string) $tiket->getJumlahKursi()); ?></td>
                                    <td>Rp<?php echo number_format($tiket->getHargaDasarTiket(), 0, ',', '.'); ?></td>
                                    <td class="facilities">
                                        <?php $tiket->tampilkanInfoFasilitas(); ?>
                                    </td>
                                    <td class="price">Rp<?php echo number_format($tiket->hitungTotalHarga(), 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>

    </div>
</body>
</html>

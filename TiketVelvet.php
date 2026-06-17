<?php

class TiketVelvet extends Tiket {
    protected string $bantalSelimutPack;
    protected string $layananButler;

    /**
     * Constructor untuk menginisialisasi TiketVelvet dengan semua properties
     * 
     * @param int $id_tiket ID unik tiket
     * @param string $nama_film Nama film yang ditayangkan
     * @param string $jadwal_tayang Jadwal tayang film (format: YYYY-MM-DD HH:MM)
     * @param int $jumlah_kursi Jumlah kursi yang dipesan
     * @param float $hargaDasarTiket Harga dasar per tiket
     * @param string $bantalSelimutPack Paket bantal dan selimut (contoh: "Premium", "Standard")
     * @param string $layananButler Layanan butler (contoh: "Full Service", "Partial")
     */
    public function __construct(
        int $id_tiket,
        string $nama_film,
        string $jadwal_tayang,
        int $jumlah_kursi,
        float $hargaDasarTiket,
        string $bantalSelimutPack,
        string $layananButler
    ): void {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->bantalSelimutPack = $bantalSelimutPack;
        $this->layananButler = $layananButler;
    }

    /**
     * Menghitung total harga tiket velvet
     * Formula: Total = (jumlah_kursi * hargaDasarTiket) * 1.50
     * Adds a 50% premium class surcharge on top of the base price
     * 
     * @return float Total harga tiket
     */
    public function hitungTotalHarga(): float {
        return (float) (($this->jumlah_kursi * $this->hargaDasarTiket) * 1.50);
    }

    /**
     * Menampilkan informasi fasilitas tiket velvet (placeholder)
     * 
     * @return void
     */
    public function tampilkanInfoFasilitas(): void {
        // Placeholder implementation
    }

    /**
     * Getter untuk bantalSelimutPack
     * 
     * @return string Paket bantal dan selimut
     */
    protected function getBantalSelimutPack(): string {
        return $this->bantalSelimutPack;
    }

    /**
     * Getter untuk layananButler
     * 
     * @return string Layanan butler
     */
    protected function getLayananButler(): string {
        return $this->layananButler;
    }
}

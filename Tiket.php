<?php

abstract class Tiket {
    protected int $id_tiket;
    protected string $nama_film;
    protected string $jadwal_tayang;
    protected int $jumlah_kursi;
    protected float $hargaDasarTiket;

    /**
     * Constructor untuk menginisialisasi semua properties
     * 
     * @param int $id_tiket ID unik tiket
     * @param string $nama_film Nama film yang ditayangkan
     * @param string $jadwal_tayang Jadwal tayang film (format: YYYY-MM-DD HH:MM)
     * @param int $jumlah_kursi Jumlah kursi yang dipesan
     * @param float $hargaDasarTiket Harga dasar per tiket
     */
    public function __construct(
        int $id_tiket,
        string $nama_film,
        string $jadwal_tayang,
        int $jumlah_kursi,
        float $hargaDasarTiket
    ) {
        $this->id_tiket = $id_tiket;
        $this->nama_film = $nama_film;
        $this->jadwal_tayang = $jadwal_tayang;
        $this->jumlah_kursi = $jumlah_kursi;
        $this->hargaDasarTiket = $hargaDasarTiket;
    }

    /**
     * Method abstrak untuk menghitung total harga tiket
     * Harus diimplementasikan oleh class turunan dengan perhitungan spesifik
     * 
     * @return float Total harga tiket
     */
    abstract public function hitungTotalHarga(): float;

    /**
     * Method abstrak untuk menampilkan informasi fasilitas tiket
     * Harus diimplementasikan oleh class turunan dengan detail fasilitas spesifik
     * 
     * @return void
     */
    abstract public function tampilkanInfoFasilitas(): void;

    /**
     * Getter untuk id_tiket
     * Public access for Presentation Layer
     * 
     * @return int ID tiket
     */
    public function getIdTiket(): int {
        return $this->id_tiket;
    }

    /**
     * Getter untuk nama_film
     * Public access for Presentation Layer
     * 
     * @return string Nama film
     */
    public function getNamaFilm(): string {
        return $this->nama_film;
    }

    /**
     * Getter untuk jadwal_tayang
     * Public access for Presentation Layer
     * 
     * @return string Jadwal tayang
     */
    public function getJadwalTayang(): string {
        return $this->jadwal_tayang;
    }

    /**
     * Getter untuk jumlah_kursi
     * Public access for Presentation Layer
     * 
     * @return int Jumlah kursi
     */
    public function getJumlahKursi(): int {
        return $this->jumlah_kursi;
    }

    /**
     * Getter untuk hargaDasarTiket
     * Public access for Presentation Layer
     * 
     * @return float Harga dasar tiket
     */
    public function getHargaDasarTiket(): float {
        return $this->hargaDasarTiket;
    }
}

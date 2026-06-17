<?php

class TiketRegular extends Tiket {
    protected string $tipeAudio;
    protected string $lokasiBaris;

    /**
     * Constructor untuk menginisialisasi TiketRegular dengan semua properties
     * 
     * @param int $id_tiket ID unik tiket
     * @param string $nama_film Nama film yang ditayangkan
     * @param string $jadwal_tayang Jadwal tayang film (format: YYYY-MM-DD HH:MM)
     * @param int $jumlah_kursi Jumlah kursi yang dipesan
     * @param float $hargaDasarTiket Harga dasar per tiket
     * @param string $tipeAudio Tipe audio (contoh: "Dolby Digital", "Stereo")
     * @param string $lokasiBaris Lokasi baris kursi (contoh: "A", "B", "C")
     */
    public function __construct(
        int $id_tiket,
        string $nama_film,
        string $jadwal_tayang,
        int $jumlah_kursi,
        float $hargaDasarTiket,
        string $tipeAudio,
        string $lokasiBaris
    ): void {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->tipeAudio = $tipeAudio;
        $this->lokasiBaris = $lokasiBaris;
    }

    /**
     * Menghitung total harga tiket regular (placeholder)
     * 
     * @return float Total harga tiket
     */
    public function hitungTotalHarga(): float {
        return 0.0;
    }

    /**
     * Menampilkan informasi fasilitas tiket regular (placeholder)
     * 
     * @return void
     */
    public function tampilkanInfoFasilitas(): void {
        // Placeholder implementation
    }

    /**
     * Getter untuk tipeAudio
     * 
     * @return string Tipe audio
     */
    protected function getTipeAudio(): string {
        return $this->tipeAudio;
    }

    /**
     * Getter untuk lokasiBaris
     * 
     * @return string Lokasi baris
     */
    protected function getLokasiBaris(): string {
        return $this->lokasiBaris;
    }
}

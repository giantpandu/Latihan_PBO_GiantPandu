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
    ) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->tipeAudio = $tipeAudio;
        $this->lokasiBaris = $lokasiBaris;
    }

    /**
     * Static Factory Method: Instantiate from database row with validation
     * Defensively handles missing or null values
     * 
     * @param array $data Database row data (associative array)
     * @return self New TiketRegular instance
     * @throws InvalidArgumentException If required fields are missing
     */
    public static function fromDatabaseRow(array $data): self {
        // Validate required fields
        $required = ['id_tiket', 'nama_film', 'jadwal_tayang', 'jumlah_kursi', 'harga_dasar_tiket', 'tipe_audio', 'lokasi_baris'];
        foreach ($required as $field) {
            if (!isset($data[$field]) || $data[$field] === null || $data[$field] === '') {
                throw new InvalidArgumentException("Field '{$field}' is required for TiketRegular");
            }
        }

        return new self(
            (int) $data['id_tiket'],
            (string) $data['nama_film'],
            (string) $data['jadwal_tayang'],
            (int) $data['jumlah_kursi'],
            (float) $data['harga_dasar_tiket'],
            (string) $data['tipe_audio'],
            (string) $data['lokasi_baris']
        );
    }

    /**
     * Menghitung total harga tiket regular
     * Formula: Total = jumlah_kursi * hargaDasarTiket
     * 
     * @return float Total harga tiket
     */
    public function hitungTotalHarga(): float {
        return (float) ($this->jumlah_kursi * $this->hargaDasarTiket);
    }

    /**
     * Menampilkan informasi fasilitas tiket regular
     * Outputs the specific facilities for regular tickets
     * 
     * @return void
     */
    public function tampilkanInfoFasilitas(): void {
        echo "<strong>Fasilitas:</strong> Tipe Audio: {$this->tipeAudio} | Lokasi Baris: {$this->lokasiBaris}";
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

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
    ) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->bantalSelimutPack = $bantalSelimutPack;
        $this->layananButler = $layananButler;
    }

    /**
     * Static Factory Method: Instantiate from database row with validation
     * Defensively handles missing or null values
     * 
     * @param array $data Database row data (associative array)
     * @return self New TiketVelvet instance
     * @throws InvalidArgumentException If required fields are missing
     */
    public static function fromDatabaseRow(array $data): self {
        // Validate required fields
        $required = ['id_tiket', 'nama_film', 'jadwal_tayang', 'jumlah_kursi', 'harga_dasar_tiket', 'bantal_selimut_pack', 'layanan_butler'];
        foreach ($required as $field) {
            if (!isset($data[$field]) || $data[$field] === null || $data[$field] === '') {
                throw new InvalidArgumentException("Field '{$field}' is required for TiketVelvet");
            }
        }

        return new self(
            (int) $data['id_tiket'],
            (string) $data['nama_film'],
            (string) $data['jadwal_tayang'],
            (int) $data['jumlah_kursi'],
            (float) $data['harga_dasar_tiket'],
            (string) $data['bantal_selimut_pack'],
            (string) $data['layanan_butler']
        );
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
     * Menampilkan informasi fasilitas tiket velvet
     * Outputs the specific facilities for velvet tickets
     * 
     * @return void
     */
    public function tampilkanInfoFasilitas(): void {
        echo "<strong>Fasilitas:</strong> Paket Bantal & Selimut: {$this->bantalSelimutPack} | Layanan Butler: {$this->layananButler}";
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

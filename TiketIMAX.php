<?php

class TiketIMAX extends Tiket {
    protected string $kacamata3dId;
    protected string $efekGerakFitur;

    /**
     * Constructor untuk menginisialisasi TiketIMAX dengan semua properties
     * 
     * @param int $id_tiket ID unik tiket
     * @param string $nama_film Nama film yang ditayangkan
     * @param string $jadwal_tayang Jadwal tayang film (format: YYYY-MM-DD HH:MM)
     * @param int $jumlah_kursi Jumlah kursi yang dipesan
     * @param float $hargaDasarTiket Harga dasar per tiket
     * @param string $kacamata3dId ID kacamata 3D (contoh: "IMAX-3D-001")
     * @param string $efekGerakFitur Fitur efek gerak (contoh: "Motion Seats", "XPlus")
     */
    public function __construct(
        int $id_tiket,
        string $nama_film,
        string $jadwal_tayang,
        int $jumlah_kursi,
        float $hargaDasarTiket,
        string $kacamata3dId,
        string $efekGerakFitur
    ) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->kacamata3dId = $kacamata3dId;
        $this->efekGerakFitur = $efekGerakFitur;
    }

    /**
     * Static Factory Method: Instantiate from database row with validation
     * Defensively handles missing or null values
     * 
     * @param array $data Database row data (associative array)
     * @return self New TiketIMAX instance
     * @throws InvalidArgumentException If required fields are missing
     */
    public static function fromDatabaseRow(array $data): self {
        // Validate required fields
        $required = ['id_tiket', 'nama_film', 'jadwal_tayang', 'jumlah_kursi', 'harga_dasar_tiket', 'kacamata_3d_id', 'efek_gerak_fitur'];
        foreach ($required as $field) {
            if (!isset($data[$field]) || $data[$field] === null || $data[$field] === '') {
                throw new InvalidArgumentException("Field '{$field}' is required for TiketIMAX");
            }
        }

        return new self(
            (int) $data['id_tiket'],
            (string) $data['nama_film'],
            (string) $data['jadwal_tayang'],
            (int) $data['jumlah_kursi'],
            (float) $data['harga_dasar_tiket'],
            (string) $data['kacamata_3d_id'],
            (string) $data['efek_gerak_fitur']
        );
    }

    /**
     * Menghitung total harga tiket IMAX
     * Formula: Total = (jumlah_kursi * hargaDasarTiket) + 35000
     * Adds a flat fee of Rp35,000 for IMAX projection and audio technology
     * 
     * @return float Total harga tiket
     */
    public function hitungTotalHarga(): float {
        return (float) (($this->jumlah_kursi * $this->hargaDasarTiket) + 35000);
    }

    /**
     * Menampilkan informasi fasilitas tiket IMAX
     * Outputs the specific facilities for IMAX tickets
     * 
     * @return void
     */
    public function tampilkanInfoFasilitas(): void {
        echo "<strong>Fasilitas:</strong> Kacamata 3D ID: {$this->kacamata3dId} | Efek Gerak: {$this->efekGerakFitur}";
    }

    /**
     * Getter untuk kacamata3dId
     * 
     * @return string ID kacamata 3D
     */
    protected function getKacamata3dId(): string {
        return $this->kacamata3dId;
    }

    /**
     * Getter untuk efekGerakFitur
     * 
     * @return string Fitur efek gerak
     */
    protected function getEfekGerakFitur(): string {
        return $this->efekGerakFitur;
    }
}

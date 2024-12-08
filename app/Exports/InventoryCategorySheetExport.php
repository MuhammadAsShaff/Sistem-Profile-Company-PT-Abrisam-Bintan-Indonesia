<?php
namespace App\Exports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class InventoryCategorySheetExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithEvents, WithTitle
{
    protected $category;
    protected $type; // Inventory Masuk atau Keluar
    protected $rowNumber; // Untuk melacak nomor baris

    public function __construct($category, $type)
    {
        $this->category = $category;
        $this->type = $type;
        $this->rowNumber = 0; // Mulai dari 0 untuk penomoran
    }

    public function collection()
    {
        // Reset nomor baris
        $this->rowNumber = 0;

        // Filter data berdasarkan jenis inventory
        if ($this->type === 'Masuk') {
            return Stock::whereNotNull('id_inventoryMasuk')
                ->where('kategoriProduk', $this->category)
                ->get(['kategoriProduk', 'nomorProduk', 'keterangan', 'updated_at']);
        } elseif ($this->type === 'Keluar') {
            return Stock::whereNotNull('id_inventoryKeluar')
                ->where('kategoriProduk', $this->category)
                ->get(['kategoriProduk', 'nomorProduk', 'keterangan', 'updated_at']);
        }

        // Jika tipe tidak valid, kembalikan koleksi kosong
        return collect([]);
    }

    public function headings(): array
    {
        return ['Nomor', 'Kategori Produk', 'Nomor Produk', 'Keterangan', 'Tanggal'];
    }

    public function map($row): array
    {
        return [
            ++$this->rowNumber, // Nomor otomatis dimulai dari 1
            $row->kategoriProduk,
            $row->nomorProduk,
            $row->keterangan ?? '-',
            date('d-m-Y', strtotime($row->updated_at)), // Format tanggal
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY, // Format tanggal untuk kolom E
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $totalRows = $this->collection()->count();
                $lastRow = $totalRows + 3; // Header + Data
    
                // Tambahkan judul di baris pertama
                $sheet->setCellValue('A1', 'Data Inventory ' . $this->type);
                $sheet->mergeCells('A1:E1'); // Gabungkan kolom A sampai E
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Tambahkan header di baris kedua
                $sheet->fromArray($this->headings(), null, 'A2', true);

                // Tambahkan data dari fungsi map()
                $mappedData = $this->collection()->map(fn($row) => $this->map($row))->toArray();
                $sheet->fromArray($mappedData, null, 'A3', true);

                // Tambahkan warna header
                $sheet->getStyle('A2:E2')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FFF5C9E0'], // Warna merah muda
                    ],
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                // Tambahkan border di header dan data
                $sheet->getStyle('A2:E' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                // Tambahkan total produk di baris terakhir
                $sheet->mergeCells('A' . $lastRow . ':C' . $lastRow); // Gabungkan kolom A sampai C
                $sheet->setCellValue('A' . $lastRow, 'Total Produk:'); // Tulis "Total Produk:"
                $sheet->setCellValue('D' . $lastRow, $totalRows); // Tulis nilai total di kolom D
                $sheet->mergeCells('D' . $lastRow . ':E' . $lastRow); // Gabungkan kolom D sampai E
                $sheet->getStyle('A' . $lastRow . ':E' . $lastRow)->getFont()->setBold(true); // Bold untuk seluruh baris
            },
        ];
    }

    public function title(): string
    {
        return $this->category; // Nama sheet sesuai kategori produk
    }
}


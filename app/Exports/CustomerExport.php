<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Events\AfterSheet;

class CustomerExport implements WithMultipleSheets
{

  public function sheets(): array
  {
    return [
      'Sudah Dihubungi' => new CustomerStatusSheet('Sudah dihubungi'),
      'Belum Dihubungi' => new CustomerStatusSheet('Belum dihubungi'),
      'Dihubungi Kembali' => new CustomerStatusSheet('Dihubungi Kembali'),
    ];
  }
}

class CustomerStatusSheet implements FromCollection, WithHeadings, WithMapping, WithTitle, WithEvents
{
  protected $status;

  // Konstruktor untuk menerima status
  public function __construct($status)
  {
    $this->status = $status;
    
  }

  public function collection()
  {
    // Ambil data customer berdasarkan status
    return Customer::where('status_customer', $this->status)->get();
  }

  public function headings(): array
  {
    return [
      'NIK',
      'Nama',
      'Tanggal Mendaftar',
      'Produk',
      'Alamat ',
      'Nomor HP ',
      'Email',
      'Jenis Kelamin',
      'Provinsi',
      'Kota',
      'Kecamatan',
      'Kelurahan',
      'Kode Pos',
      'Kordinat',

    ];
  }

  public function map($customer): array
  {
   
    
    // Mengambil nama produk dari relasi berlangganan
    $produkNama = $customer->berlangganan->map(function ($berlangganan) {
      return $berlangganan->produk->nama_produk;  // Ambil nama produk
    })->join(', ');  // Gabungkan nama produk dengan koma

    $koordinat = $customer->latitude . ', ' . $customer->longitude;

    return [
      $customer->nik,
      $customer->nama_customer,
      $customer->created_at->format('d F Y'),  // Format tanggal
      $produkNama,
      $customer->alamat_customer,
      $customer->nomor_hp_customer,
      $customer->email_customer,
      $customer->jenis_kelamin,
      $customer->provinsi,
      $customer->kota,
      $customer->kecamatan,
      $customer->kelurahan,
      $customer->kode_pos,
      $koordinat,

    ];
  }

  public function title(): string
  {
    // Menggunakan status customer untuk menentukan nama sheet
    return $this->status;
  }

  // Menggunakan WithEvents untuk menambahkan border pada sheet
  public function registerEvents(): array
  {
    return [
      AfterSheet::class => function (AfterSheet $event) {
        $sheet = $event->sheet->getDelegate();

        // Menghitung jumlah total baris data
        $totalRows = $this->collection()->count();
        $lastRow = $totalRows + 3; // Menambahkan baris judul dan header
  
        // Menambahkan judul di baris pertama
        $sheet->setCellValue('A1', 'Laporan Data Customer ' . $this->status);
        $sheet->mergeCells('A1:' . $sheet->getHighestColumn() . '1'); // Gabungkan kolom A sampai E
        $sheet->getStyle('A1')->applyFromArray([
          'font' => [
            'bold' => true,
            'size' => 14,
          ],
          'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
          ],
        ]);

        // Menambahkan header pada baris kedua
        $sheet->fromArray($this->headings(), null, 'A2', true);

        // Menambahkan data dari fungsi map()
        $mappedData = $this->collection()->map(fn($row) => $this->map($row))->toArray();
        $sheet->fromArray($mappedData, null, 'A3', true);

        // Menambahkan warna dan styling pada header
        $sheet->getStyle('A2:' . $sheet->getHighestColumn() . '2')->applyFromArray([
          'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['argb' => 'FFF5C9E0'], // Warna latar belakang pink
          ],
          'font' => [
            'bold' => true,
          ],
          'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
          ],
        ]);

        // Menambahkan border di sekitar data
        $sheet->getStyle('A2:' . $sheet->getHighestColumn() . $lastRow)
          ->getBorders()
          ->getAllBorders()
          ->setBorderStyle(Border::BORDER_THIN);

        // Menambahkan baris total di bagian bawah
        $sheet->setCellValue('A' . $lastRow, 'Total Produk:');
        $sheet->mergeCells('A' . $lastRow . ':D' . $lastRow); // Gabungkan kolom A sampai C
        $sheet->setCellValue('E' . $lastRow, $totalRows); // Menambahkan nilai total
        $sheet->mergeCells('E' . $lastRow . ':N' . $lastRow); // Gabungkan kolom D dan E
        $sheet->getStyle('A' . $lastRow . ':N' . $lastRow)->applyFromArray([
          'font' => [
            'bold' => true,
          ],
          'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
          ],
        ]);
      },
    ];
    
  }

}

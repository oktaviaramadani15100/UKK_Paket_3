<?php

namespace App\Exports;

use App\Models\Foto;
use App\Models\Album;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class PelaporanExport implements FromQuery, WithHeadings
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function query()
    {
        return Album::query()->where('id', $this->id);
    }

    public function headings(): array
    {
        return [
            'No',
            'Gambar',
            'Judul Album',
            'Deskripsi',
            'Tanggal Upload',
            'User ID'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Style untuk header
                $event->sheet->getStyle('A1:F1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'], // warna teks putih
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '4285F4'], // warna latar biru
                    ],
                ]);

                // Set jarak antar baris dan lebar kolom
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(20);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(15);

                // Memasukkan gambar ke dalam sel
                $drawing = new Drawing();
                $drawing->setName('Logo');
                $drawing->setDescription('Logo');
                $drawing->setPath(public_path('upload/')); // Path menuju gambar
                $drawing->setHeight(50); // Tinggi gambar
                $drawing->setCoordinates('B2'); // Koordinat sel untuk gambar
                $drawing->setOffsetX(5); // Jarak dari kiri
                $drawing->setOffsetY(5); // Jarak dari atas
                $drawing->setWorksheet($event->sheet->getDelegate());
            },
        ];
    }
}